<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

class Document extends Model
{

    public $table = 'documents';
    
    protected $guarded = ['id'];
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    
    protected $fillable = ['country_id', 'document_type'];
    
    public function country() {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
    
    public function documenttype() {
        return $this->belongsTo(DocumentType::class, 'document_type', 'id');
    }

}