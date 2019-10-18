<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

class PricingMaster extends Model
{

    public $table = 'pricing_master';
    
    protected $guarded = ['id'];
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    
    function getList() {
        $pricingTypes = PricingMaster::orderBy('id', 'DESC')->get();
        return $pricingTypes;
    }
    
    function getPricingType($primaryId) {
        $pricingType = PricingMaster::where('id', $primaryId)
            ->first()
            ->toArray();
        return $pricingType;
    }

}