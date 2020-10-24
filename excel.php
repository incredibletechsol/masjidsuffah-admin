<html>
<head>

</head>
<body alink="#00FF66" link="#00CC00">

<?php




/*Function for displaying all the Faculties Data in XLS Format*/

function listOfFaculties()
	{
    include("conn.php");
    include("excelwriter.class.php");
	unlink('xlsexport/faculties.xls');
	$excel=new ExcelWriter("xlsexport/faculties.xls");
	if($excel==false)	
	echo $excel->error;
	
	$myArr=array("Type","Name","Designation","Qualification","Years Of Experience");
	$excel->writeLine($myArr);
	
	$qry=mysqli_query($con,"SELECT c.type,c.name, c.designation, c.qualification, c.experience
							  FROM tbl_faculty AS c") or die("Query Not Executed");
		if($qry!=false)
		{
			$i=1;
			while($res=mysqli_fetch_array($qry))
			{
				$myArr=array($res['type'],$res['name'],$res['designation'],$res['qualification'],$res['experience']);
		        $excel->writeLine($myArr);
				$i++;
			}
		}
	}
?>
</body>
</html>