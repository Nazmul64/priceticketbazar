<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\WithdrawCommission;
use Illuminate\Http\Request;

class WithdrawcommissonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $withdrawcommisson = WithdrawCommission::all();
        return view('Admin.withdrawcommisson.index', compact('withdrawcommisson'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.withdrawcommisson.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'withdraw_commission' => 'required|numeric|min:0',
            'money_exchange_commission' => 'required|numeric|min:0',
            'status' => 'nullable|boolean',
        ]);

        // Create new record
        WithdrawCommission::create([
            'withdraw_commission' => $request->withdraw_commission,
            'money_exchange_commission' => $request->money_exchange_commission,
            'status' => $request->status ? 1 : 0,
        ]);

        return redirect()->route('withdrawcommisson.index')->with('success', 'Withdraw Commission created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $withdrawcommisson = WithdrawCommission::findOrFail($id);
        return view('Admin.withdrawcommisson.edit', compact('withdrawcommisson'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate input
        $request->validate([
            'withdraw_commission' => 'required|numeric|min:0',
            'money_exchange_commission' => 'required|numeric|min:0',
            'status' => 'nullable|boolean',
        ]);

        $withdrawcommisson = WithdrawCommission::findOrFail($id);

        // Update record
        $withdrawcommisson->update([
            'withdraw_commission' => $request->withdraw_commission,
            'money_exchange_commission' => $request->money_exchange_commission,
            'status' => $request->status ? 1 : 0,
        ]);

        return redirect()->route('withdrawcommisson.index')->with('success', 'Withdraw Commission updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $withdrawcommisson = WithdrawCommission::findOrFail($id);
        $withdrawcommisson->delete();

        return redirect()->route('withdrawcommisson.index')->with('success', 'Withdraw Commission deleted successfully.');
    }
}
