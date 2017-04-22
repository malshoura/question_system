<?php
//include ("database.php");

define("host","localhost");
define("USER","root");
define("password","12345");
define("db","doctorpatient");


$conn=@mysqli_connect(host,USER,password,db) or die("can't connect to marwa database.......");
session_start();

if (isset($_POST['username'])&&isset($_POST['password'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];


	if (!empty($username)&&!empty($password)) {

		$query = "SELECT `user_id`,`acc_type` FROM `user` WHERE (`username`='$username' or `email` = '$username')and(`password` = '$password')";
		$query_run = mysqli_query($conn,$query);
        if ($query_run) {

			if (mysqli_num_rows($query_run)==0) {

				echo "invalid username or password";
        session_destroy();

			}else if (mysqli_num_rows($query_run) == 1) {
                $feild=mysqli_fetch_assoc($query_run);

				echo "ok";
               $_SESSION['loginid']=$feild['user_id'] ;


               if($feild['acc_type']=="dtr")
               {$_SESSION['isdtr']=true;

               header('location:index_doctor.html') ;
}
               else
               {
$_SESSION['isdtr']=false;
               header('location:index_patient.html') ;
}

if($feild['acc_type']=="admin")
{$_SESSION['isadmin']=true;

header('location:index_admin.html') ;
}



      }
		}
	}else{
		echo "you must supply a valid username and password";
	}
}



?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Doctor& Patient</title>

    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body style="background-color: #E2E2E2;">
    <div class="container">
        <div class="row text-center " style="padding-top:100px;">
            <div class="col-md-12">
                <img src="assets/img/logo-invoice.png" />
            </div>
        </div>
         <div class="row ">

                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">

                            <div class="panel-body">
                                <form role="form" method="POST" action="">
                                    <hr />
                                    <h3><b>Login</b></h3>

                                <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                            <input type="text" class="form-control" placeholder="Your Username " name = "username"/>
                                        </div>
                                                                              <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                            <input type="password" class="form-control"  placeholder="Your Password" name="password"/>
                                        </div>
                                    <div class="form-group">
                                            <label class="checkbox-inline">
                                                <input type="checkbox" /> Remember me
                                            </label>
                                            <span class="pull-right">
                                                   <a href="error.html" >Forget password ? </a>
                                            </span>
                                        </div>

                                     <input name="submit" type="submit" id="submit" value= "login"/>
                                    <hr />
                                    Not register ? register now  <a href="check.html" >click here </a>
                                    </form>
                            </div>

                        </div>




        </div>

    </div>

</body>
</html>
