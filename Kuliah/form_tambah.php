<?php
include 'header.php';

// Nilai awal setiap kolom (kosong)
$nama     = '';
$email    = '';
$telepon  = '';
$jk       = '';
$jurusan  = '';
$alamat   = '';
$error    = [];
$berhasil = false;

// Proses data ketika tombol Daftar ditekan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama    = trim($_POST['nama'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $telepon = trim($_POST['telepon'] ?? '');
    $jk      = $_POST['jk'] ?? '';
    $jurusan = $_POST['jurusan'] ?? '';
    $alamat  = trim($_POST['alamat'] ?? '');

    // Validasi sederhana
    if ($nama === '') {
        $error[] = 'Nama lengkap wajib diisi.';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error[] = 'Format email tidak valid.';
    }
    if (!preg_match('/^[0-9]{10,13}$/', $telepon)) {
        $error[] = 'Nomor telepon harus berupa angka 10 sampai 13 digit.';
    }
    if ($jk !== 'Laki-laki' && $jk !== 'Perempuan') {
        $error[] = 'Jenis kelamin wajib dipilih.';
    }
    if ($jurusan === '') {
        $error[] = 'Jurusan wajib dipilih.';
    }
    if ($alamat === '') {
        $error[] = 'Alamat wajib diisi.';
    }

    if (empty($error)) {
        $berhasil = true;
    }
}

// Fungsi agar teks yang ditampilkan aman dari kode HTML
function aman($teks)
{
    return htmlspecialchars($teks, ENT_QUOTES, 'UTF-8');
}

$daftar_jurusan = ['Teknik Informatika', 'Sistem Informasi', 'Manajemen', 'Akuntansi'];
?>

<div class="kotak">
    <?php if ($berhasil) : ?>
        <div class="sukses">Pendaftaran berhasil! Berikut data yang Anda kirim:</div>
        <table>
            <tr><td>Nama Lengkap</td><td><?php echo aman($nama); ?></td></tr>
            <tr><td>Email</td><td><?php echo aman($email); ?></td></tr>
            <tr><td>No. Telepon</td><td><?php echo aman($telepon); ?></td></tr>
            <tr><td>Jenis Kelamin</td><td><?php echo aman($jk); ?></td></tr>
            <tr><td>Jurusan</td><td><?php echo aman($jurusan); ?></td></tr>
            <tr><td>Alamat</td><td><?php echo nl2br(aman($alamat)); ?></td></tr>
        </table>
        <form action="form_tambah.php" method="GET" class="tombol">
            <button type="submit" class="simpan">Daftar Lagi</button>
        </form>
    <?php else : ?>
        <?php if (!empty($error)) : ?>
            <div class="error">
                <?php foreach ($error as $pesan) : ?>
                    &bull; <?php echo $pesan; ?><br>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form action="form_tambah.php" method="POST">
            <label for="nama">Nama Lengkap</label>
            <input type="text" id="nama" name="nama" value="<?php echo aman($nama); ?>" placeholder="Masukkan nama lengkap" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo aman($email); ?>" placeholder="contoh@email.com" required>

            <label for="telepon">No. Telepon</label>
            <input type="tel" id="telepon" name="telepon" value="<?php echo aman($telepon); ?>" placeholder="08xxxxxxxxxx" required>

            <label>Jenis Kelamin</label>
            <div class="pilihan">
                <input type="radio" id="laki" name="jk" value="Laki-laki" <?php echo $jk === 'Laki-laki' ? 'checked' : ''; ?> required>
                <label for="laki">Laki-laki</label>
                <input type="radio" id="perempuan" name="jk" value="Perempuan" <?php echo $jk === 'Perempuan' ? 'checked' : ''; ?>>
                <label for="perempuan">Perempuan</label>
            </div>

            <label for="jurusan">Jurusan</label>
            <select id="jurusan" name="jurusan" required>
                <option value="">-- Pilih Jurusan --</option>
                <?php foreach ($daftar_jurusan as $j) : ?>
                    <option value="<?php echo $j; ?>" <?php echo $jurusan === $j ? 'selected' : ''; ?>><?php echo $j; ?></option>
                <?php endforeach; ?>
            </select>

            <label for="alamat">Alamat</label>
            <textarea id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat lengkap" required><?php echo aman($alamat); ?></textarea>

            <div class="tombol">
                <button type="submit" class="simpan">Daftar</button>
                <button type="reset" class="reset">Reset</button>
            </div>
        </form>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
