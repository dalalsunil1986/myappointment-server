<?php

namespace App\Http\Controllers\Admin;

use App\Src\Company\CompanyRepository;
use App\Src\Employee\Employee;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CompanyEmployeeController extends Controller
{
    /**
     * @var Company
     */
    private $companyRepository;
    /**
     * @var Employee
     */
    private $employeeRepository;

    /**
     * CompanyController constructor.
     * @param CompanyRepository $repository
     * @param Employee $employeeRepository
     */
    public function __construct(CompanyRepository $repository, Employee $employeeRepository)
    {
        $this->companyRepository = $repository;
        $this->employeeRepository = $employeeRepository;
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
        $employees = $this->employeeRepository->whereNotIn('id', $company->employees->modelKeys())->get();
        return view('admin.module.company.employee.index',compact('company','employees'));
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
    public function show($companyID,$employeeID)
    {
        $company = $this->companyRepository->model->find($companyID);
        $employee = $this->employeeRepository->find($employeeID);
        return view('admin.module.company.employee.view',compact('company','employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($companyID, $employeeID)
    {
        $company = $this->companyRepository->model->find($companyID);
        $employee = $this->employeeRepository->find($employeeID);
        return view('admin.module.company.edit',compact('company','employee'));
    }

    public function update(Request $request,$companyID,$employeeID)
    {
        //@todo : allow if other companies has the same employee name // bug only while updating
        $this->validate($request,[
            'name_en' => 'required|string|unique:employees,name_en,'.$employeeID
        ]);
        $employee = $this->employeeRepository->find($employeeID);
        $employee->update($request->all());
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
