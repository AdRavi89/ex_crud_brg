<?php
$user = 'root';
$pass = '';

try {
    // buat koneksi dengan database
    $koneksi = new PDO('mysql:host=localhost;dbname=ex_crud_brg2;', $user, $pass);
    // set error mode
    $koneksi->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // tampilkan pesan kesalahan jika koneksi gagal
    print "Koneksi atau query bermasalah : " . $e->getMessage() . "<br/>";
    die();
}

if(isset($_GET['action']) && $_GET['action'] == 'add') {
    // Tampilkan form tambah data di sini
    echo '<h3></h3>';
    // ... (Tambahkan formulir tambah data di sini)
} else {
    // Proses CRUD dan tampilkan data jika tidak ada action=add
    echo '<h3></h3>';
    // ... (Tambahkan logika CRUD dan tampilkan data di sini)
}
?>
<?php
// Proses Tambah Barang
if (isset($_POST['create'])) {
    if (!empty($_POST['nama_barang'])) {
        $nama_barang = $_POST['nama_barang'];
        $stok = $_POST['stok'];
        $harga = $_POST['harga'];
        $tanggal = $_POST['tanggal'];

        $data = array($nama_barang, $stok, $harga, $tanggal);

        $sql = 'INSERT INTO tbl_barang (nama_barang, stok, harga_barang, tgl_masuk) VALUES (?, ?, ?, ?)';
        $row = $koneksi->prepare($sql);
        $row->execute($data);

        echo '<script>alert("Berhasil Tambah Data");window.location="index.php"</script>';
    }
}

// Proses Edit Barang
if (isset($_POST['update'])) {
    if (!empty($_POST['nama_barang'])) {
        $nama_barang = $_POST['nama_barang'];
        $stok = $_POST['stok'];
        $harga = $_POST['harga'];
        $tanggal = $_POST['tanggal'];
        $id = $_POST['id_barang'];

        $data = array($nama_barang, $stok, $harga, $tanggal, $id);

        $sql = 'UPDATE tbl_barang SET nama_barang=?, stok=?, harga_barang=?, tgl_masuk=? WHERE id_barang=?';
        $row = $koneksi->prepare($sql);
        $row->execute($data);

        echo '<script>alert("Berhasil Edit Data");window.location="index.php"</script>';
    }
}

// Proses Hapus Barang
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = $_GET['id'];
    $sql = "DELETE FROM tbl_barang WHERE id_barang=?";
    $row = $koneksi->prepare($sql);
    $row->execute(array($id));

    echo '<script>alert("Berhasil Hapus Data");window.location="index.php"</script>';
}

// Menampilkan Form Tambah atau Edit Barang
$id = isset($_GET['id']) ? $_GET['id'] : 0;

if ($id > 0) {
    $sql = "SELECT * FROM tbl_barang WHERE id_barang=?";
    $row = $koneksi->prepare($sql);
    $row->execute(array($id));
    $hasil = $row->fetch();
}

?>

<!DOCTYPE HTML>
<html>
<head>
    <title><?php echo isset($hasil['nama_barang']) ? 'Edit Barang - ' . $hasil['nama_barang'] : 'Tambah Barang'; ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="container">
        <br/>
        <h3><?php echo isset($hasil['nama_barang']) ? 'Edit Barang - ' . $hasil['nama_barang'] : 'Tambah Barang'; ?></h3>
        <br/>
        <div class="row">
            <div class="col-lg-6">
                <form action="" method="POST">
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" value="<?php echo isset($hasil['nama_barang']) ? $hasil['nama_barang'] : '';?>" class="form-control" name="nama_barang">
                    </div>
                    <div class="form-group">
                        <label>Stok</label>
                        <input type="number" value="<?php echo isset($hasil['stok']) ? $hasil['stok'] : '';?>" class="form-control" name="stok">
                    </div>
                    <div class="form-group">
                        <label>Harga Barang</label>
                        <input type="text" value="<?php echo isset($hasil['harga_barang']) ? $hasil['harga_barang'] : '';?>" class="form-control" name="harga">
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" value="<?php echo isset($hasil['tgl_masuk']) ? $hasil['tgl_masuk'] : '';?>" class="form-control" name="tanggal">
                    </div>
                    <?php if (isset($hasil['id_barang'])): ?>
                        <input type="hidden" value="<?php echo $hasil['id_barang'];?>" name="id_barang">
                        <button class="btn btn-primary btn-md" name="update"><i class="fa fa-edit"></i> Update</button>
                    <?php else: ?>
                        <button class="btn btn-primary btn-md" name="create"><i class="fa fa-plus"></i> Create</button>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
