<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessBatch;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    public function process(Request $request)
    {
        //retrieve the data
        $data = $request->input('data');

        //dispatch the job
        ProcessBatch::dispatch($data);

        return response()->json(['status' => 'Batch processing started']);
    }
}