<?php

namespace App\Http\Controllers;

use App\Models\Boss;
use App\Models\Job;
use App\Models\JobDetail;
use App\Models\Service;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::all();
        $bosses = Boss::all();
        $services = Service::all();
        $active = 'job';

        return view('job', compact('jobs', 'bosses', 'services', 'active'));
    }

    public function store(Request $request)
    {
        

        $job = new Job;
        $job->invoice_code = $request->input('invoice_code');
        $job->boss_id = $request->input('boss_id');
        $job->start_date = $request->input('start_date');
        $job->payment_date = $request->input('payment_date');
        $job->payment_status = $request->input('payment_status');
        $job->total_payment = $request->input('total_payment');
        $job->admin_id = $request->input('admin_id');
        $job->save();

        $jobId = $job->id;

        $services = Service::all();

        foreach ($services as $service) {
            $serviceId = $service->id;
            $price = $request->input("price$serviceId");
            $description = $request->input("description$serviceId");

            if ($price > 0) {
                $jobDetail = new JobDetail;
                $jobDetail->job_id = $jobId;
                $jobDetail->service_id = $serviceId;
                $jobDetail->price = $price;
                $jobDetail->description = $description;
                $jobDetail->save();
            }
        }

        return redirect()->route('job_detail.index')
            ->with('success', 'Transaction created successfully');
    }
}
