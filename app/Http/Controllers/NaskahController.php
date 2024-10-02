<?php

namespace App\Http\Controllers;

use App\Http\Requests\NaskahRequest;
use App\Models\Naskah;
use Illuminate\Http\Request;

class NaskahController extends Controller
{
    public function index(Request $request)
    {
        $naskah = Naskah::fillter($request)->with('jenisNaskah')->orderBy('id', 'DESC')->get();
        return $this->sendResponse($naskah, 'success');
    }

    public function store(NaskahRequest $request)
    {
        $naskah = Naskah::create($request->validated());

        return $this->sendResponse($naskah, 'success');
    }

    public function update(NaskahRequest $request, $id)
    {
        $data = ($request->validated());

        Naskah::where('id', $id)->update($data);
        return $this->sendResponse($data, 'success');
    }

    public function destroy($id)
    {
        $data =  Naskah::findOrFail($id);
        $data->jenisNaskah()->delete();
        $data->delete();

        return $this->sendResponse($data, 'success');
    }
}
