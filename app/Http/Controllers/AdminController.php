<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Deposite;
use App\Models\User;
use App\Models\User_widthdraw;
use App\Models\WithdrawCommission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
public function dashboard()
{
    // ✅ Total Deposits (approved only)
    $total_deposites = Deposite::where('status', 'approved')->sum('amount');

    // ✅ Total Deposit Investors (unique users who deposited)
    $total_deposites_investor = Deposite::where('status', 'approved')->distinct('user_id')->count('user_id');

    // ✅ Total Users
    $total_user = User::count();

    // ✅ Weekly Deposits (last 7 days)
    $last_weekly = Deposite::where('status', 'approved')
        ->where('created_at', '>=', now()->subWeek())
        ->sum('amount');

    // ✅ Total Withdrawals (approved only)
    $total_withdrawals = User_widthdraw::where('status', 'approved')->sum('amount');

    // ✅ Commission settings
    $commission = WithdrawCommission::first();
    $commission_percentage = $commission ? $commission->withdraw_commission : 0;

    // ✅ Commission Profit (sum of charges)
    $total_commission_profit = User_widthdraw::where('status', 'approved')->sum('charge');

    // ✅ Net Deposit (Deposits - Withdrawals)
    $net_deposit = $total_deposites - $total_withdrawals;

    // ✅ Admin Net Profit (Net Deposit + Commission)
    $net_profit = $net_deposit + $total_commission_profit;

    return view('Admin.index', compact(
        'total_deposites',
        'total_deposites_investor',
        'total_user',
        'last_weekly',
        'total_withdrawals',
        'net_deposit',
        'total_commission_profit',
        'net_profit'
    ));
}





    public function showLoginForm()
    {
        return view('Admin.login.login');
    }

public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Find user by email
        $user = User::where('email', $request->email)->first();

        // If no user found
        if (!$user) {
            return back()
                ->withErrors(['email' => 'No account found with this email.'])
                ->withInput($request->except('password'));
        }

        // If user is not admin
        if (trim(strtolower($user->role)) !== 'admin') {
            return back()
                ->withErrors(['email' => 'You are not authorized to access the admin panel.'])
                ->withInput($request->except('password'));
        }

        // Attempt login
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()
                ->route('admin.dashboard')
                ->with('success', 'Login successful!');
        }

        // Wrong password
        return back()
            ->withErrors(['email' => 'Invalid password.'])
            ->withInput($request->except('password'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()
            ->route('admin.login')
            ->with('success', 'Logged out successfully.');
    }
// ✅ Fetch messages between auth user and receiver
    public function fetch(Request $request)
    {
        $receiverId = $request->get('receiver_id');

        if (!$receiverId) {
            return response()->json([]);
        }

        // mark unread → seen
        Chat::where('sender_id', $receiverId)
            ->where('receiver_id', Auth::id())
            ->where('seen', false)
            ->update(['seen' => true]);

        $messages = Chat::where(function ($q) use ($receiverId) {
                $q->where('sender_id', Auth::id())
                  ->where('receiver_id', $receiverId);
            })
            ->orWhere(function ($q) use ($receiverId) {
                $q->where('sender_id', $receiverId)
                  ->where('receiver_id', Auth::id());
            })
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($messages);
    }

    // ✅ Send message
    public function send(Request $request)
    {
        $request->validate([
            'message'     => 'required|string',
            'receiver_id' => 'required|integer'
        ]);

        $msg = Chat::create([
            'sender_id'   => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message'     => $request->message,
            'seen'        => false,
        ]);

        return response()->json($msg);
    }

    // ✅ Sidebar user list
    public function userList()
    {
        $userId = Auth::id();

        $chats = Chat::where('sender_id', $userId)
                    ->orWhere('receiver_id', $userId)
                    ->orderBy('created_at', 'desc')
                    ->get();

        $users = $chats->map(function ($chat) use ($userId) {
            $user = $chat->sender_id == $userId ? $chat->receiver : $chat->sender;
            if (!$user) return null;

            return [
                'id'       => $user->id,
                'name'     => $user->name,
                'photo'    => $user->photo ?? null,
                'last_msg' => $chat->message,
            ];
        })->filter()->unique('id')->values();

        return response()->json($users);
    }


    // user list for admin
    public function userlistadmin(){
        $users=User::where('role','user')->get();
        return view('Admin.pages.userlist.index',compact('users'));
    }
    public function updateStatus(Request $request, $id)
{
    $user = User::findOrFail($id);
    $user->status = $request->status;
    $user->save();

    return redirect()->back()->with('success', 'User status updated successfully!');
}
public function  userDelete(Request $request,$id){
   $user_delete=User::find($id);
   $user_delete->delete();
    return redirect()->back()->with('success', 'User Delete successfully!');
}

// widthraw history check for admin


}
