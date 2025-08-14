<?php
include "../admin/page/library/protect-route.php";
include('../admin/page/library/players_lib.php');
require './vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

protectRouteAccess();  

$playerObj = new Player();
$players = $playerObj->getPlayers();

// Create new Spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Players');

// Set header row
$sheet->setCellValue('A1', 'ID');
$sheet->setCellValue('B1', 'Name');
$sheet->setCellValue('C1', 'Phone');
$sheet->setCellValue('D1', 'Email');
$sheet->setCellValue('E1', 'Created At');

// Fill data
$row = 2;
foreach ($players as $player) {
    $sheet->setCellValue('A' . $row, $player['id']);
    $sheet->setCellValue('B' . $row, $player['name']);
    $sheet->setCellValue('C' . $row, $player['phone']);
    $sheet->setCellValue('D' . $row, $player['gmail']);
    $sheet->setCellValue('E' . $row, date('Y/m/d', strtotime($player['created_at'])));
    $row++;
}

// Output as Excel file
$filename = 'players_export_' . date('Ymd') . '.xlsx';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=\"$filename\"");
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
