<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Lotter;
use App\Models\Userpackagebuy;
use App\Models\LotteryResult;
use Illuminate\Http\Request;

class LotteryResultController extends Controller
{
    // Show all lotteries with purchased tickets + amount
    public function purchasedTickets()
    {
        $lotteries = Lotter::withCount('userPackageBuys')
            ->withSum('userPackageBuys', 'price')
            ->get();

        return view('Admin.lotterywin.show', compact('lotteries'));
    }

    // Show declare winners form
    public function showDeclareForm($lotteryId)
    {
        $lottery = Lotter::findOrFail($lotteryId);
        $tickets = Userpackagebuy::where('package_id', $lotteryId)
            ->with('user')
            ->get();

        return view('Admin.lotterywin.declare', compact('lottery', 'tickets'));
    }

    // Declare winners
    public function declareResult(Request $request, $lotteryId)
    {
        $lottery = Lotter::findOrFail($lotteryId);

        $request->validate([
            'winners' => 'required|array|size:3',
            'winners.*' => 'distinct',
        ]);

        $winnerIds = $request->winners;
        $allTickets = Userpackagebuy::where('package_id', $lotteryId)->get();

        foreach ($allTickets as $ticket) {
            if (in_array($ticket->id, $winnerIds)) {
                $amount = 0;
                if ($ticket->id == $winnerIds[0]) $amount = $lottery->first_prize;
                if ($ticket->id == $winnerIds[1]) $amount = $lottery->second_prize;
                if ($ticket->id == $winnerIds[2]) $amount = $lottery->third_prize;

                LotteryResult::create([
                    'user_package_buy_id' => $ticket->id,
                    'win_status' => 'won',
                    'win_amount' => $amount,
                    'draw_date' => now(),
                ]);
            } else {
                LotteryResult::create([
                    'user_package_buy_id' => $ticket->id,
                    'win_status' => 'lost',
                    'win_amount' => 0,
                    'draw_date' => now(),
                ]);
            }
        }

        $lottery->update(['draw_date' => now()]);

        return back()->with('success', '৩ জন বিজয়ী ঘোষণা করা হয়েছে!');
    }
}
