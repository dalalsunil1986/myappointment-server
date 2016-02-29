<?php

namespace App\Http\Controllers\Api;

use App\Events\AppointmentCreated;
use App\Http\Controllers\Controller;
use App\Src\Appointment\Appointment;
use App\Src\Appointment\AppointmentRepository;
use App\Src\Company\TimingRepository;
use App\Src\Timing\Timing;
use App\Src\User\User;
use App\Src\User\UserRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * @var UserRepository
     */
    private $user;
    /**
     * @var TimingRepository
     */
    private $timing;
    /**
     * @var AppointmentRepository
     */
    private $appointment;

    /**
     * AppointmentController constructor.
     * @param UserRepository $user
     * @param TimingRepository $timing
     * @param AppointmentRepository $appointment
     */
    public function __construct(
        User $user,
        Timing $timing,
        Appointment $appointment
    ) {
        $this->user = $user;
        $this->timing = $timing;
        $this->appointment = $appointment;
    }

    /**
     * Create an appointment
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAppointment(Request $request)
    {
        $userId = $request->json('user_id');
        $timingId = $request->json('timing_id');
        $date = $request->json('date');
        $user = $this->user->find($userId);
        $date = Carbon::createFromFormat('Y-m-d', $date)->toDateString();

        $appointment = $this->appointment->create([
            'user_id' => $user->id,
            'timing_id' => $timingId,
            'date' => $date
        ]);

        try {
            event(new AppointmentCreated($appointment));
            return response()->json([
                'success' => true,
            ], 200);

        } catch (\Exception $e) {
            dd($e->getMessage());
            return response()->json(['success' => false,'message'=>$e->getMessage()], 401);
        }

        return response()->json(['status' => 'success'], 200);
    }

}
