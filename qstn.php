<?php
session_start();

include "DataBase.php";
$quesid;
if(isset($_GET['questionid'])) {


   
    $quesid=$_GET['questionid'];
}
else
{
    @header("location:search_qstn.php");
}

$db=new DataBase('qstn');
$res=$db->read(['qstn_id'],["{$quesid}"],"");
//echo var_dump($res);


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
    <!--CUSTOM BASIC STYLES-->
    <link href="assets/css/basic.css" rel="stylesheet" />
    <!--CUSTOM MAIN STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
<style>

.media-object {
    display: block;
    width: 35px;
    height: 35px;
  }
</style>
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index_patient.html">Doctor & Patient </a>
            </div>

            <div class="header-right">

                <a href="mess_test.html" class="btn btn-info" title="New Message"><b>30 </b><i class="fa fa-envelope-o fa-2x"></i></a>
                <a href="Q_patient.html" class="btn btn-primary" title="New answer"><b>40 </b><i class="fa fa-question fa-2x"></i></a>
                <a href="login.html" class="btn btn-danger" title="Logout"><i class="fa fa-exclamation-circle fa-2x"></i></a>

            </div>
        </nav>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <div class="user-img-div">
                            <img src="assets/img/user.png" class="img-thumbnail" />

                            <div class="inner-text">
                                Jhon Deo Alex
                            <br />
                                <small>Last Login : 2 Weeks Ago </small>
                            </div>
                        </div>

                    </li>


                    <li>
                        <a class="active-menu" href="index_patient.html"><i class="fa fa-home "></i>Home</a>
                    </li>
                     <li>
                                <a href="strange_case.html"><i class="fa fa-stethoscope"></i>strange cases </a>
                            </li>
                    <li>
                        <a href="mess_test.html"><i class="fa fa-envelope "></i>Message</a>

                    </li>
                     <li>
                        <a href="Q_patient.html"><i class="fa fa-question "></i>Questions</a>

                    </li>
                    <li>
                        <a href="emergecy_main.html"><i class="fa fa-ambulance"></i>Emergecy</a>

                    </li>
                    <li>
                        <a href="error.html"><i class="fa fa-wrench "></i>Setting</a>

                    </li>

                      <li>
                        <a href="login.html"><i class="fa fa-power-off "></i>Logout</a>
                    </li>
                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">

              <div class="row">
                  <div class="col-md-12">


              <div class="panel-body">
                   <form role="form" action="" method="post">
                               <div class="form-group">
                                   <label> Question</label>

                                   <p class="help-block"><?php echo $res[0]['qstn_txt'] ?>.</p>
                               </div>
                        <div class="form-group">
                                   <label>Your Answer</label>
                                   <input class="form-control" type="text" name="answer_txt">
                                   <p class="help-block">Answer here.</p>
                             </div>
                        <aside align="right">
                               <button type="submit" name="answer" class="btn btn-info" align="center" onclick="doanswer(<?echo $quesid ?>)">answer</button></aside>

                           </form>
                  <?php

                  if(isset($_POST['answer'])) {
                      $db->setTable('dctr');
                      $drid=$db->read(['user_id'],[$_SESSION['loginid']],"")[0]['dctr_id'];
                      $text="'{$_POST['answer_txt']}'";

                      $db->setTable('qstn_cmnt');
                     $db->insert(['dctr_id', 'qstn_cmnt_txt', 'qstn_id'], [$drid, $text, $quesid]);

                      @header("location:qstn.php?questionid=$quesid");


                  }
                  ?>
                   </div>
                 </div>
               </div>



            <?php
            $db->setTable("qstn_cmnt");
            $db2=new DataBase('dctr');
            $img=new DataBase('user');
            $comments=$db->read(['qstn_id'],["$quesid"],"");
           for($i=0;$i<sizeof($comments);$i++)


           {

           $dr=$db2->read(['dctr_id'],["{$comments[$i]['dctr_id']}"],"");
           //echo var_dump($dr);
           
           $user=$img->read(['user_id'],["{$dr[0]['user_id']}"],"");
           $avatar=$user[0]['avatar'];
//var_dump($user);
//echo var_dump($dr);

echo "
        <li class='media'>
<a class='pull-left' href=profile.php?id={$dr[0]['user_id']}>
<img class='media-object img-circle' src={$avatar}>
</a>
<div class='media-body'>
<h4 class='media-heading'>{$dr[0]['dctr_first_nm']}
</h4>
<p>
{$comments[$i]['qstn_cmnt_txt']}



</p>
<p>
{$comments[$i]['qstn_cmnt_date']}
</p>
</div>
  
            </li> ";
            
          }
?>

   <!-- COMMENT SECTION - ONE END-->

</ul>
            </div>
        </div>
    </div>
</div>
</div>
<!-- /. PAGE WRAPPER  -->
</div>
<!-- /. WRAPPER  -->
<div id="footer-sec">
&copy; 2017 Doctor&Patient | Design By : Doctor&Patient Group | EELU
</div>
<!-- /. FOOTER  -->
<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
<!-- JQUERY SCRIPTS -->
<script src="assets/js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="assets/js/bootstrap.js"></script>
<!-- METISMENU SCRIPTS -->
<script src="assets/js/jquery.metisMenu.js"></script>
<!-- CUSTOM SCRIPTS -->
<script src="assets/js/custom.js"></script>


</body>
</html>
