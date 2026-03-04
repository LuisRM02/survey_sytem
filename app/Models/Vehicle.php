<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'plate',
        'model',
        'manufacturing_year',
        'client_id'
    ];

    public $timestamps = false;

    public function client() {
        return $this->belongsTo(Client::class);
    }
}
