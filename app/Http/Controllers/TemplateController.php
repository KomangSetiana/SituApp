<?php

namespace App\Http\Controllers;

use App\Http\Requests\TemplateRequest;
use App\Http\Requests\UpadateTemplateRequest;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TemplateController extends Controller
{
    public function index(Request $request)
    {
        $template = Template::fillter($request)->orderBy('id', 'DESC')->get();
        return $this->sendResponse($template, 'success');
    }

    public function store(TemplateRequest $request)
    {

        // Save new file in storage
        $file = $request->file('filename');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('files', $fileName, 'public');
        $filePath = Storage::url('files/' . $fileName);

        // Save file path in the database
        $template = new Template();
        $template->nama = $request->nama;
        $template->filename = $filePath;
        $template->save();

        return response()->json([
            'success' => true,
            'message' => 'File uploaded successfully',
            'nama' => $request->nama,
            'filename' => $fileName,
        ]);
    }

    public function update(UpadateTemplateRequest $request, $id)
    {

        // Temukan template berdasarkan ID
        $template = Template::findOrFail($id);
        // dd($request->filename);
        // Hapus file lama jika ada
        if ($template->filename) {
            // Konversi path agar sesuai dengan lokasi di storage/app/public
            $oldFilePath = str_replace('/storage', 'public', $template->filename);
            Storage::delete($oldFilePath); // Menghapus file
        }

        // Simpan file baru ke stora ge
        $file = $request->file('filename');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('files', $fileName, 'public');
        $filePath = Storage::url('files/' . $fileName);
        // Update file path dan nama pada model template yang ada

        $template->filename = $filePath;
        $template->nama = $request->nama;
        $template->save();

        return response()->json([
            'success' => true,
            'message' => 'File updated successfully',
            'nama' => $request->nama,
        ]);
    }

    public function destroy($id)
    {
        $data =  Template::findOrFail($id);
        if ($data->filename) {
            // Konversi path agar sesuai dengan lokasi di storage/app/public
            $oldFilePath = str_replace('/storage', 'public', $data->filename);
            Storage::delete($oldFilePath); // Menghapus file
        }
        $data->delete();

        return $this->sendResponse($data, 'success');
    }
}
