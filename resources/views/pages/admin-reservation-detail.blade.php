@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Admin Reservation Detail'])
    
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <a href="{{ route('admin.reservations.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                    <h6>Reservation Detail</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Patient Information</h6>
                            <p><strong>Name:</strong> {{ $reservation->user->name }}</p>
                            <p><strong>Phone:</strong> {{ $reservation->user->phone }}</p>
                            <p><strong>Email:</strong> {{ $reservation->user->email }}</p>
                            <p><strong>Subdistrict:</strong> {{ $reservation->user->subdistrict->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6>Doctor Information</h6>
                            <p><strong>Name:</strong> {{ $reservation->docter->name }}</p>
                            <p><strong>Category:</strong> {{ $reservation->docter->category->name }}</p>
                            <p><strong>Phone:</strong> {{ $reservation->docter->phone }}</p>
                            <p><strong>Email:</strong> {{ $reservation->docter->email }}</p>
                        </div>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-12">
                            <h6>Reservation Information</h6>
                            <p><strong>Queue Number:</strong> {{ $reservation->queue_number ?? 'Not assigned' }}</p>
                            <p><strong>Reservation Time:</strong> {{ $reservation->time_reservation }}</p>
                            <p><strong>Status:</strong> 
                                <span class="badge badge-sm 
                                    @if($reservation->status == 'hold') bg-warning
                                    @elseif($reservation->status == 'verify') bg-info
                                    @elseif($reservation->status == 'arrived') bg-primary
                                    @elseif($reservation->status == 'done') bg-success
                                    @elseif($reservation->status == 'cancel') bg-danger
                                    @endif">
                                    {{ ucfirst($reservation->status) }}
                                </span>
                            </p>
                            <p><strong>Complaint:</strong> {{ $reservation->remarks }}</p>
                            <p><strong>Created:</strong> {{ $reservation->created_at->format('d M Y H:i') }}</p>
                            
                            @if($reservation->status === 'cancel')
                                <p><strong>Cancel Reason:</strong> {{ $reservation->remark_cancel }}</p>
                            @endif
                            
                            @if($reservation->status === 'done')
                                <p><strong>Completed At:</strong> {{ $reservation->done_at ? $reservation->done_at->format('d M Y H:i') : 'N/A' }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 