<?php

namespace App\Imports;

use App\Models\Classlist;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportUser implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Assuming 'Student ID' is the unique identifier
        $classlist = Classlist::where('studentID', $row['student'])
        ->where('teacherID', auth()->user()->id)
        ->first();

        if ($classlist) {
            // Update Grade attribute of the existing record
            $classlist->update([
                'grade' => $row['grade'],
            ]);
            return null; // Return null to prevent creating a new record
        } else {
            // Create a new record
            // return new Classlist([
            //     'studentID' => $row['student'],
            //     'subject' => 'default',
            //     'teacherID' => auth()->user()->id, // Replace with your actual teacher ID
            //     'grade' => $row['grade'],
            // ]);
            return null;
        }
    }
}
