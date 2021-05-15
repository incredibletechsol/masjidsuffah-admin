<?php

$pageName = basename($_SERVER['PHP_SELF']);

if($pageName == "index.php")

	{

	echo "Admin : Masjid Suffah";

	}

if($pageName == "salattimes.php")

	{

	echo "Salat Times";

	}	
	

if($pageName == "hijri.php")

	{

	echo "Hijri Days Adjustments";

	}
	
if($pageName == "news.php")

	{

	echo "Announcements";

	}	
<<<<<<< HEAD
	
	if($pageName == "email.php")

	{

	echo "News Letters";

	}	
	
	if($pageName == "gallery.php")

	{

	echo "Gallery";

	}	
=======
>>>>>>> 2174e5b62a1bf8cc2c16a859233270829b2764f9

?>