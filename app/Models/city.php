<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class city
 * @package App\Models
 * @version October 5, 2021, 5:22 pm UTC
 *
 * @property integer $city_name
 */
class city extends Model
{

    use HasFactory;

    public $table = 'cities';
    



    public $fillable = [
        'city_name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'city_name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'city_name' => 'required'
    ];

    
}
