<?php  
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['detsuid']==0)) {
  header('location:logout.php');
  } else{

//code deletion
if(isset($_GET['delid']))
{
$rowid=intval($_GET['delid']);
$query=mysqli_query($con,"delete from tblincome where ID='$rowid'");
if($query){
echo "<script>alert('Record successfully deleted');</script>";
echo "<script>window.location.href='manage-income.php'</script>";
} else {
echo "<script>alert('Something went wrong. Please try again');</script>";

}

}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Daily Expense Tracker || Manage Expense</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
	<style>
		.search-bar
		{
			float:right;
		}
		.search-bar input
		{
			height:40px;
			width:250px;
			font-size:15px;
			padding:0px 10px;
			border-radius:10px;
			border:1px solid #d7d7d7;
		}
		.search-bar input:focus
		{
			outline:none;
		}
	</style>
</head>
<body>
	<?php include_once('includes/header.php');?>
	<?php include_once('includes/sidebar.php');?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Income</li>
			</ol>
		</div><!--/.row-->
		
		
				
		
		<div class="row">
			<div class="col-lg-12">
			
				
				
				<div class="panel panel-default">
					<div class="panel-heading">Income
					<div class="search-bar">
							<input type="text" placeholder="Search Items">
						</div>
					</div>
					<div class="panel-body">
						<p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>
						<div class="col-md-12">
							
							<div class="table-responsive printtable">
            <table class="table table-bordered mg-b-0 table-data">
              <thead>
                <tr>
                  <th>S.NO</th>
                  <th>Income Item</th>
                  <th>Income Cost</th>
                  <th>Income Date</th>
				  <th>Remarks</th>
                  
                </tr>
              </thead>
              <?php
              $userid=$_SESSION['detsuid'];
              $lastdate=date('Y-m-d',strtotime("-365 days"));
			  $tdate = date('Y-m-d');
$ret=mysqli_query($con,"select * from tblincome where UserId='$userid' AND IncomeDate BETWEEN '$lastdate' AND '$tdate'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
              <tbody>
                <tr>
                  <td><?php echo $cnt;?></td>
              
                  <td><?php  echo $row['IncomeItem'];?></td>
                  <td><?php  echo $row['IncomeCost'];?></td>
                  <td><?php  echo $row['IncomeDate'];?></td>
				  <td><?php  echo $row['Remarks'];?></td>
                 
                </tr>
                <?php 
$cnt=$cnt+1;
}?>
               
              </tbody>
            </table>
          </div>
		  <button class="btnprinter" onclick="printData()" style="background:rgb(27,149,224);height:40px;width:80px;color:white;border:none;outline:none;border-radius:8px"><i class="fa fa-print"></i>&nbsp;&nbsp;Print</button>
						</div>
					</div>
				</div><!-- /.panel-->
			</div><!-- /.col-->
			<?php include_once('includes/footer.php');?>
		</div><!-- /.row -->
	</div><!--/.main-->
	<script>
    
    function printData()
    {
        var printArea=document.querySelector('.printtable').innerHTML;
        var originalContent=document.body.innerHTML;
        document.body.innerHTML=printArea;
        window.print();
        document.body.innerHTML=originalContent;
    }    
</script>
	
<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	
</body>
<script>
	const searchbar=document.querySelector(".search-bar input");
	searchbar.onkeyup=()=>
	{
		let value=searchbar.value;
		var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.querySelector('.table-data').innerHTML=this.responseText;
      }
    };
    xmlhttp.open("GET","search-data-current-income.php?q="+value,true);
    xmlhttp.send();
  }
	
</script>
</html>
<?php }  ?>