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
     $book=$_POST['book'];
     $def=$_POST['def'];
     $note=$_POST['note'];
     $theorema=$_POST['theorema'];
     $proof=$_POST['proof'];
     $vimage1=$_FILES["img1"]["name"];
     $vimage2=$_FILES["img2"]["name"];

$vimage1 = "http://augmented.zzz.com.ua/admin/admin-ar/img/theoryimg/" .$vimage1;
$vimage2 = "http://augmented.zzz.com.ua/admin/admin-ar/img/theoryimg/" .$vimage2;

move_uploaded_file($_FILES["img1"]["tmp_name"],"img/theoryimg/".$_FILES["img1"]["name"]);
move_uploaded_file($_FILES["img2"]["tmp_name"],"img/theoryimg/".$_FILES["img2"]["name"]);

     $sql="INSERT INTO Theory(name, Definition, Note, Theorema, Proof, Picture1, Picture2)
                       Values(:book, :def, :note, :theorema, :proof, :vimage1, :vimage2)";
     $query = $dbh->prepare($sql);
     $query->bindParam(':book',$book,PDO::PARAM_STR);
     $query->bindParam(':def',$def,PDO::PARAM_STR);
     $query->bindParam(':note',$note,PDO::PARAM_STR);
     $query->bindParam(':theorema',$theorema,PDO::PARAM_STR);
     $query->bindParam(':proof',$proof,PDO::PARAM_STR);
     $query->bindParam(':vimage1',$vimage1,PDO::PARAM_STR);
     $query->bindParam(':vimage2',$vimage2,PDO::PARAM_STR);
     $query->execute();
     $lastInsertId = $dbh->lastInsertId();
     if($lastInsertId)
     {
        $msg = ' Theory created successfully ';
     }
     else 
     {
        $error = " Something went wrong. Please try again ";
     }
     
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
	
	<title>Admin Portal | Admin Post Theory</title>

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
                      <h2 class="page-title">Post A Game</h2>
                      <div class="row">
		         <div class="col-md-12">
                            <div class="panel panel-default">
				<div class="panel-heading">Basic Info</div>
                                <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				 else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
                   
                                 <div class="panel-body">
                                    <form method="post" class="form-horizontal" enctype="multipart/form-data">
                                       <div class="form-group">
                                           <label class="col-sm-2 control-label">Book Title<span style="color:red">*</span></label>
                                           <div class="col-sm-4">
                                               <input type="text" name="book" class="form-control" required>
                                           </div>
                                        </div>
                                        <div class="hr-dashed"></div>
                                          
                                        <div class="form-group">
                                           <label class="col-sm-2 control-label">Definition<span style="color:red">*</span></label>
                                           <div class="col-sm-10">
                                                <textarea class="form-control" name="def" rows="3" required></textarea>
                                           </div>
                                        </div>

                                        <div class="form-group">
                                           <label class="col-sm-2 control-label">Note<span style="color:red">*</span></label>
                                           <div class="col-sm-10">
                                                <textarea class="form-control" name="note" rows="3" required></textarea>
                                           </div>
                                        </div>

                                        <div class="form-group">
                                           <label class="col-sm-2 control-label">Theorema<span style="color:red">*</span></label>
                                           <div class="col-sm-10">
                                                <textarea class="form-control" name="theorema" rows="3" required></textarea>
                                           </div>
                                        </div>

                                        <div class="form-group">
                                           <label class="col-sm-2 control-label">Proof<span style="color:red">*</span></label>
                                           <div class="col-sm-10">
                                                <textarea class="form-control" name="proof" rows="3" required></textarea>
                                           </div>
                                        </div>

                                        <div class="form-group">
                                              <h4 class="col-sm-2"><b>Upload Images</b></h4>
                                           <div class="col-sm-5">
                                              Image 1 <span style="color:red">*</span><input type="file" name="img1" required>
                                           </div>
                                           <div class="col-sm-5">
                                              Image 2<span style="color:red">*</span><input type="file" name="img2" required>
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