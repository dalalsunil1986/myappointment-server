<?php

namespace App\Src\Service;

use App\Src\Service\Service;

class ServiceRepository
{

    public $durations_en = [
        '30 min', '1 hr', '+1 hr'
    ];

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
