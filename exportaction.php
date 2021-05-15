<?php
include('conn.php');

$fromdate =$_POST['prayerFromDate'];
$todate =$_POST['prayerToDate'];

$filename = "salat_times.csv";
$fp = fopen('php://output', 'w');

$query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='dkkkpmba_suffahwp2' AND TABLE_NAME='salat_times' and COLUMN_NAME <> 'id'";
$result = mysqli_query($con,$query);
while ($row = mysqli_fetch_row($result)) {
	$header[] = $row[0];
}	

header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$filename);
fputcsv($fp, $header);

$query = "SELECT prayer_date,
									fajr_beginning,
									fajr_athan ,
									fajr_iqama ,
									thuhr_beginning,
									thuhr_athan ,
									thuhr_iqama ,
									asr_beginning_shafi,
									asr_beginning_hanafi,
									asr_athan ,
									asr_iqama, 
									maghrib_athan, 
									maghrib_iqama ,
									isha_beginning, 
									isha_athan ,
									isha_iqama ,
									shurooq FROM salat_times where prayer_date between '$fromdate' and '$todate'";
$result = mysqli_query($con, $query);
while($row = mysqli_fetch_row($result)) {
    $row[0] = DateTime::createFromFormat('Y-m-d', $row[0])->format('m/d/Y');
    fputcsv($fp, $row);
}
exit;
?>