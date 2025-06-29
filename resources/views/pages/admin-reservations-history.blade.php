@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Admin Reservation History'])
    
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <a href="{{ route('admin.reservations.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Back to Reservations
                    </a>
                    <h6>Reservation History</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Queue #</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Patient</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Doctor</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Time</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($reservations as $reservation)
                                <tr>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">{{ $reservation->queue_number ?? 'N/A' }}</p>
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
                                        <span class="badge badge-sm 
                                            @if($reservation->status == 'done') bg-success
                                            @elseif($reservation->status == 'cancel') bg-danger
                                            @endif">
                                            {{ ucfirst($reservation->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">{{ $reservation->created_at->format('d M Y H:i') }}</p>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.reservations.show', $reservation->id) }}" class="btn btn-info btn-sm">
                                            <i class="ni ni-single-02"></i> Detail
                                        </a>
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
@endsection 