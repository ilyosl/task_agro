<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id', 'passport', 'last_name', 'first_name',
        'middle_name', 'position', 'phone', 'address'
    ];

    public function company(): BelongsTo {
        return $this->belongsTo(Company::class);
    }
}
