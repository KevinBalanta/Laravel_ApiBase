<?php

namespace App\virtual\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * 
 *
 * @OA\Schema(
 *     description="EstateIrrigationSystem model",
 *     title="Estate Irrigation System model",
 *     @OA\Xml(
 *         name="EstateIrrigationSystem"
 *     )
 * )
 */
class EstateIrrigationSystem extends Model
{
    use SoftDeletes;

    public $table = 'estate_irrigation_systems';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'estate_id',
        'irrigation_system_id',
        'configuration_id',
        'irrigation_header_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * @OA\Property(
     *      title="Name",
     *      description="Name of the irrigation system (min: 3 characters)",
     *      example="Sistema A"
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *      title="MinimumTension",
     *      format="int64",
     *      description="The minimum tension for the system (configuration)",
     *      example="1"
     * )
     *
     * @var integer
     */
    public $minimum_tension;


    /**
     * @OA\Property(
     *      title="MaximumTension",
     *      format="int64",
     *      description="The maximum tension for the system (configuration)",
     *      example="70"
     * )
     *
     * @var integer
     */
    public $maximum_tension;

    /**
     * @OA\Property(
     *      title="MinimumLevelWater",
     *      format="int64",
     *      description="The minimum level of water for the system (configuration)",
     *      example="1"
     * )
     *
     * @var integer
     */
    public $minimum_level_water;


    /**
     * @OA\Property(
     *      title="MaximumLevelWater",
     *      format="int64",
     *      description="The maximum level of water for the system (configuration)",
     *      example="70"
     * )
     *
     * @var integer
     */
    public $maximum_level_water;

    
    /**
     * @OA\Property(
     *     title="Start Time",
     *     description="The initial time to start system operations (format hh:mm:ss 24h)",
     *     example="07:00:00",
     *     format="time",
     *     type="string"
     * )
     *
     * @var \Time
     */
    private $start_time;

     /**
     * @OA\Property(
     *     title="End Time",
     *     description="The final time of the system operations (format hh:mm:ss 24h)",
     *     example="17:00:00",
     *     format="time",
     *     type="string"
     * )
     *
     * @var \Time
     */
    private $end_time;

    /**
     * @OA\Property(
     *      title="Lamina",
     *      format="float",
     *      description="Lámina de agua % (número entre 0 y 1)",
     *      example="1.0"
     * )
     *
     * @var float
     */

    public $lamina;

    /**
     * @OA\Property(
     *      title="IrrigationSystemId",
     *      format="int64",
     *      description="The ID of the irrigation system ",
     *      example="1"
     * )
     *
     * @var integer
     */
    public $irrigation_system_id;

    /**
     * @OA\Property(
     *      title="EstateId",
     *      format="int64",
     *      description="The ID of the estate (hacienda) ",
     *      example="1"
     * )
     *
     * @var integer
     */
    public $estate_id;

    /**
     * @OA\Property(
     *      title="IrrigationHeaderId",
     *      format="int64",
     *      description="The ID of the irrigation header (cabezal de riego) ",
     *      example="1"
     * )
     *
     * @var integer
     */
    public $irrigation_header_id;



    /**
     * @var DripIrrigationModules[]
     * @OA\Property(@OA\Xml(name="DripIrrigationModules", wrapped=true))
     */
    public $modules;







    public function estate()
    {
        return $this->belongsTo(Estate::class, 'estate_id');
    }

    public function irrigation_system()
    {
        return $this->belongsTo(IrrigationSystem::class, 'irrigation_system_id');
    }

    public function configuration()
    {
        return $this->belongsTo(Configuration::class, 'configuration_id');
    }

    public function irrigation_header()
    {
        return $this->belongsTo(IrrigationHeader::class, 'irrigation_header_id');
    }

   
    
}
