<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckTime
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Waktu Indonesia Tengah (UTC+8)
        $currentTime = Carbon::now('Asia/Makassar');

        // Cek jika hari Sabtu atau Minggu
        if ($currentTime->isWeekend()) {
            return response()->json(['message' => 'Data hanya bisa dibuat pada hari kerja.'], 403);
        }

        // Cek jika waktu di luar 09:00 - 16:00
        $startWorkTime = Carbon::createFromTime(9, 0, 0, 'Asia/Makassar');
        $endWorkTime = Carbon::createFromTime(17, 0, 0, 'Asia/Makassar');

        if ($currentTime->lt($startWorkTime) || $currentTime->gt($endWorkTime)) {
            return response()->json(['message' => 'Data hanya bisa dibuat antara jam 09:00 dan 17:00.'], 403);
        }

        return $next($request);
    }
}
