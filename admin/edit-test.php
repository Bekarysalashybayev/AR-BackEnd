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
$tid=$_POST['theoryid'];
$lid=$_POST['lid'];
$task=$_POST['task'];
$answer=$_POST['answer'];
$answer1=$_POST['answer1'];
$answer2=$_POST['answer2'];
$answer3=$_POST['answer3'];

      $id=intval($_GET['id']);

     $sql= "UPDATE Test SET localTestNumber= :number, Task = :task, Answer = :answer, Choice1= :answer1,
            Choice2 = :answer2, Choice3= :answer3 ,Theory_Id = :tid, Level_Id= :lid WHERE Test_Id= :id";
     $query = $dbh->prepare($sql);
     $query->bindParam(':number',$number,PDO::PARAM_STR);
     $query->bindParam(':task',$task,PDO::PARAM_STR);
     $query->bindParam(':answer',$answer,PDO::PARAM_STR);
     $query->bindParam(':answer1',$answer1,PDO::PARAM_STR);
     $query->bindParam(':answer2',$answer2,PDO::PARAM_STR);
     $query->bindParam(':answer3',$answer3,PDO::PARAM_STR);
     $query->bindParam(':lid',$lid ,PDO::PARAM_STR);
     $query->bindParam(':tid',$tid ,PDO::PARAM_STR);
     $query->bindParam(':id',$id,PDO::PARAM_STR);
     $query->execute();

    
 $msg="Data updated successfully";

}

}
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
	
	<title>Admin Portal | Admin Edit test Info</title>

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
                      <h2 class="page-title">Edit A Test</h2>
                      <div class="row">
		         <div class="col-md-12">
                            <div class="panel panel-default">
				<div class="panel-heading">Basic Info</div>
                                <?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
<?php 
$id=intval($_GET['id']);
$sql ="select Theory.name, Test.localTestNumber, Test.Task, Test.Answer, Test.Choice1, Test.Choice2, Test.Choice3,
       Level.Level, Test.Theory_Id, Test.Level_Id from Theory INNER JOIN Test on Theory.id = Test.Theory_Id Inner Join Level on Test.Level_Id = Level.Level_Id  WHERE Test.Test_Id=:id";
$query = $dbh -> prepare($sql);
$query-> bindParam(':id', $id, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{	?>
                   
                     <div class="panel-body">
                      <form method="post" class="form-horizontal" enctype="multipart/form-data" >
                        <div class="form-group">
                          <label class="col-sm-2 control-label"> Test Number</label>
                            <div class="col-sm-2">
                              <input type="number" class="form-control" name="number" id="number"  min="1" max="5" value="<?php echo htmlentities($result->localTestNumber);?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                         <label class="col-sm-2 control-label">Select Theory<span style="color:red">*</span></label>
                          <div class="col-sm-8">
                            <select style="padding:5px;margin-top:10px;" name="theoryid"  required>
                              <option value="<?php echo htmlentities($result->Theory_id);?>"><?php echo htmlentities($result->name);?></option>
                              <?php 
                              $ret="Select id,name from Theory";
                              $query1= $dbh -> prepare($ret);
                              $query1-> execute();
                              $results1 = $query1 -> fetchAll(PDO::FETCH_OBJ);
                              if($query1 -> rowCount() > 0)
                              {
                                foreach($results1 as $result1)
                                {
                                ?>
                                  <option value="<?php echo htmlentities($result1->id);?>"><?php echo htmlentities($result1->name);?></option>
                                <?php 
                                }
                              } ?>

                            </select>
                          </div>
                        </div>
                         <div class="form-group">
                         <label class="col-sm-2 control-label">Select Level<span style="color:red">*</span></label>
                          <div class="col-sm-8">
                            <select style="padding:5px;margin-top:10px;" name="lid"  required>
                              <option value="<?php echo htmlentities($result->Level_Id);?>"><?php echo htmlentities($result->Level);?></option>
                              <?php 
                              $ret1="Select Level_Id, Level from Level";
                              $query2= $dbh -> prepare($ret1);
                              $query2-> execute();
                              $results2 = $query2 -> fetchAll(PDO::FETCH_OBJ);
                              if($query2 -> rowCount() > 0)
                              {
                                foreach($results2 as $result2)
                                {
                                ?>
                                  <option value="<?php echo htmlentities($result2->Level_Id);?>"><?php echo htmlentities($result2->Level);?></option>
                                <?php 
                                }
                              } ?>

                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Given<span style="color:red">*</span></label>
                          <div class="col-sm-10">
                            <textarea class="form-control" name="task" rows="3" required><?php echo htmlentities($result->Task);?></textarea>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Answer<span style="color:red">*</span></label>
                          <div class="col-sm-4">
                            <input type="text" name="answer" placeholder="answer" value="<?php echo htmlentities($result->Answer);?>">
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-2 control-label">Choice1<span style="color:red">*</span></label>
                          <div class="col-sm-4">
                            <input type="text" name="answer1" placeholder="choice" value="<?php echo htmlentities($result->Choice1);?>">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Choice2<span style="color:red">*</span></label>
                          <div class="col-sm-4">
                            <input type="text" name="answer2" placeholder="choice" value="<?php echo htmlentities($result->Choice2);?>">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Choice3<span style="color:red">*</span></label>
                          <div class="col-sm-4">
                            <input type="text" name="answer3" placeholder="choice" value="<?php echo htmlentities($result->Choice3);?>">
                          </div>
                        </div>

                          <div class="form-group">
					  <div class="col-sm-8 col-sm-offset-2">
					      <button class="btn btn-default" type="reset">Cancel</button>
					      <button class="btn btn-primary" name="submit" type="submit">Save changes</button>
					  </div>
					</div>
                      </form>
                    </div>
<?php }} ?>
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
