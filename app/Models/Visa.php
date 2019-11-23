<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\File;

class Visa {

    public function createVisa($data, $user = null) {
        if(empty($user)) {
            $user = auth()->user();
        }
        $uploadType = isset($data['uploadType']) ? $data['uploadType'] : 0;
        $lastId = \Illuminate\Support\Facades\DB::table('bookings')->max('id');
        $countryDocuments = Document::where('country_id', $data['vistingCountry'])->select('document_type', 'document_id', 'pdf', 'display')->get()->toArray();
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
            $bookingID = (strlen($lastId + 1) < 3) ? 'VB' . '000' . ($lastId + 1) . '-' . $persons : 'VB' . ($lastId + 1) . '-' . $persons;
            
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
            
            //  echo '<pre>';print_r($countryDocuments);die;
            foreach($countryDocuments as $countryDocument) {
                if(($countryDocument['document_id'] == null && $uploadType != 0) || ($countryDocument['document_id'] == null && $countryDocument['display'] == 1 && $uploadType == 0)) {
                    $pdf = null;
                    if(isset($countryDocument['pdf']) && $countryDocument['pdf'] != null) {
                        $fileName = time() .'-'. $countryDocument['document_type'] .'-'. $countryDocument['pdf'];
                        File::copy('uploads/' . $countryDocument['pdf'], 'uploads/' . $fileName);
                        $pdf = $fileName;
                    }
                    DB::table('booking_documents')->insertGetId([
                        'DocumentID' => $countryDocument['document_type'],
                        'BookingID' => $bookingInsertedId,
                        'pdf' => $pdf
                    ]);
                }
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
            ->select(['bookings.*', 'bookings.id as visaID', 'countries.countryName', 'countries.DriveID as folderID', 'user_info.*'])
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
    
    public function uploadFile($fileName, $table, $parentId, $documentID, $text = null) {
        DB::table('visa_logs')->insert(
                [
                    'booking_id' => $parentId,
                    'log_text' => $table . ' uploaded',
                    'user_name' => 'VisaBadge',
                ]
        );
        DB::table('booking_documents')->insert(
            [
                'BookingID' => $parentId,
                'pdf' => $fileName,
                'Body' => $text,
                'DocumentID' => $documentID,
            ]
        );
    }
    
    public function updateDriveID($parentId, $driveId, $docId) {
        DB::table('booking_documents')->insert(
                [
                    'BookingID' => $parentId,
                    'DocumentId' => $docId,
                    'DriveId' => $driveId,
                ]
        );
    }
    
    public function updateDriveIDBooking($parentId, $driveId) {
        DB::table('bookings')
              ->where('id', $parentId)
              ->update(['DriveID' => $driveId]);
    }
    public function updateAssignBooking($parentId) {
        DB::table('bookings')
              ->where('id', $parentId)
              ->update(['assign_date' => date('Y-m-d'), 'status' => 1]);
    }
    
    
    public function updateAddress($userId, $address, $parentId) {
        DB::table('user_info as a')
                ->where('a.user_id', $userId)
                ->where('c.id', $parentId)
                ->join('bookings as c', 'a.id', '=', 'c.user_id')
                ->update(['Address' => $address]);
    }
    
    public function getAllMyVisa($userId) {
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
            ->where('user_info.user_id', $userId)
            ->select(['bookings.*', 'countries.countryName', 'countries.DriveID as folderID', 'user_info.FirstName', 'user_info.Surname', 'user_info.FirstName'])
            ->orderBy('bookings.id', 'DESC')
            ->get()
            ->toArray();
        return $bookings;
    }

}
