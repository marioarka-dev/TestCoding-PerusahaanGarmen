<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemSrj extends Model
{
    use HasFactory;

    protected $fillable = ['HeaderSrjId', 'NamaItem', 'WarnaItem', 'JumlahItem'];

    
    public function header()
    {
        return $this->belongsTo(Headersrj::class, 'HeaderSrjId', 'id');
    }
}
