<?php

namespace App\Http\Controllers\Api;

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
        $user->favorites->map(function($company) use ($user) {
            $company->isFavorited = true;
        });
        $user->latest()->paginate(100);
        return response()->json(['data' => $user]);
    }

    public function getAppointments(Request $request)
    {
        $user = Auth::guard('api')->user();
        if($user) {
            $appointments = $this->appointmentRepository->with([
                'user','company','employee','timing','service'
            ])->where('user_id',$user->id)->where('date','>',Carbon::now())->get();
            foreach($appointments as $app) {
                $app->load('pivot');
            }
        }
        return response()->json(['data' => $appointments]);
    }


    public function makeAppointment(Request $request)
    {
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
            if($appointment) {
//                $appointment->delete();
                return response()->json(['success'=>true]);
            }
            return response()->json(['success'=>false,'message'=>'invalid appointment']);
        }
        return response()->json(['success'=>false,'message'=>'invalid operation']);
    }


    public function favoriteCompany(Request $request,Company $companyRepository)
    {
        $company = $companyRepository->find($request->json('company'));
        $user = Auth::guard('api')->user();
        if($user && $company) {
            if($user->favorites->contains($company->id)) {
                $user->favorites()->detach($company->id);
                return response()->json(['success'=>true,'message'=>'unfavorited']);
            } else {
                $user->favorites()->attach($company->id);
                return response()->json(['success'=>true,'message'=>'favorited']);
            }
        }
        return response()->json(['success'=>false]);
    }

}
