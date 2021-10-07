<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class omra_request
 * @package App\Models
 * @version September 24, 2021, 1:20 pm UTC
 *
 * @property string $name
 * @property string $omra_date
 */
class omra_request extends Model
{

    use HasFactory;

    public $table = 'request_omras';
    
    public $timestamps = false;


    public $fillable = [
        'name',
        'request_date',
        'permission_type',
        'permission_date',
        'etamarna_pw',
        'notes' , 
        'user_id',
        'request_status',
        'id_no',
        'passport_no'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'request_date' => 'date',
        'permission_date' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'permission_type' => 'required',
        'etamarna_pw' => 'string|min:4',
        'permission_date' => 'required|date',
        'id_no' => 'nullable|numeric',
        'passport_no' => 'nullable|string|min:4'
    ];

    
}
