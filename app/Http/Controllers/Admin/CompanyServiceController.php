<?php

namespace App\Http\Controllers\Admin;

use App\Src\Company\CompanyRepository;
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
     * CompanyController constructor.
     * @param CompanyRepository $repository
     * @param ServiceRepository $serviceRepository
     * @param TimingRepository $timingRepository
     */
    public function __construct(CompanyRepository $repository, ServiceRepository $serviceRepository, TimingRepository $timingRepository)
    {
        $this->companyRepository = $repository;
        $this->timingRepository = $timingRepository;
        $this->serviceRepository = $serviceRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($companyID)
    {
        $company = $this->companyRepository->model->with(['services'])->find($companyID);
        $services = $this->serviceRepository->model->whereNotIn('id',$company->services->modelKeys())->get();
        return view('admin.module.company.service.index',compact('company','services'));
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = $this->companyRepository->model->find($id);
        return view('admin.module.company.view',compact('company'));
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
        return view('admin.module.company.edit',compact('company','timings','cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateService(Request $request, $id)
    {
        $company = $this->companyRepository->model->find($id);

        if ($request->services) {
            $company->services()->attach($request->services);
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
