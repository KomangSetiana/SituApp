<?php

namespace App\Http\Controllers;

use App\Http\Requests\JabatanRequest;
use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function index(Request $request)
    {
        $jabatan = Jabatan::fillter($request)->with('wewenang')->orderBy('id', 'DESC')->get();

        return $this->sendResponse($jabatan, 'success');
    }

    public function store(JabatanRequest $request)
    {
        $jabatan = Jabatan::create($request->validated());

        return $this->sendResponse($jabatan, 'success');
    }

    public function update(JabatanRequest $request, $id)
    {
        $data = ($request->validated());

        Jabatan::findOrFail($id)->update($data);
        return $this->sendResponse($data, 'success');
    }

    public function destroy($id)
    {

        $data =  Jabatan::findOrFail($id)->delete();

        return $this->sendResponse($data, 'success');
    }
}
