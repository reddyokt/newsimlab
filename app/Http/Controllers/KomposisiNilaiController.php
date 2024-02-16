<?php

namespace App\Http\Controllers;

use App\Models\KomposisiNilai;
use App\Models\Periode;
use App\Models\Kelas;
use App\Models\MahasiswaKelas;
use App\Models\NilaiSubjektif;
use App\Models\NilaiTugas;
use App\Models\NilaiUjian;
use App\Models\PenilaianLisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class KomposisiNilaiController extends Controller
{
    public function komposisiIndex()
    {
        $komponen = KomposisiNilai::all();

        return view('komposisi.indexkomposisi', compact('komponen'));
    }

    public function editKomposisi(Request $request, $id)
    {
        KomposisiNilai::find($id)->update(['nilai_komponen' => $request->nilai, 'updated_by' => Session::get('username')]);

        return redirect()->back()->with('success', 'Komponen nilai sudah diedit');
    }

    public function indexPenilaianAkhir()
    {
        $komPretest = KomposisiNilai::where('nama_komponen', 'Pre Test')->first()->nilai_komponen;
        $komPosttest = Komposisinilai::where('nama_komponen', 'Post Test')->first()->nilai_komponen;
        $komSubjektif = Komposisinilai::where('nama_komponen', 'Subjectif')->first()->nilai_komponen;
        $komLaporan = Komposisinilai::where('nama_komponen', 'Report')->first()->nilai_komponen;
        $komUjiawal = Komposisinilai::where('nama_komponen', 'Awal')->first()->nilai_komponen;
        $komUjiakhir = Komposisinilai::where('nama_komponen', 'Akhir')->first()->nilai_komponen;
        $komUjilisan = Komposisinilai::where('nama_komponen', 'Lisan')->first()->nilai_komponen;

        $role = Session::get('role_code');

        $periode = Periode::all();
        $kelas = Kelas::whereHas('periode', function ($q) use ($role) {
            if ($role == 'DPA') {
                $q = $q->where('id_dosen', auth()->user()->dosen->id_dosen);
            }
            if ($role == 'ASL') {
                $q = $q->where('aslab_id', auth()->user()->aslab->id_aslab);
            }
            $q->where('isActive', 'Yes');
        })->get();

        $data = MahasiswaKelas::with(["mhs", "mhskls"])
            ->whereHas('mhskls', function ($q) use ($role) {
                if ($role == 'DPA') {
                    $q = $q->where('id_dosen', auth()->user()->dosen->id_dosen);
                }
                if ($role == 'ASL') {
                    $q = $q->where('id_aslab', auth()->user()->id);
                }
                $q->whereHas('periode', function ($q1) {
                    $q1->where('isActive', 'Yes');
                });
            })->get();
        // dd($data);
        $data = json_encode($data->toArray());
        $data = json_decode($data);

        foreach ($data as $index => $kelasmhs) {
            $mahasiswa_id = $kelasmhs->id_mahasiswa_kelas;
            $kelas_id = $kelasmhs->id_kelas;
            // $jumlah_modul = $kelasmhs->kelas->matkul->jumlah_modul;
            $jml_modul = DB::table('matkul')
                            ->leftJoin('kelas', 'kelas.id_matkul','=','matkul.id_matkul')
                            ->leftJoin('mahasiswa_kelas', 'mahasiswa_kelas.id_kelas', '=', 'kelas.id_kelas')
                            ->where('mahasiswa_kelas.id_mahasiswa_kelas', $kelasmhs->id_mahasiswa_kelas)
                            ->first();
            $jumlah_modul = $jml_modul->jumlah_modul;

            $ujian_awal = NilaiUjian::whereHas('ujian', function ($q) use ($kelasmhs) {
                $q->where('id_kelas', $kelasmhs->id_kelas)
                    ->where('jenis', 'awal');
            })
                ->where('id_mahasiswa_kelas', $kelasmhs->id_mahasiswa_kelas)
                ->first();

            $ujian_akhir = NilaiUjian::whereHas('ujian', function ($q) use ($kelasmhs) {
                $q->where('id_kelas', $kelasmhs->id_kelas)
                    ->where('jenis', 'akhir');
            })
                ->where('id_mahasiswa_kelas', $kelasmhs->id_mahasiswa_kelas)
                ->first();

            $ujian_lisan = PenilaianLisan::where('id_kelas', $kelasmhs->id_kelas)
                ->where('id_mahasiswa_kelas', $kelasmhs->id_mahasiswa_kelas)
                ->first();

            $pretest = NilaiTugas::where('id_mahasiswa_kelas', $mahasiswa_id)
                ->whereHas('tgsnilai', function ($q) use ($kelas_id) {
                    $q->where('jenis', 'pre_test')
                        ->whereHas('tgsmdl', function ($q1) use ($kelas_id) {
                            $q1->where('id_kelas', $kelas_id);
                        });
                })
                ->get();

            $posttest = NilaiTugas::where('id_mahasiswa_kelas', $mahasiswa_id)
                ->whereHas('tgsnilai', function ($q) use ($kelas_id) {
                    $q->where('jenis', 'post_test')
                        ->whereHas('tgsmdl', function ($q1) use ($kelas_id) {
                            $q1->where('id_kelas', $kelas_id);
                        });
                })
                ->get();

            $laporan = NilaiTugas::where('id_mahasiswa_kelas', $mahasiswa_id)
                ->whereHas('tgsnilai', function ($q) use ($kelas_id) {
                    $q->where('jenis', 'report')
                        ->whereHas('tgsmdl', function ($q1) use ($kelas_id) {
                            $q1->where('id_kelas', $kelas_id);
                        });
                })
                ->get();

            $subjektif = NilaiSubjektif::where('id_mahasiswa_kelas', $mahasiswa_id)
                ->whereHas('modulkelas', function ($q1) use ($kelas_id) {
                    $q1->where('id_kelas', $kelas_id);
                })->get();

            $data[$index]->ujian_awal = $ujian_awal;
            $data[$index]->ujian_akhir = $ujian_akhir;
            $data[$index]->ujian_lisan = $ujian_lisan;
            $data[$index]->pretest = $pretest;
            $data[$index]->posttest = $posttest;
            $data[$index]->laporan = $laporan;
            $data[$index]->subjektif = $subjektif;


            $totalujianawal = $ujian_awal->nilai ?? 0;
            $totalujianakhir = $ujian_akhir->nilai ?? 0;
            $totalujianlisan = $ujian_lisan->nilai_lisan ?? 0;

            $totalpretest = 0;
            $totalposttest = 0;
            $totalsubjektif = 0;
            $totallaporan = 0;

            foreach ($pretest as $x) {
                $totalpretest = $totalpretest + $x->nilai;
            }

            foreach ($posttest as $x) {
                $totalposttest = $totalposttest + $x->nilai;
            }

            foreach ($subjektif as $x) {
                $totalsubjektif = $totalsubjektif + $x->nilai;
            }

            foreach ($laporan as $x) {
                $totallaporan = $totallaporan + $x->nilai;
            }

            $pembagi = $jumlah_modul * 100;
            $nilaiakhir = (
                ($totalujianawal * $komUjiawal / 100) +
                ($totalujianakhir * $komUjiakhir / 100) +
                ($totalujianlisan * $komUjilisan / 100) +
                ($totalpretest / $pembagi * $komPretest) +
                ($totalposttest / $pembagi * $komPosttest) +
                ($totalsubjektif / $pembagi * $komSubjektif) +
                ($totallaporan / $pembagi * $komLaporan)
            );

            $data[$index]->nilaiakhir = $nilaiakhir;
        }

        return view('komposisi.indexnilaiakhir', compact('data','kelas','periode'));

    }

    public function nilaiAkhirByPeriode(Request $request)
    {

        $komPretest = KomposisiNilai::where('nama_komponen', 'Pre Test')->first()->nilai_komponen;
        $komPosttest = Komposisinilai::where('nama_komponen', 'Post Test')->first()->nilai_komponen;
        $komSubjektif = Komposisinilai::where('nama_komponen', 'Subjectif')->first()->nilai_komponen;
        $komLaporan = Komposisinilai::where('nama_komponen', 'Report')->first()->nilai_komponen;
        $komUjiawal = Komposisinilai::where('nama_komponen', 'Awal')->first()->nilai_komponen;
        $komUjiakhir = Komposisinilai::where('nama_komponen', 'Akhir')->first()->nilai_komponen;
        $komUjilisan = Komposisinilai::where('nama_komponen', 'Lisan')->first()->nilai_komponen;

        $role = Session::get('role_code');

        $periode = Periode::where('id_periode', $request->periode)->first();
        $id_periode = $periode->id_periode;
        
        $kelas = Kelas::whereHas('periode', function ($q) use ($role, $id_periode) {
            if ($role == 'DPA') {
                $q = $q->where('id_dosen', auth()->user()->dosen->id_dosen);
            }
            if ($role == 'ASL') {
                $q = $q->where('aslab_id', auth()->user()->aslab->id_aslab);
            }
            $q->where('id_periode', $id_periode);
        })->get();

        $data = MahasiswaKelas::with(["mhs", "mhskls"])
            ->whereHas('mhskls', function ($q) use ($role, $id_periode) {
                if ($role == 'DPA') {
                    $q = $q->where('id_dosen', auth()->user()->dosen->id_dosen);
                }
                if ($role == 'ASL') {
                    $q = $q->where('id_aslab', auth()->user()->id);
                }
                $q->whereHas('periode', function ($q1) use($id_periode) {
                    $q1->where('id_periode', $id_periode);
                });
            })->get();

        $data = json_encode($data->toArray());
        $data = json_decode($data);

        foreach ($data as $index => $kelasmhs) {
            $mahasiswa_id = $kelasmhs->id_mahasiswa_kelas;
            $kelas_id = $kelasmhs->id_kelas;

            $jml_modul = DB::table('matkul')
                            ->leftJoin('kelas', 'kelas.id_matkul','=','matkul.id_matkul')
                            ->leftJoin('mahasiswa_kelas', 'mahasiswa_kelas.id_kelas', '=', 'kelas.id_kelas')
                            ->where('mahasiswa_kelas.id_mahasiswa_kelas', $kelasmhs->id_mahasiswa_kelas)
                            ->first();
            $jumlah_modul = $jml_modul->jumlah_modul;

            $ujian_awal = NilaiUjian::whereHas('ujian', function ($q) use ($kelasmhs) {
                $q->where('id_kelas', $kelasmhs->id_kelas)
                    ->where('jenis', 'awal');
            })
                ->where('id_mahasiswa_kelas', $kelasmhs->id_mahasiswa_kelas)
                ->first();

            $ujian_akhir = NilaiUjian::whereHas('ujian', function ($q) use ($kelasmhs) {
                $q->where('id_kelas', $kelasmhs->id_kelas)
                    ->where('jenis', 'akhir');
            })
                ->where('id_mahasiswa_kelas', $kelasmhs->id_mahasiswa_kelas)
                ->first();

            $ujian_lisan = PenilaianLisan::where('id_kelas', $kelasmhs->id_kelas)
                ->where('id_mahasiswa_kelas', $kelasmhs->id_mahasiswa_kelas)
                ->first();

            $pretest = NilaiTugas::where('id_mahasiswa_kelas', $mahasiswa_id)
                ->whereHas('tgsnilai', function ($q) use ($kelas_id) {
                    $q->where('jenis', 'pre_test')
                        ->whereHas('tgsmdl', function ($q1) use ($kelas_id) {
                            $q1->where('id_kelas', $kelas_id);
                        });
                })
                ->get();

            $posttest = NilaiTugas::where('id_mahasiswa_kelas', $mahasiswa_id)
                ->whereHas('tgsnilai', function ($q) use ($kelas_id) {
                    $q->where('jenis', 'post_test')
                        ->whereHas('tgsmdl', function ($q1) use ($kelas_id) {
                            $q1->where('id_kelas', $kelas_id);
                        });
                })
                ->get();

            $laporan = NilaiTugas::where('id_mahasiswa_kelas', $mahasiswa_id)
                ->whereHas('tgsnilai', function ($q) use ($kelas_id) {
                    $q->where('jenis', 'report')
                        ->whereHas('tgsmdl', function ($q1) use ($kelas_id) {
                            $q1->where('id_kelas', $kelas_id);
                        });
                })
                ->get();

            $subjektif = NilaiSubjektif::where('id_mahasiswa_kelas', $mahasiswa_id)
                ->whereHas('modulkelas', function ($q1) use ($kelas_id) {
                    $q1->where('id_kelas', $kelas_id);
                })->get();

            $data[$index]->ujian_awal = $ujian_awal;
            $data[$index]->ujian_akhir = $ujian_akhir;
            $data[$index]->ujian_lisan = $ujian_lisan;
            $data[$index]->pretest = $pretest;
            $data[$index]->posttest = $posttest;
            $data[$index]->laporan = $laporan;
            $data[$index]->subjektif = $subjektif;


            $totalujianawal = $ujian_awal->nilai ?? 0;
            $totalujianakhir = $ujian_akhir->nilai ?? 0;
            $totalujianlisan = $ujian_lisan->nilai_lisan ?? 0;

            $totalpretest = 0;
            $totalposttest = 0;
            $totalsubjektif = 0;
            $totallaporan = 0;

            foreach ($pretest as $x) {
                $totalpretest = $totalpretest + $x->nilai;
            }

            foreach ($posttest as $x) {
                $totalposttest = $totalposttest + $x->nilai;
            }

            foreach ($subjektif as $x) {
                $totalsubjektif = $totalsubjektif + $x->nilai;
            }

            foreach ($laporan as $x) {
                $totallaporan = $totallaporan + $x->nilai;
            }

            $pembagi = $jumlah_modul * 100;
            $nilaiakhir = (
                ($totalujianawal * $komUjiawal / 100) +
                ($totalujianakhir * $komUjiakhir / 100) +
                ($totalujianlisan * $komUjilisan / 100) +
                ($totalpretest / $pembagi * $komPretest) +
                ($totalposttest / $pembagi * $komPosttest) +
                ($totalsubjektif / $pembagi * $komSubjektif) +
                ($totallaporan / $pembagi * $komLaporan)
            );

            $data[$index]->nilaiakhir = $nilaiakhir;
        }

        return view('komposisi.indexnilaiakhirbyperiode', compact('data','kelas','periode'));

    }
}
