<?php

namespace App\Http\Controllers;

use App\Http\Requests\KlasifikasiRequest;
use App\Models\Klasifikasi;
use Illuminate\Http\Request;

class KlasifikasiController extends Controller
{
    public function index(Request $request)
    {
        $klasifikasi = Klasifikasi::fillter($request)->with('nomor')->orderBy('id', 'DESC')->paginate(20);

        return $this->sendResponse($klasifikasi, 'success');
    }

    public function store(KlasifikasiRequest $request)
    {


        $klasifikasi = Klasifikasi::create($request->validated());

        return $this->sendResponse($klasifikasi, 'success');
    }

    public function update(KlasifikasiRequest $request, $id)
    {
        $data = ($request->validated());
        Klasifikasi::findOrFail($id)->update($data);
        return $this->sendResponse($data, 'success');
    }

    public function destroy($id)
    {
        $data =  Klasifikasi::findOrFail($id)->delete();

        return $this->sendResponse($data, 'success');
    }

    public function getAll(Request $request)
    {
        $klasifikasi = Klasifikasi::all();

        return $this->sendResponse($klasifikasi, 'success');
    }
}
