<div class="row">

    {{-- TOTAL --}}
    <div class="col-lg-3 col-md-6 col-12">

        <div class="small-box bg-info shadow-sm">

            <div class="inner">

                <h3>
                    {{ $totalAppointments }}
                </h3>

                <p>
                    Total Appointments
                </p>

            </div>

            <div class="icon">
                <i class="fas fa-calendar-check"></i>
            </div>

        </div>

    </div>

    {{-- EARNINGS --}}
    <div class="col-lg-3 col-md-6 col-12">

        <div class="small-box bg-success shadow-sm">

            <div class="inner">

                <h3>
                    ৳{{ number_format($totalEarnings, 2) }}
                </h3>

                <p>
                    Total Earnings
                </p>

            </div>

            <div class="icon">
                <i class="fas fa-money-bill-wave"></i>
            </div>

        </div>

    </div>

    {{-- CONFIRMED --}}
    <div class="col-lg-3 col-md-6 col-12">

        <div class="small-box bg-primary shadow-sm">

            <div class="inner">

                <h3>
                    {{ $completedAppointments }}
                </h3>

                <p>
                    Confirmed
                </p>

            </div>

            <div class="icon">
                <i class="fas fa-check-circle"></i>
            </div>

        </div>

    </div>

    {{-- CANCELLED --}}
    <div class="col-lg-3 col-md-6 col-12">

        <div class="small-box bg-danger shadow-sm">

            <div class="inner">

                <h3>
                    {{ $cancelledAppointments }}
                </h3>

                <p>
                    Cancelled
                </p>

            </div>

            <div class="icon">
                <i class="fas fa-times-circle"></i>
            </div>

        </div>

    </div>

</div>
