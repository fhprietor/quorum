<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ["name","content","status"];

    protected static function boot()
    {
        parent::boot();
        self::creating(function($table) {
            if (!app()->runningInConsole()) {
                $table->reunion_id = 1;
                $table->status =  "new";
            }


        });
    }

}
