<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlhRequest;
use App\Models\Plh;
use Illuminate\Http\Request;

class PlhController extends Controller
{
    public function index(Request $request)
    {
        $plh = Plh::fillter($request)->with('jabatans')->orderBy('id', 'DESC')->paginate(50);

        return $this->sendResponse($plh, 'success');
    }

    public function store(PlhRequest $request)
    {

        $dataReq = $request->all();
        $dataReq['jabatan_id'] = $request->jabatan_id['id'];
        $plh = Plh::create($dataReq);

        return $this->sendResponse($plh, 'success');
    }

    public function update(PlhRequest $request, $id)
    {
        $dataReq = $request->all();
        $dataReq['jabatan_id'] = $request->jabatan_id['id'];
        Plh::findOrFail($id)->update($dataReq);
        return $this->sendResponse($dataReq, 'success');
    }
    public function destroy($id)
    {

        $data =  Plh::findOrFail($id)->delete();

        return $this->sendResponse($data, 'success');
    }
}
