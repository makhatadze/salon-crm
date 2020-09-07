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

class Profile extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'birthday',
        'phone',
        'pid',
        'position',
        'salary',
        'salary_type',
        'percent',
    ];

    /**
     * Get the owning profileable model.
     */
    public function profileable()
    {
        return $this->morphTo();
    }
}
