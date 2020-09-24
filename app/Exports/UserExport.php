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
            
            unset($user->updated_at);
            unset($user->email_verified_at);
            unset($user->password);
            unset($user->active);
            unset($user->remember_token);
            unset($user->deleted_at);
            unset($user->status);
            if($user->profile()->first()){
                $user->name = $user->profile()->first()->first_name .' '. $user->profile()->first()->last_name;
                $user['birthday'] = $user->profile()->first()->birthday;
                $user['phone'] = $user->profile()->first()->phone;
                $user['pid'] = $user->profile()->first()->pid;
                $user['salary'] = $user->profile()->first()->salary;
                $user['percent'] = $user->profile()->first()->percent;
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
