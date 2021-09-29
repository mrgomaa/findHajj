<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Nation
 * @package App\Models
 * @version September 29, 2021, 12:15 pm UTC
 *
 * @property string $nation_name
 * @property string $nation_lang
 */
class Nation extends Model
{

    use HasFactory;

    public $table = 'nations';
    



    public $fillable = [
        'nation_name',
        'nation_lang'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nation_name' => 'string',
        'nation_lang' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
