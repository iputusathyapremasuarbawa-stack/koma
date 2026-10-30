<?php
$title = "Form Pendaftaran";
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
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="alert alert-success">
                <h5><i class="fa-solid fa-circle-check"></i> Validasi Berhasil!</h5>
                <p class="mb-0">Data dikelola menggunakan Class MahasiswaBaru</p>
            </div>

            <strong>Ringkasan Data:</strong>
            <table class="table table-striped mt-2">
                <tr><th style="width: 35%">Nama</th><td><?= $mhs->nama ?></td></tr>
                <tr><th>Email</th><td><?= $mhs->email ?></td></tr>
                <tr><th>Jenis Kelamin</th><td><?= $mhs->getFormatJK() ?></td></tr>
                <tr><th>Prodi</th><td><?= $mhs->getNamaProdi() ?></td></tr>
                <tr><th>Tanggal Lahir</th><td><?= $mhs->getTanggalLahir() ?></td></tr>
                <tr><th>Alamat</th><td><?= $mhs->alamat ?></td></tr>
                <tr><th>Nama File Foto</th><td><?= $mhs->foto_nama ?></td></tr>
                <tr><th>Ukuran File Foto</th><td><?= $mhs->getFormatUkuranFoto() ?></td></tr>
            </table>

            <a href="form_tambah.php" class="btn btn-primary px-4">
                <i class="fa-solid fa-arrow-left me-2"></i> Kembali ke Formulir
            </a>
        </div>
    </div>
<?php
} else {
?>
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5 class="mb-0 py-1"><i class="fa-solid fa-address-card me-2"></i> Formulir Pendaftaran Mahasiswa Baru</h5>
        </div>
        <div class="card-body">
            <form action="form_tambah.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nama" class="form-label fw-bold">Nama Lengkap</label>
                    <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama sesuai ijazah" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan email" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="tgl_lahir" class="form-label fw-bold">Tanggal Lahir</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                            <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Jenis Kelamin</label>
                        <div class="pt-1">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="jk_l" value="L" required>
                                <label class="form-check-label" for="jk_l">
                                    <i class="fa-solid fa-mars text-primary"></i> Laki-laki
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="jk_p" value="P">
                                <label class="form-check-label" for="jk_p">
                                    <i class="fa-solid fa-venus text-danger"></i> Perempuan
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label fw-bold">Alamat</label>
                    <textarea name="alamat" id="alamat" rows="3" class="form-control" placeholder="Masukkan alamat lengkap" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="id_prodi" class="form-label fw-bold">Program Studi</label>
                    <select name="id_prodi" id="id_prodi" class="form-select" required>
                        <option value="">Pilih Prodi...</option>
                        <option value="1">Sistem Komputer</option>
                        <option value="2">Sistem Informasi</option>
                        <option value="3">Teknologi Informasi</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="foto_mhs" class="form-label fw-bold">Pas Foto (Max 2MB)</label>
                    <input type="file" name="foto_mhs" id="foto_mhs" class="form-control" accept=".jpg,.jpeg,.png" required>
                    <div class="form-text">Format: JPG, PNG, atau JPEG.</div>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fa-solid fa-circle-check me-2"></i> Daftar
                    </button>

                    <button type="reset" class="btn btn-secondary px-4">
                        <i class="fa-solid fa-arrow-rotate-left me-2"></i> Reset
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
