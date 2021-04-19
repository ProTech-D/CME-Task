<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Clients extends Model
{

    const CREATED_AT = 'created_date';
    const UPDATED_AT = 'updated_date';
    use HasFactory;

    protected $fillable = [
        "name", "email"
    ];

    public function relclients(){
        return $this->hasMany('App\Models\CompaniesClients','client_id'); 
	}
}
