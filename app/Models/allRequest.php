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
class allRequest extends Model
{

    use HasFactory;

    public $table = 'all_requests';
    
    public $timestamps = false;
    
}
