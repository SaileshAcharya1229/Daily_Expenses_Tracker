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
$userid=$_COOKIE['user'];
$lastdate=date('Y-m-d',strtotime("-7 days"));
$cdate=date('Y-m-d');
if($q=="")
{
   $query="select * from tblexpense where UserId='$userid' AND ExpenseDate BETWEEN '$lastdate' AND '$cdate'";
}
 else
 {
   $query="select * from tblexpense where UserId='$userid' AND ExpenseItem LIKE '$q%' OR ExpenseCost LIKE '$q%' OR ExpenseDate LIKE '$q%'";
 }
   $display_string="";
	
//Execute query
$qry_result = mysqli_query($con,$query) or die(mysqli_error());
$cnt=1;
$display_string.="<tr>";
$display_string.="<th>S.NO</th>";
$display_string.="<th>Expense Item</th>";
$display_string.="<th>Expense Cost</th>";
$display_string.="<th>Expense Date</th>";
$display_string.="</tr>";
// Insert a new row in the table for each person returned
while($row = mysqli_fetch_array($qry_result)) {
   $display_string .= "<tr>";
   $display_string.="<td>$cnt</td>";
   $display_string .= "<td>$row[ExpenseItem]</td>";
   $display_string .= "<td>$row[ExpenseCost]</td>";
   $display_string .= "<td>$row[ExpenseDate]</td>";
   $display_string .= "</tr>";
   $cnt=$cnt+1;
}

echo $display_string;
?>