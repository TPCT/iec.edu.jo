<?php

namespace App\Models\SummerCamp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;

class SummerCampRegisterForm extends Model implements \OwenIt\Auditing\Contracts\Auditable
{
    protected $table = 'summer_camp_register_form';

    use HasFactory, Auditable;

    protected $guarded = ['id', 'created_at', 'updated_at'];
}