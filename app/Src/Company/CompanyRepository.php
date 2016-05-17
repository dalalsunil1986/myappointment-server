<?php

namespace App\Src\Company;

class CompanyRepository
{
    public $model;

    public  $cities = [
        'salmiya',
        'hawally',
        'jahra',
        'qortuba'
    ];

    /**
     * TimingRepository constructor.
     * @param Company $model
     */
    public function __construct(Company $model)
    {
        $this->model = $model;
    }

}
