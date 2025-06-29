<?php

namespace App\Http\Controllers\WEB;

use App\Helpers\FCM;
use App\Http\Controllers\Controller;
use App\Http\Requests\WEB\CancelReservationRequest;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Docter;
use App\Repositories\ReservationRepository;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['user', 'docter.category'])
            ->orderBy('created_at', 'desc')
            ->get();

        $doctors = Docter::with('category')->get();
        $users = User::all();

        // Calculate statistics
        $totalReservations = $reservations->count();
        $pendingReservations = $reservations->where('status', 'hold')->count();
        $todayReservations = $reservations->where('created_at', '>=', Carbon::today())->count();
        $completedReservations = $reservations->where('status', 'done')->count();

        return view('pages.admin-reservations', compact(
            'reservations',
            'doctors',
            'users',
            'totalReservations',
            'pendingReservations',
            'todayReservations',
            'completedReservations'
        ));
    }

    public function show($id)
    {
        $reservation = Reservation::with(['user', 'docter.category'])->findOrFail($id);
        
        return view('pages.admin-reservation-detail', compact('reservation'));
    }

    public function cancel(CancelReservationRequest $request, $id)
    {
        $input = $request->only('remark-cancel');
        $reservation = Reservation::with(['user', 'docter'])->findOrFail($id);
        
        // Send notification to user
        $deviceToken = User::where('id', $reservation->created_by)->pluck('device_token')->first();
        $titleNotificationTemplate = "Maaf admin telah membatalkan reservasi Anda dengan dokter " . $reservation->docter->name;
        
        if ($deviceToken) {
            FCM::android([$deviceToken])->send([
                'title' => $titleNotificationTemplate,
                'message' => "Check ke aplikasi untuk tahu kenapa reservasi dibatalkan!",
                'reservation_id' => $reservation->id,
            ]);
        }

        $input['status'] = 'cancel';
        $input['remark_cancel'] = $input['remark-cancel'];
        unset($input['remark-cancel']);
        $reservation->update($input);

        return redirect()->route('admin.reservations.index')->with('success', 'Reservation cancelled successfully!');
    }

    public function history()
    {
        $reservations = Reservation::with(['user', 'docter.category'])
            ->whereIn('status', ['done', 'cancel'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.admin-reservations-history', compact('reservations'));
    }

    public function reports()
    {
        // Get date range from request or default to last 30 days
        $startDate = request('start_date', Carbon::now()->subDays(30)->format('Y-m-d'));
        $endDate = request('end_date', Carbon::now()->format('Y-m-d'));

        $reservations = Reservation::with(['user', 'docter.category'])
            ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->get();

        // Calculate statistics
        $totalReservations = $reservations->count();
        $completedReservations = $reservations->where('status', 'done')->count();
        $cancelledReservations = $reservations->where('status', 'cancel')->count();
        $pendingReservations = $reservations->where('status', 'hold')->count();
        $verifiedReservations = $reservations->where('status', 'verify')->count();
        $arrivedReservations = $reservations->where('status', 'arrived')->count();

        // Group by doctor
        $doctorStats = $reservations->groupBy('docter.name')->map(function ($doctorReservations) {
            return [
                'total' => $doctorReservations->count(),
                'completed' => $doctorReservations->where('status', 'done')->count(),
                'cancelled' => $doctorReservations->where('status', 'cancel')->count(),
                'pending' => $doctorReservations->where('status', 'hold')->count(),
            ];
        });

        // Daily statistics
        $dailyStats = $reservations->groupBy(function ($reservation) {
            return $reservation->created_at->format('Y-m-d');
        })->map(function ($dayReservations) {
            return [
                'total' => $dayReservations->count(),
                'completed' => $dayReservations->where('status', 'done')->count(),
                'cancelled' => $dayReservations->where('status', 'cancel')->count(),
            ];
        });

        return view('pages.admin-reservations-reports', compact(
            'reservations',
            'totalReservations',
            'completedReservations',
            'cancelledReservations',
            'pendingReservations',
            'verifiedReservations',
            'arrivedReservations',
            'doctorStats',
            'dailyStats',
            'startDate',
            'endDate'
        ));
    }

    public function export($format)
    {
        $reservations = Reservation::with(['user', 'docter.category'])
            ->orderBy('created_at', 'desc')
            ->get();

        if ($format === 'excel') {
            // Return Excel file
            return response()->download($this->generateExcel($reservations), 'reservations.xlsx');
        } elseif ($format === 'pdf') {
            // Return PDF file
            return response()->download($this->generatePDF($reservations), 'reservations.pdf');
        }

        return redirect()->route('admin.reservations.index')->with('error', 'Invalid export format');
    }

    private function generateExcel($reservations)
    {
        // Implementation for Excel generation
        // This would typically use a library like PhpSpreadsheet
        // For now, we'll return a simple CSV
        $filename = storage_path('app/temp/reservations.csv');
        
        $handle = fopen($filename, 'w');
        fputcsv($handle, ['Queue #', 'Patient', 'Doctor', 'Time', 'Status', 'Created']);
        
        foreach ($reservations as $reservation) {
            fputcsv($handle, [
                $reservation->queue_number ?? 'N/A',
                $reservation->user->name,
                $reservation->docter->name,
                $reservation->time_reservation,
                $reservation->status,
                $reservation->created_at->format('d M Y H:i')
            ]);
        }
        
        fclose($handle);
        return $filename;
    }

    private function generatePDF($reservations)
    {
        // Implementation for PDF generation
        // This would typically use a library like DomPDF
        // For now, we'll return a simple text file
        $filename = storage_path('app/temp/reservations.txt');
        
        $content = "RESERVATION REPORT\n";
        $content .= "Generated: " . now()->format('d M Y H:i') . "\n\n";
        
        foreach ($reservations as $reservation) {
            $content .= "Queue #: " . ($reservation->queue_number ?? 'N/A') . "\n";
            $content .= "Patient: " . $reservation->user->name . "\n";
            $content .= "Doctor: " . $reservation->docter->name . "\n";
            $content .= "Time: " . $reservation->time_reservation . "\n";
            $content .= "Status: " . $reservation->status . "\n";
            $content .= "Created: " . $reservation->created_at->format('d M Y H:i') . "\n";
            $content .= "----------------------------------------\n";
        }
        
        file_put_contents($filename, $content);
        return $filename;
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'docter_id' => 'required|exists:docters,id',
            'time_reservation' => 'required|date',
            'status' => 'required|in:hold,verify,arrived,done',
            'remarks' => 'required|string|min:5|max:1000',
        ]);

        $reservation = Reservation::create([
            'user_id' => $request->user_id,
            'docter_id' => $request->docter_id,
            'time_reservation' => $request->time_reservation,
            'status' => $request->status,
            'remarks' => $request->remarks,
            'created_by' => $request->user_id,
        ]);

        // If status is verify, generate queue number
        if ($request->status === 'verify') {
            $queueNumber = Reservation::generateQueueNumber($request->docter_id);
            $reservation->update([
                'queue_number' => $queueNumber,
                'verify_at' => now(),
            ]);
        }

        // If status is arrived, set arrival time
        if ($request->status === 'arrived') {
            $reservation->update([
                'time_arrival' => now(),
            ]);
        }

        // If status is done, set done time
        if ($request->status === 'done') {
            $reservation->update([
                'done_at' => now(),
            ]);
        }

        return redirect()->route('admin.reservations.index')->with('success', 'Reservation created successfully!');
    }
} 