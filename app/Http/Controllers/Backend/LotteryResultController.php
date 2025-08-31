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
    $winType = $request->get('type');

    $query = Lotter::withCount('userPackageBuys')
                   ->withSum('userPackageBuys', 'price');

    // 👉 Only active lotteries (not completed ones)
    $query->where('status', 'active');

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
        ->get()
        ->unique('user_id'); // 👉 Only one entry per user

    return view('Admin.lotterywin.declare', compact('lottery', 'buyers'));
}

    // Declare winners
   // Declare winners
public function declareResult(Request $request, $lotteryId)
{
    $request->validate([
        'random'        => 'nullable|boolean',
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

    // Eligible buyers (only who haven't result yet)
    $buyers = Userpackagebuy::where('package_id', $lotteryId)
        ->whereNotIn('id', function($query) {
            $query->select('user_package_buy_id')->from('lottery_results');
        })
        ->with('user') // eager load for performance
        ->get();

    if ($buyers->isEmpty()) {
        return back()->with('error', 'No eligible buyers for this lottery.');
    }

    // Winner selection
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

        // Handle winners
        foreach ($winners as $position => $userId) {
            if ($userId) {
                $user = User::lockForUpdate()->find($userId); // lock row
                if ($user) {
                    $user->increment('balance', $prizes[$position]);

                    $buy = $buyers->firstWhere('user_id', $userId);
                    if ($buy) {
                        Lottery_result::create([
                            'user_package_buy_id' => $buy->id,
                            'win_status'          => 'won',
                            'win_amount'          => $prizes[$position],
                            'position'            => $position,
                            'draw_date'           => now(),
                        ]);
                    }
                }
            }
        }

        // Handle non-winners
        $winnerIds = array_filter($winners); // only valid ids
        $nonWinners = $buyers->whereNotIn('user_id', $winnerIds);

        foreach ($nonWinners as $ticket) {
            Lottery_result::create([
                'user_package_buy_id' => $ticket->id,
                'win_status'          => 'lost',
                'win_amount'          => 0,
                'position'            => null,
                'draw_date'           => now(),
            ]);
        }

        // Mark lottery as completed
        $lottery = Lotter::lockForUpdate()->find($lotteryId);
        if ($lottery) {
            $lottery->status = 'completed';
            $lottery->save();
        }
    });

    return back()->with('success', '✅ Winners declared successfully & balances updated!');
}

}
