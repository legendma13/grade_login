<?php

namespace App\Exports;

use App\Models\Classlist;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ExportUser implements FromQuery, WithHeadingRow
{
    use Exportable;

    protected $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function query()
    {
        return Classlist::leftJoin('users', 'classlist.teacherID', '=', 'users.id')
            ->where('classlist.teacherID', '=', $this->id)
            ->select('users.userID', 'users.name', 'classlist.grade');
    }

    public function headingRow(): array
    {
        return ["Student ID", "Student Name", "Grade"];
    }
}
