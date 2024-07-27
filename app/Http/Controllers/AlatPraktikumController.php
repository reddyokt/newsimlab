<?php

namespace App\Http\Controllers;

use App\Models\AlatPraktikum;
use App\Models\DetailAlat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AlatPraktikumController extends Controller
{
    public function alatIndex()
    {
        $alat = DB::table('alat')->whereNull('alat.deleted_at')
            ->leftJoin('lemari', 'lemari.id_lemari', '=', 'alat.id_lemari')
            ->leftJoin('lokasi', 'lokasi.id_lokasi', '=', 'lemari.id_lokasi')
            ->select(DB::raw('alat.id_alat, alat.jenis as jenis, alat.nama_alat as nama,
                                        alat.merk_alat as merk, alat.ukuran_alat as ukuran,
                                        alat.jumlah as jumlah, alat.baris as baris, alat.kolom as kolom,
                                        lemari.nama_lemari as lemari, lokasi.nama_lokasi as lokasi,
                                        alat.images as images, alat.qrcode as qrcode'))
            ->get()->toArray();
        return view('inventory.alat.indexalat', compact('alat'));
    }

    public function createAlat()
    {
        $lemari = DB::table('lemari')->leftJoin('lokasi', 'lokasi.id_lokasi', '=', 'lemari.id_lokasi')
            ->select(DB::raw('lemari.id_lemari as id_lemari, lemari.nama_lemari as nama_lemari,
                                        lokasi.nama_lokasi as nama_lokasi'))
            ->get()->toArray();

        return view('inventory.alat.createalat', compact('lemari'));
    }

    public function storeAlat(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $req = $request->all();

        $waktu = Carbon::now()->format('YmdHis');
        $creatorid = Session::get('user_id');
        $pp = null;
        if ($request->file('images')) {
            $namafile = str_replace(' ', '_', $request->name);
            $extension = $request->file('images')->getClientOriginalExtension();
            $pp = 'images' . '-' . $namafile . '-' . $waktu . '.' . $extension;
            $dataImage = $request->file('images')->get();
            File::put(public_path('upload/inventory/alat/' . $pp), $dataImage);
        }
        if ($request->jenisalat == 'c2b') {

            $namalat = str_replace(' ', '_', $request->name);
            $storealat = new AlatPraktikum();
            $storealat->nama_alat = $req['name'];
            $storealat->jenis = $req['jenisalat'];
            $storealat->merk_alat = $req['merk'];
            $storealat->ukuran_alat = $req['ukuran'];
            $storealat->jumlah = $req['jumlah'];
            $storealat->id_lemari = $req['lemari_id'];
            $storealat->baris = $req['baris'];
            $storealat->kolom = $req['kolom'];
            $storealat->images = $pp;
            $storealat->created_by = $creatorid;
            $storealat->save();

            $sequence = [];
            for ($i = 1; $i <= $request->jumlah; $i++) {
                $sequence[] = sprintf("%03d", $i);
            }

            foreach ($sequence as $sequence) {

                $storedetail = new DetailAlat();
                $storedetail->id_alat = $storealat->id_alat;
                $storedetail->sub_id_alat = $sequence;
                $storedetail->condition = 'good';
                $storedetail->created_by = Session::get('username');
                $storedetail->qrcode = 'qr_code_' . $namalat . '-' . $sequence . '.png';
                $storedetail->save();

                $this->generateAndSaveQRCodeBySubId($namalat, $storealat->id_alat, $storedetail->sub_id_alat);
            }
        } elseif ($request->jenisalat == 'c2a') {

            $namalat = str_replace(' ', '_', $request->name);
            $storealat = new AlatPraktikum();
            $storealat->nama_alat = $req['name'];
            $storealat->jenis = $req['jenisalat'];
            $storealat->merk_alat = $req['merk'];
            $storealat->ukuran_alat = $req['ukuran'];
            $storealat->jumlah = $req['jumlah'];
            $storealat->id_lemari = $req['lemari_id'];
            $storealat->baris = $req['baris'];
            $storealat->kolom = $req['kolom'];
            $storealat->images = $pp;
            $storealat->created_by = $creatorid;
            $storealat->save();

            // Dapatkan id_alat yang telah disimpan ke database
            $id_alat = $storealat->id_alat;

            // Buat nama file QR code dengan menggunakan id_alat
            $qrcode_filename = 'qr_code_' . $namalat . '-' . $id_alat . '.png';

            // Simpan QR code dengan menggunakan id_alat yang telah disimpan
            $this->generateAndSaveQRCodeById($namalat, $id_alat);

            // Simpan nama file QR code ke dalam properti qrcode dari alat yang telah disimpan
            $storealat->qrcode = $qrcode_filename;
            $storealat->save();
        }

        return redirect('/alat')->with('success', 'alhamdulillah Data Alat berhasil dibuat');
    }

    public function detailAlat($id)
    {
        $alat = DB::table('alat')->where('id_alat', $id)
            ->leftJoin('lemari', 'lemari.id_lemari', '=', 'alat.id_lemari')
            ->join('lokasi', 'lokasi.id_lokasi', '=', 'lemari.id_lokasi')
            ->first();

        $detail = DB::table('alat')
            ->leftJoin('detail_alat', 'detail_alat.id_alat', '=', 'alat.id_alat')
            ->where('alat.id_alat', $id)
            ->whereNull('alat.deleted_at')
            ->select(DB::raw('alat.id_alat, alat.nama_alat as nama_alat, alat.merk_alat, alat.ukuran_alat, alat.jumlah, alat.images,
                                        detail_alat.sub_id_alat, detail_alat.condition, detail_alat.description, 
                                        detail_alat.deadline_calibration, detail_alat.file as file, detail_alat.qrcode as qrcode'))
            ->get();
        $condition = ['good', 'need_repair', 'bad'];

        return view('inventory.alat.detailalat', compact('alat', 'detail', 'condition'));
    }

    public function notifKalibrasi()
    {
        date_default_timezone_set('Asia/Jakarta');

        $notifikasi = DB::table('detail_alat')
            ->leftJoin('alat', 'alat.id_alat', '=', 'detail_alat.id_alat')
            ->whereRaw('DATEDIFF(deadline_calibration, NOW()) <= 30')
            ->get();

        return view('layouts.topbar', compact('notifikasi'));
    }

    public function editDetailAlat(Request $request, $id1, $id2)
    {
        // dd($request);

        $pp = null;
        if ($request->file('file')) {
            $namafile = str_replace(' ', '_', $request->nama_alat);
            $sub_id_alat = str_replace(' ', '_', $request->sub_id_alat);
            $extension = $request->file('file')->getClientOriginalExtension();
            $pp = 'file' . '-' . $namafile . '-' . $sub_id_alat . '.' . $extension;
            $dataImage = $request->file('file')->get();
            File::put(public_path('upload/inventory/alat/' . $pp), $dataImage);
        }

        // Convert dates
        $deadline_calibration = $request->tanggal ? date('Y-m-d', strtotime($request->tanggal)) : null;
        $last_calibration_at = $request->tanggal_last ? date('Y-m-d', strtotime($request->tanggal_last)) : null;

        DetailAlat::where('id_alat', $id1)->where('sub_id_alat', $id2)
            ->update([
                'condition' => $request->condition,
                'description' => $request->body,
                'deadline_calibration' => $deadline_calibration,
                'last_calibration_at' => $last_calibration_at,
                'file' => $pp
            ]);

        return redirect()->back()->with('success', 'Alhamdulillah, data berhasil diedit');
    }


    public function viewAlat($id_alat, $sub_id_alat)
    {
        $alat = DB::table('alat')->where('id_alat', $id_alat)
            ->leftJoin('lemari', 'lemari.id_lemari', '=', 'alat.id_lemari')
            ->join('lokasi', 'lokasi.id_lokasi', '=', 'lemari.id_lokasi')
            ->first();

        $detail = DB::table('alat')
            ->leftJoin('detail_alat', 'detail_alat.id_alat', '=', 'alat.id_alat')
            ->where('alat.id_alat', $alat->id_alat)
            ->whereNull('alat.deleted_at')
            ->select(DB::raw('alat.id_alat, alat.nama_alat as nama_alat, alat.merk_alat, alat.ukuran_alat, 
                              alat.jumlah, alat.images, detail_alat.sub_id_alat, detail_alat.condition, 
                              detail_alat.description, detail_alat.deadline_calibration, detail_alat.last_calibration_at, detail_alat.file as file, 
                              detail_alat.qrcode as qrcode'))
            ->get();
        // dd($detail);
        $condition = ['good', 'need_repair', 'bad'];

        return view('inventory.alat.detailalat', compact('alat', 'detail', 'condition'));
    }

    public function editlAlat($id)
    {

        $lemari = DB::table('lemari')->leftJoin('lokasi', 'lokasi.id_lokasi', '=', 'lemari.id_lokasi')
            ->select(DB::raw('lemari.id_lemari as id_lemari, lemari.nama_lemari as nama_lemari,
                                                    lokasi.nama_lokasi as nama_lokasi'))
            ->get()->toArray();

        $edit = DB::table('alat')->where('id_alat', $id)
            ->select(DB::raw('id_alat,jenis,id_lemari,nama_alat,merk_alat,ukuran_alat,jumlah,baris,kolom,images'))
            ->first();

        return view('inventory.alat.editalat', compact('lemari', 'edit'));
    }

    public function storeEditAlat($id)
    {
        $alat = AlatPraktikum::findOrFail($id);
        $data = request()->only(['jenisalat', 'name', 'merk', 'ukuran', 'jumlah', 'lemari_id', 'baris', 'kolom', 'images']);
        $existingJumlah = $alat->jumlah;
        $newJumlah = $data['jumlah'];
        $difference = $newJumlah - $existingJumlah;

        $waktu = Carbon::now()->format('YmdHis');
        $creatorid = Session::get('user_id');
        $pp = null;

        if (request()->hasFile('images')) {
            $uploadedFile = request()->file('images');
            $namafile = str_replace(' ', '_', $data['name']);
            $extension = $uploadedFile->getClientOriginalExtension();
            $pp = 'images' . '-' . $namafile . '-' . $waktu . '.' . $extension;
            $uploadedFile->move(public_path('upload/inventory/alat/'), $pp);
        }

        if ($data['jenisalat'] == 'c2b') {
            if ($difference > 0) {
                // Find the highest existing sub_id_alat for the given id_alat
                $highestSubIdAlat = DetailAlat::where('id_alat', $id)->max('sub_id_alat');
                // If there are no existing sub_id_alat records, set $nextSubIdAlat to 1
                $nextSubIdAlat = ($highestSubIdAlat) ? ++$highestSubIdAlat : 1;

                $alat->update([
                    'nama_alat' => $data['name'],
                    'jenis' => $data['jenisalat'],
                    'merk_alat' => $data['merk'],
                    'ukuran_alat' => $data['ukuran'],
                    'jumlah' => $data['jumlah'],
                    'id_lemari' => $data['lemari_id'],
                    'baris' => $data['baris'],
                    'kolom' => $data['kolom'],
                    'images' => $pp,
                    'created_by' => $creatorid,
                ]);

                $sequence = range($nextSubIdAlat, $nextSubIdAlat + $difference - 1);

                foreach ($sequence as $seq) {
                    $storedetail = new DetailAlat();
                    $storedetail->id_alat = $alat->id_alat;
                    $storedetail->sub_id_alat = sprintf("%03d", $seq);
                    $storedetail->condition = 'good';
                    $storedetail->created_by = Session::get('username');
                    $storedetail->save();
                }
            } else {

                $alat->update([
                    'nama_alat' => $data['name'],
                    'jenis' => $data['jenisalat'],
                    'merk_alat' => $data['merk'],
                    'ukuran_alat' => $data['ukuran'],
                    'jumlah' => $data['jumlah'],
                    'id_lemari' => $data['lemari_id'],
                    'baris' => $data['baris'],
                    'kolom' => $data['kolom'],
                    'images' => $pp,
                    'created_by' => $creatorid,
                ]);
            }
        } else {

            $alat->update([
                'nama_alat' => $data['name'],
                'jenis' => $data['jenisalat'],
                'merk_alat' => $data['merk'],
                'ukuran_alat' => $data['ukuran'],
                'jumlah' => $data['jumlah'],
                'id_lemari' => $data['lemari_id'],
                'baris' => $data['baris'],
                'kolom' => $data['kolom'],
                'images' => $pp,
                'created_by' => $creatorid,
            ]);
        }

        return redirect()->back()->with('success', 'alhamdulillah Data berhasil diedit');
    }

    public function generateAndSaveQRCodeBySubId($namaAlat, $idalat, $subId)
    {
        // Generate QR code
        $qrCode = QrCode::format('png')->size(200)->generate($namaAlat . $idalat . $subId);

        // Path to save the QR code image
        $qrCodePath = 'qr_code_' . $namaAlat . '-' . $subId . '.png';

        // Save the QR code image as a PNG file
        File::put(public_path('upload/qrcodes/' . $qrCodePath), $qrCode);

        // Return the URL to access the QR code image
        $qrCodeUrl = url('qrcodes/' . $qrCodePath);

        return $qrCodeUrl;
    }

    public function generateAndSaveQRCodeById($namaAlat, $idalat)
    {
        // Generate QR code
        $qrCode = QrCode::format('png')->size(200)->generate($namaAlat . $idalat);

        // Path to save the QR code image
        $qrCodePath = 'qr_code_' . $namaAlat . '-' . $idalat . '.png';

        // Save the QR code image as a PNG file
        File::put(public_path('upload/qrcodes/' . $qrCodePath), $qrCode);

        // Return the URL to access the QR code image
        $qrCodeUrl = url('qrcodes/' . $qrCodePath);

        return $qrCodeUrl;
    }
}
