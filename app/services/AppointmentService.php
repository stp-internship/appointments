<?php

namespace App\Services;

use App\Models\Appointment;

class AppointmentService
{

    public function store($data)
    {
        return Appointment::create($data);
    }

    public function edit($appointmentId)
    {
        return Appointment::findOrFail($appointmentId);
    }

    public function update($data, $appointmentId)
    {
        $appointment = Appointment::findOrFail($appointmentId);
        $appointment->update($data);
        return $appointment;
    }

    public function destroy($appointmentId)
    {
        $appointment = Appointment::findOrFail($appointmentId);
        $appointment->delete();
        return $appointment;
    }
}
