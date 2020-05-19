<?php

namespace App\virtual\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @OA\Schema(
 *     description="DripIrrigationModules model",
 *     title="Drip Irrigation Modules model",
 *     @OA\Xml(
 *         name="DripIrrigationModules"
 *     )
 * )
 */
class DripIrrigationModules extends Model
{
    


    /**
     * @OA\Property(
     *      title="Name",
     *      description="Name of the irrigation system (min: 3 characters)",
     *      example="module A"
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *      title="Area",
     *      format="float",
     *      description="Area of the module ",
     *      example="60"
     * )
     *
     * @var float
     */

    public $area;

  
    /**
     * @OA\Property(
     *      title="DropperTypeId",
     *      format="int64",
     *      description="The ID of the dropper type (el tipo de un gotero)",
     *      example="1"
     * )
     *
     * @var integer
     */
    public $dropper_type_id;

    /**
     * @OA\Property(
     *      title="Dropper flow",
     *      format="float",
     *      description="The flow of the dropper (flujo del gotero)",
     *      example="2.0"
     * )
     *
     * @var float
     */

    public $dropper_flow;

    /**
     * @OA\Property(
     *      title="SurcoSeparationId",
     *      format="int64",
     *      description="The ID of the surco separation (separación entre surcos)",
     *      example="1"
     * )
     *
     * @var integer
     */
    public $surco_separation_id;

    /**
     * @OA\Property(
     *      title="Dropper separation",
     *      format="float",
     *      description="The separation between droppers (separación entre goteros mts)",
     *      example="0.5"
     * )
     *
     * @var float
     */

    public $dropper_separation;

    /**
     * @OA\Property(
     *      title="IrrigationStrategyId",
     *      format="int64",
     *      description="The ID of the irrigation strategy (estrategia de riego)",
     *      example="1"
     * )
     *
     * @var integer
     */
    public $irrigation_strategy_id;

    /**
     * @OA\Property(
     *      title="IrrigationMinutes",
     *      format="int64",
     *      description="Minutes for the irrigation (minutos de riego)",
     *      example="80"
     * )
     *
     * @var integer
     */
    public $irrigation_amount_minutes;

    /**
     * @OA\Property(
     *      title="IrrigationDays",
     *      format="int64",
     *      description="The amount of irrigation days per week (# días de riego a la semana)",
     *      example="5"
     * )
     *
     * @var integer
     */
    public $irrigation_frequency_days;