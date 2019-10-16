<?php
namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model as Model;

class Bookings extends Model
{

    public $table = 'bookings';
    
    protected $guarded = ['id'];
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    
    public function user() {
        return $this->belongsTo(UserInfo::class, 'user_id', 'id');
    }
    
    public function country() {
        return $this->belongsTo(Country::class, 'VisitingCountry', 'id');
    }

    function getList() {
        $bookings = Bookings::latest()->get();
        return $bookings;
    }
    
    function getBooking($bookingId) {
        $booking = Bookings::where('id', $bookingId)
            ->first()
            ->toArray();
        return $booking;
    }

}