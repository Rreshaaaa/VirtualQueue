<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function show()
{
    $student = Auth::guard('student')->user();
    return view('student.profile.show', compact('student'));
}
    public function edit()
{
    $student = Auth::guard('student')->user();
    return view('student.profile.edit', compact('student'));
}

public function update(Request $request)
{
    $request->validate([
        'first_name' => 'required|string|max:255',
        'middle_name' => 'nullable|string|max:255',
        'last_name' => 'required|string|max:255',
        'contact_number' => 'nullable|string|max:20',
        'address' => 'nullable|string|max:500',
        'about' => 'nullable|string|max:1000',
    ]);

    $student = Auth::user();
        $student->update($request->only([
            'first_name',
            'middle_name',
            'last_name',
            'contact',
            'address',
            'about' => $request->input('about'),
        ]));

    return redirect()->route('student.profile.show')->with('success', 'Profile updated successfully!');
}
}
