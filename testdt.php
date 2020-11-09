<?php
$dt="03-15-2013";
// convert it through strtotime to get the date and back.
if($dt == date('Y-m-d',strtotime($dt)))
{
   echo "Date is in YYYY-MM-DD format";
}
else if($dt == date('mm/dd/YYYY',strtotime($dt)))
{
    echo "Date is in MM-DD-YYYY format";
}
else if($dt == date('dd/mm/YYYY',strtotime($dt)))
{
    echo "Date is in DD-MM-YYYY format";
}
else
   echo "Problem...";
?>