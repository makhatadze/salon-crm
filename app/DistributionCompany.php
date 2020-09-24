<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class DistributionCompany extends Model
{
    use SoftDeletes;
    protected $fillable = ['code', 'name_ge', 'name_ru', 'name_en'];
    protected $table = 'distribution_companies';
    protected $primarykey = 'id';
    
    public function purchases(){
        return $this->hasMany('App\Purchase', 'distributor_id');
    }
}
