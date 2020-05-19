<?php

namespace App\virtual\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 
 *
 * @OA\Schema(
 *     description="WaterSource model",
 *     title="Water Source model",
 *     @OA\Xml(
 *         name="WaterSource"
 *     )
 * )
 */

class WaterSource extends Model
{
    use SoftDeletes;

    public $table = 'water_sources';

    

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'capacity',
        'uptake_time',
        'type_id',
        'estate_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

      /**
     * @OA\Property(
     *      title="Name",
     *      description="Name of the Water Source",
     *      example="Rio Cauca"
     * )
     *
     * @var string
     */
    public $name;

/**
     * @OA\Property(
     *      title="Capacity",
     *      format="float",
     *      description="Capacity of the Water Source / M3 para Reservorio , Rio and Pozo M3/h",
     *      example="100.0"
     * )
     *
     * @var float
     */

    public $capacity;

/**
     * @OA\Property(
     *      title="UptakeTime",
     *      format="int64",
     *      description="Uptake Timeof the Water Source in hours",
     *      example="16"
     * )
     *
     * @var integer
     */

    public $uptake_time;

    
/**
     * @OA\Property(
     *      title="TypeId",
     *      format="int64",
     *      description="The ID of the water source Type: (Rio, Pozo, Reservorio)",
     *      example="1"
     * )
     *
     * @var integer
     */
    public $type_id;

    
/**
     * @OA\Property(
     *      title="EstateId",
     *      format="int64",
     *      description="The ID of the estate where belongs the water source",
     *      example="1"
     * )
     *
     * @var integer
     */
    public $estate_id;

    

    public function type()
    {
        return $this->belongsTo(WaterSourceType::class, 'type_id');
    }

    public function estate()
    {
        return $this->belongsTo(Estate::class, 'estate_id');
    }
}
