<?php
$title = "Formulir Pendaftaran Mahasiswa Baru";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = "Data Pendaftar";
}
include 'header.php';

// 1. Definisi Class
class MahasiswaBaru {
    // Property untuk menyimpan data mahasiswa
    public $nama;
    public $email;
    public $tgl_lahir;
    public $jenis_kelamin;
    public $alamat;
    public $id_prodi;
    public $foto_nama;
    public $foto_ukuran;

    // Constructor: Otomatis jalan saat objek dibuat
    public function __construct($data, $file) {
        $this->nama          = htmlspecialchars($data['nama']);
        $this->email         = htmlspecialchars($data['email']);
        $this->tgl_lahir     = $data['tgl_lahir'];
        $this->jenis_kelamin = $data['jenis_kelamin'];
        $this->alamat        = htmlspecialchars($data['alamat']);
        $this->id_prodi      = $data['id_prodi'];
        $this->foto_nama     = htmlspecialchars($file['foto_mhs']['name']);
        $this->foto_ukuran   = $file['foto_mhs']['size'];
    }

    public function getNamaProdi() {    // Method: Logika penentuan Nama Prodi
        $daftar_prodi = [
            "1" => "Sistem Komputer",
            "2" => "Sistem Informasi",
            "3" => "Teknologi Informasi"
        ];
        return $daftar_prodi[$this->id_prodi] ?? "Prodi Tidak Diketahui";
    }

    public function getFormatJK() { // Method: Logika penentuan Jenis Kelamin
        return ($this->jenis_kelamin == "L") ? "Laki-laki" : "Perempuan";
    }

    public function getTanggalLahir() { // Method: Format Tanggal
        return date('d-M-Y', strtotime($this->tgl_lahir));
    }

    public function getFormatUkuranFoto() { // Method: Format Ukuran Foto
        return number_format($this->foto_ukuran / 1024, 2) . " KB";
    }
} // End of Class MahasiswaBaru

// 2. Implementasi Objek
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Membuat Objek baru dari Class MahasiswaBaru
    $mhs = new MahasiswaBaru($_POST, $_FILES);
?>
    <div class="card kartu shadow">
        <div class="card-body p-4">
            <div class="text-center mb-4">
                <i class="fa-solid fa-circle-check fa-4x" style="color: var(--warna-utama);"></i>
                <h4 class="mt-3 mb-1">Pendaftaran Berhasil!</h4>
                <p class="text-muted mb-0">Data dikelola menggunakan Class MahasiswaBaru</p>
            </div>

            <h6 class="judul-bagian"><i class="fa-solid fa-list-check me-2"></i>Ringkasan Data</h6>
            <ul class="list-group list-group-flush mb-4">
                <li class="list-group-item d-flex justify-content-between"><span class="text-muted">Nama</span><strong><?= $mhs->nama ?></strong></li>
                <li class="list-group-item d-flex justify-content-between"><span class="text-muted">Email</span><strong><?= $mhs->email ?></strong></li>
                <li class="list-group-item d-flex justify-content-between"><span class="text-muted">Jenis Kelamin</span><strong><?= $mhs->getFormatJK() ?></strong></li>
                <li class="list-group-item d-flex justify-content-between"><span class="text-muted">Program Studi</span><strong><?= $mhs->getNamaProdi() ?></strong></li>
                <li class="list-group-item d-flex justify-content-between"><span class="text-muted">Tanggal Lahir</span><strong><?= $mhs->getTanggalLahir() ?></strong></li>
                <li class="list-group-item d-flex justify-content-between"><span class="text-muted">Alamat</span><strong class="text-end"><?= $mhs->alamat ?></strong></li>
                <li class="list-group-item d-flex justify-content-between"><span class="text-muted">Nama File Foto</span><strong><?= $mhs->foto_nama ?></strong></li>
                <li class="list-group-item d-flex justify-content-between"><span class="text-muted">Ukuran File Foto</span><strong><?= $mhs->getFormatUkuranFoto() ?></strong></li>
            </ul>

            <div class="text-center">
                <a href="form_tambah.php" class="btn btn-utama rounded-pill px-4">
                    <i class="fa-solid fa-rotate-left me-2"></i> Isi Formulir Lagi
                </a>
            </div>
        </div>
    </div>
