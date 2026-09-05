<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /*  INDEX PAGE*/
    public function index(Request $request)
    {
        $payments = Payment::with([
            'user',
            'appointment.doctor',
            'appointment.service',
        ])
            ->when($request->status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->when($request->payment_method, function ($query, $method) {
                $query->where('payment_method', $method);
            })
            ->when($request->type, function ($query, $type) {
                $query->whereHas('appointment', function ($query) use ($type) {
                    $query->where('type', $type);
                });
            })
            ->when($request->date, function ($query, $date) {
                $query->whereDate('created_at', $date);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        foreach ($payments as $payment) {
            $appointment = $payment->appointment;
            $type = $appointment?->type;
            $method = strtolower($payment->payment_method ?? '');
            $status = strtolower($payment->status ?? '');

            $payment->patient_name = $payment->user->name ?? 'Guest User';
            $payment->patient_phone = $payment->user->phone ?? null;
            $payment->appointment_number = $appointment ? '#' . $appointment->id : 'N/A';

            $payment->provider_name = match ($type) {
                'doctor' => $appointment->doctor->name ?? 'N/A',
                'service' => $appointment->service->title ?? 'N/A',
                default => 'N/A',
            };

            $payment->provider_type = match ($type) {
                'doctor' => 'Doctor',
                'service' => 'Service',
                default => 'N/A',
            };

            $payment->provider_image = match ($type) {
                'doctor' => $appointment->doctor->image ?? null,
                'service' => $appointment->service->image ?? null,
                default => null,
            };

            $payment->provider_image_url = $payment->provider_image
                ? asset($payment->provider_image)
                : asset('images/default-avatar.png');

            $payment->transaction_display = $payment->transaction_id ?? 'N/A';
            $payment->reference_display = $payment->payment_reference ?? 'N/A';
            $payment->formatted_amount = number_format($payment->amount, 2);

            $payment->method_label = match ($method) {
                'bkash' => 'bKash',
                'nagad' => 'Nagad',
                'rocket' => 'Rocket',
                default => ucfirst($payment->payment_method ?? 'N/A'),
            };

            $payment->method_badge = match ($method) {
                'bkash' => 'primary',
                'nagad' => 'warning',
                'rocket' => 'info',
                default => 'secondary',
            };

            $payment->status_label = match ($status) {
                'paid' => 'Paid',
                'failed' => 'Failed',
                default => 'Pending',
            };

            $payment->status_badge = match ($status) {
                'paid' => 'success',
                'failed' => 'danger',
                default => 'warning',
            };

            $payment->formatted_date = $payment->created_at?->format('d M Y') ?? 'N/A';
            $payment->formatted_time = $payment->created_at?->format('h:i A') ?? 'N/A';
        }

        return view('backend.payment.index', compact('payments'));
    }

    /* =========================================================
        SHOW PAGE
    ========================================================= */
    public function show($id)
    {
        $payment = Payment::with([
            'user',
            'appointment.doctor',
            'appointment.service',
        ])->findOrFail($id);

        $appointment = $payment->appointment;
        $method = strtolower($payment->payment_method ?? '');
        $type = strtolower($appointment->type ?? '');
        $appointmentStatus = strtolower($appointment->status ?? '');
        $paymentStatus = strtolower($payment->status ?? '');

        $appointment->type_label = ucfirst($appointment->type ?? 'N/A');
        $appointment->provider_name = match ($type) {
            'doctor' => $appointment->doctor->name ?? 'N/A',
            'service' => $appointment->service->title ?? 'N/A',
            default => 'N/A',
        };

        $appointment->formatted_date = $appointment->appointment_date
            ? \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y')
            : 'N/A';

        $appointment->formatted_time = $appointment->appointment_time
            ? \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A')
            : 'N/A';

        $appointment->status_label = match ($appointmentStatus) {
            'confirmed' => 'Confirmed',
            'pending' => 'Pending',
            default => ucfirst($appointment->status ?? 'N/A'),
        };

        $appointment->status_badge = match ($appointmentStatus) {
            'confirmed' => 'success',
            'pending' => 'warning',
            default => 'secondary',
        };

        $payment->formatted_amount = number_format($payment->amount, 2);
        $payment->formatted_created_at = $payment->created_at?->format('d M Y, h:i A');

        $payment->method_label = match ($method) {
            'bkash' => 'bKash',
            'nagad' => 'Nagad',
            'rocket' => 'Rocket',
            default => ucfirst($payment->payment_method ?? 'N/A'),
        };

        $payment->method_badge = match ($method) {
            'bkash' => 'primary',
            'nagad' => 'warning',
            'rocket' => 'info',
            default => 'secondary',
        };

        $payment->status_label = match ($paymentStatus) {
            'paid' => 'Paid',
            'failed' => 'Failed',
            default => 'Pending',
        };
        
        $payment->status_badge = match ($paymentStatus) {
            'paid' => 'success',
            'failed' => 'danger',
            default => 'warning',
        };

        return view('backend.payment.show', compact('payment'));
    }

    /* =========================================================
        DELETE
    ========================================================= */
    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);

        $payment->delete();

        return back()->with('success', 'Payment deleted successfully!');
    }
}
