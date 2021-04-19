<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class CompaniesClients extends Model
{

    const CREATED_AT = 'created_date';
    const UPDATED_AT = 'updated_date';
    use HasFactory;
    protected $table = 'companies_clients_r';
    protected $fillable = [
        "client_id","company_id"
    ];

    public function client(){
        return $this->belongTo("App\models\Clients","client_id");
    }
    public function company(){
        return $this->belongTo("App\models\Companies","company_id");
    }
}
