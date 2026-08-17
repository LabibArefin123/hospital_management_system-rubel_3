<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'appointment_id',
        'payment_method',
        'transaction_id',
        'amount',
        'card_number',
        'expiry',
        'cvv',
        'status',
    ];

    /* =========================================================
        CASTS
    ========================================================= */
    protected $casts = [
        'amount' => 'decimal:2',
    ];

    /* =========================================================
        USER RELATION
    ========================================================= */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /* =========================================================
        APPOINTMENT RELATION
    ========================================================= */
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    /* =========================================================
        ACCESSOR : MASKED CARD
    ========================================================= */
    public function getMaskedCardAttribute()
    {
        if (!$this->card_number) {
            return 'N/A';
        }

        return '**** **** **** ' . $this->card_number;
    }

    /* =========================================================
        ACCESSOR : STATUS BADGE
    ========================================================= */
    public function getStatusBadgeAttribute()
    {
        return match ($this->status) {

            'paid' => '<span class="badge badge-success px-3 py-2">Paid</span>',

            'failed' => '<span class="badge badge-danger px-3 py-2">Failed</span>',

            default => '<span class="badge badge-warning px-3 py-2">Pending</span>',
        };
    }
}
