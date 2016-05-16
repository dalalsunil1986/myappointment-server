<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Src\Timing\Timing;
use Illuminate\Http\Request;

class TimingController extends Controller
{
    /**
     * @var Timing
     */
    private $timingRepository;

    /**
     * TimingController constructor.
     * @param Timing $timingRepository
     */
    public function __construct(Timing $timingRepository)
    {
        $this->timingRepository = $timingRepository;
    }

    public function index()
    {
        $timings = $this->timingRepository->all();
        return response()->json(['data' => $timings]);
    }

//    public function getAvailableTimings(Request $request, Timing $timing, CompanyService $companyService)
//    {
//        $companyID = $request->get('company');
//        $serviceID = $request->get('service');
//
//        $companyServices = $companyService->where('company_id', $companyID)->where('service_id', $serviceID)->get();
//
//        $companyServiceIDs = $companyServices->lists('id')->toArray();
//
//        $timings = $timing->where('company_service_id', $companyServiceIDs)->get();
//
//        return response()->json(['data' => $timings]);
//
//    }

}
