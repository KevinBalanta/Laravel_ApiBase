<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Resources\EntityJsonResource;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EstateController extends Controller
{
    public function index()
    {
     
        $states = Auth::User()->estates; 
        return new EntityJsonResource($states);
    }
}
