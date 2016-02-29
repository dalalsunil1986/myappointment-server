<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Src\Company\Company;
use App\Src\Service\Service;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * @var Company
     */
    private $companyRepository;
    /**
     * @var Service
     */
    private $serviceRepository;

    /**
     * CompanyController constructor.
     * @param Company $companyRepository
     * @param Service $serviceRepository
     */
    public function __construct(Company $companyRepository,Service $serviceRepository)
    {
        $this->companyRepository = $companyRepository;
        $this->serviceRepository = $serviceRepository;
    }

    public function index()
    {
        $companies = $this->companyRepository->with(['services','employees'])->get();
        return response()->json(['data'=>$companies]);
    }

    public function show($id)
    {
        $company = $this->companyRepository->with(['services','employees'])->find($id);
        return response()->json(['data'=>$company]);
    }

    public function getEmployees()
    {

    }

    /**
     * @param Request $request
     */
    public function getTimings(Request $request,$companyID,$serviceID)
    {
        $date = $request->date;
        $company = $this->companyRepository->find($companyID);
        $service = $this->serviceRepository->find($serviceID);

        // get all the timings for the company ?

        return response()->json(['data'=>$company->services]);

    }

    public function getHolidays()
    {

    }

}
