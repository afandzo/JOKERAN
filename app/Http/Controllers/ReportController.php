<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobDetail;
use App\Models\Service;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $active = 'report';
        return view('report', compact('active'));
    }

    public function cari(Request $request)
    {
        $active = 'report';
        $awal = $request->input('awal');
        $akhir = $request->input('akhir');

        // Add your search logic here, modify as needed
        $jobs = Job::whereBetween('start_date', [$awal, $akhir])->get();
        $error = $jobs->isEmpty();
        
        $coba = !$error;

        $bayar = [];
        $totalHarga = 0;

        foreach ($jobs as $job) {
            // Fetch related data
            $job_details = JobDetail::where('job_id', $job->id)->get();

            // Calculate total for the current transaction
            $subtotal = 0;
            foreach ($job_details as $detail) {
                $service = Service::find($detail->service_id);
                $hargaService = $detail->price;
                $subtotal +=  $hargaService;
            }

            $bayar[] = $subtotal;
            $totalHarga += $subtotal;
        }

        return view('report', compact('jobs','job_details', 'bayar', 'totalHarga', 'error', 'coba', 'awal', 'akhir','active'));
    }

    public function cetak(Request $request)
    {
        $awal = $request->input('awal');
        $akhir = $request->input('akhir');

        // Fetch data from the database
        $jobs = Job::whereBetween('start_date', [$awal, $akhir])->get();
        
        $bayar = [];
        $totalHarga = 0;

        foreach ($jobs as $job) {
            // Fetch related data
            $job_details = JobDetail::where('job_id', $job->id)->get();

            // Calculate total for the current transaction
            $subtotal = 0;
            foreach ($job_details as $detail) {
                $service = Service::find($detail->service_id);
                $hargaService = $detail->price;
                $subtotal +=  $hargaService;
            }

            $bayar[] = $subtotal;
            $totalHarga += $subtotal;
        }

        return view('print_report', compact('jobs','job_details', 'bayar', 'totalHarga', 'awal', 'akhir'));
    }
}
