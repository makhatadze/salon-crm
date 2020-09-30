<?php

namespace App\Exports;

use App\Department;
use App\User;
use App\UserHasJob;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DepartmentExport implements FromCollection, WithHeadings
{
    protected $id;

    function __construct($id) {
            $this->id = $id;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $users = UserHasJob::where('department_id', $this->id)->get();
        foreach ($users as  $user) {
            $user['first_name'] = $user->user->profile->first_name;
            $user['last_name'] = $user->user->profile->last_name;
            $user['register_date'] = Carbon::parse($user->created_at)->isoFormat('DD/MM/Y');
            unset($user->user_id);
            unset($user->company_id);
            unset($user->department_id);
            unset($user->office_id);
            unset($user->created_at);
            unset($user->updated_at);
            unset($user->deleted_at);
        }
        return $users;
    }
    public function headings(): array
    {
        return [
            'სახელი',
            'გვარი',
            'რეგისტრაციის თარიღი',
        ];
    }
}
