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

class SalaryToService extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'service_id', 'service_price', 'percent',
    ];
}
