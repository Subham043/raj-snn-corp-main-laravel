<?php

namespace App\Modules\Enquiries\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Enquiry extends Model
{
    use HasFactory;

    protected $table = 'enquiries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'page_url',
        'email',
        'phone',
    ];

}
