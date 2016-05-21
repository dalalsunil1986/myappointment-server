<?php

namespace App\Http\Controllers\Admin;

use App\Core\ImageUploader;
use App\Src\Company\CompanyRepository;
use App\Src\Timing\TimingRepository;
use Illuminate\Http\Request;
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
     * @var ImageUploader
     */
    private $imageUploader;

    /**
     * CompanyController constructor.
     * @param CompanyRepository $repository
     * @param TimingRepository $timingRepository
     * @param ImageUploader $imageUploader
     */
    public function __construct(CompanyRepository $repository, TimingRepository $timingRepository, ImageUploader $imageUploader)
    {
        $this->companyRepository = $repository;
        $this->timingRepository = $timingRepository;
        $this->imageUploader = $imageUploader;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companyRepo = $this->companyRepository;
        $companies = $companyRepo->model->paginate(100);
        $timings = $this->timingRepository->timings;
        $cities = $companyRepo->cities;
        return view('admin.module.company.index',compact('companies','timings','cities'));
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
        $this->validate($request, [
            'name_en' => 'required|string|unique:companies,name_en',
            'image' => 'image'
        ]);

        $uploaded = false;
        $companyRepo = $this->companyRepository->model;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageUploader = $this->imageUploader->upload($file, $companyRepo);
            $uploaded = true;
        }

        $company = $companyRepo->create(array_merge(
            $request->all(),
            ['image'=> $uploaded ?  url(env('IMAGES_UPLOAD_DIR').env('LARGE_IMAGE_DIR').$imageUploader->getHashedName()) : null]
        ));

        return redirect()->action('Admin\CompanyController@show',$company->id)->with('success','Saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $companyRepo = $this->companyRepository;
        $company = $companyRepo->model->find($id);
        $timings = $this->timingRepository->timings;
        $cities = $companyRepo->cities;

        return view('admin.module.company.view',compact('company','cities','timings'));
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
            'name_en' => 'required|string|unique:companies,name_en,'.$id,
            'image'          => 'image'
        ]);

        $uploaded = false;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageUploader = $this->imageUploader->upload($file, $company);
            $uploaded = true;
        }

        $company->update(array_merge(
            $request->all(),
            ['image'=> $uploaded ?  url(env('IMAGES_UPLOAD_DIR').env('LARGE_IMAGE_DIR').$imageUploader->getHashedName()) : $company->image]
        ));

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
