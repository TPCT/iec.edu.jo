<?php

namespace App\Models\SummerCamp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class SummerCampLang extends Model implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;

    protected $table = "summer_camps_lang";
    public $timestamps = false;
    protected $guarded = [
        'id'
    ];
}
