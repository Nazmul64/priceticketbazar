<?php

namespace App\Http\Controllers\Backend;

use App\Models\cr;
use App\Http\Controllers\Controller;
use App\Models\Deposite;
use App\Models\Waleta_setup;
use Illuminate\Http\Request;

class DepositeContrller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
   public function create()
{
    // Get all transactions for the authenticated user, with payment method relationship
    $transactions = Deposite::with('method_type')->where('user_id', auth()->id())->orderBy('created_at', 'desc')->get();

    // Get all available wallet/payment methods
    $walate = Waleta_setup::all();

    return view('userdashboard.deposite.deposite', compact('walate', 'transactions'));
}


    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    // Validate request
    $validated = $request->validate([
        'payment_method' => 'required|exists:waleta_setups,id', // Must match a payment method in DB
        'amount'         => 'required|numeric|min:500',         // Minimum 500 Taka
        'transaction_id' => 'required|string|max:255',
        'screenshot'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // 2MB limit
    ], [
        'amount.min' => 'ন্যূনতম 500 টাকা ডিপোজিট করতে হবে।', // Custom Bangla message
    ]);

    // Handle file upload
    $photoName = null;
    if ($request->hasFile('screenshot')) {
        $photoName = time() . '.' . $request->screenshot->extension();
        $request->screenshot->move(public_path('uploads/deposite'), $photoName);
    }

    // Create deposit record
    Deposite::create([
        'user_id'        => auth()->id(),
        'amount'         => $validated['amount'],
        'payment_method' => $validated['payment_method'],
        'transaction_id' => $validated['transaction_id'],
        'screenshot'     => $photoName,
    ]);

    return redirect()->back()->with('success', 'Deposit request submitted successfully!');
}




    /**
     * Display the specified resource.
     */
    public function show(cr $cr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(cr $cr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, cr $cr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(cr $cr)
    {
        //
    }
}
