<?php include('session.php');

include 'fungsi_indotgl.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store</title>
    <link rel="stylesheet" type="text/css" href="../css/styleadmin.css">
</head>
<body>
      <div class="wrapper">
        <div class="header">
        </div>
        <div class="sidebar">
            <div class="sidebar-title"><b>Open Store</b></div>
            <ul>
                <?php include 'sidebar.php' ?>
            </ul>
        </div>

        <script>
    function toggleSidebar() {
        var sidebar = document.querySelector('.sidebar');
        sidebar.classList.toggle('open');
    }</script>
    
    <button class="openbtn" onclick="toggleSidebar()">☰</button>


        <div class="section">
            <h3 class="card-title">Data Check Out Selesai</h3>
            <table class="table1" width="100%">
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Gambar</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Tanggal</th>
                    <th>Bukti</th>
                    <th>Pelanggan</th>
                    <th>Alamat</th>
                    <th>Telpon</th>
                </tr>
                <?php
                $no = 1;
                $admin_id = $_SESSION['id_login'];
                $produk = mysqli_query($conn, "SELECT admin_name, admin_telp, admin_address,(jml*product_price) AS total,tgl, ck_id, product_name, product_price, product_image, jml, bukti, validasi, status FROM tb_product, tb_checkout, tb_admin WHERE tb_admin.admin_id=tb_checkout.admin_id AND tb_checkout.product_id=tb_product.product_id AND status ='Selesai' "); 
                while ($row = mysqli_fetch_array($produk)) {
                    ?>
                 <tr>
                       <td><?php echo $no++ ?></td>
                       <td><?php echo $row['product_name'] ?></td>
                       <td>Rp. <?php echo number_format($row['product_price']) ?></td>
                       <td><a herf="../produk/<?php echo $row['product_image'] ?>"target="_blank"> <img src="../produk/<?php echo $row['product_image'] ?>" width="50px"> </a></td>
                       <td><?php echo $row['jml'] ?></td>
                       <td>Rp. <?php echo number_format($row['total']) ?></td>
                       <td><?php echo tgl_indo($row['tgl']) ?></td>
                       <td><a href="../bukti_transfer/<?php echo $row['bukti'] ?>" target="_blank"> <img src="../bukti_transfer/<?php echo $row['bukti'] ?>" width="50px"> </a></td>
                       <td><?php echo $row['admin_name'] ?></td>
                       <td><?php echo $row['admin_address'] ?></td>
                       <td><?php echo $row['admin_telp'] ?></td>
                </tr>  
                <?php } ?>
                </table>
           </div>
     </div>
    
</body>
</html>
