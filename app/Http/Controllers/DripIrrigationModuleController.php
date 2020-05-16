<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\EntityJsonResource;
use App\Models\DropperType;
use App\Models\SurcosSeparation;

class DripIrrigationModuleController extends Controller
{
    
    public function getDropperTypes(){
        return (new EntityJsonResource(DropperType::All()));
    }

    public function getSurcoSeparations(){
        return (new EntityJsonResource(SurcosSeparation::All()));
    }
}
