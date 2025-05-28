<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;


     /**
     * Attributes that are mass assignable.
     *
     * 
     */
   protected $fillable = [
    'title',
    'assigned_to',
    'description',
    'status',
    'due_date',
    ];

}
