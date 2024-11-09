<?php
include('includes/dbconnection.php');
if(isset($_POST['submit']))
{
  	$userid=23;
    $dateexpense=$_POST['dateexpense'];
    $item=$_POST['item'];
    $costitem=$_POST['costitem'];
	$remarks=$_POST['remarks'];
    $query="";
	try{
	$query=mysqli_query($con, "insert into tblexpense(UserId,ExpenseDate,ExpenseItem,ExpenseCost,remarks) value('$userid','$dateexpense','$item','$costitem','$remarks')");
	echo "<script>alert('Expense has been added');</script>";
	}
	catch(Exception $e)
	{
	
		$err=mysqli_error($con);
		//echo $err;
		echo "<script>alert('$err');</script>";
	}
}
?>

<html>
<head>
	
	
	
</head>
<body>
	
		
	

							<form role="form" method="post" action="">
								<div class="form-group">
									<label>Date of Expense</label>
									<input class="form-control" type="date" value="" name="dateexpense" required="true">
								</div>
								<div class="form-group">
									<label>Item</label>
									<input type="text" class="form-control" name="item" value="" required="true" autocomplete="off">
								</div>
								
								<div class="form-group">
									<label>Cost of Item</label>
									<input class="form-control" type="text" value="" required="true" name="costitem" id="nonnegative">
								</div>
								<div class="form-group">
									<label>Remarks</label>
									<input class="form-control" type="text" value="" required="true" name="remarks" >
								</div>
																
								<div class="form-group has-success">
									<button type="submit" class="btn btn-primary" name="submit" id="submit">Add</button>
							
								
						
	
</body>

</html>