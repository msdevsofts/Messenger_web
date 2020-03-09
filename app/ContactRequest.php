<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactRequest extends Model
{
    protected $fillable = [ 'accepted_at', 'refused_at' ];
    public $timestamps = false;
}
