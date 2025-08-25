<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CommissionSetting;
use Illuminate\Http\Request;

class CommissionSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    $commissions = CommissionSetting::orderBy("created_at", "desc")->paginate(10);
    return view("Admin.commissionsetting.index", compact('commissions'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Admin.commissionsetting.create");
    }

    /**
     * Store a newly created resource in storage.
     */
 public function store(Request $request)
{
    // // ✅ Validation
    // $request->validate([
    //     'refer_commission'        => 'required|numeric|min:0',
    //     'generation_commission'   => 'required|numeric|min:0',
    //     'generation_level_1'      => 'required|numeric|min:0',
    //     'generation_level_2'      => 'required|numeric|min:0',
    //     'generation_level_3'      => 'required|numeric|min:0',
    //     'generation_level_4'      => 'required|numeric|min:0',
    //     'generation_level_5'      => 'required|numeric|min:0',
    //     'weekly_team_commission'  => 'required|numeric|min:0',
    //     'lottery_percentages'=>'required|numeric|min:0',
    //     'status'                  => 'required|in:0,1',
    // ]);

    // ✅ Create Commission
    CommissionSetting::create([
        'refer_commission'        => $request->refer_commission,
        'generation_commission'   => $request->generation_commission,
        'generation_level_1'      => $request->generation_level_1,
        'generation_level_2'      => $request->generation_level_2,
        'generation_level_3'      => $request->generation_level_3,
        'generation_level_4'      => $request->generation_level_4,
        'generation_level_5'      => $request->generation_level_5,
        'weekly_team_commission'  => $request->weekly_team_commission,
        'lottery_percentages'     => $request->lottery_percentages,
         'status' => (int) $request->status,

    ]);

    // ✅ Redirect with success message
    return redirect()
        ->route('commissionsetting.index')
        ->with('success', 'Commission created successfully!');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       $commission = CommissionSetting::findOrFail($id);
       return view('Admin.commissionsetting.edit', compact('commission'));
    }

    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request, string $id)
{
    // // Validate incoming request data
    // $request->validate([
    //     'refer_commission'       => 'required|numeric|min:0',
    //     'generation_commission'  => 'required|numeric|min:0',
    //     'generation_level_1'     => 'required|numeric|min:0',
    //     'generation_level_2'     => 'required|numeric|min:0',
    //     'generation_level_3'     => 'required|numeric|min:0',
    //     'generation_level_4'     => 'required|numeric|min:0',
    //     'generation_level_5'     => 'required|numeric|min:0',
    //     'weekly_team_commission' => 'required|numeric|min:0',
    //     'lottery_percentages'=>'required|numeric|min:0',
    //     'status'                 => 'required|in:0,1',
    // ]);

    // Find commission record
    $commission = CommissionSetting::findOrFail($id);

    // Update fields
    $commission->refer_commission       = $request->refer_commission;
    $commission->generation_commission  = $request->generation_commission;
    $commission->generation_level_1     = $request->generation_level_1;
    $commission->generation_level_2     = $request->generation_level_2;
    $commission->generation_level_3     = $request->generation_level_3;
    $commission->generation_level_4     = $request->generation_level_4;
    $commission->generation_level_5     = $request->generation_level_5;
    $commission->weekly_team_commission = $request->weekly_team_commission;
    $commission->lottery_percentages = $request->lottery_percentages;
    $commission->status                 = $request->status;

    // Save updated record
    $commission->save();

    // Redirect with success message
    return redirect()->route('commissionsetting.index')
        ->with('success', 'Commission updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
   public function destroy(string $id)
{
    // Find commission by ID
    $commission = CommissionSetting::findOrFail($id);

    // Delete commission
    $commission->delete();

    // Redirect with success message
    return redirect()->route('commissionsetting.index')
        ->with('success', 'Commission deleted successfully.');
}

}
