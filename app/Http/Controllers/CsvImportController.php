<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessCsvImport;
use Illuminate\Http\Request;

class CsvImportController extends Controller
{
    public function show()
    {
        return view('csv.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:10240',
        ]);

        $path = $request->file('csv_file')->store('csv-imports');

        ProcessCsvImport::dispatch($path);

        return redirect()->route('csv.import')
            ->with('success', 'CSV enviado! O processamento está sendo feito em segundo plano.');
    }
}
