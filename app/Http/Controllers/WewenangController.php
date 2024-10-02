<?php

namespace App\Http\Controllers;

use App\Http\Requests\WewenangRequest;
use App\Models\Wewenang;
use Illuminate\Http\Request;

class WewenangController extends Controller
{
    public function index(Request $request)
    {
        $Wewenang = Wewenang::fillter($request)->with(['jabatan', 'jenisNaskah'])->orderBy('id', 'DESC')->get();

        return $this->sendResponse($Wewenang, 'success');
    }

    public function store(WewenangRequest $request)
    {

        $dataReq = $request->all();
        $dataReq['jabatan_id'] = $request->jabatan_id['id'];
        $dataReq['jenis_naskah_id'] = $request->jenis_naskah_id['id'];

        $uniqWewenang = Wewenang::where('jabatan_id', $dataReq['jabatan_id'])->where('jenis_naskah_id', $dataReq['jenis_naskah_id'])->get()->first();

        if ($uniqWewenang) {
            return $this->sendError('wewenang sudah ada', $uniqWewenang);
        }
        Wewenang::create($dataReq);

        return $this->sendResponse($dataReq, 'success');
    }

    public function update(WewenangRequest $request, $id)
    {
        $dataReq = $request->all();
        $dataReq['jabatan_id'] = $request->jabatan_id['id'];
        $dataReq['jenis_naskah_id'] = $request->jenis_naskah_id['id'];
        // dd($dataReq);
        Wewenang::findOrFail($id)->update($dataReq);
        return $this->sendResponse($dataReq, 'success');
    }
    public function destroy($id)
    {

        $data =  Wewenang::findOrFail($id)->delete();

        return $this->sendResponse($data, 'success');
    }
}
