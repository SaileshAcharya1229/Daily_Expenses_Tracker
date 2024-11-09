<?php  
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['detsuid']==0)) {
  header('location:logout.php');
  } 
 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
    <title>Update Income</title>
</head>
<body>
<div class="row">
	<hr />
    <?php 
        $id=$_GET['upid'];
        $ret=mysqli_query($con,"select * from tblincome where ID='$id'");
        while ($row=mysqli_fetch_array($ret)) {
    ?>
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">UPDATE INCOME</div>
				<div class="panel-body">
					<form role="form" action="" method="post" id="" name="signup">
					
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Income Item" value="<?php echo $row['IncomeItem']; ?>" name="eItem" type="text" required="true">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Income Cost" value="<?php echo $row['IncomeCost']; ?>" name="eCost" type="text" required="true">
							</div>
							<div class="form-group">
								<input type="date" class="form-control" id="mobilenumber" name="eDate" placeholder="Income Date" value="<?php echo $row['IncomeDate']; ?>" maxlength="10" required="true">
							</div>
                            <div class="form-group">
									<label>Remarks</label>
									<input class="form-control" type="text" value="<?php echo $row['remarks'];?>" required="true" name="remarks" >
								</div>
							
                                <div class="checkbox">
								<button type="submit" value="submit" name="submit" class="btn btn-primary">Update</button><span style="padding-left:250px">
                                <a class="btn btn-primary" onclick="history.back()">Back</a>
							</div>
							 </fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
        <?php
        }
        if(isset($_POST['submit']))
        {
            $epItem=$_POST['eItem'];
            $urlData=$_GET['upid'];
            $epCost=$_POST['eCost'];
            $epDate=$_POST['eDate'];
            $remarks=$_POST['remarks'];
            $ret=mysqli_query($con,"UPDATE tblincome set IncomeItem='$epItem',IncomeCost='$epCost',IncomeDate='$epDate',remarks='$remarks' where ID='$urlData'");
            if($ret)
            {
                echo("<script>alert('Update Success!');</script>");
                header("location:manage-income.php");
            }
            else
            {
                echo("<script>alert('Update Fail!');</script>");
            }
            
        }
        ?>
	</div><!-- /.row -->	
	

<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>