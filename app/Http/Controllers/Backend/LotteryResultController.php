<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Lotter;
use App\Models\Lottery_result;
use App\Models\Userpackagebuy;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LotteryResultController extends Controller
{
    // Show only active lotteries with ticket info
    public function purchasedTickets(Request $request)
    {
        $winType = $request->get('type'); // daily, 7days, etc.

        $query = Lotter::withCount('userPackageBuys')
                       ->withSum('userPackageBuys', 'price')
                       ->where('status', 'active'); // only new/active lotteries

        if ($winType) {
            $query->where('win_type', $winType);
        }

        $lotteries = $query->orderBy('created_at', 'desc')->get();

        return view('Admin.lotterywin.show', compact('lotteries', 'winType'));
    }

    // Show form to declare winners
    public function showDeclareForm($lotteryId)
    {
        $lottery = Lotter::findOrFail($lotteryId);

        $buyers = Userpackagebuy::where('package_id', $lotteryId)
            ->whereNotIn('id', function($query){
                $query->select('user_package_buy_id')->from('lottery_results');
            })
            ->with('user')
            ->get();

        return view('Admin.lotterywin.declare', compact('lottery', 'buyers'));
    }

    // Declare winners
    public function declareResult(Request $request, $lotteryId)
    {
        $request->validate([
            'random' => 'nullable|boolean',
            'first_winner' => 'nullable|exists:users,id',
            'second_winner' => 'nullable|exists:users,id',
            'third_winner' => 'nullable|exists:users,id',
            'first_prize' => 'nullable|numeric|min:0',
            'second_prize' => 'nullable|numeric|min:0',
            'third_prize' => 'nullable|numeric|min:0',
        ]);

        $prizes = [
            'first' => $request->first_prize ?? 0,
            'second' => $request->second_prize ?? 0,
            'third' => $request->third_prize ?? 0,
        ];

        $buyers = Userpackagebuy::where('package_id', $lotteryId)
            ->whereNotIn('id', function($query){
                $query->select('user_package_buy_id')->from('lottery_results');
            })
            ->pluck('user_id')->unique()->toArray();

        if (count($buyers) < 1) {
            return back()->with('error', 'No eligible buyers for this lottery.');
        }

        // Random selection
        if ($request->has('random') && $request->random == 1) {
            $selectedCount = min(3, count($buyers));
            $selected = collect($buyers)->random($selectedCount)->values();
            $winners = [
                'first' => $selected[0] ?? null,
                'second' => $selected[1] ?? null,
                'third' => $selected[2] ?? null,
            ];
        } else {
            $winners = [
                'first' => $request->first_winner,
                'second' => $request->second_winner,
                'third' => $request->third_winner,
            ];
        }

        DB::transaction(function () use ($winners, $prizes, $lotteryId) {
            foreach ($winners as $position => $userId) {
                if ($userId) {
                    $user = User::find($userId);
                    $user->increment('balance', $prizes[$position]);

                    $buy = Userpackagebuy::where('package_id', $lotteryId)
                        ->where('user_id', $userId)
                        ->first();

                    Lottery_result::create([
                        'user_package_buy_id' => $buy->id,
                        'win_status' => 'won',
                        'win_amount' => $prizes[$position],
                        'position' => $position,
                        'draw_date' => now(),
                    ]);
                }
            }

            // Non-winners
            $nonWinners = Userpackagebuy::where('package_id', $lotteryId)
                ->whereNotIn('user_id', array_filter($winners))
                ->whereNotIn('id', function($query){
                    $query->select('user_package_buy_id')->from('lottery_results');
                })
                ->get();

            foreach ($nonWinners as $ticket) {
                Lottery_result::create([
                    'user_package_buy_id' => $ticket->id,
                    'win_status' => 'lost',
                    'win_amount' => 0,
                    'position' => null,
                    'draw_date' => now(),
                ]);
            }

            // Mark lottery as completed so it disappears from admin
            $lottery = Lotter::find($lotteryId);
            $lottery->status = 'completed';
            $lottery->save();
        });

        return back()->with('success', '✅ Winners declared successfully & balances updated!');
    }
}
