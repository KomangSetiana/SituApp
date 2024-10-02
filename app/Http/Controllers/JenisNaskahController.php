<?php

namespace App\Http\Controllers;

use App\Http\Requests\JenisNaskahRequest;
use App\Http\Requests\NaskahRequest;
use App\Models\JenisNaskah;
use App\Models\Naskah;
use Illuminate\Http\Request;

class JenisNaskahController extends Controller
{
    public function index(Request $request)
    {
        $jenisNaskah = JenisNaskah::fillter($request)->with(['naskah', 'wewenang'])->orderBy('id', 'DESC')->get();

        return $this->sendResponse($jenisNaskah, 'success');
    }

    public function store(JenisNaskahRequest $request)
    {
        $dataReq = $request->all();
        $dataReq['naskah_id'] = $request->naskah_id['id'];
        $jenisNaskah = JenisNaskah::create($dataReq);

        return $this->sendResponse($jenisNaskah, 'success');
    }

    public function update(JenisNaskahRequest $request, $id)
    {
        $dataReq =  $request->all();
        $dataReq['naskah_id'] = $request->naskah_id['id'];

        JenisNaskah::findOrFail($id)->update($dataReq);
        return $this->sendResponse($dataReq, 'success');
    }
    public function destroy($id)
    {

        $data =  JenisNaskah::findOrFail($id)->delete();

        return $this->sendResponse($data, 'success');
    }
}
