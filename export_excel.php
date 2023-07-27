<?php
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

// Buat spreadsheet baru
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Menambahkan header kolom
$sheet->setCellValue('A1', 'No');
$sheet->setCellValue('B1', 'Nama');
$sheet->setCellValue('C1', 'Email');
$sheet->setCellValue('D1', 'Nomor Hp/Tlp');
$sheet->setCellValue('E1', 'Angkatan');
$sheet->setCellValue('F1', 'Alamat');

// Mengisi data dari database ke spreadsheet
$row = 2;
$no = 1;
if ($result->num_rows > 0) {
    while ($data = $result->fetch_assoc()) {
        $sheet->setCellValue('A' . $row, $no);
        $sheet->setCellValue('B' . $row, $data['nama']);
        $sheet->setCellValue('C' . $row, $data['email']);
        $sheet->setCellValue('D' . $row, $data['no_hp']);
        $sheet->setCellValue('E' . $row, $data['angkatan']);
        $sheet->setCellValue('F' . $row, $data['alamat']);
        $row++;
        $no++;
    }
}

// Menyimpan spreadsheet ke file
$writer = new Xlsx($spreadsheet);
$filename = 'data_kehadiran.xlsx';
$writer->save($filename);

// Download file
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$filename.'"');
header('Cache-Control: max-age=0');
$writer->save('php://output');
exit;
?>
