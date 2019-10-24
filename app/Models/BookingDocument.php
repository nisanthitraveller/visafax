<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

class BookingDocument extends Model
{

    public $table = 'booking_documents';
    
    protected $guarded = ['id'];
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    
    protected $fillable = ['DocumentID', 'DriveId'];

    public function documenttype() {
        return $this->belongsTo(DocumentType::class, 'DocumentID', 'id');
    }
}