<?php
namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model as Model;

class Hotels extends Model
{

    public $table = 'hotel_booking';
    
    protected $guarded = ['id'];
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    
    public function country() {
        return $this->belongsTo(Country::class, 'Country', 'id');
    }
    
    public function booking() {
        return $this->belongsTo(Bookings::class, 'BookingID', 'id');
    }

}