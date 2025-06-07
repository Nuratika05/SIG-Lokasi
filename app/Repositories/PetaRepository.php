<?php

namespace App\Repositories;

use App\Models\Peta;
use App\Repositories\BaseRepository;

/**
 * Class PetaRepository
 * @package App\Repositories
 * @version February 28, 2024, 8:09 am UTC
*/

class PetaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nomor',
        'keterangan',
        'x',
        'y'
    ];

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
        return Peta::class;
    }
}
