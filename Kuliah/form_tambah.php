<?php
$title = "Formulir Pendaftaran";
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
    <div class="card mx-auto" style="max-width: 720px;">
        <div class="card-header bg-white">
            <h5 class="mb-0">Data Pendaftar</h5>
        </div>
        <div class="card-body">
            <div class="alert alert-success">Data berhasil dikirim dan diolah dengan class MahasiswaBaru.</div>

            <table class="table table-bordered mb-4">
                <tr><th style="width: 35%">Nama</th><td><?= $mhs->nama ?></td></tr>
                <tr><th>Email</th><td><?= $mhs->email ?></td></tr>
                <tr><th>Jenis Kelamin</th><td><?= $mhs->getFormatJK() ?></td></tr>
                <tr><th>Program Studi</th><td><?= $mhs->getNamaProdi() ?></td></tr>
                <tr><th>Tanggal Lahir</th><td><?= $mhs->getTanggalLahir() ?></td></tr>
                <tr><th>Alamat</th><td><?= $mhs->alamat ?></td></tr>
                <tr><th>Nama File Foto</th><td><?= $mhs->foto_nama ?></td></tr>
                <tr><th>Ukuran File Foto</th><td><?= $mhs->getFormatUkuranFoto() ?></td></tr>
            </table>

            <a href="form_tambah.php" class="btn btn-outline-secondary">Kembali</a>
        </div>
    </div>
<?php
} else {
?>
    <div class="card mx-auto" style="max-width: 720px;">
        <div class="card-header bg-white">
            <h5 class="mb-0">Formulir Pendaftaran</h5>
        </div>
        <div class="card-body">
            <form action="form_tambah.php" method="POST" enctype="multipart/form-data">
                <div class="row mb-3">
                    <label for="nama" class="col-sm-3 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-9">
                        <input type="text" name="nama" id="nama" class="form-control" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="tgl_lahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-9">
                        <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-3 col-form-label">Jenis Kelamin</div>
                    <div class="col-sm-9 pt-sm-2">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="jk_l" value="L" required>
                            <label class="form-check-label" for="jk_l">Laki-laki</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="jk_p" value="P">
                            <label class="form-check-label" for="jk_p">Perempuan</label>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                    <div class="col-sm-9">
                        <textarea name="alamat" id="alamat" rows="3" class="form-control" required></textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="id_prodi" class="col-sm-3 col-form-label">Program Studi</label>
                    <div class="col-sm-9">
                        <select name="id_prodi" id="id_prodi" class="form-select" required>
                            <option value="">Pilih</option>
                            <option value="1">Sistem Komputer</option>
                            <option value="2">Sistem Informasi</option>
                            <option value="3">Teknologi Informasi</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-4">
                    <label for="foto_mhs" class="col-sm-3 col-form-label">Pas Foto</label>
                    <div class="col-sm-9">
                        <input type="file" name="foto_mhs" id="foto_mhs" class="form-control" accept=".jpg,.jpeg,.png" required>
                        <div class="form-text">JPG, JPEG, atau PNG, maksimal 2MB.</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-9 offset-sm-3">
                        <button type="submit" class="btn btn-marun">Kirim</button>
                        <button type="reset" class="btn btn-outline-secondary">Ulangi</button>
                    </div>
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
