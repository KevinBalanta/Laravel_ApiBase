<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Resources\EntityJsonResource;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\IrrigationSystem;
use App\Models\IrrigationStrategy;
use App\Models\SurcosSeparation;
use App\Models\Configuration;
use App\Models\EstateIrrigationSystem;
use App\Models\Irrigation;
use App\Models\Dropper;
use App\Models\DripIrrigationModule;

class EstateIrrigationSystemController extends Controller
{

     /**
     * @OA\Post(
     *      path="/v1/estate-irrigation-systems",
     *      operationId="storeEstateIrrigationSystem",
     *      tags={"EstateIrrigationSystems"},
     *      summary="Store new estate irrigation system",
     *      description="Returns estate irrigation system data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/EstateIrrigationSystem")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/EstateIrrigationSystem")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    
    public function store(Request $request){


        /**
         * nombre del sistema
         * tipo de sistema de riego
         * config {tensión mínima, máxima, nivel mín de agua, máx, hora inicial (hh:mm:ss), final(hh:mm:ss), % lámina de agua, módulos}
         * modules {name, area en hectarea, tipo gotero, cauda gotero, separación surcos, separación goteros, id estrategia riego,
         * horas de riego }
         */
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'minimum_tension' => 'required|numeric|min:0,',
            'maximum_tension' => 'required|numeric|max:80',
            'minimum_level_water' => 'required|numeric|min:20',
            'maximum_level_water' => 'required|numeric|max:100',
            'start_time' => 'required|date_format:H:i:s|after:07:00:00',
            'end_time' => 'required|date_format:H:i:s|after:start_time|before:17:00:00',
            'lamina' => 'required|numeric|between:0.0,1.0',
            'irrigation_system_id' => 'required',
            'estate_id' => 'required',
            'irrigation_header_id' => 'required',
            'modules.*.name' => 'required|min:3',
            'modules.*.area' => 'required|numeric',
            'modules.*.dropper_type_id' => 'required',
            'modules.*.dropper_flow' => 'required|numeric|min:1',
            'modules.*.surco_separation_id' => 'required',
            'modules.*.dropper_separation' => 'required|numeric|min:0.1',
            'modules.*.irrigation_strategy_id' =>'required',
            'modules.*.irrigation_amount_minutes' => 'required|numeric|min:10',
            'modules.*.irrigation_frequency_days' => 'required|numeric|min:1'


        ] );

    if ($validator->fails()) {
        $fieldsWithErrorMessagesArray = $validator->messages()->get('*');
        return response()->json(['messages' => $fieldsWithErrorMessagesArray],400);
    }

        //crear config
        $configuration = Configuration::create([
            'minimum_tension' => ($request->minimum_tension),
            'maximum_tension' => ($request->maximum_tension),
            'minimum_level_water' => ($request->minimum_level_water),
            'maximum_level_water' => ($request->maximum_level_water),
            'start_time' => ($request->start_time),
            'end_time' => ($request->end_time),
            'lamina' => ($request->lamina)
        ]);

        //crear sistema hacienda

        $estate_irrigation_system = EstateIrrigationSystem::create([
            'name' => ($request->name),
            'estate_id' => ($request->estate_id),
            'irrigation_system_id' => ($request->irrigation_system_id),
            'configuration_id' => ($configuration->id),
            'irrigation_header_id' => ($request->irrigation_header_id)
        ]);


        //crear irrigation (1)
        //crear gotero (2)
        //crear modulo con (1) y (2)
     

        $modules_array = ($request->modules);

        foreach ($modules_array as $module) {
            $irrigation = Irrigation::create([
                'frequency_days' => ($module['irrigation_frequency_days']),
                'amount_minutes' => ($module['irrigation_amount_minutes']),
                'strategy_id' => ($module['irrigation_strategy_id'])
            ]);

            $dropper = Dropper::create([
                'flow' => ($module['dropper_flow']),
                'separation' => ($module['dropper_separation']),
                'dropper_type_id' => ($module['dropper_type_id'])
            ]);

            $drip_irrigation_module = DripIrrigationModule::create([
                'area' => ($module['area']),
                'name' => ($module['name']),
                'estate_irrigation_system_id' => ($estate_irrigation_system->id),
                'dropper_id' => ($dropper->id),
                'surco_separation_id' => ($module['surco_separation_id']),
                'irrigation_id' => ($irrigation->id)
            ]);

         }

    
        return  response()->json([
           (new EntityJsonResource($estate_irrigation_system))
        ])
        ->setStatusCode(Response::HTTP_CREATED);
    }

    public function getSurcosSeparation(){
        return (new EntityJsonResource(SurcosSeparation::All()));
    }
    /**
     * irrigation system types
     */
    public function getSistemTypes(){

        return (new EntityJsonResource(IrrigationSystem::All()));

    }

    public function getIrrigationStrategies(){
        return (new EntityJsonResource(IrrigationStrategy::All()));
    }
}