<?php
} else {
?>
    <div class="card kartu shadow">
        <div class="card-body p-4">
            <p class="text-muted"><i class="fa-solid fa-circle-info me-1"></i> Lengkapi data di bawah ini. Semua kolom wajib diisi.</p>

            <form action="form_tambah.php" method="POST" enctype="multipart/form-data">
                <h6 class="judul-bagian"><i class="fa-solid fa-user me-2"></i>Data Pribadi</h6>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                            <input type="text" name="nama" id="nama" class="form-control" placeholder="Sesuai ijazah terakhir" required>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                            <input type="email" name="email" id="email" class="form-control" placeholder="nama@email.com" required>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-cake-candles"></i></span>
                            <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label d-block">Jenis Kelamin</label>
                        <div class="d-flex gap-2">
                            <div class="form-check pilih-jk flex-fill ps-5">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="jk_l" value="L" required>
                                <label class="form-check-label" for="jk_l">Laki-laki</label>
                            </div>
                            <div class="form-check pilih-jk flex-fill ps-5">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="jk_p" value="P">
                                <label class="form-check-label" for="jk_p">Perempuan</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mb-4">
                        <label for="alamat" class="form-label">Alamat</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-location-dot"></i></span>
                            <textarea name="alamat" id="alamat" rows="2" class="form-control" placeholder="Jalan, desa/kelurahan, kecamatan, kota" required></textarea>
                        </div>
                    </div>
                </div>

                <h6 class="judul-bagian"><i class="fa-solid fa-book-open me-2"></i>Data Akademik</h6>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="id_prodi" class="form-label">Program Studi</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-building-columns"></i></span>
                            <select name="id_prodi" id="id_prodi" class="form-select" required>
                                <option value="">-- Pilih Program Studi --</option>
                                <option value="1">Sistem Komputer</option>
                                <option value="2">Sistem Informasi</option>
                                <option value="3">Teknologi Informasi</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="foto_mhs" class="form-label">Pas Foto</label>
                        <input type="file" name="foto_mhs" id="foto_mhs" class="form-control" accept=".jpg,.jpeg,.png" required>
                        <div class="form-text">JPG, JPEG, atau PNG. Maksimal 2MB.</div>
                    </div>
                </div>

                <div class="d-flex flex-wrap justify-content-end gap-2 mt-3">
                    <button type="reset" class="btn btn-outline-secondary rounded-pill px-4 text-nowrap">
                        <i class="fa-solid fa-eraser me-2"></i> Kosongkan
                    </button>
                    <button type="submit" class="btn btn-utama rounded-pill px-4 text-nowrap">
                        <i class="fa-solid fa-paper-plane me-2"></i> Kirim Pendaftaran
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('foto_mhs').addEventListener('change', function() {
            const file = this.files[0]; // Ambil file yang diupload
            const maxSize = 2 * 1024 * 1024; // Max 2MB

            if (file) {
                // 1. Cek Format File Dulu (Prioritas)
                const allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
                if (!allowedExtensions.exec(this.value)) {
                    alert("Format file salah! Hanya boleh JPG, JPEG, atau PNG.");
                    this.value = "";
                    return; // STOP! Jangan lanjut ke bawah
                }

                // 2. Cek Ukuran File
                if (file.size > maxSize) {
                    alert("File kamu terlalu besar! Maksimal ukuran adalah 2MB");
                    this.value = "";
                    return; // STOP!
                }
            }
        });
    </script>
<?php
}

include 'footer.php';
?>
