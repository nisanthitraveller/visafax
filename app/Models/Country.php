<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class City
 * @package App\Models
 * @version August 26, 2019, 11:18 am UTC
 *
 * @property integer location_id
 * @property string city_name
 * @property boolean status
 */
class Country extends Model
{

    public $table = 'countries';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    
    protected $fillable = ['countryName', 'visa_cost', 'status', 'description'];
    
    

    
}
