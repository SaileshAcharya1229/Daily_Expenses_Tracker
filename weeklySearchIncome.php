<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "detsdb";
	
//Connect to MySQL Server
$con=mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
$query="";
//Select Database
// Retrieve data from Query String
$q = $_GET['q'];
//build query
$lastdate=date('Y-m-d',strtotime("-7 days"));
 $tdate = date('Y-m-d');
 $userid=$_COOKIE['user'];
if($q=="")
{
   $query="select * from tblincome where UserId='$userid' AND IncomeDate BETWEEN '$lastdate' AND '$tdate'";
}
 else
 {
   $query="select * from tblincome where UserId='$userid' AND IncomeDate BETWEEN '$lastdate' AND '$tdate' AND IncomeItem LIKE '$q%' OR IncomeCost LIKE '$q%'";
 }
   $display_string="";
	
//Execute query
$qry_result = mysqli_query($con,$query) or die(mysqli_error());
$cnt=1;
$display_string.="<tr>";
$display_string.="<th>S.NO</th>";
$display_string.="<th>Income Item</th>";
$display_string.="<th>Income Cost</th>";
$display_string.="<th>Income Date</th>";
$display_string.="</tr>";
// Insert a new row in the table for each person returned
while($row = mysqli_fetch_array($qry_result)) {
   $display_string .= "<tr>";
   $display_string.="<td>$cnt</td>";
   $display_string .= "<td>$row[IncomeItem]</td>";
   $display_string .= "<td>$row[IncomeCost]</td>";
   $display_string .= "<td>$row[IncomeDate]</td>";
   $display_string .= "</tr>";
   $cnt=$cnt+1;
}

echo $display_string;
?>