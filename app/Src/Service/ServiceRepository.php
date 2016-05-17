<?php

namespace App\Src\Service;

use App\Src\Service\Service;

class ServiceRepository
{
    public $model;
    /**
     * TimingRepository constructor.
     * @param Service $model
     */
    public function __construct(Service $model)
    {
        $this->model = $model;
    }

}
