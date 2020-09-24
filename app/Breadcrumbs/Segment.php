<?php

namespace App\Breadcrumbs;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class Segment
{
    protected $request;

    protected $segment;

    public function __construct(Request $request, $segment)
    {
        $this->request = $request;
        $this->segment = $segment;
    }

    public function name()
    {
        return $this->segment;
    }

    public function model()
    {
        // Todo get route parameter model
//         return collect($this->request->route()->parameters())->where('slug',$this->segment);
    }

    public function url()
    {
        return url(implode(array_slice($this->request->segments(), 0, $this->position() + 1), '/'));
    }

    public function position()
    {
        return array_search($this->segment, $this->request->segments());
    }
}