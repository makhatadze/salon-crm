<?php
/**
 *  app/SalaryToService.php
 *
 * User:
 * Date-Time: 21.09.20
 * Time: 13:04
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ClientService;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
class SalaryToService extends Model implements Auditable
{
    use SoftDeletes, \OwenIt\Auditing\Auditable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'service_id', 'sale_id', 'service_price', 'percent',
    ];
    protected $table = 'salary_to_services';
    public function getClientName(){
        $name = ClientService::find($this->service_id)->first();
        if($name){
            return $name->clinetserviceable()->first()->{"full_name_".app()->getLocale()};
        }
        return;
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function service()
    {
        return $this->belongsTo('App\ClientService');
    }
    public function sale()
    {
        return $this->belongsTo('App\Sale');
    }
}
