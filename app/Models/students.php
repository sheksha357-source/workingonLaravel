<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class students extends Model
{
    protected $table = 'students'; // Specify the table name if it doesn't follow Laravel's naming convention

    protected $fillable = [
        'name',
        'section',
        'age',
        'date_of_birth',
    ]; // Allow mass assignment for these fields
}
