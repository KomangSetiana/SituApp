<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends Controller
{
    public function loginWithExternalApi(Request $request)
    {
        $credentials = $request->only('username', 'password');

        // Guzzle Client untuk memanggil API eksternal
        $client = new Client();

        try {
            // Request ke API eksternal untuk mendapatkan semua user
            $response = $client->get('https://xapi.ppb.ac.id/index.php/api/pengguna_singkat?kata-ajaib=pitz', [
                'auth' => ['pitawt', 'ppb.123'],
                'verify' => false // Menggunakan Basic Auth
            ]);

            $users = json_decode($response->getBody(), true);

            // Cari user berdasarkan username
            $userFromApi = collect($users['data'])->firstWhere('username', $credentials['username']);

            // Jika user ditemukan di API dan password cocok
            if ($userFromApi && md5($credentials['password']) === $userFromApi['password']) {

                // Cari user di database lokal
                $localUser = User::where('username', $userFromApi['username'])->first();

                // Jika user lokal ada, periksa apakah ada perbedaan dalam data
                if ($localUser) {
                    $needsUpdate = false;

                    // Bandingkan data dari API dan database
                    if (
                        $localUser->id_pengguna != $userFromApi['id_pengguna'] ||
                        $localUser->nip != $userFromApi['nip'] ||
                        $localUser->username != $userFromApi['username'] ||
                        $localUser->nama_pengguna != $userFromApi['nama_pengguna'] ||
                        !Hash::check($credentials['password'], $localUser->password) || // Periksa apakah password berbeda
                        $localUser->status_dosen != $userFromApi['status_dosen'] ||
                        $localUser->status_pegawai != $userFromApi['status_pegawai']
                    ) {
                        $needsUpdate = true;
                    }

                    // Update hanya jika ada perbedaan data
                    if ($needsUpdate) {
                        $localUser->update([
                            'id_pengguna' => $userFromApi['id_pengguna'],
                            'nip' => $userFromApi['nip'],
                            'username' => $userFromApi['username'],
                            'nama_pengguna' => $userFromApi['nama_pengguna'],
                            'password' => bcrypt($credentials['password']), // Ubah password ke format Bcrypt
                            'status_dosen' => $userFromApi['status_dosen'],
                            'status_pegawai' => $userFromApi['status_pegawai']
                        ]);
                    }
                } else {
                    // Jika user tidak ada di database lokal, buat baru
                    $localUser = User::create([
                        'id_pengguna' => $userFromApi['id_pengguna'],
                        'nip' => $userFromApi['nip'],
                        'nama_pengguna' => $userFromApi['nama_pengguna'],
                        'username' => $userFromApi['username'],
                        'role' => 'user',
                        'password' => bcrypt($credentials['password']), // Ubah password ke format Bcrypt
                        'status_dosen' => $userFromApi['status_dosen'],
                        'status_pegawai' => $userFromApi['status_pegawai']
                    ]);
                }

                // Generate token (misalnya menggunakan JWT)
                $token = JWTAuth::fromUser($localUser);

                // Kembalikan respons dengan user dan token
                return response()->json([
                    'user' => $localUser,
                    'token' => $token
                ], 200);
            } else {
                // Jika username atau password tidak cocok di API, cek di database lokal
                $localUser = User::where('username', $credentials['username'])->first();

                // Jika user lokal ditemukan dan password cocok
                if ($localUser && Hash::check($credentials['password'], $localUser->password)) {
                    // Generate token dari user lokal
                    $token = JWTAuth::fromUser($localUser);

                    // Kembalikan respons dengan user dan token
                    return response()->json([
                        'user' => $localUser,
                        'token' => $token
                    ], 200);
                } else {
                    // Jika tidak ditemukan atau password salah
                    return response()->json(['error' => 'Invalid credentials'], 401);
                }
            }
        } catch (Exception $e) {
            return $e;
            return response()->json(['error' => 'something wrong'], 500);
        }
    }
}
