<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Headersrj extends Model
{
    use HasFactory;

    protected $fillable = ['TglBuat', 'NamaTujuan', 'AlamatTujuan', 'PerusahaanTujuan'];

    
    public function items()
    {
        return $this->hasMany(ItemSrj::class, 'HeaderSrjId', 'id');
    }
}
