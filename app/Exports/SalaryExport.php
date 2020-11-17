<?php

namespace App\Exports;

use App\Salary;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SalaryExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $salaries = Salary::all();
        foreach ($salaries as $salary) {
            $salary['user'] = $salary->user->profile->first_name .' '.$salary->user->profile->last_name;
            $salary['cashier'] = $salary->cashier->name == "main" ? __('paymethod.miancashier') : $salary->cashier->name;
            unset($salary->cashier_id);
            if ($salary->type == 'salary') {
                $salary['money'] = number_format(($salary->salary + $salary->bonus)/100, 2);
            }else if ($salary->type == 'earn') {
                $salary['money'] = number_format($salary->made_salary/100, 2);
            }else if ($salary->type == 'avansi') {
                $salary['money'] = number_format($salary->salary/100, 2);
            }
            unset($salary->user_id);
            unset($salary->created_at);
            unset($salary->salary);
            unset($salary->bonus);
            unset($salary->salary);
            unset($salary->made_salary);
            $salary->avansi_complate = number_format($salary->avansi_complate/100, 2);

        }
        return $salaries;
    }
    public function headings(): array
    {
        return [
            '#',
            __('salaryexport.type'),
            __('salaryexport.reason'),
            __('salaryexport.update'),
            __('salaryexport.avansipaid'),
            __('salaryexport.emoloyee'),
            __('salaryexport.cashier'),
            __('salaryexport.money'),
        ];
    }
}
