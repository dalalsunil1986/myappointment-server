<?php

namespace App\Http\Controllers\Admin;

use App\Src\Company\CompanyRepository;
use App\Src\Timing\TimingRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
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
     * CompanyController constructor.
     * @param CompanyRepository $repository
     * @param TimingRepository $timingRepository
     */
    public function __construct(CompanyRepository $repository, TimingRepository $timingRepository)
    {
        $this->companyRepository = $repository;
        $this->timingRepository = $timingRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = $this->companyRepository->model->paginate(100);
        return view('admin.module.company.index',compact('companies'));
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
    public function update(Request $request, $id)
    {
        //
        $company = $this->companyRepository->model->find($id);
        $this->validate($request, [
            'name_en'       => 'required',
//            'cover'          => 'image'
        ]);

        $company->update(array_merge($request->all()));
//
//        if ($request->hasFile('cover')) {
//            $file = $request->file('cover');
//            $photoRepository->replace($file, $blog, ['thumbnail' => 1], $id);
//        }
        return redirect()->action('Admin\CompanyController@show',$id)->with('success','Saved');
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
