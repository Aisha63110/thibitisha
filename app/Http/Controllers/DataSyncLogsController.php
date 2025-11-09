<?php

namespace App\Http\Controllers;

use App\Http\Requests\Storedata_sync_logsRequest;
use App\Http\Requests\Updatedata_sync_logsRequest;
use App\Models\data_sync_logs;

class DataSyncLogsController extends Controller
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
    public function store(Storedata_sync_logsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(data_sync_logs $data_sync_logs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(data_sync_logs $data_sync_logs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updatedata_sync_logsRequest $request, data_sync_logs $data_sync_logs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(data_sync_logs $data_sync_logs)
    {
        //
    }
}
