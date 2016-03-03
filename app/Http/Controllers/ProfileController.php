<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Src\Appointment\Appointment;
use App\Src\Company\Company;
use App\Src\User\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    private $userRepository;
    private $appointmentRepository;

    /**
     * UserController constructor.
     * @param User $userRepository
     * @param Appointment $appointmentRepository
     */
    public function __construct(User $userRepository,Appointment $appointmentRepository)
    {
        $this->userRepository = $userRepository;
        $this->appointmentRepository = $appointmentRepository;
    }

    public function getFavorites(Request $request)
    {
        $user = Auth::guard('api')->user()->load('favorites');
        $companies =  $user->favorites;
        $companies->map(function($company) use ($user) {
            $company->isFavorited = true;
        });
        return response()->json(['data' => $companies]);
    }

    public function getAppointments(Request $request)
    {
        $user = Auth::guard('api')->user();
        if($user) {
            $appointments = $this->appointmentRepository->with([
                'user','company','employee','timing'
            ])->where('user_id',1)->get();
            foreach($appointments as $app) {
                $app->load(['company.services'=>function($q) use ($app) {
                    $q->where('services.id',$app->service_id)->first();
                }]);
            }
        }
        return response()->json(['data' => $appointments]);
    }


    public function createAppointment(Request $request)
    {
        dd('a');
        //create appointment
        $user = Auth::guard('api')->user();
        $timingID = $request->json('timing_id');
        $companyID = $request->json('company_id');
        $serviceID = $request->json('service_id');
        $employee_id = $request->json('employee_id') ? : 0;
        $date = $request->json('date');
        $date = Carbon::createFromFormat('Y-m-d', $date)->toDateString();
        if($user) {
            try {
                $user->appointments()->create([
                    'timing_id' => $timingID,
                    'service_id' => $serviceID,
                    'company_id' => $companyID,
                    'employee_id' => $employee_id,
                    'date' => $date,
                    'status' => 'confirmed',
                ]);
                return response()->json(['success'=>true]);
            } catch(Exception $e) {
                return response()->json(['success'=>false,'message'=>'error occured while creating appointment']);
            }
        }
        return response()->json(['success'=>false,'message'=>'invalid user']);
    }

    public function cancelAppointment(Request $request)
    {
        //create appointment
        $user = Auth::guard('api')->user();
        if($user) {
            $appointment = $this->appointmentRepository->find($request->json('id'));
            $appointment->delete();
            return response()->json(['success'=>true]);
        }
        return response()->json(['success'=>false,'message'=>'invalid operation']);
    }


    public function favoriteCompany(Request $request,Company $companyRepository, $companyID)
    {
        $company = $companyRepository->find($companyID);
        $user = Auth::guard('api')->user();
        if($user) {
            if(!$user->favorites->contains($company->id)) {
                $user->favorites()->attach($company->id);
            }
        }
        return response()->json(['success'=>true]);
    }

    public function unFavoriteCompany(Request $request,Company $companyRepository, $companyID)
    {
        $company = $companyRepository->find($companyID);
        $user = Auth::guard('api')->user();
        if($user) {
            $user->favorites()->detach($company->id);
            return response()->json(['success'=>true]);
        }
        return response()->json(['success'=>false,'message'=>'invalid operation']);
    }

}
