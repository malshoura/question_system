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

                <!-- /. ROW  -->
                <div class="row">
                    <form role="form" method="post" action="">
            <div class="col-md-6">


                                        <div class="form-group">
                                            <label> search </label>
                                            <input class="form-control" type="text" name="question">
                                            <p class="help-block">Help text here.</p>
                                        </div>

</div>
<div class="col-md-6">
                                        <div class="form-group">
                                            <label>Choose Field</label>
                                            <select class="form-control" name="specialization">
                                                <option value="1">Ear, Nose and Throat</option>
                                                <option value="2">dentist</option>
                                                <option value="3">psychological</option>
                                                <option value="4">pediatric</option>
                                                <option value="5">bones and joints</option>
                                                <option value="6">kidney and urinary</option>
                                                <option value="7">skin and venereal</option>
                                                <option value="8">Obstetrics and Gynecology</option>
                                                <option value="9">ophthalmologist</option>
                                                <option value="10">physiotherapist</option>
                                                <option value="11">Gastroenterology</option>
                                                <option value="12">Chest</option>
                                                <option value="13">heart</option>
                                                <option value="14">veins</option>
                                                <option value="15">Neurologists</option>

                                            </select>
                                        </div>

                                 <aside align="right">
                                        <button type="submit" class="btn btn-info" align="center" name="search">search</button></aside>

                                    </form>
                </div>
            </div>
                <div class="row">
                    <div class="container">
                    <?php
                    include "DataBase.php";
                    $db=new DataBase('qstn');
                    if(isset($_POST['search'])) {


                        $res = $db->read(['spclty_id'], [$_POST['specialization']], " and `qstn_txt` LIKE '%{$_POST['question']}%'");
                        //echo var_dump($res);
                        if (sizeof($res) == 0) {
                            echo
                            "<h1 style=color:red>no result found</h1>";
                        } else {
                            echo
                            "<h1 style=color:green>your search results</h1>";
                            for ($i = 0; $i < sizeof($res); $i++) {


                                echo
                                    "
<div>
<a href=qstn.php?questionid={$res[$i]['qstn_id']}> "
                                    . "

                            {$res[$i]['qstn_txt']}
</a></div>";


                            }


                        }
                    }
                    else
                    {
                        $res=$db->read([],[],"");
                        for($i=0;$i<sizeof($res);$i++){
                       // while ($res) {

                            echo
"
<div>
<a href=qstn.php?questionid={$res[$i]['qstn_id']}> "
                            ."

                            {$res[$i]['qstn_txt']}
</a></div>" ;


                        }




                    }




                    ?>

                            </div>
                </div>

        </div>
             <!--/.ROW-->

            <!-- /. PAGE INNER  -->
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
