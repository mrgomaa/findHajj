<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class VolunteerRequest
 * @package App\Models
 * @version October 5, 2021, 5:31 pm UTC
 *
 * @property string $name
 * @property integer $city_id
 * @property string $mobile_no
 * @property string $facebook_link
 * @property integer $volunteer_service_id
 * @property string $notes
 */
class VolunteerRequest extends Model
{

    use HasFactory;

    public $table = 'volunteer_requests';
    



    public $fillable = [
        'name',
        'city_id',
        'mobile_no',
        'facebook_link',
        'volunteer_service_id',
        'notes'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'city_id' => 'integer',
        'mobile_no' => 'string',
        'facebook_link' => 'string',
        'volunteer_service_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'city_id' => 'required',
        'mobile_no' => 'required',
        'facebook_link' => 'required',
        'volunteer_service_id' => 'required'
    ];

    
}
