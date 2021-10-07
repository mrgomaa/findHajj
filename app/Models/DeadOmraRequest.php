<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class DeadOmraRequest
 * @package App\Models
 * @version October 5, 2021, 4:28 pm UTC
 *
 * @property string $mobile_no
 * @property string $request_sender_name
 * @property string $dead_name
 * @property integer $dead_age
 * @property string $notes
 */
class DeadOmraRequest extends Model
{

    use HasFactory;

    public $table = 'dead_omra_requests';
    



    public $fillable = [
        'mobile_no',
        'request_sender_name',
        'dead_name',
        'dead_age',
        'notes',
        'dead_gender',
        'user_id',
        'request_date' , 
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
        'mobile_no' => 'string',
        'request_sender_name' => 'string',
        'dead_name' => 'string',
        'dead_age' => 'integer',
        'notes' => 'string',
        'request_date' => 'date',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'mobile_no' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:15|unique:users',
        'request_sender_name' => 'required',
        'dead_name' => 'required',
        'dead_age' => 'required|numeric',
        'dead_gender' =>  'numeric',
        'id_no' => 'nullable|numeric',
        'passport_no' => 'nullable|string|min:4'
    ];

    
}
