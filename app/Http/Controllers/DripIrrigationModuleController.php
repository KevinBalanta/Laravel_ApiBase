<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\EntityJsonResource;
use App\Models\DropperType;
use App\Models\SurcosSeparation;
use App\Models\EstateIrrigationSystem;
use App\Models\DripIrrigationModule;
use App\Models\Irrigation;
use App\Models\Dropper;

class DripIrrigationModuleController extends Controller
{
    /**
     * @OA\Get(
     *      path="/v1/drip-irrigation-modules",
     *      operationId="getDripIrrigationModuleList",
     *      tags={"DripIrrigationModules"},
     *      summary="Get list of drip irrigation modules",
     *      description="Returns list of drip irrigation modules ",
     *   security={
     *     {"jwt_key": {}},
     *   }, 
     *
     * @OA\Parameter(
     *     name="estate_irrigation_system_id",
     *     required=true,
     *     in="query",
     *     description="The ID of the estate irrigation system ",
     *     @OA\Schema(
     *         type="integer"
     *     )
     *   ),
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
    public function index(Request $request){
        $estate_irrigation_system_id = $request->query('estate_irrigation_system_id');
        $estate_irrigation_system = EstateIrrigationSystem::where('id', $estate_irrigation_system_id)->first();

        $modules = $estate_irrigation_system->drip_irrigation_modules;


        return (new EntityJsonResource($modules));
    }

    /**
     * @OA\Post(
     *      path="/v1/drip-irrigation-modules",
     *      operationId="storeDripIrrigationModule",
     *      tags={"DripIrrigationModules"},
     *      summary="Store new drip irrigation module",
     *      description="Returns drip irrigation module data",
     *   security={
     *     {"jwt_key": {}},
     *   }, 
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/DripIrrigationModule")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/DripIrrigationModule")
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
            'estate_irrigation_system_id' => 'required',
            'name' => 'required|min:3',
            'area' => 'required|numeric',
            'dropper_type_id' => 'required',
            'dropper_flow' => 'required|numeric|min:1',
            'surco_separation_id' => 'required',
            'dropper_separation' => 'required|numeric|min:0.1',
            'irrigation_strategy_id' =>'required',
            'irrigation_amount_minutes' => 'required|numeric|min:10',
            'irrigation_frequency_days' => 'required|numeric|between:1,7'

        ] );

    if ($validator->fails()) {
        $fieldsWithErrorMessagesArray = $validator->messages()->get('*');
        return response()->json(['messages' => $fieldsWithErrorMessagesArray],400);
    }

    $irrigation = Irrigation::create([
        'frequency_days' => ($request->irrigation_frequency_days),
        'amount_minutes' => ($request->irrigation_amount_minutes),
        'strategy_id' => ($request->irrigation_strategy_id)
    ]);

    $dropper = Dropper::create([
        'flow' => ($request->dropper_flow),
        'separation' => ($request->dropper_separation),
        'dropper_type_id' => ($request->dropper_type_id)
    ]);

    $drip_irrigation_module = DripIrrigationModule::create([
        'area' => ($request->area),
        'name' => ($request->name),
        'estate_irrigation_system_id' => ($request->estate_irrigation_system_id),
        'dropper_id' => ($dropper->id),
        'surco_separation_id' => ($request->surco_separation_id),
        'irrigation_id' => ($irrigation->id)
    ]);


    return (new EntityJsonResource($drip_irrigation_module));

    }


    /**
     * @OA\Get(
     *      path="/v1/drip-irrigation-modules/{id}",
     *      operationId="getDripIrrigationModuleById",
     *      tags={"DripIrrigationModules"},
     *      summary="Get drip irrigation module information",
     *      description="Returns drip irrigation module data",
     *   security={
     *     {"jwt_key": {}},
     *   }, 
     *      @OA\Parameter(
     *          name="id",
     *          description="Drip irrigation module id",
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
    public function getById(DripIrrigationModule $dripIrrigationModule){
        return (new EntityJsonResource($dripIrrigationModule));
    }

    /**
     * @OA\Get(
     *      path="/v1/dropper-types",
     *      operationId="getDropperTypesList",
     *      tags={"DropperTypes"},
     *      summary="Get list of dropper types",
     *      description="Returns list of dropper types",
     *   security={
     *     {"jwt_key": {}},
     *   }, 
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
    
    public function getDropperTypes(){
        return (new EntityJsonResource(DropperType::All()));
    }

    /**
     * @OA\Get(
     *      path="/v1/surco-separations",
     *      operationId="getSurcoSeparationsList",
     *      tags={"SurcoSeparations"},
     *      summary="Get list of surco separations ",
     *      description="Returns list of surco separations (mts)",
     *   security={
     *     {"jwt_key": {}},
     *   }, 
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

    public function getSurcoSeparations(){
        return (new EntityJsonResource(SurcosSeparation::All()));
    }
}
