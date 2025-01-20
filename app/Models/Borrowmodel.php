<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowmodel extends Model
{
    use HasFactory;

    // Table name (if different from the default `borrowmodels`)
    protected $table = 'borrows';

    // Fillable attributes for mass assignment
    protected $fillable = [
        'item_name',
        'qty',
        'borrower',
        'status',
    ];
}