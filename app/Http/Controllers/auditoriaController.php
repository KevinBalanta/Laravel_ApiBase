<?php

namespace App\Http\Controllers;
use App\Models\Auditoria;

use Illuminate\Http\Request;


class auditoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function list()
    {
        $result = Auditoria::first();

        return response($result);
    }

    public function show($id)
    {
        $result = Auditoria::find($id);

        return response($result);
    }


}
