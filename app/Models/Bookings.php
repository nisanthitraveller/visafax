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
    
    public function child() {
        return $this->hasMany(Bookings::class, 'ParentID', 'id');
    }
    
    public function hotels() {
        return $this->hasMany(Hotels::class, 'BookingID', 'id');
    }
    
    public function documents() {
        return $this->hasMany(Document::class, 'BookingID', 'id');
    }

    function getList() {
        $bookings = Bookings::latest()->with('user')->with('country')->get();
        return $bookings;
    }
    
    function getBooking($bookingId) {
        $booking = Bookings::where('id', $bookingId)
            ->with('user')
            ->with('country')
            ->first()
            ->toArray();
        return $booking;
    }
    
    public function updatePayment($parentId, $data) {
        unset($data['payStat']);
        DB::table('bookings')
              ->where('id', $parentId)
              ->update($data);
        DB::table('bookings')
              ->where('ParentID', $parentId)
              ->update($data);
    }

}