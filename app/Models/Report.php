<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Response;


class Report extends Model
{
    use HasFactory;
    protected $fillable = [
        'nik',
        'nama',
        'no_tlp',
        'pengaduan',
        'foto',
    ];

    public function response()
    {
        return $this->hasOne(Response::class);
    }
}
