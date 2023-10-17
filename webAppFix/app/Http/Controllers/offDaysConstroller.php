<?php

namespace App\Http\Controllers;

use Alert;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\offDays;
use App\Http\Middleware\Authenticate;

class offDaysConstroller extends Controller
{
    function __construct()
    {
        $this->middleware("auth");
    }
    function index()
    {
        return view('dateList');
    }
    function read()
    {
        try {
            $offDate = offDays::orderBy('off_date', 'asc')->get();
            return view('read', compact('offDate'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function filterByYear(Request $request)
    {
        $year = $request->input('year');
        if ($year && $year !== 'all') {
            // Filter data based on the selected year            
            $offDate = offDays::whereYear('off_date', $year)->orderBy('off_date', 'asc')->get();
        } else {
            // Fetch all data without any filtering based on the year            
            $offDate = offDays::orderBy('off_date', 'asc')->get();
        }        

        return view('read', compact('offDate'));
    }

    function create()
    {
        return view('create');
    }
    function store(Request $request)
    {
        // Validasi request jika diperlukan
        $request->validate([
            'off_date' => 'required|date',
            'desc' => 'required|string',
        ]);

        // Simpan data ke dalam database
        $off_date = $request->off_date;
        $data = new offDays(); // Gantilah 'Data' dengan nama model yang sesuai dengan entitas Anda
        $data->off_date = Carbon::parse($off_date)->format('Y-m-d');
        $data->desc = $request->desc;
        $data->save();
        Alert::success('Data Tanggal Berhasil Disimpan');
        return response()->json(['message' => 'Data berhasil disimpan!']);
    }

    function show($id)
    {        
        $offDate = offDays::find($id);        
        return view('edit', compact('offDate'));
    }
    function update(Request $request, $id) {
        $off_date = $request->off_date;
        $data = offDays::find($id);        
        $data->off_date = Carbon::parse($off_date)->format('Y-m-d');
        $data->desc = $request->desc;
        $data->save();
        Alert::success('Data Tanggal Sudah Diupdate');
        return response()->json(['message' => 'Data berhasil diupdate!']);
    }

    function destroy($id) {
        $offDate = offDays::find($id);        
        $offDate->delete();
    }
}