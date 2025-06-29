@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Admin Reservation Management'])
    
    <!-- Statistics Cards -->
    <div class="row mt-4 mx-4">
        <div class="col-xl-3 col-sm-6 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Reservations</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $totalReservations }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-single-copy-04 text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Pending</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $pendingReservations }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-warning shadow text-center border-radius-md">
                                <i class="ni ni-time-alarm text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Today's Reservations</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $todayReservations }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                                <i class="ni ni-calendar-grid-58 text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Completed</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $completedReservations }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-success shadow text-center border-radius-md">
                                <i class="ni ni-check-bold text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Reservation Table -->
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6>Reservation Management</h6>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addReservationModal">
                            <i class="ni ni-fat-add"></i> Add Reservation
                        </button>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <select class="form-select" id="statusFilter">
                                <option value="">All Status</option>
                                <option value="hold">Hold</option>
                                <option value="verify">Verified</option>
                                <option value="arrived">Arrived</option>
                                <option value="done">Done</option>
                                <option value="cancel">Cancelled</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" id="doctorFilter">
                                <option value="">All Doctors</option>
                                @foreach($doctors as $doctor)
                                    <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="date" class="form-control" id="dateFilter">
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="searchInput" placeholder="Search patient...">
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="reservationsTable">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Queue #</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Patient</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Doctor</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Time</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Complaint</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($reservations as $reservation)
                                <tr class="reservation-row" 
                                    data-status="{{ $reservation->status }}"
                                    data-doctor="{{ $reservation->docter->id }}"
                                    data-date="{{ $reservation->created_at->format('Y-m-d') }}"
                                    data-patient="{{ strtolower($reservation->user->name) }}">
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">
                                            {{ $reservation->queue_number ?? 'N/A' }}
                                        </p>
                                    </td>
                                    <td>
                                        <div class="d-flex px-3 py-1">
                                            <div>
                                                <img src="{{ $reservation->user->photo !== null ? url($reservation->user->photo) : asset('assets/img/default.png') }}"
                                                    class="avatar me-3" alt="photo">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $reservation->user->name }}</h6>
                                                <p class="text-xs text-secondary mb-0">{{ $reservation->user->phone }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-3 py-1">
                                            <div>
                                                <img src="{{ $reservation->docter->photo !== null ? url($reservation->docter->photo) : asset('assets/img/default.png') }}"
                                                    class="avatar me-3" alt="doctor photo">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $reservation->docter->name }}</h6>
                                                <p class="text-xs text-secondary mb-0">{{ $reservation->docter->category->name }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">{{ $reservation->time_reservation }}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">{{ Str::limit($reservation->remarks, 50) }}</p>
                                    </td>
                                    <td>
                                        <span class="badge badge-sm 
                                            @if($reservation->status == 'hold') bg-warning
                                            @elseif($reservation->status == 'verify') bg-info
                                            @elseif($reservation->status == 'arrived') bg-primary
                                            @elseif($reservation->status == 'done') bg-success
                                            @elseif($reservation->status == 'cancel') bg-danger
                                            @endif">
                                            {{ ucfirst($reservation->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">{{ $reservation->created_at->format('d M Y H:i') }}</p>
                                    </td>
                                    <td class="align-middle text-end">
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('admin.reservations.show', $reservation->id) }}" class="btn btn-info btn-sm">
                                                <i class="ni ni-single-02"></i> Detail
                                            </a>
                                            @if($reservation->status === 'hold')
                                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#cancelModal{{ $reservation->id }}">
                                                    <i class="ni ni-fat-remove"></i> Cancel
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cancel Modals -->
    @foreach ($reservations as $reservation)
        @if($reservation->status === 'hold')
        <div class="modal fade" id="cancelModal{{ $reservation->id }}" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cancelModalLabel">Cancel Reservation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('admin.reservations.cancel', $reservation->id) }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="modal-body">
                            <p>Are you sure you want to cancel this reservation?</p>
                            <div class="form-group">
                                <label for="remark_cancel">Cancel Reason (Required)</label>
                                <textarea name="remark_cancel" class="form-control" rows="4" placeholder="Please provide a reason for cancellation..." required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Cancel Reservation</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endif
    @endforeach

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusFilter = document.getElementById('statusFilter');
            const doctorFilter = document.getElementById('doctorFilter');
            const dateFilter = document.getElementById('dateFilter');
            const searchInput = document.getElementById('searchInput');
            const tableRows = document.querySelectorAll('.reservation-row');

            function filterTable() {
                const statusValue = statusFilter.value;
                const doctorValue = doctorFilter.value;
                const dateValue = dateFilter.value;
                const searchValue = searchInput.value.toLowerCase();

                tableRows.forEach(row => {
                    const status = row.getAttribute('data-status');
                    const doctor = row.getAttribute('data-doctor');
                    const date = row.getAttribute('data-date');
                    const patient = row.getAttribute('data-patient');

                    const statusMatch = !statusValue || status === statusValue;
                    const doctorMatch = !doctorValue || doctor === doctorValue;
                    const dateMatch = !dateValue || date === dateValue;
                    const searchMatch = !searchValue || patient.includes(searchValue);

                    if (statusMatch && doctorMatch && dateMatch && searchMatch) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            statusFilter.addEventListener('change', filterTable);
            doctorFilter.addEventListener('change', filterTable);
            dateFilter.addEventListener('change', filterTable);
            searchInput.addEventListener('input', filterTable);

            // Set today's date as default
            const today = new Date().toISOString().split('T')[0];
            dateFilter.value = today;
            filterTable();

            // Set default datetime for reservation time
            const now = new Date();
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const day = String(now.getDate()).padStart(2, '0');
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const defaultDateTime = `${year}-${month}-${day}T${hours}:${minutes}`;
            
            const timeReservationInput = document.getElementById('time_reservation');
            if (timeReservationInput) {
                timeReservationInput.value = defaultDateTime;
            }

            // Form validation for add reservation modal
            const addReservationForm = document.querySelector('#addReservationModal form');
            if (addReservationForm) {
                addReservationForm.addEventListener('submit', function(e) {
                    const userId = document.getElementById('user_id').value;
                    const docterId = document.getElementById('docter_id').value;
                    const timeReservation = document.getElementById('time_reservation').value;
                    const status = document.getElementById('status').value;
                    const remarks = document.getElementById('remarks').value;

                    if (!userId || !docterId || !timeReservation || !status || !remarks.trim()) {
                        e.preventDefault();
                        alert('Please fill in all required fields.');
                        return false;
                    }

                    if (remarks.trim().length < 5) {
                        e.preventDefault();
                        alert('Remarks must be at least 5 characters long.');
                        return false;
                    }
                });
            }
        });
    </script>

    <!-- Add Reservation Modal -->
    <div class="modal fade" id="addReservationModal" tabindex="-1" role="dialog" aria-labelledby="addReservationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addReservationModalLabel">Add New Reservation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.reservations.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user_id" class="form-control-label">Patient *</label>
                                    <select name="user_id" id="user_id" class="form-control" required>
                                        <option value="">Select Patient</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->phone }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="docter_id" class="form-control-label">Doctor *</label>
                                    <select name="docter_id" id="docter_id" class="form-control" required>
                                        <option value="">Select Doctor</option>
                                        @foreach($doctors as $doctor)
                                            <option value="{{ $doctor->id }}">{{ $doctor->name }} - {{ $doctor->category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="time_reservation" class="form-control-label">Reservation Time *</label>
                                    <input type="datetime-local" name="time_reservation" id="time_reservation" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status" class="form-control-label">Status *</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="hold">Hold</option>
                                        <option value="verify">Verified</option>
                                        <option value="arrived">Arrived</option>
                                        <option value="done">Done</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="remarks" class="form-control-label">Complaint/Remarks *</label>
                                    <textarea name="remarks" id="remarks" class="form-control" rows="4" placeholder="Enter patient complaint or remarks..." required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create Reservation</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection 