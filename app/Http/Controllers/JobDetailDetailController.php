<?php

namespace App\Http\Controllers;

use App\Models\Boss;
use App\Models\Job;
use App\Models\JobDetail;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class JobDetailDetailController extends Controller
{
    public function index($job_id, $kode)
    {
        $job = Job::findOrFail($job_id);
        $bosses = Boss::all(); // Sesuaikan dengan model yang digunakan
        $boss = Boss::findOrFail($job->boss_id);
        $job_detail = JobDetail::where('job_id', $job_id)->get();
        $services = Service::all(); // Sesuaikan dengan model yang digunakan
        $users = User::all(); // Sesuaikan dengan model yang digunakan
        $active = 'job_history';

        return view('job_detail_detail', compact('job', 'bosses','boss', 'job_detail', 'services','users','active'));
    }

    # JobDetailDetailController

public function update(Request $request, $idTransaksi)
{
    // Validate the request data
    $request->validate([
        // Add validation rules as needed
        'boss_id' => 'required',
        'start_date' => 'required|date',
        'payment_date' => 'nullable|date',
        'payment_status' => 'required|in:belum bayar,dibayar',
        'total_payment' => 'required|numeric',
        // Add any other fields that need validation
    ]);

    // Find the job and its details
    $job = Job::findOrFail($idTransaksi);
    $jobDetails = JobDetail::where('job_id', $idTransaksi)->get();

    // Update the job information
    $job->boss_id = $request->input('boss_id');
    $job->start_date = $request->input('start_date');
    $job->payment_date = $request->input('payment_date');
    $job->payment_status = $request->input('payment_status');
    $job->total_payment = $request->input('total_payment');
    $job->save();

    // Update or create job details
    $services = Service::all();

    foreach ($services as $service) {
        $serviceId = $service->id;
        $price = $request->input("price$serviceId");
        $description = $request->input("description$serviceId");

        $jobDetail = $jobDetails->where('service_id', $serviceId)->first();

        if ($price > 0) {
            if ($jobDetail) {
                // Update existing job detail
                $jobDetail->price = $price;
                $jobDetail->description = $description;
                $jobDetail->save();
            } else {
                // Create new job detail
                $jobDetail = new JobDetail;
                $jobDetail->job_id = $idTransaksi;
                $jobDetail->service_id = $serviceId;
                $jobDetail->price = $price;
                $jobDetail->description = $description;
                $jobDetail->save();
            }
        } elseif ($jobDetail) {
            // If the price is 0 or empty, delete the job detail
            $jobDetail->delete();
        }
    }

    return redirect()->route('detail_job_detail.index', ['idtransaksi' => $idTransaksi, 'kode' => $job->invoice_code])
        ->with('success', 'Transaction updated successfully');
}

}
