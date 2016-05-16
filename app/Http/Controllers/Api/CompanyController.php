<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Src\Company\Company;
use App\Src\Service\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function index(Request $request)
    {
        $userID = Auth::guard('api')->user() ? Auth::guard('api')->user()->id  :'0';
        $searchString = trim($request->get('search') ? $request->get('search') : '' );
        $companies = $this->companyRepository->with(['favorites']);
        $companies = $companies->where('name_en', 'LIKE', "%$searchString%")->orWhere('city_en','LIKE',"%$searchString%")->get();
        $companies->map(function($company) use ($userID) {
            $company->isFavorited = $company->favorites->contains($userID);
        });
        return response()->json(['data'=>$companies]);
    }

    public function show($id)
    {
        $userID = Auth::guard('api')->user() ? Auth::guard('api')->user()->id  :'0';
        $company = $this->companyRepository->with(['favorites','services','employees'])->find($id);
        $company->isFavorited = $company->favorites->contains($userID);
        return response()->json(['data'=>$company]);
    }

    public function getEmployees()
    {

    }

    public function getHolidays()
    {

    }

    public function getMarkers()
    {
        $companies = $this->companyRepository->select(['id','name_en','city_en','latitude','longitude'])->get();
        return response()->json(['data'=>$companies]);
    }
}
