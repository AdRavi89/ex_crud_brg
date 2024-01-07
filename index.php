<?php
	require_once('koneksi.php');
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>App - Toko Sederhana</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body>
		<div class="container">
			<div class="row">
				 <div class="col-lg-12">
				 <br/>
				 <a href="tambah.php" class="btn btn-success btn-md"><span class="fa fa-plus"></span> Tambah</a>
				 <table class="table table-hover table-bordered" style="margin-top: 10px">
					<tr class="success">
						<th width="50px">No</th>
						<th>Nama Barang</th>
						<th>Stok</th>
						<th>Harga Barang</th>
						<th>Tanggal Masuk</th>
						<th style="text-align: center;">Actions</th>
					</tr>
					 <?php
						$sql = "SELECT * FROM tbl_barang";
						$row = $koneksi->prepare($sql);
						$row->execute();
						$hasil = $row->fetchAll();
						$a =1;
						foreach($hasil as $isi){
					 ?>
					<tr>
						<td><?php echo $a ?></td>
						<td><?php echo $isi['nama_barang']?></td>
						<td><?php echo $isi['stok'];?></td>
						<td><?php echo $isi['harga_barang'];?></td>
						<td><?php echo $isi['tgl_masuk'];?></td>
						<td style="text-align: center;">
							<a href="edit.php?id=<?php echo $isi['id_barang'];?>" class="btn btn-success btn-md">
							<span class="fa fa-edit"></span></a>
							<a onclick="return confirm('Apakah yakin data akan di hapus?')" href="hapus.php?id=<?php echo $isi['id_barang'];?>" 
							class="btn btn-danger btn-md"><span class="fa fa-trash"></span></a>
						</td>
					</tr>
					<?php
						$a++;
						}
					?>
				 </table>
			  </div>
			</div>
		</div>
	</body>
</html>