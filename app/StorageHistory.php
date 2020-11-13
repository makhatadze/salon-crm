<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StorageHistory extends Model
{
    protected $fillable = [
        'storage_id',
        'stock',
        'user_id',
        'department_id',
        'product_id',
        'price',
        'description'
    ];
    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }
    public function storage()
    {
        return $this->belongsTo('App\Storage', 'storage_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function department()
    {
        return $this->belongsTo('App\Department', 'department_id');
    }
}
