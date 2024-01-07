<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dashboardController extends Controller
{
    public function index()
    {
        $allTeacher = User::where('role', '=', 'teacher')->get();
        $allStudent = User::select('users.userID as studentID', 'users.name as studentName',
                DB::raw('GROUP_CONCAT(teachers.name SEPARATOR \', \') as teacherNames'))
            ->leftJoin('classlist', 'users.userID', '=', 'classlist.studentID')
            ->leftJoin('users as teachers', 'teachers.id', '=', 'classlist.teacherID')
            ->where('users.role', '=', 'student')
            ->groupBy('users.userID', 'users.name')
            ->get();
    
        return view('admin.dashboard', ['allTeacher' => $allTeacher, 'allStudent' => $allStudent]);
    }
}
