<?php

namespace App\Exports;

use App\MemberGroup;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GroupExport implements FromCollection, WithHeadings
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
        
        $clients = MemberGroup::findOrFail($this->id)->clients;
        foreach ($clients as $client) {
            $client->full_name_ge = $client->{'full_name_'.app()->getLocale()};
            unset($client->full_name_ru);
            unset($client->full_name_en);
            unset($client->updated_at);
            unset($client->deleted_at);
            unset($client->group_id);
            unset($client->birthday);
        }
        return $clients;
    }
    public function headings(): array
    {
        return [
            '#',
            'სახელი',
            'მისამართი',
            'ნომერი',
            'რეგისტრაციის თარიღი',
            'ელ-ფოსტა',
            'სქესი',
            'დაბადების თარიღი',
            'პირადი ნომერი',
        ];
    }
}
