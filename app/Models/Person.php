<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'dob', 'district_id', 'phone', 'gender', 'occupation', 'education', 'result',
    ];

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
