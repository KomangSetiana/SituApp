<?php

namespace App\Http\Controllers;

use App\Exports\NomorExport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class NomorExportController extends Controller
{
    public function export(Request $request)
    {
        // Dapatkan rentang tanggal dari parameter kueri
        $dateStart = $request->query('start_date');
        $dateEnd = $request->query('end_date');

        // Log tanggal untuk debugging
        // \Log::info('Start Date: ' . $dateStart);
        // \Log::info('End Date: ' . $dateEnd);

        // Validasi format tanggal
        if (!$dateStart || !$dateEnd) {
            return response()->json(['error' => 'Missing date parameters'], 400);
        }

        $dateStart = Carbon::createFromFormat('Y-m-d', $dateStart);
        $dateEnd = Carbon::createFromFormat('Y-m-d', $dateEnd);

        if (!$dateStart || !$dateEnd) {
            return response()->json(['error' => 'Invalid date format'], 400);
        }

        $dateStart = $dateStart->startOfDay();
        $dateEnd = $dateEnd->endOfDay();

        $filename = 'nomor-naskah_' . $dateStart->format('Ymd') . '_to_' . $dateEnd->format('Ymd') . '.xlsx';

        // Menghasilkan file Excel
        return Excel::download(new NomorExport($dateStart, $dateEnd), $filename);
    }
}
