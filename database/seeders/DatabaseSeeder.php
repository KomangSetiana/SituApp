<?php

namespace Database\Seeders;

use App\Models\AksesNaskah;
use App\Models\Jabatan;
use App\Models\JenisNaskah;
use App\Models\Klasifikasi;
use App\Models\Naskah;
use App\Models\User;
use App\Models\Wewenang;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'id_pengguna' => 'a1',
            'nama_pengguna' => 'Admin Situ',
            'username' => 'situppb',
            'password' => 'situppb',
            'role' => 'admin'
        ]);

        Naskah::factory()->create([
            'nama' => 'Naskah Arahan',
        ]);

        Naskah::factory()->create([
            'nama' => 'Naskah Dinas Korespondensi',

        ]);
        Naskah::factory()->create([
            'nama' => ' Naskah Dinas Khusus dan ND Lainnya',

        ]);

        // Akses Naskah 
        AksesNaskah::factory()->create([
            'nama' => 'Rahasia',
            'kode' => 'R'
        ]);
        AksesNaskah::factory()->create([
            'nama' => 'Terbatas',
            'kode' => 'T'
        ]);
        AksesNaskah::factory()->create([
            'nama' => 'Biasa',
            'kode' => 'B'
        ]);

        // Jenis Naskah

        JenisNaskah::factory()->create([
            'naskah_id' => 1,
            'nama' => 'Surat Edaran ',
            'kode' => 'SE'

        ]);
        JenisNaskah::factory()->create([
            'naskah_id' => 1,
            'nama' => 'SOP',
            'kode' => 'SOP'

        ]);
        JenisNaskah::factory()->create([
            'naskah_id' => 1,
            'nama' => 'Keputusan',
            'kode' => 'SK'

        ]);
        JenisNaskah::factory()->create([
            'naskah_id' => 1,
            'nama' => 'Surat Tugas ',
            'kode' => 'ST'

        ]);
        JenisNaskah::factory()->create([
            'naskah_id' => 1,
            'nama' => 'Surat Perintah (penunjukan Plt/Plh) ',
            'kode' => 'SPRIN'

        ]);



        JenisNaskah::factory()->create([
            'naskah_id' => 2,
            'nama' => 'Surat Undangan',
            'kode' => 'UND',
            'akses_naskah' => 1


        ]);
        JenisNaskah::factory()->create([
            'naskah_id' => 2,
            'nama' => 'Nota Dinas',
            'kode' => 'ND',
            'akses_naskah' => 1


        ]);
        JenisNaskah::factory()->create([
            'naskah_id' => 2,
            'nama' => 'Memorandum',
            'kode' => 'MO',
            'akses_naskah' => 1


        ]);
        JenisNaskah::factory()->create([
            'naskah_id' => 2,
            'nama' => 'Surat Dinas',
            'kode' => 'SD',
            'akses_naskah' => 1
        ]);


        // Naskah dinas khusus dan lainnya

        JenisNaskah::factory()->create([
            'naskah_id' => 3,
            'nama' => 'Nota Kesepahaman/MoU (Memorandum of Understanding)',
            'kode' => 'NK'

        ]);
        JenisNaskah::factory()->create([
            'naskah_id' => 3,
            'nama' => 'Perjanjian Kerja Sama/MoA (Memorandum of Agreement)',
            'kode' => 'PKS'

        ]);
        JenisNaskah::factory()->create([
            'naskah_id' => 3,
            'nama' => 'Surat Kuasa',
            'kode' => 'SKU'

        ]);
        JenisNaskah::factory()->create([
            'naskah_id' => 3,
            'nama' => 'Berita Acara',
            'kode' => 'BA'
        ]);
        JenisNaskah::factory()->create([
            'naskah_id' => 3,
            'nama' => 'Surat Pernyataan',
            'kode' => 'SPER'

        ]);
        JenisNaskah::factory()->create([
            'naskah_id' => 3,
            'nama' => 'Surat Keterangan',
            'kode' => 'SKET'

        ]);
        JenisNaskah::factory()->create([
            'naskah_id' => 3,
            'nama' => 'Surat Keterangan Pendidikan dan Pelatihan',
            'kode' => 'SKDL'

        ]);
        JenisNaskah::factory()->create([
            'naskah_id' => 3,
            'nama' => 'Surat Pengantar',
            'kode' => 'SPENG'

        ]);
        JenisNaskah::factory()->create([
            'naskah_id' => 3,
            'nama' => 'Pengumuman',
            'kode' => 'PEM'

        ]);
        JenisNaskah::factory()->create([
            'naskah_id' => 3,
            'nama' => 'Piagam Penghargaan',
            'kode' => 'PP'

        ]);
        JenisNaskah::factory()->create([
            'naskah_id' => 3,
            'nama' => 'Sertifikat',
            'kode' => 'SRTF'

        ]);
        JenisNaskah::factory()->create([
            'naskah_id' => 3,
            'nama' => 'Surat Tanda Tamat Pendidikan dan Pelatihan',
            'kode' => 'STTPL'

        ]);

        // Jabatan

        Jabatan::factory()->create([
            'nama' => 'Direktur',
            'kode' => 'PTP.2',
            'has_plh' => 1


        ]);

        Jabatan::factory()->create([
            'nama' => 'Kabag ADAK',
            'kode' => 'PTP.2.1',


        ]);
        Jabatan::factory()->create([
            'nama' => 'Kabag ADUM',
            'kode' => 'PTP.2.2',


        ]);

        Jabatan::factory()->create([
            'nama' => 'Kasubbag. Administrasi Akademik dan Kerjasama',
            'kode' => 'PTP.2.1.1',


        ]);
        Jabatan::factory()->create([
            'nama' => 'Kasubbag. Administrasi Tendik & Kemahasiswaan',
            'kode' => 'PTP.2.1.2',


        ]);
        Jabatan::factory()->create([
            'nama' => 'subbag. Administrasi Kepegawaian dan Tata Usaha',
            'kode' => 'PTP.2.2.1',


        ]);
        Jabatan::factory()->create([
            'nama' => 'Kasubbag. Administrasi Keuangan',
            'kode' => 'PTP.2.2.2',


        ]);
        Jabatan::factory()->create([
            'nama' => 'Kasubbag. Administrasi Keuangan ',
            'kode' => 'PTP.2.2.2',


        ]);
        Jabatan::factory()->create([
            'nama' => 'Wakil Direktur I',
            'kode' => 'PTP.2.A',


        ]);
        Jabatan::factory()->create([
            'nama' => 'Wakil Direktur II',
            'kode' => 'PTP.2.B',


        ]);
        Jabatan::factory()->create([
            'nama' => 'Wakil Direktur IIII',
            'kode' => 'PTP.2.C',


        ]);
        Jabatan::factory()->create([
            'nama' => 'Kuasa Pengguna Anggaran',
            'kode' => 'PTP.2.D',


        ]);
        Jabatan::factory()->create([
            'nama' => 'PPK 52',
            'kode' => 'PTP.2.E',


        ]);
        Jabatan::factory()->create([
            'nama' => 'PPK 53',
            'kode' => 'PTP.2.F',


        ]);
        Jabatan::factory()->create([
            'nama' => 'Pejabat Pengadaan',
            'kode' => 'PTP.2.G',


        ]);
        Jabatan::factory()->create([
            'nama' => 'Pejabat Penandatangan SPM',
            'kode' => 'PTP.2.H',
        ]);

        // PLH



        // Jabatan
        Wewenang::factory()->create([
            'jabatan_id' => 1,
            'jenis_naskah_id' => 1,
        ]);
        Wewenang::factory()->create([
            'jabatan_id' => 1,
            'jenis_naskah_id' => 2,
        ]);
        Wewenang::factory()->create([
            'jabatan_id' => 1,
            'jenis_naskah_id' => 3,
        ]);
        Wewenang::factory()->create([
            'jabatan_id' => 1,
            'jenis_naskah_id' => 4,
        ]);
        Wewenang::factory()->create([
            'jabatan_id' => 1,
            'jenis_naskah_id' => 5,
        ]);



        // Klasifikasi


        // Umum
        Klasifikasi::factory()->create([
            'nama' => 'Sambutan Pidato Menteri/Pimpinan',
            'kode' => 'UM.00.00',
        ]);

        Klasifikasi::factory()->create([
            'nama' => 'Rapat/Rapat Kerja/Rapat Pimpinan',
            'kode' => 'UM.00.01',
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Perjalanan Dinas Dalam dan Luar Negeri',
            'kode' => 'UM.00.02',
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Pemberian Pengghargaan/Tanda Kenang-Kenangan',
            'kode' => 'UM.00.03',
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Ucapan',
            'kode' => 'UM.00.04',
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Memori Jabatan Pimpinan',
            'kode' => 'UM.00.05',
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Pencetakan, Penggandaan, dan Penjilidan',
            'kode' => 'UM.00.06',
        ]);

        // Kerotokolan
        Klasifikasi::factory()->create([
            'nama' => 'Acara Kedinasan Menteri/Pimpinan',
            'kode' => 'UM.01.00',
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Agenda Kegiatan Pimpinan',
            'kode' => 'UM.01.01',
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Kunjungan',
            'kode' => 'UM.01.02',
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Buku Tamu',
            'kode' => 'UM.01.03',
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Daftar Nama dan Alamat Pejabat ',
            'kode' => 'UM.01.04',
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Audiensi',
            'kode' => 'UM.01.05',
        ]);

        //Kerumahtanggaan
        Klasifikasi::factory()->create([
            'nama' => 'Peringatan/Upacara Hari Kemerdekaan, Hari Besar Nasional',
            'kode' => 'UM.02.00',
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Pengelolaan dan Penggunaan Fasilitas Kantor',
            'kode' => 'UM.02.01',
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Pakaian Dinas Pegawai',
            'kode' => 'UM.02.02',
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Tanda Pengenal Pegawai ',
            'kode' => 'UM.02.03',
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Konsumsi dan Akomodasi',
            'kode' => 'UM.02.04',
        ]);


        // Ketertiban dan Keamanan
        Klasifikasi::factory()->create([
            'nama' => 'Ketertiban dan Keamanan',
            'kode' => 'UM.03',
        ]);

        //  Pelayanan
        Klasifikasi::factory()->create([
            'nama' => 'Kesehatan Pegawai/Poliklinik',
            'kode' => 'UM.04.00',
        ]);

        Klasifikasi::factory()->create([
            'nama' => 'Tempat Penitipan Anak',
            'kode' => 'UM.04.01',
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Layanan Lainnya',
            'kode' => 'UM.04.02',
        ]);


        // Kegiatan Sosial
        Klasifikasi::factory()->create([
            'nama' => 'Kegiatan Kerohanian',
            'kode' => 'UM.05.00',
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Kegiatan Olahraga',
            'kode' => 'UM.05.01',
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Kegiatan Kesenian',
            'kode' => 'UM.05.02',
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Sumbangan/Bantuan Sosial ',
            'kode' => 'UM.05.03',
        ]);

        // Organisasi Non Kedinasan 
        Klasifikasi::factory()->create([
            'nama' => 'KORPRI',
            'kode' => 'UM.06.00',
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Dharma Wanita',
            'kode' => 'UM.06.01',
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Organisasi Non Kedinasan Lainnya',
            'kode' => 'UM.06.02',
        ]);

        // Kearsipan
        Klasifikasi::factory()->create([
            'nama' => ' Penyusunan Sistem/NSPK',
            'kode' => 'UM.07.00',
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Penciptaan Arsip dan Administrasi Persuratan',
            'kode' => 'UM.07.01',
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Penyimpanan dan Pemeliharaan Arsip',
            'kode' => 'UM.07.02',
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Layanan Peminjaman dan Penggunaan Arsip',
            'kode' => 'UM.07.03',
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Alih Media Arsip ',
            'kode' => 'UM.07.04',
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Program Arsip Vital dan Arsip Terjaga ',
            'kode' => 'UM.07.05',
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Penyusutan/Pemindahan Arsip ',
            'kode' => 'UM.07.06',
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Penyusutan/Pemusnahan Arsip',
            'kode' => 'UM.07.07',
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Penyusutan/Penyerahan Arsip Statis ',
            'kode' => 'UM.07.08',
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Monitoring dan Evaluasi Kearsipan ',
            'kode' => 'UM.07.09',
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Pembinaan Kearsipan',
            'kode' => 'UM.07.10',
        ]);


        //  PERLENGKAPAN DAN PENGELOLAAN BARANG MILIK NEGARA 
        // Perencanaan Pengadaan 

        Klasifikasi::factory()->create([
            'nama' => 'Analisis Kebutuhan Kantor',
            'kode' => 'PL.00.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Penyusunan Standar Harga Satuan Barang Persediaan ',
            'kode' => 'PL.00.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Tata Ruang/Layout Ruang Kerja',
            'kode' => 'PL.00.02'
        ]);

        // Pengelolaan Barang
        Klasifikasi::factory()->create([
            'nama' => 'Penyimpanan/Pergudangan',
            'kode' => 'PL.01.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Distribusi/Penyaluran',
            'kode' => 'PL.01.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Pemasangan Fasilitas Kantor',
            'kode' => 'PL.01.02'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Penggunaan',
            'kode' => 'PL.01.03'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Pemanfaatan ',
            'kode' => 'PL.01.04'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Penilaian',
            'kode' => 'PL.01.05'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Pemeliharaan/Perbaikan Barang Milik Negara/ Fasilitas Kantor',
            'kode' => 'PL.01.06'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Pengamanan',
            'kode' => 'PL.01.07'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Pemindahtanganan',
            'kode' => 'PL.01.08'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Penyimpanan/Pergudangan',
            'kode' => 'PL.01.09'
        ]);

        // Penatausahaan BMN 

        Klasifikasi::factory()->create([
            'nama' => 'SIMAK BMN',
            'kode' => 'PL.02.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Pembukuan',
            'kode' => 'PL.02.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Daftar Barang Ruangan',
            'kode' => 'PL.02.02'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Inventarisasai BMN',
            'kode' => 'PL.02.03'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Laporan BMN',
            'kode' => 'PL.02.04'
        ]);

        //
        Klasifikasi::factory()->create([
            'nama' => 'Bukti-bukti Kepemilikan Aset',
            'kode' => 'PL.03'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Pembinaan, Pengawasan, dan Pengendalian BMN',
            'kode' => 'PL.04'
        ]);

        // PA. PENGADAAN
        // 00. Pengelolaan Pengadaan Barang/Jasa

        Klasifikasi::factory()->create([
            'nama' => 'Inventarisasi Paket',
            'kode' => 'PA.00.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Analisis Pasar',
            'kode' => 'PA.00.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Penyusunan Strategi',
            'kode' => 'PA.00.02'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Pemilihan Penyedia',
            'kode' => 'PA.00.03'
        ]);

        // 01. Pengelolaan Layanan Pengadaan 
        Klasifikasi::factory()->create([
            'nama' => 'Pengelolaan dan Pengembangan Sistem Informasi ',
            'kode' => 'PA.01.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'PLayanan Informasi, Registrasi, dan Verifikasi Pengguna Sistem
Informasi',
            'kode' => 'PA.01.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Pengelolaan Daftar Hitam',
            'kode' => 'PA.01.02'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Bimbingan Teknis/Pendampingan/Konsultasi Proses Pengadaan ',
            'kode' => 'PA.01.03'
        ]);

        // 02. Bimbingan dan Konsultasi Pengadaan 
        Klasifikasi::factory()->create([
            'nama' => 'Bimbingan Teknis/Pendampingan/Konsultasi Substansi Hukum',
            'kode' => 'PA.02.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'LPembinaan SDM dan Kelembagaan',
            'kode' => 'PA.02.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => ' Layanan Penyelesaian Sengketa Kontrak Melalui Mediasi',
            'kode' => 'PA.02.02'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Pemantauan dan Evaluasi',
            'kode' => 'PA.02.03'
        ]);

        // 03. Pelaksanaan Pengadaan Barang dan jasa
        Klasifikasi::factory()->create([
            'nama' => 'Secara Langsung (Penunjukan Langsung)',
            'kode' => 'PA.03.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Melalui Lelang',
            'kode' => 'PA.03.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Se Melalui Bantuan/hibah',
            'kode' => 'PA.03.02'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Melalui Pinjaman',
            'kode' => 'PA.03.03'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Melalui Sewa',
            'kode' => 'PA.02.03'
        ]);
    }
}
