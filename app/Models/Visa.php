<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Visa {

    public function createVisa($data) {
        
        $user = auth()->user();
        
        $parentId = 0;
        for ($persons = 1; $persons <= $data['persons']; $persons++):
            
            $id = DB::table('user_info')->insertGetId(
                    [
                        'CountryOfBirth' => $data['residenceCountry'],
                        'CurrentNationality' => $data['residenceCountry'],
                        'user_id' => $data['userId'],
                        'Surname' => $user->last_name,
                        'FirstName' => $user->first_name,
                        'CityOfResidence' => '',
                        'EmailID' => $user->email,
                        'PhoneNo' => $user->phone,
                    ]
            );
            $bookingID = (strlen($id) < 3) ? 'VB' . '000' . $id : 'VB' . $id;
            
            $bookingInsertedId = DB::table('bookings')->insertGetId(
                    [
                        'user_id' => $id,
                        'BookingID' => $bookingID,
                        'ParentID' => $parentId,
                        'VisitingCountry' => $data['vistingCountry'],
                        'VisaType' => $data['visaType'],
                    ]
            );
            if($persons == 1) {
                $parentId = $bookingInsertedId;
            }
            
        endfor;
        
        $id = DB::table('visa_logs')->insertGetId(
                [
                    'booking_id' => $parentId,
                    'log_text' => 'Application created',
                    'user_name' => 'VisaBadge',
                ]
        );
        
        return $parentId;
    }
    
    public function getVisa($parentId) {
        $bookings = DB::table('bookings')
            ->join('user_info', 'bookings.user_id', '=', 'user_info.id')
            ->join('countries', 'bookings.VisitingCountry', '=', 'countries.id')
//            ->leftJoin('booking_documents', 'bookings.id', '=', 'booking_documents.BookingID')
//            ->leftJoin('flights', 'bookings.id', '=', 'flights.BookingID')
//            ->leftJoin('hotels', 'bookings.id', '=', 'hotels.BookingID')
//            ->leftJoin('hotel_booking', 'bookings.id', '=', 'hotel_booking.BookingID')
//            ->leftJoin('insurance', 'bookings.id', '=', 'insurance.BookingID')
//            ->leftJoin('itr', 'bookings.id', '=', 'itr.BookingID')
//            ->leftJoin('offer_letter', 'bookings.id', '=', 'offer_letter.BookingID')
//            ->leftJoin('old_visa', 'bookings.id', '=', 'old_visa.BookingID')
//            ->leftJoin('passport', 'bookings.id', '=', 'passport.BookingID')
//            ->leftJoin('pay_slip', 'bookings.id', '=', 'pay_slip.BookingID')
            ->where('bookings.id', $parentId)
            ->orWhere('bookings.ParentID', $parentId)
            ->select(['bookings.*', 'countries.countryName', 'user_info.*'])
            ->get();
        return $bookings;
    }
    
    public function getPassports($parentId) {
        $bookings = DB::table('passport')
            ->where('BookingID', $parentId)
            ->get();
        return $bookings;
    }
    
    public function getHotelFiles($parentId) {
        $bookings = DB::table('hotels')
            ->where('BookingID', $parentId)
            ->get();
        return $bookings;
    }
    
    public function getFlights($parentId) {
        $bookings = DB::table('flights')
            ->where('BookingID', $parentId)
            ->get();
        return $bookings;
    }
    
    public function getOfferLetter($parentId) {
        $bookings = DB::table('offer_letter')
            ->where('BookingID', $parentId)
            ->get();
        return $bookings;
    }
    
    public function getAddressProof($parentId) {
        $bookings = DB::table('address_proof')
            ->where('BookingID', $parentId)
            ->get();
        return $bookings;
    }
    
    public function uploadFile($fileName, $table, $parentId, $text = null) {
        DB::table('visa_logs')->insert(
                [
                    'booking_id' => $parentId,
                    'log_text' => $table . ' uploaded',
                    'user_name' => 'VisaBadge',
                ]
        );
        DB::table($table)->insert(
            [
                'BookingID' => $parentId,
                'pdf' => $fileName,
                'text' => $text
            ]
        );
    }

}
