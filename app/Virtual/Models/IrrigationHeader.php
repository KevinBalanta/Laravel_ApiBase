<?php

namespace App\virtual\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * 
 *
 * @OA\Schema(
 *     description="IrrigationHeader model",
 *     title="Irrigation Header model",
 *     @OA\Xml(
 *         name="IrrigationHeader"
 *     )
 * )
 */
class IrrigationHeader extends Model
{
    use SoftDeletes;

    public $table = 'irrigation_headers';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'motorpump_id',
        'estate_id',
        'water_source_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];


     /**
     * @OA\Property(
     *      title="Name",
     *      description="Name of the irrigation header",
     *      example="Cabezal A"
     * )
     *
     * @var string
     */
    public $name;

    

    /**
     * @OA\Property(
     *      title="EstateId",
     *      format="int64",
     *      description="The ID of the estate (Hacienda)",
     *      example="1"
     * )
     *
     * @var integer
     */
    public $estate_id;

    /**
     * @OA\Property(
     *      title="WaterSourceId",
     *      format="int64",
     *      description="The ID of the water source (Fuente de agua)",
     *      example="1"
     * )
     *
     * @var integer
     */
    public $water_source_id;

    /**
     * @OA\Property(
     *      title="Motorpump brand",
     *      description="The brand of the motorpump (la marca de la motobomba)",
     *      example="Honda"
     * )
     *
     * @var string
     */
    public $motorpump_brand;


    /**
     * @OA\Property(
     *      title="Motorpump reference",
     *      description="The reference of the motorpump (la ref de la motobomba)",
     *      example="modelo XYZ"
     * )
     *
     * @var string
     */
    public $motorpump_reference;

    /**
     * @OA\Property(
     *      title="Motorpump HP",
     *      format="float",
     *      description="The HP of the motorpump (caballos de fuerza de la motobomba)",
     *      example="10.5"
     * )
     *
     * @var float
     */

    public $motorpump_hp;


    /**
     * @OA\Property(
     *      title="Motorpump flow",
     *      format="float",
     *      description="The flow of the motorpump (flujo de la motobomba)",
     *      example="5.5"
     * )
     *
     * @var float
     */

    public $motorpump_flow;





    public function motorpump()
    {
        return $this->belongsTo(Motorpump::class, 'motorpump_id');
    }

    public function estate()
    {
        return $this->belongsTo(Estate::class, 'estate_id');
    }

    public function water_source()
    {
        return $this->belongsTo(WaterSource::class, 'water_source_id');
    }
}
