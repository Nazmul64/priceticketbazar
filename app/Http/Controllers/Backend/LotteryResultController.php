<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Lotter;
use App\Models\Userpackagebuy;
use App\Models\Lottery_result;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LotteryResultController extends Controller
{
    // Show all lotteries with ticket info


    // Show form to declare winners
    public function showDeclareForm($lotteryId)
    {
        $lottery = Lotter::findOrFail($lotteryId);

        // Only buyers who have not yet won
        $buyers = Userpackagebuy::where('package_id', $lotteryId)
            ->whereDoesntHave('results')
            ->with('user')
            ->get()
            ->unique('user_id'); // One entry per user

        return view('Admin.lotterywin.declare', compact('lottery', 'buyers'));
    }

public function purchasedTickets(Request $request)
{
    $winType = $request->get('type');

    $query = Lotter::withCount(['userPackageBuys as tickets_sold' => function($q){
                    $q->whereDoesntHave('results'); // Only buyers without results
                }])
                ->withSum(['userPackageBuys as total_amount' => function($q){
                    $q->whereDoesntHave('results');
                }], 'price')
                ->orderBy('created_at', 'desc');

    if ($winType) {
        $query->where('win_type', $winType);
    }

    $lotteries = $query->get();

    // Update status dynamically: if there are pending buyers, status = active
    foreach($lotteries as $lottery){
        $pending = Userpackagebuy::where('package_id', $lottery->id)
                    ->whereDoesntHave('results')
                    ->count();
        $lottery->status = $pending > 0 ? 'active' : 'completed';
    }

    return view('Admin.lotterywin.show', compact('lotteries', 'winType'));
}

public function declareResult(Request $request, $lotteryId)
{
    $request->validate([
        'random' => 'nullable|boolean',
        'first_winner'  => 'nullable|exists:users,id',
        'second_winner' => 'nullable|exists:users,id',
        'third_winner'  => 'nullable|exists:users,id',
        'first_prize'   => 'nullable|numeric|min:0',
        'second_prize'  => 'nullable|numeric|min:0',
        'third_prize'   => 'nullable|numeric|min:0',
    ]);

    $prizes = [
        'first'  => $request->first_prize ?? 0,
        'second' => $request->second_prize ?? 0,
        'third'  => $request->third_prize ?? 0,
    ];

    $buyers = Userpackagebuy::where('package_id', $lotteryId)
        ->whereDoesntHave('results')
        ->with('user')
        ->get();

    if ($buyers->isEmpty()) {
        return back()->with('error', 'No eligible buyers for this lottery.');
    }

    // Select winners
    if ($request->boolean('random')) {
        $selected = $buyers->random(min(3, $buyers->count()));
        $winners = [
            'first'  => $selected[0]->user_id ?? null,
            'second' => $selected[1]->user_id ?? null,
            'third'  => $selected[2]->user_id ?? null,
        ];
    } else {
        $winners = [
            'first'  => $request->first_winner,
            'second' => $request->second_winner,
            'third'  => $request->third_winner,
        ];
    }

    DB::transaction(function () use ($winners, $prizes, $buyers, $lotteryId) {
        foreach ($winners as $position => $userId) {
            if ($userId) {
                $user = User::lockForUpdate()->find($userId);
                if ($user) {
                    $user->increment('balance', $prizes[$position]);

                    $buy = $buyers->firstWhere('user_id', $userId);
                    if ($buy) {
                        Lottery_result::create([
                            'user_package_buy_id' => $buy->id,
                            'win_status' => 'won',
                            'win_amount' => $prizes[$position],
                            'position'   => $position,
                            'draw_date'  => now(),
                        ]);
                    }
                }
            }
        }

        // Non-winners
        $winnerIds = array_filter($winners);
        $nonWinners = $buyers->whereNotIn('user_id', $winnerIds);
        foreach ($nonWinners as $ticket) {
            Lottery_result::create([
                'user_package_buy_id' => $ticket->id,
                'win_status' => 'lost',
                'win_amount' => 0,
                'position'   => null,
                'draw_date'  => now(),
            ]);
        }

        // Update lottery status only if no pending buyers
        $pending = Userpackagebuy::where('package_id', $lotteryId)
                    ->whereDoesntHave('results')
                    ->count();
        $lottery = Lotter::lockForUpdate()->find($lotteryId);
        if($lottery){
            $lottery->status = $pending > 0 ? 'active' : 'completed';
            $lottery->save();
        }
    });

    return back()->with('success', '✅ Winners declared and balances updated!');
}

}
