<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Companies extends Model
{

    const CREATED_AT = 'created_date';
    const UPDATED_AT = 'updated-date';
    use HasFactory;

    protected $fillable = [
        "company_name"
    ];

    public function relcomps(){
        return $this->hasMany('App\Models\CompaniesClients','id','company_id'); 
	}


}
