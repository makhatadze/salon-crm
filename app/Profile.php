<?php
/**
 *  app/Profile.php
 *
 * User:
 * Date-Time: 07.09.20
 * Time: 11:08
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Profile extends Model implements Auditable
{
    use SoftDeletes, \OwenIt\Auditing\Auditable;
    protected $fillable = [
        'first_name',
        'last_name',
        'birthday',
        'phone',
        'pid',
        'salary',
        'salary_type',
        'percent',
        'show_user',
        'interval_between_meeting',
        'brake_between_meeting',
        'percent_from_sales'
    ];

    /**
     * Get the owning profileable model.
     */
    public function profileable()
    {
        return $this->morphTo();
    }
    
    protected $casts = [
        'salary' => 'integer'
    ];
}
