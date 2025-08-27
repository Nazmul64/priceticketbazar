<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PartnarController extends Controller
{
    /**
     * Display a listing of the partners.
     */
    public function index()
    {
        $partners = Partner::latest()->get();
        return view('Admin.partner.index', compact('partners'));
    }

    /**
     * Show the form for creating a new partner.
     */
    public function create()
    {
        return view('Admin.partner.create');
    }

    /**
     * Store a newly created partner in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|boolean',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = Str::uuid() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('uploads/partners'), $photoName);
            $photoPath = 'uploads/partners/' . $photoName;
        }

        Partner::create([
            'photo' => $photoPath,
            'status' => $request->status,
        ]);

        return redirect()->route('partner.index')->with('success', 'Partner added successfully!');
    }

    /**
     * Show the form for editing the specified partner.
     */
    public function edit($id)
    {
        $partner = Partner::findOrFail($id);
        return view('Admin.partner.edit', compact('partner'));
    }

    /**
     * Update the specified partner in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'new_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|boolean',
        ]);

        $partner = Partner::findOrFail($id);
        $data = [];

        if ($request->hasFile('new_photo')) {
            // Delete old photo if exists
            if ($partner->photo && File::exists(public_path($partner->photo))) {
                File::delete(public_path($partner->photo));
            }

            // Ensure upload directory exists
            $uploadPath = public_path('uploads/partners');
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }

            // Save new photo
            $photo = $request->file('new_photo');
            $photoName = Str::uuid() . '.' . $photo->getClientOriginalExtension();
            $photo->move($uploadPath, $photoName);
            $data['photo'] = 'uploads/partners/' . $photoName;
        }

        $data['status'] = $request->status;

        // Update partner record
        $partner->update($data);

        return redirect()->route('partner.index')->with('success', 'Partner updated successfully!');
    }

    /**
     * Remove the specified partner from storage.
     */
    public function destroy($id)
    {
        $partner = Partner::findOrFail($id);

        // Delete the photo file if it exists
        if ($partner->photo && File::exists(public_path($partner->photo))) {
            File::delete(public_path($partner->photo));
        }

        $partner->delete();

        return redirect()->route('partner.index')->with('success', 'Partner deleted successfully!');
    }
}
