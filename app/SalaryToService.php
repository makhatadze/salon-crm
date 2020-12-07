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
        'user_id', 'service_id', 'sale_id', 'sale_percent', 'service_price', 'percent', 'salary_status',
    ];
    protected $table = 'salary_to_services';
    
    public function getClientName(){
       if ($this->sale) {
           return $this->sale->client->full_name_ge;
       }
       return $this->service->clinetserviceable->full_name_ge;
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function service()
    {
        return $this->belongsTo('App\ClientService', 'service_id');
    }
    public function sale()
    {
        return $this->belongsTo('App\Sale');
    }
}
