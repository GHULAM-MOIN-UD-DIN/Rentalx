<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\AppointmentBooked;
use App\Mail\AppointmentConfirmed;

class AppointmentController extends Controller
{
    /**
     * Show appointment booking page
     */
    public function create(Request $request)
    {
        $carId = $request->query('car_id');
        $car = null;
        
        if ($carId) {
            $car = Car::find($carId);
        }

        return view('Pages.appointment', compact('car'));
    }

    /**
     * Store appointment in database
     */
    public function store(Request $request)
    {
        // Validate request
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'pickup_date' => 'required|date|after_or_equal:today',
            'return_date' => 'required|date|after_or_equal:pickup_date',
            'delivery_location' => 'required|string|max:255',
            'car_name' => 'required|string|max:255',
            'price_per_day' => 'required|numeric|min:0',
            'total_price' => 'required|numeric|min:0',
            'addons' => 'nullable|array',
            'addons.*' => 'string',
            'special_requests' => 'nullable|string',
            'car_id' => 'nullable|exists:cars,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Please fix the errors below.');
        }

        try {
            // Create appointment
            $appointment = Appointment::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'pickup_date' => $request->pickup_date,
                'return_date' => $request->return_date,
                'delivery_location' => $request->delivery_location,
                'car_name' => $request->car_name,
                'price_per_day' => $request->price_per_day,
                'total_price' => $request->total_price,
                'addons' => $request->addons,
                'special_requests' => $request->special_requests,
                'status' => 'pending',
                'car_id' => $request->car_id,
                'user_id' => Auth::id(),
            ]);

            // Send Appointment Booked Email
            try {
                Mail::to($appointment->email)->send(new AppointmentBooked($appointment));
            } catch (\Exception $e) {
                Log::error('Appointment Booking Email Error: ' . $e->getMessage());
            }

            // Return JSON response for AJAX request
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Your appointment has been booked successfully!',
                    'appointment' => $appointment
                ]);
            }

            // For non-AJAX request, redirect back with success
            return redirect()->route('appointment.create')
                ->with('success', 'Your appointment has been booked successfully!')
                ->with('appointment_id', $appointment->id);
                
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Something went wrong. Please try again.'
                ], 500);
            }
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Something went wrong. Please try again. ' . $e->getMessage());
        }
    }

    /**
     * Show appointment details (Admin)
     */
    public function show($id)
    {
        $user = Auth::user();
        $appointment = Appointment::with(['car', 'user'])->findOrFail($id);
        return view('Pages.appointment-details', compact('appointment', 'user'));
    }

    /**
     * Cancel appointment
     */
    public function cancel($id)
    {
        $appointment = Appointment::findOrFail($id);
        
        // Check if user is authorized (either the one who booked or admin)
        if (Auth::id() !== $appointment->user_id && !Auth::user()?->isAdmin()) {
            abort(403);
        }

        $appointment->update(['status' => 'cancelled']);

        return redirect()->back()->with('success', 'Appointment cancelled successfully.');
    }

    // ========== ADMIN FUNCTIONS ==========

    /**
     * Show all appointments (Admin)
     */
    public function adminIndex(Request $request)
    {
        $query = Appointment::with(['car', 'user'])->orderBy('created_at', 'desc');

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Search
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'LIKE', "%{$search}%")
                  ->orWhere('last_name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('phone', 'LIKE', "%{$search}%")
                  ->orWhere('car_name', 'LIKE', "%{$search}%");
            });
        }

        // Filter by date range
        if ($request->has('date_from') && $request->date_from) {
            $query->where('pickup_date', '>=', $request->date_from);
        }
        if ($request->has('date_to') && $request->date_to) {
            $query->where('return_date', '<=', $request->date_to);
        }

        $appointments = $query->paginate(15);

        // Statistics
        $stats = [
            'total' => Appointment::count(),
            'pending' => Appointment::where('status', 'pending')->count(),
            'confirmed' => Appointment::where('status', 'confirmed')->count(),
            'completed' => Appointment::where('status', 'completed')->count(),
            'cancelled' => Appointment::where('status', 'cancelled')->count(),
            'total_revenue' => Appointment::where('status', 'completed')->sum('total_price')
        ];

        return view('Admin.appointments', compact('appointments', 'stats'));
    }

    /**
     * Update appointment status (Admin)
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled'
        ]);

        $appointment = Appointment::findOrFail($id);
        $oldStatus = $appointment->status;
        $appointment->update(['status' => $request->status]);

        // Send email if appointment is confirmed
        if ($appointment->status === 'confirmed' && $oldStatus !== 'confirmed') {
            try {
                Mail::to($appointment->email)->send(new AppointmentConfirmed($appointment));
            } catch (\Exception $e) {
                Log::error('Appointment Confirmation Email Error: ' . $e->getMessage());
            }
        }

        return redirect()->back()->with('success', 'Appointment status updated successfully.');
    }

    /**
     * View single appointment (Admin)
     */
    public function adminShow($id)
    {
        $appointment = Appointment::with(['car', 'user'])->findOrFail($id);
        return view('Admin.appointment-details', compact('appointment'));
    }

    /**
     * Delete appointment (Admin)
     */
    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return redirect()->route('admin.appointments')
            ->with('success', 'Appointment deleted successfully.');
    }

    /**
     * Export appointments (Admin)
     */
    public function export(Request $request)
    {
        $query = Appointment::query();

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $appointments = $query->get();

        // Generate CSV
        $filename = 'appointments_' . date('Y-m-d') . '.csv';
        $handle = fopen('php://output', 'w');
        
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        // Add headers
        fputcsv($handle, [
            'ID', 'First Name', 'Last Name', 'Email', 'Phone', 
            'Pickup Date', 'Return Date', 'Car', 'Price/Day', 'Total',
            'Addons', 'Status', 'Created At'
        ]);

        // Add data
        foreach ($appointments as $app) {
            fputcsv($handle, [
                $app->id,
                $app->first_name,
                $app->last_name,
                $app->email,
                $app->phone,
                $app->pickup_date->format('Y-m-d'),
                $app->return_date->format('Y-m-d'),
                $app->car_name,
                $app->price_per_day,
                $app->total_price,
                $app->addons ? implode(', ', $app->addons) : '',
                $app->status,
                $app->created_at->format('Y-m-d H:i')
            ]);
        }

        fclose($handle);
        exit;
    }
}