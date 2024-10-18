<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Document extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function owners(){
        return $this->belongsTo(User::class , 'owner');
    }
    public function department(){
        return $this->belongsTo(Department::class , 'department_id');
    }
    public function signature(){
        return $this->hasMany(Signature::class , 'document_id');
    }
}
