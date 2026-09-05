<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class PaymentService
{
    /* This is for payment creation */
    public function store(array $data): Payment
    {
        return DB::transaction(function () use ($data) {
            $appointment = Appointment::with(['doctor', 'service'])
                ->findOrFail($data['appointment_id']);

            $this->authorize($appointment);
            $this->validateAmount($appointment, $data['amount']);

            if (Payment::where('appointment_id', $appointment->id)->exists()) {
                throw ValidationException::withMessages([
                    'payment' => 'Payment has already been submitted for this appointment.',
                ]);
            }

            $transactionId = trim($data['transaction_id']);
            $paymentReference = trim($data['payment_reference']);

            if (Payment::where('transaction_id', $transactionId)->exists()) {
                throw ValidationException::withMessages([
                    'transaction_id' => 'This transaction ID has already been used.',
                ]);
            }

            $payment = Payment::create([
                'user_id' => Auth::id(),
                'appointment_id' => $appointment->id,
                'payment_method' => strtolower($data['payment_method']),
                'transaction_id' => $transactionId,
                'payment_reference' => $paymentReference,
                'amount' => $appointment->amount,
                'status' => 'paid',
            ]);

            $appointment->update(['status' => 'confirmed']);

            return $payment->load('appointment');
        });
    }

    /* This is for payment authorization */
    protected function authorize(Appointment $appointment): void
    {
        if ($appointment->user_id !== Auth::id()) {
            throw ValidationException::withMessages([
                'payment' => 'You are not authorized to make payment for this appointment.',
            ]);
        }
    }

    /* This is for payment amount validation */
    protected function validateAmount(Appointment $appointment, $amount): void
    {
        if ((float) $amount !== (float) $appointment->amount) {
            throw ValidationException::withMessages([
                'amount' => 'Please pay the full amount!',
            ]);
        }
    }

    /* This is for payment success redirect */
    public function successRedirect(Payment $payment)
    {
        $appointment = $payment->appointment;
        $route = $appointment->type === 'doctor' ? 'doctor.show' : 'service.show';
        $id = $appointment->type === 'doctor'
            ? $appointment->doctor_id
            : $appointment->service_id;
        $type = $appointment->type === 'doctor' ? 'doctor' : 'service';

        return redirect()->route($route, $id)->with(
            'success',
            "Payment successful! Your {$type} appointment has been confirmed. " .
            "Payment reference: {$payment->payment_reference}"
        );
    }

    /* This is for payment transaction ID */
    public function transactionId(): string
    {
        return 'TXN' . strtoupper(Str::random(12));
    }
}
