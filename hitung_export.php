<?php
// Create a new Spreadsheet object

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

include 'functions.php';
$spreadsheet = new Spreadsheet();

$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'kode_alternatif');
$sheet->setCellValue('B1', 'nama_alternatif');
$sheet->setCellValue('C1', 'cluster');

$rows = $db->get_results("SELECT * FROM tb_alternatif ORDER BY kode_alternatif");
$keanggotaan = $_SESSION['keanggotaan'];
$baris = 2;
foreach ($rows as $row) {
    $sheet->setCellValue('A' . $baris, $row->kode_alternatif);
    $sheet->setCellValue('B' . $baris, $row->nama_alternatif);
    $sheet->setCellValue('C' . $baris, $keanggotaan[$row->kode_alternatif]);
    $baris++;
}

$writer = new Xls($spreadsheet);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename=profile.xls');
$writer->save('php://output');
