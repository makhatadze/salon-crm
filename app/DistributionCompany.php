<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DistributionCompany extends Model
{
    protected $fillable = ['code', 'name_ge', 'name_ru', 'name_en'];
    protected $table = 'distribution_companies';
    protected $primarykey = 'id';
}
