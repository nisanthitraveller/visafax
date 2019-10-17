<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

class DocumentType extends Model
{

    public $table = 'document_types';
    
    protected $guarded = ['id'];
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    
    function getList() {
        $documentTypes = DocumentType::orderBy('type', 'ASC')->get();
        return $documentTypes;
    }
    
    function getDocumentType($primaryId) {
        $documentType = DocumentType::where('id', $primaryId)
            ->first()
            ->toArray();
        return $documentType;
    }

}