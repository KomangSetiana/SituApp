<?php

namespace App\Http\Controllers;

use App\Http\Requests\NomorRequest;
use App\Http\Requests\AdminNomorRequest;
use App\Http\Requests\UpdateNomorRequest;
use App\Http\Requests\UploadFileRequest;
use App\Models\AksesNaskah;
use App\Models\Jabatan;
use App\Models\JenisNaskah;
use App\Models\Klasifikasi;
use App\Models\Naskah;
use App\Models\Nomor;
use App\Models\User;
use App\Models\Plh;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NomorController extends Controller
{

    public function index(Request $request)
    {
        $nomors = Nomor::fillter($request)
            ->with(['jabatan.jenis_naskahs', 'jenisNaskah', 'naskahs', 'klasifikasis', 'users', 'plhs.jabatan'])
            ->whereNull('filename')->orderBy('updated_at', 'DESC')->paginate(20);
        return $this->sendResponse($nomors, 'success');
    }

    public function nomorSelesai(Request $request)
    {

        $dateStart = null;
        if ($request->dateStart) {
            $dateStart = Carbon::parse($request->dateStart)->format('Y-m-d');
        }
        $dateEnd = null;
        if ($request->dateEnd) {
            $dateEnd = Carbon::parse($request->dateEnd)->format('Y-m-d');
        }
        $nomors = Nomor::fillterDate($dateStart, $dateEnd)->fillter($request)
            ->with(['jabatan', 'jenisNaskah', 'naskahs', 'klasifikasis', 'users', 'plhs.jabatan'])
            ->whereNotNull('filename')->where('status', 'pending')->orderBy('updated_at', 'DESC')->paginate(20);

        return $this->sendResponse($nomors, 'success');
    }

    public function nomorRejected(Request $request)
    {

        $dateStart = null;
        if ($request->dateStart) {
            $dateStart = Carbon::parse($request->dateStart)->format('Y-m-d');
        }
        $dateEnd = null;
        if ($request->dateEnd) {
            $dateEnd = Carbon::parse($request->dateEnd)->format('Y-m-d');
        }
        $nomors = Nomor::fillterDate($dateStart, $dateEnd)->fillter($request)
            ->with(['jabatan', 'jenisNaskah', 'naskahs', 'klasifikasis', 'users', 'plhs.jabatan'])
            ->whereNotNull('filename')->where('status', 'rejected')->orderBy('updated_at', 'DESC')->paginate(20);

        return $this->sendResponse($nomors, 'success');
    }

    public function nomorDibatalkan(Request $request)
    {

        $dateStart = null;
        if ($request->dateStart) {
            $dateStart = Carbon::parse($request->dateStart)->format('Y-m-d');
        }
        $dateEnd = null;
        if ($request->dateEnd) {
            $dateEnd = Carbon::parse($request->dateEnd)->format('Y-m-d');
        }
        $nomors = Nomor::fillterDate($dateStart, $dateEnd)->fillter($request)
            ->with(['jabatan', 'jenisNaskah', 'naskahs', 'klasifikasis', 'users', 'plhs.jabatan'])
            ->onlyTrashed()->orderBy('updated_at', 'DESC')->paginate(20);

        return $this->sendResponse($nomors, 'success');
    }

    public function nomorAll(Request $request)
    {

        $dateStart = null;
        if ($request->dateStart) {
            $dateStart = Carbon::parse($request->dateStart)->format('Y-m-d');
        }
        $dateEnd = null;
        if ($request->dateEnd) {
            $dateEnd = Carbon::parse($request->dateEnd)->format('Y-m-d');
        }
        $nomors = Nomor::fillterDate($dateStart, $dateEnd)->fillter($request)
            ->with(['jabatan', 'jenisNaskah', 'naskahs', 'klasifikasis', 'users', 'plhs.jabatan'])
            ->withTrashed()->orderBy('updated_at', 'DESC')->paginate(20);

        return $this->sendResponse($nomors, 'success');
    }

    public function arsipNaskah(Request $request)
    {

        $dateStart = null;
        if ($request->dateStart) {
            $dateStart = Carbon::parse($request->dateStart)->format('Y-m-d');
        }
        $dateEnd = null;
        if ($request->dateEnd) {
            $dateEnd = Carbon::parse($request->dateEnd)->format('Y-m-d');
        }
        $nomors = Nomor::fillterDate($dateStart, $dateEnd)->fillter($request)->with(['jabatan', 'jenisNaskah', 'naskahs', 'klasifikasis', 'users', 'plhs.jabatan'])
            ->where('status', 'approved ')->orderBy('updated_at', 'DESC')->paginate(20);

        return $this->sendResponse($nomors, 'success');
    }

    // User Nomor
    public function UserNomor(Request $request)
    {
        $nomors = Nomor::fillter($request)->with(['jabatan.jenis_naskahs', 'jenisNaskah', 'naskahs', 'klasifikasis', 'users', 'plhs.jabatan'])
            ->whereNull('filename')->where('status', 'pending')
            ->where('id_pengguna', auth()->user()->id_pengguna)->orderBy('id', 'DESC')->paginate(20);
        return $this->sendResponse($nomors, 'success');
    }

    public function UserNomorSelesai(Request $request)
    {

        $dateStart = null;
        if ($request->dateStart) {
            $dateStart = Carbon::parse($request->dateStart)->format('Y-m-d');
        }
        $dateEnd = null;
        if ($request->dateEnd) {
            $dateEnd = Carbon::parse($request->dateEnd)->format('Y-m-d');
        }
        $nomors = Nomor::fillterDate($dateStart, $dateEnd)->fillter($request)
            ->with(['jabatan', 'jenisNaskah', 'naskahs', 'klasifikasis', 'users', 'plhs.jabatan'])
            ->whereNotNull('filename')->where('status', 'pending')->where('id_pengguna', auth()->user()->id_pengguna)
            ->orderBy('updated_at', 'DESC')->paginate(20);
        return $this->sendResponse($nomors, 'success');
    }

    public function UserNomorRejected(Request $request)
    {

        $dateStart = null;
        if ($request->dateStart) {
            $dateStart = Carbon::parse($request->dateStart)->format('Y-m-d');
        }
        $dateEnd = null;
        if ($request->dateEnd) {
            $dateEnd = Carbon::parse($request->dateEnd)->format('Y-m-d');
        }
        $nomors = Nomor::fillterDate($dateStart, $dateEnd)->fillter($request)
            ->with(['jabatan', 'jenisNaskah', 'naskahs', 'klasifikasis', 'users', 'plhs.jabatan'])
            ->whereNotNull('filename')->where('status', 'rejected')->where('id_pengguna', auth()->user()->id_pengguna)
            ->orderBy('updated_at', 'DESC')->paginate(20);
        return $this->sendResponse($nomors, 'success');
    }

    public function UserNomorDibatalkan(Request $request)
    {

        $dateStart = null;
        if ($request->dateStart) {
            $dateStart = Carbon::parse($request->dateStart)->format('Y-m-d');
        }
        $dateEnd = null;
        if ($request->dateEnd) {
            $dateEnd = Carbon::parse($request->dateEnd)->format('Y-m-d');
        }
        $nomors = Nomor::fillterDate($dateStart, $dateEnd)->fillter($request)
            ->with(['jabatan', 'jenisNaskah', 'naskahs', 'klasifikasis', 'users', 'plhs.jabatan'])
            ->onlyTrashed()->where('id_pengguna', auth()->user()->id_pengguna)
            ->orderBy('updated_at', 'DESC')->paginate(20);
        return $this->sendResponse($nomors, 'success');
    }

    public function UserNomorAll(Request $request)
    {

        $dateStart = null;
        if ($request->dateStart) {
            $dateStart = Carbon::parse($request->dateStart)->format('Y-m-d');
        }
        $dateEnd = null;
        if ($request->dateEnd) {
            $dateEnd = Carbon::parse($request->dateEnd)->format('Y-m-d');
        }
        $nomors = Nomor::fillterDate($dateStart, $dateEnd)->fillter($request)
            ->with(['jabatan', 'jenisNaskah', 'naskahs', 'klasifikasis', 'users', 'plhs.jabatan'])
            ->where('id_pengguna', auth()->user()->id_pengguna)->withTrashed()
            ->orderBy('updated_at', 'DESC')->paginate(20);
        return $this->sendResponse($nomors, 'success');
    }

    public function UserArsipNomor(Request $request)
    {

        $dateStart = null;
        if ($request->dateStart) {
            $dateStart = Carbon::parse($request->dateStart)->format('Y-m-d');
        }
        $dateEnd = null;
        if ($request->dateEnd) {
            $dateEnd = Carbon::parse($request->dateEnd)->format('Y-m-d');
        }
        $nomors = Nomor::fillterDate($dateStart, $dateEnd)->fillter($request)
            ->with(['jabatan', 'jenisNaskah', 'naskahs', 'klasifikasis', 'users', 'plhs.jabatan'])
            ->where('id_pengguna', auth()->user()->id_pengguna)->where('status', 'approved')
            ->orderBy('updated_at', 'DESC')->paginate(20);
        return $this->sendResponse($nomors, 'success');
    }

    public function store(NomorRequest $request)
    {

        $kodeJenis = JenisNaskah::where('id', $request->jenis_naskah_id['id'])->get()->first();
        // dd($kodeJenis->kode);
        $kodeKlasifikasi = Klasifikasi::where('id', $request->klasifikasi_id['id'])->get()->first();
        // dd($kodeKlasifikasi->kode);
        $kodeJabatan = Jabatan::where('id', $request->jabatan_id['id'])->get()->first();
        // dd($kodeJabatan->kode);
        $tahunSekarang = Carbon::now()->year;

        $lastNomor = Nomor::with('akses_naskahs')->where('jabatan_id', $request->jabatan_id['id'])->where('jenis_naskah_id', $request->jenis_naskah_id['id'])->whereYear('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->latest()->first();
        // dd($lastNomor);

        $nomorPlh = Nomor::with('akses_naskahs')->whereNotNull('plh_id')->where('jenis_naskah_id', $request->jenis_naskah_id['id'])->whereYear('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->latest()->first();
        // dd($nomorPlh);

        if ($lastNomor == null) {
            $lastNomor = 1;
        } else {

            if ($lastNomor['akses_naskah'] != null) {
                $p =  explode('/', $lastNomor['nomor_surat']);
                $lastNomor = intval($p[2]) + 1;
            } else {
                $p =  explode('/', $lastNomor['nomor_surat']);
                $lastNomor = intval($p[1]) + 1;
            }
        }

        if ($nomorPlh == null) {
            $nomorPlh = 1;
        } else {

            if ($nomorPlh['akses_naskah'] != null) {
                $p =  explode('/', $nomorPlh['nomor_surat']);
                $nomorPlh = intval($p[2]) + 1;
            } else {
                $p =  explode('/', $nomorPlh['nomor_surat']);
                $nomorPlh = intval($p[1]) + 1;
            }
        }
        $dataReq = $request->all();


        if ($request->jenis_naskah_id["akses_naskah"] == 1) {
            $request->validate(
                [
                    "akses_naskah" => "required"
                ],
                [
                    'akses_naskah.required' => 'Akses naskah wajib diisi!',
                ]
            );
        }
        // dd($request->jenis_naskah_id["akses_naskah"]);


        if ($kodeJabatan['has_plh'] == true && isset($dataReq['akses_naskah'])) {

            $getPlh = Plh::with('jabatans')->whereDate('tanggal', Carbon::now())->get()->first();
            // dd($getPlh);
            $kodeAkses = AksesNaskah::where('id', $request->akses_naskah['id'])->get()->first();
            if ($getPlh == null) {
                // $dataReq['plh_id'] = $getPlh->id;

                $nomor = $kodeAkses->kode . "/" . $kodeJenis->kode . "/" . $lastNomor  . "/"
                    . $kodeKlasifikasi->kode . "/" . $kodeJabatan->kode .  "/" . $tahunSekarang;
            } else {

                if ($kodeJenis->has_direktur == true) {
                    return response()->json(['message' => 'Tidak bisa mengajukan nomor naskah ' . $request->jenis_naskah_id['nama'] . ' karena bapak direktur tidak ada di kampus'], 403);
                }
                $dataReq['plh_id'] = $getPlh->id;
                $nomor = $kodeAkses->kode . "/" . $kodeJenis->kode . "/" . $nomorPlh  . "/"
                    . $kodeKlasifikasi->kode . "/" . $kodeJabatan->kode . "/" . $getPlh->jabatans['kode'] . "/" . $tahunSekarang;
            }
        } elseif (isset($dataReq['akses_naskah'])) {

            $kodeAkses = AksesNaskah::where('id', $request->akses_naskah['id'])->get()->first();
            // $kodeplh = Jabatan::where('id', $dataReq['plh'])->get()->first();
            $nomor = $kodeAkses->kode . "/" . $kodeJenis->kode . "/" . $lastNomor  . "/"
                . $kodeKlasifikasi->kode . "/" . $kodeJabatan->kode . "/" . $tahunSekarang;
        } elseif ($kodeJabatan['has_plh'] == true) {
            $getPlh = Plh::with('jabatans')->whereDate('tanggal', Carbon::now())->get()->first();
            if ($getPlh == null) {

                $nomor =  $kodeJenis->kode . "/" . $lastNomor  . "/"
                    . $kodeKlasifikasi->kode . "/" . $kodeJabatan->kode .  "/" . $tahunSekarang;
            } else {
                if ($kodeJenis->has_direktur == true) {
                    return response()->json(['message' => 'Tidak bisa mengajukan nomor naskah ' . $request->jenis_naskah_id['nama'] . ' karena bapak direktur tidak ada di kampus'], 403);
                }
                $dataReq['plh_id'] = $getPlh->id;
                $nomor =  $kodeJenis->kode . "/" . $nomorPlh  . "/"
                    . $kodeKlasifikasi->kode . "/" . $kodeJabatan->kode . "/" . $getPlh->jabatans['kode'] . "/" . $tahunSekarang;
            }
        } else {


            $nomor = $kodeJenis->kode . "/" . $lastNomor  . "/"
                . $kodeKlasifikasi->kode . "/" .
                $kodeJabatan->kode . "/" . $tahunSekarang;
        }

        // $dataReq['filename'] = 'file coba-coba';
        // dd(auth()->user()->id_pengguna);
        $dataReq['id_pengguna'] = auth()->user()->id_pengguna;
        $dataReq['nomor_surat'] = $nomor;
        $dataReq['klasifikasi_id'] = $request->klasifikasi_id['id'];
        $dataReq['jabatan_id'] = $request->jabatan_id['id'];
        $dataReq['jenis_naskah_id'] = $request->jenis_naskah_id['id'];

        if ($request->akses_naskah !== null) {
            $dataReq['akses_naskah'] = $request->akses_naskah['id'];
        }

        // dd($dataReq);
        $data = Nomor::create($dataReq);
        return $this->sendResponse($data, "success");
    }

    public function storeAdmin(AdminNomorRequest $request)
    {

        $kodeJenis = JenisNaskah::where('id', $request->jenis_naskah_id['id'])->get()->first();
        // dd($kodeJenis->kode);
        $kodeKlasifikasi = Klasifikasi::where('id', $request->klasifikasi_id['id'])->get()->first();
        // dd($kodeKlasifikasi->kode);
        $kodeJabatan = Jabatan::where('id', $request->jabatan_id['id'])->get()->first();
        // dd($kodeJabatan->kode);
        $tahunSekarang = Carbon::now()->year;

        $lastNomor = Nomor::with('akses_naskahs')->where('jabatan_id', $request->jabatan_id['id'])->where('jenis_naskah_id', $request->jenis_naskah_id['id'])->whereYear('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->latest()->first();
        // dd($lastNomor);

        $nomorPlh = Nomor::with('akses_naskahs')->whereNotNull('plh_id')->where('jenis_naskah_id', $request->jenis_naskah_id['id'])->whereYear('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->latest()->first();
        // dd($nomorPlh);

        if ($lastNomor == null) {
            $lastNomor = 1;
        } else {

            if ($lastNomor['akses_naskah'] != null) {
                $p =  explode('/', $lastNomor['nomor_surat']);
                $lastNomor = intval($p[2]) + 1;
            } else {
                $p =  explode('/', $lastNomor['nomor_surat']);
                $lastNomor = intval($p[1]) + 1;
            }
        }

        if ($nomorPlh == null) {
            $nomorPlh = 1;
        } else {

            if ($nomorPlh['akses_naskah'] != null) {
                $p =  explode('/', $nomorPlh['nomor_surat']);
                $nomorPlh = intval($p[2]) + 1;
            } else {
                $p =  explode('/', $nomorPlh['nomor_surat']);
                $nomorPlh = intval($p[1]) + 1;
            }
        }
        $dataReq = $request->all();


        if ($request->jenis_naskah_id["akses_naskah"] == 1) {
            $request->validate(
                [
                    "akses_naskah" => "required"
                ],
                [
                    'akses_naskah.required' => 'Akses naskah wajib diisi!',
                ]
            );
        }
        // dd($request->jenis_naskah_id["akses_naskah"]);


        if ($kodeJabatan['has_plh'] == true && isset($dataReq['akses_naskah'])) {

            $getPlh = Plh::with('jabatans')->whereDate('tanggal', Carbon::now())->get()->first();
            // dd($getPlh);
            $kodeAkses = AksesNaskah::where('id', $request->akses_naskah['id'])->get()->first();
            if ($getPlh == null) {
                // $dataReq['plh_id'] = $getPlh->id;

                $nomor = $kodeAkses->kode . "/" . $kodeJenis->kode . "/" . $lastNomor  . "/"
                    . $kodeKlasifikasi->kode . "/" . $kodeJabatan->kode .  "/" . $tahunSekarang;
            } else {
                $dataReq['plh_id'] = $getPlh->id;
                $nomor = $kodeAkses->kode . "/" . $kodeJenis->kode . "/" . $nomorPlh  . "/"
                    . $kodeKlasifikasi->kode . "/" . $kodeJabatan->kode . "/" . $getPlh->jabatans['kode'] . "/" . $tahunSekarang;
            }
        } elseif (isset($dataReq['akses_naskah'])) {

            $kodeAkses = AksesNaskah::where('id', $request->akses_naskah['id'])->get()->first();
            // $kodeplh = Jabatan::where('id', $dataReq['plh'])->get()->first();
            $nomor = $kodeAkses->kode . "/" . $kodeJenis->kode . "/" . $lastNomor  . "/"
                . $kodeKlasifikasi->kode . "/" . $kodeJabatan->kode . "/" . $tahunSekarang;
        } elseif ($kodeJabatan['has_plh'] == true) {
            $getPlh = Plh::with('jabatans')->whereDate('tanggal', Carbon::now())->get()->first();
            if ($getPlh == null) {

                $nomor =  $kodeJenis->kode . "/" . $lastNomor  . "/"
                    . $kodeKlasifikasi->kode . "/" . $kodeJabatan->kode .  "/" . $tahunSekarang;
            } else {
                $dataReq['plh_id'] = $getPlh->id;
                $nomor =  $kodeJenis->kode . "/" . $nomorPlh  . "/"
                    . $kodeKlasifikasi->kode . "/" . $kodeJabatan->kode . "/" . $getPlh->jabatans['kode'] . "/" . $tahunSekarang;
            }
        } else {


            $nomor = $kodeJenis->kode . "/" . $lastNomor  . "/"
                . $kodeKlasifikasi->kode . "/" .
                $kodeJabatan->kode . "/" . $tahunSekarang;
        }

        // cek user apakah sudah pernah login

        $user = User::where('id_pengguna', $request->id_pengguna['id_pengguna'])->first();

        if ($user == null) {
            $data = new User();

            $data->id_pengguna = $request->id_pengguna['id_pengguna'];
            $data->nama_pengguna = $request->id_pengguna['nama_pengguna'];
            $data->username = $request->id_pengguna['username'];
            $data->password = $request->id_pengguna['password'];
            $data->save();
        }

        // dd($request->id_pengguna);
        $dataReq['id_pengguna'] = $request->id_pengguna['id_pengguna'];
        $dataReq['nomor_surat'] = $nomor;
        $dataReq['klasifikasi_id'] = $request->klasifikasi_id['id'];
        $dataReq['jabatan_id'] = $request->jabatan_id['id'];
        $dataReq['jenis_naskah_id'] = $request->jenis_naskah_id['id'];

        if ($request->akses_naskah !== null) {
            $dataReq['akses_naskah'] = $request->akses_naskah['id'];
        }

        // dd($dataReq);
        $data = Nomor::create($dataReq);
        return $this->sendResponse($data, "success");
    }


    public function updateFile(UploadFileRequest $request, $id)
    {


        $item = Nomor::findOrFail($id);

        // Hapus file lama jika ada
        if ($item->filename) {
            // Konversi path agar sesuai dengan lokasi di storage/app/public
            $oldFilePath = str_replace('/storage', 'public', $item->filename);
            Storage::delete($oldFilePath); // Menghapus file
        }

        // Save new file in storage
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('files', $fileName, 'public');
        $filePath = Storage::url('files/' . $fileName);

        $item->filename = $filePath;
        $item->status = 'pending';
        $item->save();

        return response()->json([
            'success' => true,
            'message' => 'File updated successfully',
            'filename' => $fileName,
        ]);
    }



    public function updateStatus(Request $request, $id)
    {
        // Validasi input untuk memastikan hanya nilai tertentu yang diterima
        $validated = $request->validate([
            'status' => 'required|in:approved,rejected,pending', // Status harus salah satu dari approved, rejected, atau pending
        ]);

        // Cari data berdasarkan ID
        $data = Nomor::findOrFail($id);

        // Update status
        $data->status = $request->input('status');
        $data->save();

        // Kembalikan respon sukses
        return response()->json([
            'message' => 'Status updated successfully',
            'data' => $data,
        ], 200);
    }

    public function updateTipe($id, Request $request)
    {
        // dd($request);
        $data = Nomor::findOrFail($id);

        $data->tipe = $request->tipe;
        $data->save();


        return $this->sendResponse($data, 'success');
    }

    public function getNumber()
    {

        // $ttd = Jabatan::with(['wewenang.jenisNaskah.naskah'])->get();
        // $ttd = JenisNaskah::with(['naskah', 'wewenangs.jabatan'])->get();
        // $naskahs = Naskah::with('jenisNaskah.wewenangs.jabatan')->get();
        // return $naskahs;
        $jabatans = Jabatan::with('jenis_naskahs.naskah')->get();
        return $jabatans;
    }

    public function update($id, UpdateNomorRequest $request)
    {
        $data = Nomor::findOrFail($id);
        $data->tujuan = $request->tujuan;
        $data->perihal = $request->perihal;
        $data->tanggal_surat = $request->tanggal_surat;
        $data->proses_by = $request->proses_by;
        $data->save();

        return $this->sendResponse($data, 'success');
    }

    public function updateStatusAndTipe($id, Request $request)
    {
        $data = Nomor::findOrFail($id);

        $data->tipe = $request->tipe;
        $data->status = $request->input('status');

        $data->save();

        return $this->sendResponse($data, 'success');
    }

    public function destroy($id)
    {
        $data =  Nomor::findOrFail($id);
        $data->delete();

        return $this->sendResponse($data, 'success');
    }
}
