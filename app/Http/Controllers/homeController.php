<?php

namespace App\Http\Controllers;

use App\Models\Classlist;
use Illuminate\Http\Request;

class homeController extends Controller
{
    public function index()
    {
        $myID = auth()->user()->id;
    
        $allStudent = Classlist::leftJoin('users', 'classlist.studentID', '=', 'users.userID')
            ->where('classlist.teacherID', '=', $myID)
            ->select('users.name', 'users.userID', 'users.email', 'classlist.grade')
            ->get();
        return view('users.home', ['allStudent' => $allStudent]);
    }
}
