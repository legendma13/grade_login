<?php

namespace App\Http\Controllers;

use App\Models\Classlist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function addstudent(Request $request) {
    
        // Remove 'teacher' from the validated data
        $teachers = $request->input('teacher');  // Default to empty array if not present

    
        $validated = $request->validate([
            'userID' => ['required', Rule::unique('users', 'userID')],
            'name' => ['required'],
            'teacher' => ['required', 'array'],
        ]);
        
        // Concatenate "student-" with the userID
        $validated['userID'] = 'student-' . $validated['userID'];
        // Generate email from the name (replace spaces with dots and make it lowercase)
        $validated['email'] = strtolower(str_replace(' ', '.', $validated['name'])) . '@example.com';
        $validated['password'] = bcrypt('1234');
        $validated['role'] = 'student';
        
        // Remove 'teacher' from the validated data
        $request->input('teacher', []);  // Default to empty array if not present

        
        // Insert data into the 'users' table
        $student = User::create($validated);
        
        $studentID = $student->userID;
        
        // Insert teachers into the 'classlist' table
        foreach ($teachers as $teacherID) {
            $classlistData = [
                'teacherID' => $teacherID,
                'studentID' => $studentID,
                'subject' => 'something',
                'grade' => '0'
            ];
            Classlist::create($classlistData);
        }

        // If you have a many-to-many relationship between users and teachers, you may attach them here
        return redirect('./admin/home')->with('success', 'Student created successfully');
    }
        
}
