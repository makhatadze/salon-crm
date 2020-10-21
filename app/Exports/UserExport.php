<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class UserExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $users =User::whereNull('deleted_at')->get();
        foreach($users as $key => $user){
            dd($user);
            unset($user->updated_at);
            unset($user->email_verified_at);
            unset($user->password);
            unset($user->active);
            unset($user->remember_token);
            unset($user->deleted_at);
            unset($user->status);
            if($user->profile){
                $user->name = $user->profile->first_name .' '. $user->profile->last_name;
                $user['birthday'] = $user->profile->birthday;
                $user['phone'] = $user->profile->phone;
                $user['pid'] = $user->profile->pid;
                $user['salary'] = $user->profile->salary;
                $user['percent'] = $user->profile->percent;
                $user['earned'] = $user->getEarnedMoney();
            }
        }
        return $users;
    }
    public function headings(): array
    {
        return [
            '#',
            'სრული სახელი',
            'ელ-ფოსტა',
            'დამატების თარიღი',
            'დაბადების თარიღი',
            'ნომერი',
            'პირადი ნომერი',
            'ხელფასი',
            'პროცენტრი',
            'გამოიმუშავა',
        ];
    }
}
