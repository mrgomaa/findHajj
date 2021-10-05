<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class VolunteerService
 * @package App\Models
 * @version October 5, 2021, 5:19 pm UTC
 *
 * @property string $service_name
 */
class VolunteerService extends Model
{

    use HasFactory;

    public $table = 'volunteer_services';
    



    public $fillable = [
        'service_name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'service_name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'service_name' => 'required'
    ];

    
}
