<?php

namespace App\Http\Controllers;
use App\Models\Clients;
use App\Models\Companies;
use App\Models\CompaniesClients;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function all()
    {
        $allClients = Clients::select('clients.id','clients.name','clients.email','companies.company_name')
        ->join("companies_clients_r",'clients.id','=','companies_clients_r.client_id')
        ->join("companies",'companies.id','=','companies_clients_r.company_id')
        ->orderBy('clients.id','desc')
        ->get()->toArray();
        return Response::json(array('allClients' => $allClients));
    }
    public function apidata(){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, 'https://ah-devsec.com/test/');
        $result = curl_exec($ch);
        curl_close($ch);
        
        $obj = json_decode($result,true);
        $emails = array_column($obj,'email');
        $allClients = Clients::select('clients.name','clients.email','companies.company_name')
        ->whereIn("email",$emails)
        ->join("companies_clients_r",'clients.id','=','companies_clients_r.client_id')
        ->join("companies",'companies.id','=','companies_clients_r.company_id')
        ->get()->toArray();
        return Response::json(array('allapiClients' => $allClients));
    }

    public function registration(Request $request){
        $data = $request->input();
        $newclient =  Clients::create(['name'=>$data['name'],'email'=>$data['email']]);
        $newcompany =  Companies::create(['company_name'=>$data['company']]);
        $companyClient = CompaniesClients::create(['client_id'=>$newclient->id,'company_id'=>$newcompany->id]);
        return Response::json(array('success' => $companyClient->id,'clientid'=>$newclient->id));
    }
}
