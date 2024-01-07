<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportUser;
use App\Exports\ExportUser;
use App\Models\Classlist;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ClassListController extends Controller
{
    public function importView(Request $request){
        return view('importFile');
    }
 
    public function import(Request $request){
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);
        Excel::import(new ImportUser, $request->file('file')->store('files'));
        return redirect('./users/home')->with('success', 'Import excel file success');
    }
 
    // public function exportclasslist(Request $request)
    // {
    //     $id = auth()->user()->id;
    //     return (new ExportUser($id))->download('classlist.xlsx');
    // }
    
    public function setteacher(Request $request) {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'teacher' => ['required', 'array'],
        ]);
        $teachers = $request->input('teacher');  // Default to empty array if not present
        
        // Insert teachers into the 'classlist' table
        foreach ($teachers as $teacherID) {
            // Check if the record already exists
            $existingRecord = Classlist::where('teacherID', $teacherID)
                                        ->where('studentID', $request->input('id'))
                                    ->exists();
        
            if (!$existingRecord) {
                // Record doesn't exist, create a new one
                $classlistData = [
                    'teacherID' => $teacherID,
                    'studentID' => $request->input('id'),
                    'subject' => 'something',
                    'grade' => '0'
                ];
                Classlist::create($classlistData);
            } else {
                return redirect('./admin/home')->with('error', 'Already tag this student to the teacher');
            }
        }
        // If you have a many-to-many relationship between users and teachers, you may attach them here
        return redirect('./admin/home')->with('success', 'Successfully tag teacher to student');
    }
    
    public function getpie() {
    
        if (auth()->check()) {
            $teacherID = auth()->user()->id;
            $result = Classlist::where('teacherID', $teacherID)
                ->where('teacherID', $teacherID)
                ->select(DB::raw('COUNT(CASE WHEN grade >= 5 THEN 1 END) as pass_count'))
                ->addSelect(DB::raw('COUNT(CASE WHEN grade < 5 THEN 1 END) as fail_count'))
                ->first();
                
            // $result now contains pass_count and fail_count
            $passCount = $result->pass_count;
            $failCount = $result->fail_count;
            
            // Return the counts as JSON
            return response()->json([
                'pass_count' => $passCount,
                'failed_count' => $failCount,
            ]);
        } else {
            return redirect('404');
        }
    }
 }
?>
