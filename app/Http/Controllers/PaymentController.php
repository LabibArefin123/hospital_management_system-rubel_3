<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /* =========================================================
        INDEX PAGE
    ========================================================= */
    public function index()
    {
        $payments = Payment::with(['user', 'appointment'])
            ->latest()
            ->paginate(10);

        return view('backend.payment.index', compact('payments'));
    }

    /* =========================================================
        SHOW PAGE
    ========================================================= */
    public function show($id)
    {
        $payment = Payment::with(['user', 'appointment.doctor', 'appointment.service'])
            ->findOrFail($id);

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
