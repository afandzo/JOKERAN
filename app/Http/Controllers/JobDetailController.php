<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobDetail;
use Illuminate\Http\Request;

class JobDetailController extends Controller
{
    public function index()
    {
        $admin_id = auth()->id();
        $jobs = Job::where('admin_id', $admin_id)->orderBy('id', 'DESC')->get();
        $active = 'job_history';

        return view('job_detail', compact('jobs','active'));
    }

    public function delete($id)
    {
        // Hapus transaksi dan detail transaksi
        JobDetail::where('job_id', $id)->delete();
        Job::where('id', $id)->delete();

        return redirect()->route('job_detail.index')->with('success', 'Transaction successfully deleted');
    }
}
