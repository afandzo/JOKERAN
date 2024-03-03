<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Boss;

class BossController extends Controller
{
    public function index()
    {
        return view('boss', [
            'bosses' => Boss::all(),
            'active' => 'boss'
        ]);
    }

    public function tambahDataBoss(Request $request)
    {
        // dd($request->all());
        Boss::create($request->all());
        return redirect()->route('boss')->with('success', 'Data added successfully!');
    }

    public function updateDataBoss(Request $request, $id)
    {
        $boss = Boss::find($id);
        if ($boss) {
            $boss->update($request->all());
            return redirect()->route('boss')->with('success', 'Data updated successfully!');
        } else {
            return redirect()->route('boss')->with('error', 'Failed to update data');
        }
    }

    public function deleteDataBoss($id)
    {
        $boss = Boss::find($id);
        if ($boss) {
            $boss->delete();
            return redirect()->route('boss')->with('success', 'Data deleted successfully!');
        } else {
            return redirect()->route('boss')->with('error', 'Failed to delete data');
        }
    }
}
