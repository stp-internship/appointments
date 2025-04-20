<?php

namespace App\Http\Controllers;

use App\Http\Requests\Appointmen\AppointmenStoreRequest;
use App\Models\Appointment;
use App\Services\AppointmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

class AppointmentController extends Controller
{


    private $appointmentService;

    public function __construct(AppointmentService $appointmentService)
    {
        $this->appointmentService = $appointmentService;
    }


    public function getAppointments()
    {
        $appointments = Appointment::orderBy('appointment_date')->get();
        return view('welcome', compact('appointments'));
    }

    public function store(AppointmenStoreRequest $request)
    {
        $this->appointmentService->store($request->validated());
        return redirect()->route('appointments.get')->with('message', 'تم انشاء موعد بنجاح');
    }

    public function edit($appointmentId)
    {
        $appointment= $this->appointmentService->edit($appointmentId);

        return view('welcome', compact('appointment'));
    }

    public function update(AppointmenStoreRequest $request, $appointmentId)
    {
        $this->appointmentService->update($request->validated(), $appointmentId);

        return redirect()->route('appointments.get')->with('message', 'تم التحديث بنجاح');
    }


    public function destroy($appointmentId)
    {
        $this->appointmentService->destroy($appointmentId);
        return redirect()->route('appointments.get')->with('message', 'تم الحذف بنجاح');

    }
}
