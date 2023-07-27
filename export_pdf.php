<?php
require 'vendor/autoload.php';
use \TCPDF as TCPDF;

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kehadiran-itcharlah";

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mengambil data tamu dari database
$sql = "SELECT * FROM iddatas ORDER BY id ASC";
$result = $conn->query($sql);

// Buat objek PDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Atur nama dokumen dan halaman
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Data Kehadiran ITC');
$pdf->SetSubject('Data Kehadiran ITC');
$pdf->SetKeywords('Data, Kehadiran, ITC');

// Atur margin
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Atur font
$pdf->SetFont('times', '', 10);

// Tambahkan halaman baru
$pdf->AddPage();

// Menambahkan header kolom
$pdf->Cell(10, 10, 'No', 1, 0, 'C');
$pdf->Cell(30, 10, 'Nama', 1, 0, 'C');
$pdf->Cell(50, 10, 'Email', 1, 0, 'C');
$pdf->Cell(30, 10, 'Nomor Hp/Tlp', 1, 0, 'C');
$pdf->Cell(20, 10, 'Angkatan', 1, 0, 'C');
$pdf->Cell(50, 10, 'Alamat', 1, 1, 'C');

// Mengisi data dari database ke PDF
$no = 1;
if ($result->num_rows > 0) {
    while ($data = $result->fetch_assoc()) {
        $pdf->Cell(10, 10, $no, 1, 0, 'C');
        $pdf->Cell(30, 10, $data['nama'], 1, 0, 'C');
        $pdf->Cell(50, 10, $data['email'], 1, 0, 'C');
        $pdf->Cell(30, 10, $data['no_hp'], 1, 0, 'C');
        $pdf->Cell(20, 10, $data['angkatan'], 1, 0, 'C');
        $pdf->Cell(50, 10, $data['alamat'], 1, 1, 'C');
        $no++;
    }
}

// Outputkan file PDF
$pdf->Output('data_kehadiran.pdf', 'D');
?>
