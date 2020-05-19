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
use App\Models\Estate;

class EstateIrrigationSystemController extends Controller
{

     /**
     * @OA\Post(
     *      path="/v1/estate-irrigation-systems",
     *      operationId="storeEstateIrrigationSystem",
     *      tags={"EstateIrrigationSystems"},
     *      summary="Store new estate irrigation system",
     *      description="Returns estate irrigation system data",
     *   security={
     *     {"jwt_key": {}},
     *   }, 
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
            'start_time' => 'required|date_format:H:i:s|after:06:59:59',
            'end_time' => 'required|date_format:H:i:s|after:start_time|before:17:00:01',
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
            'modules.*.irrigation_frequency_days' => 'required|numeric|between:1,7'


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

    
        return  (new EntityJsonResource($estate_irrigation_system));
    }

    /**
     * @OA\Get(
     *      path="/v1/estate-irrigation-systems",
     *      operationId="getEstateIrrigationSystemList",
     *      tags={"EstateIrrigationSystems"},
     *      summary="Get list of irrigation systems",
     *      description="Returns list of irrigation systems filter by its type of system and irrgation header 
     *      (filtro por tipo de sistema de riego o cabezal de riego)",
     *   security={
     *     {"jwt_key": {}},
     *   }, 
     * @OA\Parameter(
     *     name="estate_id",
     *     required=true,
     *     in="query",
     *     description="The ID of the estate (hacienda)",
     *     @OA\Schema(
     *         type="integer"
     *     )
     *   ),
     * @OA\Parameter(
     *     name="irrigation_system_id",
     *     required=false,
     *     in="query",
     *     description="The ID of the type of system (tipo: goteo, aspersión, ..)",
     *     @OA\Schema(
     *         type="integer"
     *     )
     *   ),
     * @OA\Parameter(
     *     name="irrigation_header_id",
     *     required=false,
     *     in="query",
     *     description="The ID of the irrigation header of the system (cabezal de riego)",
     *     @OA\Schema(
     *         type="integer"
     *     )
     *   ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/EntityJsonResource")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */

    public function index(Request $request){
        $estate_id = $request->query('estate_id');
        $irrigation_system_id = $request->query('irrigation_system_id');
        $irrigation_header_id = $request->query('irrigation_header_id');
        
        //obtener la hacienda y todos los sistemas
        //filtrar tipo
        //filtrar cabezal
        if(is_null($estate_id)){
            return  response()->json([
                'message' => 'estate_id es requerido'
            ],400);
        }

       $estate = Estate::where('id',$estate_id)->first();

       $systems = $estate->estateIrrigationSystems;

       if(!is_null($irrigation_system_id)){
            $systems = $systems->where('irrigation_system_id',$irrigation_system_id );
       }

       if(!is_null($irrigation_header_id)){
        $systems = $systems->where('irrigation_header_id',$irrigation_header_id );
       }

       //cómo obtener todos los objetos asociados? (eager loading papá)

        return  (new EntityJsonResource($systems));


    }

    /**
     * @OA\Get(
     *      path="/v1/estate-irrigation-systems/{id}",
     *      operationId="getEstateIrrigationSystemById",
     *      tags={"EstateIrrigationSystems"},
     *      summary="Get estate irrigation system information",
     *      description="Returns estate irrigation system data",
     *   security={
     *     {"jwt_key": {}},
     *   }, 
     *      @OA\Parameter(
     *          name="id",
     *          description="Estate irrigation system id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/EntityJsonResource")
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
    public function getById(EstateIrrigationSystem $estateIrrigationSystem){
        return (new EntityJsonResource($estateIrrigationSystem));
    }

   
    

    /**
     * @OA\Get(
     *      path="/v1/irrigation-systems",
     *      operationId="getIrrigationSystemList",
     *      tags={"IrrigationSystems"},
     *      summary="Get list of irrigation systems",
     *      description="Returns list of irrigation systems",
     *   security={
     *     {"jwt_key": {}},
     *   }, 
     *
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/EntityJsonResource")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function getSistemTypes(){

        return (new EntityJsonResource(IrrigationSystem::All()));

    }

    /**
     * @OA\Get(
     *      path="/v1/irrigation-strategies",
     *      operationId="getIrrigationEstrategiesList",
     *      tags={"IrrigationEstrategies"},
     *      summary="Get list of irrigation estrategies",
     *      description="Returns list of irrigation estrategies",
     *   security={
     *     {"jwt_key": {}},
     *   }, 
     *
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/EntityJsonResource")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */

    public function getIrrigationStrategies(){
        return (new EntityJsonResource(IrrigationStrategy::All()));
    }
}
