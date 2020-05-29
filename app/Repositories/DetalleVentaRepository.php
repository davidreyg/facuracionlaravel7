<?php

namespace App\Repositories;

use App\Models\DetalleVenta;

/**
 * Class ProductoRepository
 * @package App\Repositories\V1
 * @version April 10, 2020, 7:21 pm -05
 */

class DetalleVentaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return DetalleVenta::class;
    }
}
