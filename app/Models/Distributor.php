<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    use HasFactory;

    protected $fillable = [
        'company',
        'contact_person',
        'contact_information',
        'email_id',
        'city',
        'state_wise_distribution'
    ];
}
