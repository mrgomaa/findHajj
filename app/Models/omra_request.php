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
        'omra_date'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'omra_date' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
