<?php

namespace App\Http\Controllers\Admin;

use App\Src\Appointment\Appointment;
use App\Src\Company\CompanyRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CompanyAppointmentController extends Controller
{
    /**
     * @var Company
     */
    private $companyRepository;
    /**
     * @var Appointment
     */
    private $appointmentRepository;

    /**
     * CompanyController constructor.
     * @param CompanyRepository $repository
     * @param Appointment $appointmentRepository
     */
    public function __construct(CompanyRepository $repository, Appointment $appointmentRepository)
    {
        $this->companyRepository = $repository;
        $this->appointmentRepository = $appointmentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param $companyID
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$companyID)
    {
//        dd(Carbon::now()->toDateTimeString());
        $appointments = $this->appointmentRepository->with([
            'user','service',
            'timing','employee',
        ])->where('company_id',$companyID)->orderBy('date','desc');
        if($request->type == 'past') {
            $appointments->where('date','<',Carbon::now()->toDateTimeString());
        } elseif($request->type == 'all') {
            // dont run query, (will output all the records)
        } else {
            $appointments->where('date','>',Carbon::now()->toDateTimeString())->orderBy('date','asc');
        }
        $appointments = $appointments->get();
        $company = $this->companyRepository->model->find($companyID);
        return view('admin.module.company.appointment.index',compact('appointments','company'));
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
    public function store(Request $request, $id)
    {
        $this->validate($request,[
            'name_en' => 'required|string|unique:employees,name_en,null,'.$id.',company_id,'.$id
        ]);

        $company = $this->companyRepository->model->find($id);
        // strip duplicates
        // @todo : use sync
        $company->employees()->create($request->all());
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
