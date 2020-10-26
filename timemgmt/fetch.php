<?php
//fetch.php
include('database_connection.php');
$columns = array('fajr_beginning',
'fajr_athan ',
'fajr_iqama ',
'thuhr_beginning',
'thuhr_athan ',
'prayer_date ',
'thuhr_iqama ',
'asr_beginning_shafi',
'asr_beginning_hanafi',
'asr_athan ',
'asr_iqama', 
'maghrib_athan', 
'maghrib_iqama ',
'isha_beginning', 
'isha_athan ',
'isha_iqama ',
'shurooq');

$query = "SELECT * from salat_times WHERE DAYOFYEAR(curdate()) <= dayofyear(`prayer_date`) AND DAYOFYEAR(curdate()) +25 >= dayofyear(`prayer_date`) ";


if(isset($_POST["search"]["value"]))
{
 $query .= ' 
 OR fajr_beginning LIKE "%'.$_POST["search"]["value"].'%" 
 OR fajr_athan LIKE "%'.$_POST["search"]["value"].'%" 
 OR fajr_iqama LIKE "%'.$_POST["search"]["value"].'%" 
 OR thuhr_beginning LIKE "%'.$_POST["search"]["value"].'%" 
 OR thuhr_athan LIKE "%'.$_POST["search"]["value"].'%" 
 OR prayer_date LIKE "%'.$_POST["search"]["value"].'%" 
 OR thuhr_iqama LIKE "%'.$_POST["search"]["value"].'%" 
 OR asr_beginning_shafi LIKE "%'.$_POST["search"]["value"].'%" 
 OR asr_beginning_hanafi LIKE "%'.$_POST["search"]["value"].'%" 
 OR asr_athan LIKE "%'.$_POST["search"]["value"].'%" 
 OR asr_iqama LIKE "%'.$_POST["search"]["value"].'%" 
 OR maghrib_athan LIKE "%'.$_POST["search"]["value"].'%" 
 OR maghrib_iqama LIKE "%'.$_POST["search"]["value"].'%" 
 OR isha_beginning LIKE "%'.$_POST["search"]["value"].'%"  
 OR isha_athan LIKE "%'.$_POST["search"]["value"].'%"  
 OR isha_iqama LIKE "%'.$_POST["search"]["value"].'%"  
 OR shurooq LIKE "%'.$_POST["search"]["value"].'%"  
 ';
}


if(isset($_POST["order"]))
{
 $query .= ' ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].'';
}
else
{
 $query .= ' order by DAY(prayer_date) desc LIMIT 90';
}

/*
$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
*/

$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

//$result = mysqli_query($connect, $query . $query1);
$result = mysqli_query($connect, $query);

$data = array();

while($row = mysqli_fetch_array($result))
{
	$sub_array = array();
	$sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="prayer_date">' . $row["prayer_date"] . '</div>';
	$sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="fajr_beginning">' . $row["fajr_beginning"] . '</div>';
	$sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="fajr_athan">' . $row["fajr_athan"] . '</div>';
	$sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="fajr_iqama">' . $row["fajr_iqama"] . '</div>';
	$sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="thuhr_beginning">' . $row["thuhr_beginning"] . '</div>';
	$sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="thuhr_athan">' . $row["thuhr_athan"] . '</div>';
	$sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="thuhr_iqama">' . $row["thuhr_iqama"] . '</div>';
	$sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="asr_beginning_shafi">' . $row["asr_beginning_shafi"] . '</div>';
	$sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="asr_beginning_hanafi">' . $row["asr_beginning_hanafi"] . '</div>';
	$sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="asr_athan">' . $row["asr_athan"] . '</div>';
	$sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="asr_iqama">' . $row["asr_iqama"] . '</div>';
	$sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="maghrib_athan">' . $row["maghrib_athan"] . '</div>';
	$sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="maghrib_iqama">' . $row["maghrib_iqama"] . '</div>';
	$sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="isha_beginning">' . $row["isha_beginning"] . '</div>';
	$sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="isha_athan">' . $row["isha_athan"] . '</div>';
	$sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="isha_iqama">' . $row["isha_iqama"] . '</div>';
	$sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="shurooq">' . $row["shurooq"] . '</div>';
	$sub_array[] = '<button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row["id"].'">Delete</button>';
	$data[] = $sub_array;
}

function get_all_data($connect)
{
 $query = "SELECT * from salat_times WHERE DAYOFYEAR(curdate()) 
                                            <= dayofyear(`prayer_date`) AND DAYOFYEAR(curdate()) +25 >= dayofyear(`prayer_date`) order by MONTH(prayer_date) asc,DAY(prayer_date) asc LIMIT 90";
 $result = mysqli_query($connect, $query);
 return mysqli_num_rows($result);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($connect),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);

?>