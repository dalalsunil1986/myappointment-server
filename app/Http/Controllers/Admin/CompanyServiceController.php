<?php

namespace App\Http\Controllers\Admin;

use App\Src\Company\CompanyRepository;
use App\Src\Company\CompanyService;
use App\Src\Service\ServiceRepository;
use App\Src\Timing\TimingRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CompanyServiceController extends Controller
{
    /**
     * @var Company
     */
    private $companyRepository;
    /**
     * @var TimingRepository
     */
    private $timingRepository;
    /**
     * @var ServiceRepository
     */
    private $serviceRepository;
    /**
     * @var CompanyService
     */
    private $companyService;

    /**
     * CompanyController constructor.
     * @param CompanyRepository $repository
     * @param ServiceRepository $serviceRepository
     * @param TimingRepository $timingRepository
     */
    public function __construct(CompanyRepository $repository, ServiceRepository $serviceRepository, TimingRepository $timingRepository, CompanyService $companyService)
    {
        $this->companyRepository = $repository;
        $this->timingRepository = $timingRepository;
        $this->serviceRepository = $serviceRepository;
        $this->companyService = $companyService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($companyID)
    {
        $company = $this->companyRepository->model->with(['services'=>function($q) {
            $q->latest();
        }])->find($companyID);
        $services = $this->serviceRepository->model->whereNotIn('id', $company->services->modelKeys())->get();
        $durations = $this->serviceRepository->durations_en;
        return view('admin.module.company.service.index',compact('company','services','durations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($companyID,$serviceID)
    {
        $companyService = $this->companyService->with(['company','service'])
            ->where('company_id',$companyID)
            ->where('service_id',$serviceID)
            ->first()
        ;

        $durations = $this->serviceRepository->durations_en;

        return view('admin.module.company.service.view',compact('companyService','durations'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $companyRepo = $this->companyRepository;
        $company = $companyRepo->model->find($id);
        $timings = $this->timingRepository->timings;
        $cities = $companyRepo->cities;
        $durations = $companyRepo->durations;
        return view('admin.module.company.edit',compact('company','timings','cities','durations'));
    }

    public function update(Request $request,$companyID,$serviceID)
    {
        $this->validate($request,[
//            'price'=>'integer'
        ]);

        $companyService = $this->companyService->with(['company','service'])
            ->where('company_id',$companyID)
            ->where('service_id',$serviceID)
            ->first()
        ;

        $companyService->update($request->all());

        return redirect()->back()->with('success','Saved');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {

        $this->validate($request,[
            'service' => 'required|integer|unique:company_services,service_id,null,'.$id.',company_id,'.$id
        ]);

        $company = $this->companyRepository->model->find($id);

        // strip duplicates
        $companyServices = $company->services->modelKeys();

        // @todo : use sync
        if ($request->service) {
//            $newServices = collect($request->services)->filter(function ($item) use ($companyServices) {
//                return !in_array($item,$companyServices);
//            })->toArray();
            if(!in_array($request->service,$companyServices)) {
                $company->services()->attach($request->service,$request->except(['service','_token']));
            }
        }

        return redirect()->back()->with('success','Saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
