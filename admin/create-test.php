<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{

if(isset($_POST['submit']))
{
$number=$_POST['number'];
$id=$_POST['theoryid'];
$lid=$_POST['levelid'];

$task=$_POST['task'];	

$answer=$_POST['answer'];
$answer1=$_POST['answer1'];
$answer2=$_POST['answer2'];	
$answer3=$_POST['answer3'];
 

 $sql="INSERT INTO  Test(localTestNumber, Task, Choice1, Choice2, Choice3, Answer, Level_Id, Theory_id) 
                   VALUES(:number,:task, :answer1, :answer2,:answer3,:answer, :lid, :id)";
$query = $dbh->prepare($sql);
$query->bindParam(':number',$number,PDO::PARAM_STR);
$query->bindParam(':task',$task,PDO::PARAM_STR);
$query->bindParam(':answer1',$answer1,PDO::PARAM_STR);
$query->bindParam(':answer2',$answer2,PDO::PARAM_STR);
$query->bindParam(':answer3',$answer3,PDO::PARAM_STR);
$query->bindParam(':answer',$answer,PDO::PARAM_STR);
$query->bindParam(':lid',$lid,PDO::PARAM_STR);
$query->bindParam(':id',$id,PDO::PARAM_STR);
$query->execute();
}}
?>
<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>Arr app | Admin Create Test</title>

	<!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="css/style.css">
  <style>
		.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
		</style>


</head>
   <body>
    <?php include('includes/header.php');?>
    <div class="ts-main-content">
      <?php include('includes/leftbar.php');?>
      <div class="content-wrapper">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <h2 class="page-title">Create Tesk</h2>
              <div class="row">
                <div class="col-md-10">
                  <div class="panel panel-default">
                    <div class="panel-heading">Form fields</div>
                    <div class="panel-body">
                      <form method="post" class="form-horizontal" enctype="multipart/form-data" >
                        <div class="form-group">
                          <label class="col-sm-2 control-label"> Task Number</label>
                            <div class="col-sm-2">
                              <input type="number" class="form-control" name="number" id="number"  min="1" max="5" required>
                            </div>
                        </div>
                        <div class="form-group">
                         <label class="col-sm-2 control-label">Select Theory<span style="color:red">*</span></label>
                          <div class="col-sm-6">
                            <select style="padding:5px;margin-top:10px;" name="theoryid"  required>
                              <option value=""> Select </option>
                              <?php 
                              $ret="Select id,name from Theory";
                              $query= $dbh -> prepare($ret);
                              $query-> execute();
                              $results = $query -> fetchAll(PDO::FETCH_OBJ);
                              if($query -> rowCount() > 0)
                              {
                                foreach($results as $result)
                                {
                                ?>
                                  <option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->name);?></option>
                                <?php 
                                }
                              } ?>

                            </select>
                          </div>
                        </div>
                         <div class="form-group">
                         <label class="col-sm-2 control-label">Select Level<span style="color:red">*</span></label>
                          <div class="col-sm-6">
                            <select style="padding:5px;margin-top:10px;" name="levelid"  required>
                              <option value=""> Select </option>
                              <?php 
                              $ret="Select Level_Id as id, Level from Level";
                              $query= $dbh -> prepare($ret);
                              $query-> execute();
                              $results = $query -> fetchAll(PDO::FETCH_OBJ);
                              if($query -> rowCount() > 0)
                              {
                                foreach($results as $result)
                                {
                                ?>
                                  <option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->Level);?></option>
                                <?php 
                                }
                              } ?>

                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Given<span style="color:red">*</span></label>
                          <div class="col-sm-10">
                            <textarea class="form-control" name="task" rows="3" required required></textarea>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Answer<span style="color:red">*</span></label>
                          <div class="col-sm-4" >
                            <input type="text" name="answer" placeholder="answer" required>
                          </div>
                        </div>
                       <div class="form-group">
                          <label class="col-sm-2 control-label">Choice2<span style="color:red">*</span></label>
                          <div class="col-sm-4" >
                            <input type="text" name="answer1" placeholder="choice" required>
                          </div>
                        </div>
                         <div class="form-group">
                          <label class="col-sm-2 control-label">Choice2<span style="color:red">*</span></label>
                          <div class="col-sm-4" >
                            <input type="text" name="answer2" placeholder="choice" required>
                          </div>
                        </div>
                         <div class="form-group">
                          <label class="col-sm-2 control-label">Choice3<span style="color:red">*</span></label>
                          <div class="col-sm-4" >
                            <input type="text" name="answer3" placeholder="choice" required>
                          </div>
                        </div>
                        <div class="form-group">
			  <div class="col-sm-12 col-sm-offset-4">
			    <button class="btn btn-primary" name="submit" type="submit">Save</button>
			  </div>
			</div>
                       
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
  </body>
</html>