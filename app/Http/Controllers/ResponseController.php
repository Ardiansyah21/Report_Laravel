<?php

namespace App\Http\Controllers;

use App\Models\Response;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Response $response)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($report_id)
    {
        $report = Response::where('report_id', $report_id)->first();
        $reportId = $report_id;
        return view('dashboard.response', compact('report', 'reportId'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $report_id)
    {
        $request->validate(
        [
            'status' => 'required',
            'pesan' => 'required',
        ]);

        Response::updateOrCreate(
          [
            'report_id' => $report_id,
          ],
          [
            'status' => $request->status,
            'pesan' => $request->pesan,

          ]
            
          );
        return redirect()->route('data.petugas')->with('responseSuccess', 'Berhasilmengubah response');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Response $response)
    {
        //
    }
}
