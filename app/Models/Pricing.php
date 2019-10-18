<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

class Pricing extends Model
{

    public $table = 'pricing';
    
    protected $guarded = ['id'];
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    
    protected $fillable = ['country_id', 'plan_id', 'price'];

}