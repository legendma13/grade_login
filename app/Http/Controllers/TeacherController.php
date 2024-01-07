<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TeacherController extends Controller
{
    public function adduser(Request $request) {
        $validated = $request->validate([
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'userID' => ['required', Rule::unique('users', 'userID')],
            'name' => ['required'],
            'birthday' => ['required'],
        ]);
        
        // Concatenate "student-" with the userID
        $validated['userID'] = 'teacher-' . $validated['userID'];
        $validated['password'] = bcrypt($validated['birthday']);
        $validated['role'] = 'teacher';
        
        User::create($validated);
        return redirect('./admin/home')->with('success', 'Teacher Account created successfully');
    }
}
