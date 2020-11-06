<?php

namespace App\Exports;

use App\PayController;
use App\SalaryToService;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PayMethodExport implements FromCollection, WithHeadings
{
    public $id;
    
    function __construct($id) {
        $this->id = $id;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $paymethod = SalaryToService::all();
        $method = PayController::findOrFail(intval($this->id));
        foreach ($paymethod as $item) {
            if ($item->sale && $item->sale->pay_method_id == $this->id || $item->service && $item->service->pay_method_id == $this->id) {
                $item['name'] = $item->sale ? "გაყიდვა" : "სერვისი";
                $item['client'] = $item->getClientName();
                $item['total'] = number_format(($item->sale ? $item->sale->total : $item->service->new_price)/100, 2);
                $item['paid'] = number_format(($item->sale ? $item->sale->paid : $item->service->paid)/100, 2);
                $item['salary'] = number_format(($item->service_price * $item->percent/100)/100, 2);
                $item['creator'] = $item->user->profile->first_name .' '.$item->user->profile->last_name;
                unset($item['created_at']);
                unset($item['deleted_at']);
                unset($item['percent']);
                unset($item['service_price']);
                unset($item['service_id']);
                unset($item['sale_id']);
                unset($item['user_id']);
            }else{
                unset($item['id']);
                unset($item['updated_at']);
                unset($item['created_at']);
                unset($item['deleted_at']);
                unset($item['percent']);
                unset($item['service_price']);
                unset($item['service_id']);
                unset($item['sale_id']);
                unset($item['user_id']);
            }
        }
        return $paymethod;
    }
    
    public function headings(): array
    {
        return [
            '#',
            'ბოლო განახლება',
            'შემოსავალი',
            'კლიენტი',
            'ფასი',
            'გადახდილი',
            'ხელფასზე',
            'ავტორი',
        ];
    }
}
