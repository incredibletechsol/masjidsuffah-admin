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

?>