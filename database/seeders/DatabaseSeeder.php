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
            'kode' => 'SE',
            'has_direktur' => 1

        ]);
        JenisNaskah::factory()->create([
            'naskah_id' => 1,
            'nama' => 'SOP',
            'kode' => 'SOP',
            'has_direktur' => 1


        ]);
        JenisNaskah::factory()->create([
            'naskah_id' => 1,
            'nama' => 'Keputusan',
            'kode' => 'SK',
            'has_direktur' => 1

        ]);
        JenisNaskah::factory()->create([
            'naskah_id' => 1,
            'nama' => 'Surat Tugas',
            'kode' => 'ST',
            'has_direktur' => 1


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
            'kode' => 'NK',
            'has_direktur' => 1


        ]);
        JenisNaskah::factory()->create([
            'naskah_id' => 3,
            'nama' => 'Perjanjian Kerja Sama/MoA (Memorandum of Agreement)',
            'kode' => 'PKS',
            'has_direktur' => 1


        ]);
        JenisNaskah::factory()->create([
            'naskah_id' => 3,
            'nama' => 'Surat Kuasa',
            'kode' => 'SKU',


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
            'kode' => 'SRTF',
            'has_direktur' => 1


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



        //  Hukum
        Klasifikasi::factory()->create([
            'nama' => 'Program Legislasi',
            'kode' => 'HK.00.00'
        ]);

        // 01.Produk hukum
        Klasifikasi::factory()->create([
            'nama' => 'Rancangan Peraturan Perundang-Undangan tentang Pariwisata dan Ekonomi Kreatif',
            'kode' => 'HK.01.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Peraturan Menteri Parekraf/Kepala Badan Parekraf',
            'kode' => 'HK.01.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Keputusan/Ketetapan Pimpinan Kemenparekraf/Baparekraf',
            'kode' => 'HK.01.02'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Instruksi/Surat Edaran',
            'kode' => 'HK.01.03'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Standar/Pedoman/Prosedur Kerja/Petunjuk Pelaksanaan/ Petunjuk Teknis',
            'kode' => 'HK.01.04'
        ]);

        // 02. Dokumentasi produk hukum
        Klasifikasi::factory()->create([
            'nama' => 'Dokumentasi Produk Hukum Eksternal',
            'kode' => 'HK.02.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Dokumentasi Produk Hukum Internal',
            'kode' => 'HK.02.01'
        ]);
        // 03. Telaah Hukum
        Klasifikasi::factory()->create([
            'nama' => 'Telaah Hukum Internal',
            'kode' => 'HK.03.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Telaah Hukum Eksternal',
            'kode' => 'HK.03.01'
        ]);

        //04. Bantuan/Konsultasi Hukum/advokasi 
        Klasifikasi::factory()->create([
            'nama' => 'Bantuan/Konsultasi Hukum/advokasi',
            'kode' => 'HK.04'
        ]);

        //  05. Kasus Sengketa Hukum
        Klasifikasi::factory()->create([
            'nama' => 'Kasus/Sengketa Hukum Pidana',
            'kode' => 'HK.05.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Kasus/Sengketa Hukum Perdata',
            'kode' => 'HK.05.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Kasus/Sengketa Hukum Peradilan Tata Usaha',
            'kode' => 'HK.05.02'
        ]);

        //06. dan seterusnya
        Klasifikasi::factory()->create([
            'nama' => 'Hak Atas Kekayaan Intelektual (HAKI)',
            'kode' => 'HK.06'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Perjanjian Kerja Sama',
            'kode' => 'HK.07'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Sosialisasi/Publikasi/Penyuluhan Hukum',
            'kode' => 'HK.08'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Inventarisasi Perkara Hukum',
            'kode' => 'HK.09'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Jaringan Dokumentasi dan Informasi Hukum (JDIH)',
            'kode' => 'HK.10'
        ]);


        // PR Perencanaan
        Klasifikasi::factory()->create([
            'nama' => 'Usulan Rencana Kerja/Kegiatan',
            'kode' => 'PR.00.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Program Kerja/Kegiatan Tahunan ',
            'kode' => 'PR.00.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Program Prioritas dari Unit Kerja dan/atau Unit Eselon I',
            'kode' => 'PR.00.02'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Rencana Kerja Berdasarkan Pagu Indikatif',
            'kode' => 'PR.00.03'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'New Initiative',
            'kode' => 'PR.00.04'
        ]);

        //penetapan kerja
        Klasifikasi::factory()->create([
            'nama' => 'Penetapan Kinerja',
            'kode' => 'PR.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Pemantauan dan Evaluasi Program Kerja',
            'kode' => 'PR.02'
        ]);

        //03. Laporan
        Klasifikasi::factory()->create([
            'nama' => 'Laporan Berkala',
            'kode' => 'PR.03.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Laporan Khusus',
            'kode' => 'PR.03.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Progres Report',
            'kode' => 'PR.03.02'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Laporan Akuntabilitas Kinerja Instansi Pemerintah (LAKIP)/Laporan 
            Kinerja (LAKIN)',
            'kode' => 'PR.03.03'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Laporan Akuntabilitas Kinerja Perguruan Tinggi Pariwisata',
            'kode' => 'PR.03.04'
        ]);

        // KU keuangan
        Klasifikasi::factory()->create([
            'nama' => 'Penyusunan RKA',
            'kode' => 'KU.00.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Penyusunan Rencana Kerja dan Anggaran Pagu Anggaran',
            'kode' => 'KU.00.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Penyusunan Rencana Kerja dan Anggaran Pagu Alokasi Anggaran',
            'kode' => 'KU.00.02'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'RKA Perguruan Tinggi Pariwisata',
            'kode' => 'KU.00.03'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Rencana Operasional dan Rutin',
            'kode' => 'KU.00.04'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Petunjuk Operasional Kegiatan (POK) dan Rencana Anggaran Biaya (RAB)',
            'kode' => 'KU.00.05'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Standar Biaya Keluaran/Standar Biaya',
            'kode' => 'KU.00.06'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Standar Satuan Biaya Operasional Pendidikan Tinggi (SSBOPT)/Biaya Kuliah Tunggal (BKT/Uang Kuliah Tunggal (UKT)',
            'kode' => 'KU.00.07'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Anggaran Pendapatan dan Belanja Negara-Perubahan (APBN-P)',
            'kode' => 'KU.00.08'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Ketentuan yang Berkaitan dengan Penyusunan, Pelaksanaan, dan Pertanggungjawaban Anggaran',
            'kode' => 'KU.00.09'
        ]);

        // 01.Revisi Dokumen anggran
        Klasifikasi::factory()->create([
            'nama' => 'enerimaan Negara Bukan Pajak (PNBP) ',
            'kode' => 'KU.01.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Anggaran Belanja Tambahan (ABT)',
            'kode' => 'KU.01.01'
        ]);

        // 02. Pemantauan dan Evaluasi
        Klasifikasi::factory()->create([
            'nama' => 'Pemantauan dan Evaluasi Program dan Anggaran ',
            'kode' => 'KU.02.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Pemantauan dan Evaluasi Program dan Anggaran Perguruan Tinggi Pariwisata',
            'kode' => 'KU.02.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Dokumen Realisasi Capaian Kinerja Program, Capaian Output, dan Anggaran',
            'kode' => 'KU.02.02'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'SIMonev/Sistem Pengendalian Intern',
            'kode' => 'KU.02.03'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Fasilitasi Pendanaan Daerah/Dana Alokasi Khusus',
            'kode' => 'KU.02.04'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Pinjaman dan Hibah Luar Negeri (PHLN)',
            'kode' => 'KU.02.05'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Kerjasama Pemerintah Badan Usaha (KPBU)',
            'kode' => 'KU.02.06'
        ]);


        // 03. Akuntansi dan Pelaporan 
        Klasifikasi::factory()->create([
            'nama' => 'Sistem Akuntansi Instansi (SAI)',
            'kode' => 'KU.03.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Dokumen Akuntansi Keuangan',
            'kode' => 'KU.03.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Pelaporan Keuangan',
            'kode' => 'KU.03.02'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Akuntansi BMN',
            'kode' => 'KU.03.03'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Pelaporan BMN',
            'kode' => 'KU.03.04'
        ]);


        //04,05,06
        Klasifikasi::factory()->create([
            'nama' => 'Penerimaan Negara Bukan Pajak (PNBP)',
            'kode' => 'KU.04'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Badan Layanan Umum (BLU) ',
            'kode' => 'KU.05'
        ]);

        // 06. Tata Kelola Perbendaharaan
        Klasifikasi::factory()->create([
            'nama' => 'Perbendaharaan/Penetapan Pejabat Perbendaharaan',
            'kode' => 'KU.06.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Dokumen Pembayaran Keuangan/Pengeluaran Anggaran Pelaksana Kegiatan',
            'kode' => 'KU.06.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Pajak ',
            'kode' => 'KU.06.02'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Penerimaan Non Pajak',
            'kode' => 'KU.06.03'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Kartu Pengawasan Kredit',
            'kode' => 'KU.06.04'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Berita Acara Pemeriksaan Kas',
            'kode' => 'KU.06.05'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Pembukuan Rekening',
            'kode' => 'KU.06.06'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Pemantauan Tindak Lanjut Laporan Hasil Pengawasan (TLLHP)',
            'kode' => 'KU.06.07'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Laporan Hasil Pemeriksaan BPK/INS/BPKP',
            'kode' => 'KU.06.08'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Penyelesaian Kerugian Negara',
            'kode' => 'KU.06.09'
        ]);


        //07. Pelaksanaan Anggaran 
        Klasifikasi::factory()->create([
            'nama' => 'Daftar Isian Pelaksanaan Anggaran (DIPA)',
            'kode' => 'KU.07.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'DIPA Anggaran Pendapatan dan Belanja Negara – Perubahan (APBN – P)',
            'kode' => 'KU.07.01'
        ]);


        // 08. Belanja
        Klasifikasi::factory()->create([
            'nama' => 'Barang Habis Pakai',
            'kode' => 'KU.08.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Barang Inventaris berupa Barang Bergerak/Barang Inventaris',
            'kode' => 'KU.08.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Barang Inventaris berupa Tanah dan Bangunan',
            'kode' => 'KU.08.02'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Jasa',
            'kode' => 'KU.08.03'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Software Komputer',
            'kode' => 'KU.08.04'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Belanja Modal',
            'kode' => 'KU.08.05'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Belanja Lainnya',
            'kode' => 'KU.08.06'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Penggajian/Tunjangan/Lembur/Honorarium',
            'kode' => 'KU.08.07'
        ]);

        // 09. Ketatausahaan Keuangan
        Klasifikasi::factory()->create([
            'nama' => 'Pembukuan Anggaran',
            'kode' => 'KU.09.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Keterangan Penghasilan',
            'kode' => 'KU.09.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Surat Keterangan Pemberhentian Pembayaran (SKPP)',
            'kode' => 'KU.09.02'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Permohonan Pinjaman',
            'kode' => 'KU.09.03'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Iuran Keanggotaan Organisasi',
            'kode' => 'KU.09.04'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Speciment Tanda Tangan KPA, BP, PPK, dan BPP',
            'kode' => 'KU.09.05'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Surat Pemberitahuan (SPT) Pajak',
            'kode' => 'KU.09.06'
        ]);

        //10. Layanan Keuangan
        Klasifikasi::factory()->create([
            'nama' => 'Administrasi Perbendaharaan dan Penggajian',
            'kode' => 'KU.10.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Verifikasi Anggaran',
            'kode' => 'KU.10.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Koordinasi Keuangan (Rekonsiliasi)',
            'kode' => 'KU.10.02'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Koordinasi Pelaksanaan Kegiatan',
            'kode' => 'KU.10.03'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Sosialisasi/Bimtek Keuangan',
            'kode' => 'KU.10.04'
        ]);



        // KP. KEPEGAWAIAN
        Klasifikasi::factory()->create([
            'nama' => 'Kebijakan Bidang Manajemen Kepegawaian',
            'kode' => 'KP.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Bezzeting/Persediaan Pegawai',
            'kode' => 'KP.01'
        ]);


        // 02. Penyusunan dan Penetapan Kebutuhan Pegawai 

        Klasifikasi::factory()->create([
            'nama' => 'Perencanaan Kebutuhan Pegawai',
            'kode' => 'KP.02.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Perencanaan Pertimbangan Formasi',
            'kode' => 'KP.02.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Penetapan Kebutuhan Pegawai',
            'kode' => 'KP.02.02'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Penetapan Kebutuhan Pegawai',
            'kode' => 'KP.02.03'
        ]);

        // 03. Formasi Pegawai
        Klasifikasi::factory()->create([
            'nama' => 'Usulan Formasi dari Unit Kerja',
            'kode' => 'KP.03.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Usulan Permintaan Formasi',
            'kode' => 'KP.03.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Persetujuan Formasi',
            'kode' => 'KP.03.02'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Penetapan Formasi',
            'kode' => 'KP.03.03'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Penetapan Formasi Khusus',
            'kode' => 'KP.03.04'
        ]);

        // 04. Pengadaan Pegawai 
        Klasifikasi::factory()->create([
            'nama' => 'Proses Penerimaan Pegawai',
            'kode' => 'KP.04.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Berkas Lamaran yang Diterima',
            'kode' => 'KP.04.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Berkas Lamaran yang Tidak Diterima',
            'kode' => 'KP.04.02'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Usul dan Kelengkapan Penetapan NIP',
            'kode' => 'KP.04.03'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Nota Usul Pengangkatan PNS',
            'kode' => 'KP.04.04'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'SK CPNS/PNS Kolektif',
            'kode' => 'KP.04.05'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Open Bidding (Seleksi Terbuka Jabatan)',
            'kode' => 'KP.04.06'
        ]);

        // 05 Sistem Rekrutmen ASN 
        Klasifikasi::factory()->create([
            'nama' => 'Sistem Rekrutmen ASN',
            'kode' => 'KP.06.00'
        ]);

        // 06. Pembinaan dan Penghargaan Pegawai
        Klasifikasi::factory()->create([
            'nama' => 'Kode Etik dan Kode Perilaku Pegawai',
            'kode' => 'KP.06.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Disiplin Pegawai',
            'kode' => 'KP.06.02'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Penghargaan dan Tanda Jasa',
            'kode' => 'KP.06.03'
        ]);

        // 07. Mutasi Pegawai 
        Klasifikasi::factory()->create([
            'nama' => 'Kenaikan Pangkat/Golongan/Jabatan',
            'kode' => 'KP.07.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Pengangkatan dan Pemberhentian dalam Jabatan',
            'kode' => 'KP.07.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Berita Acara Pelantikan dan Serah Terima Jabatan',
            'kode' => 'KP.07.02'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Alih Status, Pindah Instansi, Pindah Wilayah Kerja, Diperbantukan, Dipekerjakan, Penugasan Sementara, Mutasi antar Perwakilan, 
Mutasi ke dan dari Perwakilan, Pemindahan Sementara, 
Persetujuan/Pertimbangan Kepala BKN ',
            'kode' => 'KP.07.03'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Penetapan Perubahan Data Dasar/Status/Kedudukan Hukum Pegawai',
            'kode' => 'KP.07.04'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Peninjauan Masa Kerja',
            'kode' => 'KP.07.05'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Berkas Badan Pertimbangan Jabatan dan Pangkat',
            'kode' => 'KP.07.06'
        ]);


        // 08. Status dan Kedudukan Pegawai
        Klasifikasi::factory()->create([
            'nama' => 'Pertimbangan Status Kepegawaian',
            'kode' => 'KP.08.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Pertimbangan Kedudukan Kepegawaian',
            'kode' => 'KP.08.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Penyesuaian Pengelolaan Keberatan Pegawai',
            'kode' => 'KP.08.02'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Perselisihan/Sengketa Kepegawaian',
            'kode' => 'KP.08.03'
        ]);

        // 09. Pemberhentian dan Pensiun 
        Klasifikasi::factory()->create([
            'nama' => 'Pemberhentian Pegawai',
            'kode' => 'KP.09.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Pensiun',
            'kode' => 'KP.09.01'
        ]);

        //10 Administrasi/Fasilitasi Penilaian Angka Kredit Jabatan Fungsional
        Klasifikasi::factory()->create([
            'nama' => 'Administrasi/Fasilitasi Penilaian Angka Kredit Jabatan Fungsional',
            'kode' => 'KP.10'
        ]);

        // 11. Administrasi Pegawai 
        Klasifikasi::factory()->create([
            'nama' => 'Surat Perintah/SPPT/SPMT/SPP',
            'kode' => 'KP.11.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Cuti Sakit, Cuti Bersalin, Cuti Tahunan',
            'kode' => 'KP.11.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Cuti Alasan Penting',
            'kode' => 'KP.11.02'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Cuti Besar dan Cuti di Luar Tanggungan Negara',
            'kode' => 'KP.11.03'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Dokumentasi Identitas Pegawai',
            'kode' => 'KP.11.04'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Berkas Kepegawaian dan Daftar Urut Kepangkatan',
            'kode' => 'KP.11.05'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Berkas Pengurusan Kenaikan Gaji Berkala, Mutasi Gaji/Tunjangan/Uang Makan',
            'kode' => 'KP.11.06'
        ]);


        // 12. Berkas Perseorangan
        Klasifikasi::factory()->create([
            'nama' => 'Berkas Perseorangan ASN/PNS',
            'kode' => 'KP.12.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Berkas Perseorangan PPPK',
            'kode' => 'KP.12.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Berkas Perseorangan ASN yang Berjasa/Terlibat dalam Peristiwa Berskala Nasional',
            'kode' => 'KP.12.02'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Berkas Perseorangan Menteri dan Wakil Menteri',
            'kode' => 'KP.12.03'
        ]);


        // 13. Kesejahteraan Pegawai
        Klasifikasi::factory()->create([
            'nama' => 'Layanan Asuransi Pegawai/BPJS',
            'kode' => 'KP.13.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Layanan Tabungan Perumahan',
            'kode' => 'KP.13.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Layanan Pensiun',
            'kode' => 'KP.13.02'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Berkas tentang Medical Record',
            'kode' => 'KP.13.03'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Dokumen-dokumen yang berkaitan dengan rekreasi',
            'kode' => 'KP.13.04'
        ]);

        // 14 Bantuan Hukum 
        Klasifikasi::factory()->create([
            'nama' => 'Bantuan Hukum pegawai',
            'kode' => 'KP.14'
        ]);

        // 15. Kinerja
        Klasifikasi::factory()->create([
            'nama' => 'Penilaian dan Standar Kinerja Pegawai (SKP)',
            'kode' => 'KP.15.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Pengelolaan Database dan Analisis Sistem Informasi Kinerja Pegawai',
            'kode' => 'KP.15.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Pemantauan dan Evaluasi Kinerja dan Standar Kinerja',
            'kode' => 'KP.15.02'
        ]);


        // 16. Pengembangan Karir 
        Klasifikasi::factory()->create([
            'nama' => 'Perencanaan dan Pengembangan Karir',
            'kode' => 'KP.16.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Usulan Tugas Belajar/Ijin Belajar/Diklat/Kursus/Magang/Ujian 
Dinas/Praktek Kerja di Instansi Lain/Pertukaran Antar ASN Dengan 
Pegawai Swasta ',
            'kode' => 'KP.16.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Penyesuaian Ijazah',
            'kode' => 'KP.16.02'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Penyesuaian Sistem Karir',
            'kode' => 'KP.16.03'
        ]);

        // 17 Kompetensi dan Manajemen Talenta
        Klasifikasi::factory()->create([
            'nama' => 'Kompetensi dan Manajemen Talenta',
            'kode' => 'KP.17'
        ]);
        // 18 Pengawasan dan Pengendalian Kepegawaian
        Klasifikasi::factory()->create([
            'nama' => 'Pengawasan dan Pengendalian Kepegawaian',
            'kode' => 'KP.18'
        ]);

        // 19. Sistem Informasi Kepegawaian 
        Klasifikasi::factory()->create([
            'nama' => 'Pengelolaan Data dan Informasi Kepegawaian',
            'kode' => 'KP.19.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Pengembangan Sistem Informasi Kepegawaian ',
            'kode' => 'KP.19.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Pengembangan Sistem Pengelolaan Arsip Kepegawaian',
            'kode' => 'KP.19.02'
        ]);


        // OT. ORGANISASI DAN TATA LAKSANA
        // organisasi
        Klasifikasi::factory()->create([
            'nama' => 'Pembentukan, Penataan, dan Penutupan/Pembubaran Organisasi',
            'kode' => 'OT.00.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Struktur, Tugas, dan Fungsi Organisasi',
            'kode' => 'OT.00.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Analisis Organisasi',
            'kode' => 'OT.00.02'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Evaluasi Organisasi',
            'kode' => 'OT.00.03'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Analisa Jabatan dan Beban Kerja',
            'kode' => 'OT.00.04'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Peta Jabatan',
            'kode' => 'OT.00.05'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Standar Kompetensi Jabatan',
            'kode' => 'OT.00.06'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Uraian Jabatan dan Tata Kerja',
            'kode' => 'OT.00.07'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Evaluasi Jabatan',
            'kode' => 'OT.00.08'
        ]);

        // 01. Tata Laksana
        Klasifikasi::factory()->create([
            'nama' => 'Sistem dan Prosedur Kerja',
            'kode' => 'OT.01.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Pembakuan Sarana Kerja',
            'kode' => 'OT.01.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Pembinaan/Penyuluhan Ketatalaksanaan',
            'kode' => 'OT.01.00'
        ]);

        // 02 Internalisasi Reformasi Birokrasi 
        Klasifikasi::factory()->create([
            'nama' => 'Internalisasi Reformasi Birokrasi',
            'kode' => 'OT.02'
        ]);


        // KK. KOMUNIKASI
        // 00. Informasi Publik 
        Klasifikasi::factory()->create([
            'nama' => 'Layanan Informasi dan Pengaduan',
            'kode' => 'KK.00.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Sistem Manajemen Informasi (SMI)',
            'kode' => 'KK.00.01'
        ]);

        // 01. Hubungan Antar Lembaga 
        Klasifikasi::factory()->create([
            'nama' => 'Lembaga Negara/Lembaga Pemerintahan',
            'kode' => 'KK.01.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Organisasi Pariwisata',
            'kode' => 'KK.01.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Perusahaan/Swasta',
            'kode' => 'KK.01.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Organisasi Kemasyarakatan/LSM/Ormas/Orpol',
            'kode' => 'KK.01.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Perguruan Tinggi/Sekolah',
            'kode' => 'KK.01.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Bakohumas',
            'kode' => 'KK.01.00'
        ]);

        //02 Rapat Koordinasi/Rapat Pimpinan/Rapat Terbatas/Rapat Kerja/Rapat Dengar Pendapat/Sidang Kabinet 
        Klasifikasi::factory()->create([
            'nama' => 'Rapat Koordinasi/Rapat Pimpinan/Rapat Terbatas/Rapat Kerja/Rapat Dengar Pendapat/Sidang Kabinet',
            'kode' => 'KK.02'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Manajemen Krisis Kepariwisataan',
            'kode' => 'KK.03'
        ]);


        // 04. Hubungan Masyarakat
        Klasifikasi::factory()->create([
            'nama' => 'Pengelolaan Publikasi dan Relasi Media',
            'kode' => 'KK.04.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Pemantauan dan Analisis Media',
            'kode' => 'KK.04.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Pengembangan Komunitas',
            'kode' => 'KK.04.02'
        ]);


        // 05. Media Digital 
        Klasifikasi::factory()->create([
            'nama' => 'Pengelolaan dan Publikasi Media Sosial',
            'kode' => 'KK.05.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Analisa Digital',
            'kode' => 'KK.05.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Program Aktivasi ',
            'kode' => 'KK.05.02'
        ]);

        // 06. Produksi Konten
        Klasifikasi::factory()->create([
            'nama' => 'Produksi Narasi',
            'kode' => 'KK.06.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Produksi Foto dan Video',
            'kode' => 'KK.06.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Desain Grafis',
            'kode' => 'KK.06.02'
        ]);


        // PW. PENGAWASAN
        // 00. Rencana Pengawasan
        Klasifikasi::factory()->create([
            'nama' => 'Rencana Strategis Pengawasan',
            'kode' => 'PW.00.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Rencana Kerja Tahunan',
            'kode' => 'PW.00.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Rencana Kinerja Tahunan',
            'kode' => 'PW.00.02'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Penetapan Kinerja Tahunan',
            'kode' => 'PW.00.03'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Rakor Pengawasan',
            'kode' => 'PW.00.04'
        ]);

        // 01. Program Kerja Pengawasan
        Klasifikasi::factory()->create([
            'nama' => 'Program Pembinaan',
            'kode' => 'PW.01.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Program Konsultasi dan Koordinasi Pengawasan',
            'kode' => 'PW.01.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Program Pemantauan Hasil Pengawasan dan Pemeriksaan',
            'kode' => 'PW.01.02'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Program AKIP Unit Kerja',
            'kode' => 'PW.01.03'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Program AKIP Kementerian',
            'kode' => 'PW.01.04'
        ]);

        // 02. Pelaksanaan Pengawasan 
        Klasifikasi::factory()->create([
            'nama' => 'Administrasi Pelaksanaan Pengawasan',
            'kode' => 'PW.02.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Laporan Hasil Pengawasan yang Memerlukan Tindak lanjut',
            'kode' => 'PW.02.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Laporan Hasil Pengawasan yang Tidak Memerlukan Tindak lanjut',
            'kode' => 'PW.02.02'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Laporan Perkembangan Penanganan Surat Pengaduan Masyarakat',
            'kode' => 'PW.02.03'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Laporan Pemutakhiran Data Tindak Lanjut Temuan',
            'kode' => 'PW.02.04'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Laporan Perkembangan Barang Milik Negara',
            'kode' => 'PW.02.05'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Laporan Kegiatan Pendampingan Penyusunan Laporan Keuangan dan Reviu ',
            'kode' => 'PW.02.06'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Tuntutan Ganti Rugi (TGR)',
            'kode' => 'PW.02.07'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Pemantauan dan Evaluasi',
            'kode' => 'PW.02.08'
        ]);

        // 03 Kegiatan Pengawasan Lainnya
        Klasifikasi::factory()->create([
            'nama' => 'Kegiatan Pengawasan Lainnya',
            'kode' => 'PW.03'
        ]);
        // 04 Pelaksanaan Pembangunan Zona Integritas
        Klasifikasi::factory()->create([
            'nama' => 'Pelaksanaan Pembangunan Zona Integritas',
            'kode' => 'PW.04'
        ]);
        // 05 Good Corporate Governance
        Klasifikasi::factory()->create([
            'nama' => 'Good Corporate Governance',
            'kode' => 'PW.05'
        ]);
        // 06 Publikasi Pengawasan 
        Klasifikasi::factory()->create([
            'nama' => 'Publikasi Pengawasan',
            'kode' => 'PW.06'
        ]);
        // 07 Sistem Informasi/Aplikasi Pengawasan 
        Klasifikasi::factory()->create([
            'nama' => 'Sistem Informasi/Aplikasi Pengawasan',
            'kode' => 'PW.07'
        ]);


        // DS. DATA DAN SISTEM INFORMASI 
        // 00. Data dan Informasi 
        Klasifikasi::factory()->create([
            'nama' => 'Pengolahan Data dan Informasi',
            'kode' => 'DS.00.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Analisis Data dan Informasi ',
            'kode' => 'DS.00.01'
        ]);

        // 01. Perencanaan dan Pengembangan Sistem Informasi dan Jaringan
        Klasifikasi::factory()->create([
            'nama' => 'Kebijakan/Rencana Strategis/Master Plan Pengembangan Sistem Informasi dan Jaringan',
            'kode' => 'DS.01.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Pengelolaan dan Pengembangan Sistem Informasi',
            'kode' => 'DS.01.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Pengelolaan dan Pengembangan Jaringan dan Sarana Infrastruktur TIK',
            'kode' => 'DS.01.02'
        ]);

        // 02. Pengelolaan dan Layanan Operasional Teknologi Informasi
        Klasifikasi::factory()->create([
            'nama' => 'Pengelolaan Aplikasi dan Basis Data',
            'kode' => 'DS.02.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Pelayanan Operasional Teknologi Informasi',
            'kode' => 'DS.02.01'
        ]);

        // 03. Layanan Perpustakaan
        Klasifikasi::factory()->create([
            'nama' => 'Pengadaan dan Pengolahan Bahan Pustaka',
            'kode' => 'DS.03.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Penyimpanan Deposit Bahan Pustaka',
            'kode' => 'DS.03.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Daftar Koleksi',
            'kode' => 'DS.03.02'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Layanan Perpustakaan',
            'kode' => 'DS.03.03'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Pelestarian Bahan Pustaka',
            'kode' => 'DS.03.04'
        ]);


        // PS. PENGEMBANGAN SDM PARIWISATA DAN EKONOMI KREATIF 
        // 00. Pendidikan dan Pelatihan (Diklat) 
        Klasifikasi::factory()->create([
            'nama' => 'Kebijakan di Bidang Diklat',
            'kode' => 'PS.00.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Perencanaan dan Program Diklat ',
            'kode' => 'PS.00.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Konsultasi Pelaksanaan Diklat',
            'kode' => 'PS.00.02'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Kerja Sama Diklat',
            'kode' => 'PS.00.03'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Tenaga Kediklatan',
            'kode' => 'PS.00.04'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Modul/Bahan Ajar Diklat',
            'kode' => 'PS.00.05'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Peserta Diklat',
            'kode' => 'PS.00.06'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Pelaksanaan Diklat',
            'kode' => 'PS.00.07'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Sistem Informasi Diklat',
            'kode' => 'PS.00.08'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Monitoring dan Evaluasi Diklat',
            'kode' => 'PS.00.09'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Akreditasi Diklat',
            'kode' => 'PS.00.10'
        ]);

        // 01. Jabatan Fungsional
        Klasifikasi::factory()->create([
            'nama' => 'Pengembangan Jabatan Fungsional',
            'kode' => 'PS.01.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Pembinaan Jabatan Fungsional',
            'kode' => 'PS.01.01'
        ]);

        // 02. Pembinaan Administrasi dan Kerja Sama Pendidikan Tinggi 
        Klasifikasi::factory()->create([
            'nama' => 'Pembinaan Administrasi Pendidikan Tinggis',
            'kode' => 'PS.02.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Kurikulum dan Kerjasama Perguruan Tinggi',
            'kode' => 'PS.02.01'
        ]);

        //         KLASIFIKASI ARSIP FUNGSI SUBSTANTIF
        // KE. KEBIJAKAN KEPARIWISATAAN DAN EKONOMI KREATIF
        // 00 Rumusan Kebijakan Bidang Pariwisata dan Ekonomi Kreatif
        Klasifikasi::factory()->create([
            'nama' => 'Rumusan Kebijakan Bidang Pariwisata dan Ekonomi Kreatif',
            'kode' => 'KE.00'
        ]);


        // KS. KEBIJAKAN STRATEGIS
        // 00. Kajian Strategis

        Klasifikasi::factory()->create([
            'nama' => 'Kebijakan Pengembangan dan Kajian Strategis',
            'kode' => 'KS.00.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Pelaporan Data Statistik Pariwisata',
            'kode' => 'KS.00.01'
        ]);

        // 01. Manajemen Strategis
        Klasifikasi::factory()->create([
            'nama' => 'Rencana Pembangunan Jangka Panjang (RPJP)',
            'kode' => 'KS.01.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Rencana Pembangunan Jangka Menengah Nasional (RPJMN)',
            'kode' => 'KS.01.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Rencana Strategis (Renstra)',
            'kode' => 'KS.01.02'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Program Prioritas',
            'kode' => 'KS.01.03'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Indikator Kinerja Utama (IKU)',
            'kode' => 'KS.01.04'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Rencana Kerja Pemerintah (RKP)',
            'kode' => 'KS.01.05'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Sumber Pembiayaan dan Pendanaan',
            'kode' => 'KS.01.06'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Rencana Induk Pariwisata Terpadu',
            'kode' => 'KS.01.07'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Rencana Bisnis, Studi Kelayakan, dan Perencanaan Investasi',
            'kode' => 'KS.01.08'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Rencana Induk Kepariwisataan Nasional',
            'kode' => 'KS.01.09'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Advokasi Perencanaan Daerah dan Sektor Bidang Pariwisata',
            'kode' => 'KS.01.10'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Rencana Induk Pembangunan Ekonomi Kreatif Nasional',
            'kode' => 'KS.01.11'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Advokasi Perencanaan Daerah dan Sektor Bidang Ekonomi Kreatif',
            'kode' => 'KS.01.12'
        ]);

        // 02. Regulasi
        Klasifikasi::factory()->create([
            'nama' => 'Regulasi Bidang Pariwisata dan Ekonomi Kreatif',
            'kode' => 'KS.02.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Sinkronisasi Regulasi Pusat dan Daerah Bidang Pariwisata dan Ekonomi Kreatif',
            'kode' => 'KS.02.01'
        ]);


        //         SD. SUMBER DAYA DAN KELEMBAGAAN 
        // 00. Pengembangan Sumber Daya Manusia Pariwisata
        Klasifikasi::factory()->create([
            'nama' => 'Pemberdayaan Masyarakat',
            'kode' => 'SD.00.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Peningkatan Kompetensi Sumber Daya Manusia Pariwisata',
            'kode' => 'SD.00.01'
        ]);

        // 01 Pengembangan Sumber Daya Manusia Ekonomi Kreatif
        Klasifikasi::factory()->create([
            'nama' => 'Pengembangan Sumber Daya Manusia Ekonomi Kreatif',
            'kode' => 'SD.01'
        ]);

        // 02. Standardisasi Kompetensi 
        Klasifikasi::factory()->create([
            'nama' => 'Pengembangan Standar Kompetensi',
            'kode' => 'SD.02.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Sertifikasi Kompetensi Profesi',
            'kode' => 'SD.02.01'
        ]);

        // 03. Hubungan Antarlembaga 
        Klasifikasi::factory()->create([
            'nama' => 'Hubungan Antarlembaga Dalam Negeri',
            'kode' => 'SD.03.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Hubungan Antarlembaga ASEAN',
            'kode' => 'SD.03.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Hubungan Antarlembaga Bilateral',
            'kode' => 'SD.03.02'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Hubungan Antarlembaga Multilateral',
            'kode' => 'SD.03.03'
        ]);

        //         DI. PENGEMBANGAN DESTINASI DAN INFRASTRUKTUR 
        // 00. Tata Kelola Destinasi 
        Klasifikasi::factory()->create([
            'nama' => 'Analisis dan Strategi Pengembangan Destinasi',
            'kode' => 'DI.00.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Pengembangan Ekosistem Destinasi',
            'kode' => 'DI.00.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Manajemen Krisis',
            'kode' => 'DI.00.02'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Destinasi Pariwisata Berkelanjutan',
            'kode' => 'DI.00.03'
        ]);


        // 01. Infrastruktur Ekonomi Kreatif
        Klasifikasi::factory()->create([
            'nama' => 'Pengembangan Klaster Ekonomi Kreatif',
            'kode' => 'DI.01.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Infrastruktur Fisik Ekonomi Kreatif',
            'kode' => 'DI.01.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Infrastruktur Digital Ekonomi Kreatif',
            'kode' => 'DI.01.02'
        ]);

        // 02 Pengembangan Destinasi 
        Klasifikasi::factory()->create([
            'nama' => 'Pengembangan Destinasi',
            'kode' => 'DI.02'
        ]);


        //         II. INDUSTRI DAN INVESTASI 
        // 00. Standarisasi dan Sertifikasi Usaha

        Klasifikasi::factory()->create([
            'nama' => 'Standar Usaha Pariwisata dan Ekonomi Kreatif',
            'kode' => 'II.00.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Sertifikasi Usaha Pariwisata dan Ekonomi Kreatif',
            'kode' => 'II.00.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Pengawasan Standar dan Sertifikasi Usaha Pariwisata dan Ekonomi Kreatif',
            'kode' => 'II.00.02'
        ]);

        // 01. Manajemen Industri 
        Klasifikasi::factory()->create([
            'nama' => 'Tata Kelola Industri',
            'kode' => 'II.01.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Kemitraan Pelaku Usaha',
            'kode' => 'II.01.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Ketahanan dan Pengembangan Industri',
            'kode' => 'II.01.02'
        ]);

        // 02. Manajemen Investasi
        Klasifikasi::factory()->create([
            'nama' => 'Perencanaan Investasi',
            'kode' => 'II.02.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Promosi dan Pendampingan Investasi',
            'kode' => 'II.02.01'
        ]);

        // 03. Akses Pembiayaan
        Klasifikasi::factory()->create([
            'nama' => 'Perbankan',
            'kode' => 'II.03.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Teknologi Finansial dan Modal Ventura',
            'kode' => 'II.03.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Dana Masyarakat',
            'kode' => 'II.03.02'
        ]);

        // PM. PEMASARAN 
        // 00. Komunikasi Pemasaran
        Klasifikasi::factory()->create([
            'nama' => 'Strategi Komunikasi dan kemitraan',
            'kode' => 'PM.00.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Konten dan Sarana Komunikasi Pemasaran',
            'kode' => 'PM.00.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Komunikasi Media Digital',
            'kode' => 'PM.00.02'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Komunikasi Multimedia',
            'kode' => 'PM.00.03'
        ]);

        // 01. Pemasaran Pariwisata
        Klasifikasi::factory()->create([
            'nama' => 'Pemasaran Pariwisata Nusantara',
            'kode' => 'PM.01.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Pemasaran Pariwisata Mancanegara',
            'kode' => 'PM.01.00'
        ]);

        // 02. Pemasaran Ekonomi Kreatif
        Klasifikasi::factory()->create([
            'nama' => 'Pemasaran Ekonomi Kreatif',
            'kode' => 'PM.02'
        ]);


        // PP. PRODUK WISATA DAN PENYELENGGARA KEGIATAN (EVENTS) 
        // 00. Wisata Minat Khusus

        Klasifikasi::factory()->create([
            'nama' => 'Strategi dan Komunikasi Wisata Alam, Budaya, Buatan',
            'kode' => 'PP.00.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Produk dan Promosi Wisata Alam, Budaya, Buatan',
            'kode' => 'PP.00.00'
        ]);

        // 01. Pertemuan, Insentif, Konvensi, dan Pameran 
        Klasifikasi::factory()->create([
            'nama' => 'Strategi dan Kemitraan Pertemuan, Insentif, Konvensi, dan Pameran',
            'kode' => 'PP.01.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Pemenangan Tuan Rumah dan Pendukung Pertemuan, Insentif, Konvensi, dan Pameran',
            'kode' => 'PP.01.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Promosi dan Publikasi Pertemuan, Insentif, Konvensi, dan Pameran',
            'kode' => 'PP.01.02'
        ]);

        // 02. Event Nasional dan Internasional

        Klasifikasi::factory()->create([
            'nama' => 'Penyelenggaraan Event Nasional',
            'kode' => 'PP.02.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Penyelenggaraan Event Internasional',
            'kode' => 'PP.02.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Strategi dan Promosi Event Nasional dan Internasional',
            'kode' => 'PP.02.02'
        ]);

        // 03. Event Daerah
        Klasifikasi::factory()->create([
            'nama' => 'Penyelenggaraan Event Daerah',
            'kode' => 'PP.03.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Strategi dan Promosi Event Daerah',
            'kode' => 'PP.03.01'
        ]);

        // EP. EKONOMI DIGITAL DAN PRODUK KREATIF
        // 00 Tata Kelola Ekonomi Digital 
        Klasifikasi::factory()->create([
            'nama' => 'Tata Kelola Ekonomi Digital',
            'kode' => 'EP.00'
        ]);
        // 01 Pengembangan Aplikasi, Permainan, Televisi, dan Radio
        Klasifikasi::factory()->create([
            'nama' => 'Pengembangan Aplikasi, Permainan, Televisi, dan Radio',
            'kode' => 'EP.01'
        ]);
        // 02 Pengembangan Kuliner, Kriya, Desain, dan Fesyen
        Klasifikasi::factory()->create([
            'nama' => 'Pengembangan Kuliner, Kriya, Desain, dan Fesyen',
            'kode' => 'EP.03'
        ]);
        // 03 Pengembangan Musik, Seni Pertunjukan, dan Penerbitan
        Klasifikasi::factory()->create([
            'nama' => 'Pengembangan Musik, Seni Pertunjukan, dan Penerbitan',
            'kode' => 'EP.03'
        ]);


        // 04. Pengembangan Kekayaan Intelektual Industri Kreatif
        Klasifikasi::factory()->create([
            'nama' => 'Pengembangan Bidang Edukasi, Advokasi, dan Pendampingan Kekayaan Intelektua',
            'kode' => 'EP.04.00'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Pengembangan Bidang Fasilitasi Pendaftaran dan Pencatatan Kekayaan Intelektual',
            'kode' => 'EP.04.01'
        ]);
        Klasifikasi::factory()->create([
            'nama' => 'Pengembangan Bidang Pembinaan, Penguatan, dan Pemanfaatan Kekayaan Intelektual',
            'kode' => 'EP.04.02'
        ]);
    }
}
