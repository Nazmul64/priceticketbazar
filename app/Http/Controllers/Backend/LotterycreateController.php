<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Lotter;
use Illuminate\Http\Request;

class LotterycreateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // সব লটারির তথ্য নিয়ে index ভিউতে পাঠানো
        return view('Admin.Lottery.index', [
            'lotteries' => Lotter::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.Lottery.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ভ্যালিডেশন
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'draw_date' => 'required|date',
            'win_type' => 'required|string',
            'first_prize' => 'nullable|string',
            'second_prize' => 'nullable|string',
            'third_prize' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $lottery = new Lotter();
        $lottery->name = $request->name;
        $lottery->price = $request->price;
        $lottery->description = $request->description;
        $lottery->draw_date = $request->draw_date;
        $lottery->win_type = $request->win_type;
        $lottery->first_prize = $request->first_prize;
        $lottery->second_prize = $request->second_prize;
        $lottery->third_prize = $request->third_prize;
        $lottery->status = $request->status;

        // ফটো আপলোড
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/Lottery'), $filename);
            $lottery->photo = $filename;
        }

        $lottery->save();

        return redirect()->route('lottery.index')->with('success', 'Lottery created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $lottery = Lotter::findOrFail($id);
        return view('Admin.Lottery.edit', compact('lottery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $lottery = Lotter::findOrFail($id);

        // ভ্যালিডেশন
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'draw_date' => 'required|date',
            'win_type' => 'required|string',
            'first_prize' => 'nullable|string',
            'second_prize' => 'nullable|string',
            'third_prize' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $lottery->name = $request->name;
        $lottery->price = $request->price;
        $lottery->description = $request->description;
        $lottery->draw_date = $request->draw_date;
        $lottery->win_type = $request->win_type;
        $lottery->first_prize = $request->first_prize;
        $lottery->second_prize = $request->second_prize;
        $lottery->third_prize = $request->third_prize;
        $lottery->status = $request->status;

        // ফটো আপলোড
        if ($request->hasFile('new_photo')) {
            $file = $request->file('new_photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/Lottery'), $filename);
            $lottery->photo = $filename;
        }

        $lottery->save();

        return redirect()->route('lottery.index')->with('success', 'Lottery updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $lottery = Lotter::findOrFail($id);

        // পুরানো ফটো ডিলিট
        if ($lottery->photo && file_exists(public_path('uploads/Lottery/'.$lottery->photo))) {
            unlink(public_path('uploads/Lottery/'.$lottery->photo));
        }

        $lottery->delete();

        return redirect()->route('lottery.index')->with('success', 'Lottery deleted successfully!');
    }
}
