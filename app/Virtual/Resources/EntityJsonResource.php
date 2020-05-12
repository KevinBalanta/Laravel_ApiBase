<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     title="EntityJsonResource",
 *     description="A Json wrapper resource",
 *     @OA\Xml(
 *         name="EntityJsonResource"
 *     )
 * )
 */

class EntityJsonResource extends JsonResource
{

    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\Project[]
     */
    private $data;
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}