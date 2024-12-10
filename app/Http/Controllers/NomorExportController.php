<?php

namespace App\Http\Controllers;

use App\Exports\NaskahApprovedExport;
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
        $jabatanName = $request->query('jabatan_name');
        $jenisNaskahName = $request->query('jenis_naskah_name');

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

        // Menghasilkan file Excel dengan filter tambahan
        return Excel::download(new NomorExport($dateStart, $dateEnd, $jabatanName, $jenisNaskahName), $filename);
    }
    public function exportApprovedNaskah(Request $request)
    {
        // Dapatkan rentang tanggal dari parameter kueri
        $dateStart = $request->query('start_date');
        $dateEnd = $request->query('end_date');
        $jabatanName = $request->query('jabatan_name');
        $jenisNaskahName = $request->query('jenis_naskah_name');

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

        // Menghasilkan file Excel dengan filter tambahan
        return Excel::download(new NaskahApprovedExport($dateStart, $dateEnd, $jabatanName, $jenisNaskahName), $filename);
    }
}
