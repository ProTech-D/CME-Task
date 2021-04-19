<?php

namespace App\Http\Controllers;
use App\Models\Clients;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $clients  =  Clients::latest()->paginate(5);
        return view('view', compact('clients'));
    }

   
}
