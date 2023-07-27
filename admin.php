<?php
include "header.php";
?>

<?php
if (isset($_POST['btn'])) {

    $nama = htmlspecialchars($_POST['nama'], ENT_QUOTES);
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES);
    $no_hp = htmlspecialchars($_POST['no_hp'], ENT_QUOTES);
    $angkatan = htmlspecialchars($_POST['angkatan'], ENT_QUOTES);
    $alamat = htmlspecialchars($_POST['alamat'], ENT_QUOTES);

    // $jam = date('h:i:s a');

    $save = "INSERT INTO iddatas VALUES (NULL, '$nama', '$email', '$no_hp', '$angkatan', '$alamat')";

    if ($conn->query($save) === true) {
        echo "<script>alert('Hallo Selamat Datang... Terima Kasih Sudah Hadir :)');
        document.location='?'</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<div class="head text-center">
    <img class="mt-2 mb-2" src="assets/img/logo.png" alt="ITCyberCommunity" width="150">
    <h4 class="text-white">Daftar Kehadiran <br>IT Cyber Community</h4>
</div>

<div class="row mt-2 flex justify-content-center align-items-center">
    <div class="col-lg-7 mb-3">
        <div class="card shadow bg-gradient-light">
            <div class="card-body">

                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Isi Daftar Kehadiran</h1>
                </div>

                <form class="user" method="post" action="">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="nama" name="nama" aria-describedby="nameHelp" placeholder="Nama..." required>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control form-control-user" id="email" name="email" aria-describedby="emailHelp" placeholder="Email...">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="no_hp" name="no_hp" placeholder="Nomor WhatsApp / Tlp..." required>
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control form-control-user" id="angkatan" name="angkatan" placeholder="Angkatan di ITC..." required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="alamat" name="alamat" placeholder="Alamat..." required>
                    </div>
                    <button type="submit" name="btn" class="btn-primary btn-user btn-block">
                        Submit
                    </button>
                    <hr>

                </form>
                <hr>
                <div class="text-center">
                    <p class="small">By. IT Cyber Community | 2010 - <?= date('Y') ?></p>
                </div>


            </div>
        </div>
    </div>

    <div class="col-lg-7 mb-3">
        <div class="card shadow bg-light">
            <div class="card-body">

                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            statistik kehadiran</div>
                        <!-- <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div> -->
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
                <?php
                // Query untuk menghitung jumlah data per angkatan
                $query = "SELECT angkatan, COUNT(*) as jumlah FROM iddatas GROUP BY angkatan";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='row no-gutters align-items-center'>";
                        echo "<div class='col mr-2'>";
                        echo "<div class='text-xs font-weight-bold text-primary text-uppercase mb-1'>";
                        echo "Angkatan " . $row['angkatan'];
                        echo "<div class='h5 mb-0 font-weight-bold text-gray-800'>" . $row['jumlah'];
                        echo "<svg xmlns='http://www.w3.org/2000/svg' width='18' height='16' fill='currentColor' class='bi bi-people ml-1' viewBox='0 0 16 16'><path d='M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8Zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022ZM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816ZM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z'/></svg>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div class='col-auto'>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "Belum ada data kehadiran.";
                }
                ?>
            </div>
        </div>
    </div>

</div>

<!-- DataTable -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Kehadiran ITC</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Nomor Hp/Tlp</th>
                        <th>Angkatan</th>
                        <th>Alamat</th>
                    </tr>

                    <?php
                    // date_default_timezone_set('Asia/Jakarta'); // Zona Waktu indonesia
                    // $jam = date('h:i:s a'); // menampilkan jam sekarang
                    $tampil = mysqli_query($conn, "SELECT * FROM iddatas order by id asc");

                    $no = 1;

                    while ($data = mysqli_fetch_array($tampil)) {

                    ?>


                <tbody>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data['nama'] ?></td>
                        <td><?= $data['email'] ?></td>
                        <td><?= $data['no_hp'] ?></td>
                        <td><?= $data['angkatan'] ?></td>
                        <td><?= $data['alamat'] ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <!-- Tombol Ekspor Excel -->
            <center>
                
                    <a href="export_excel.php" class="btn btn-success"><i class="fa fa-download"></i> Ekspor ke Excel</a>

                <!-- Tombol Ekspor PDF -->
                <a href="export_pdf.php" class="btn btn-danger"><i class="fa fa-download"></i> Ekspor ke PDF</a>
            </center>
        </div>
    </div>
</div>

<!-- Footer -->
<?php
include "footer.php";
?>