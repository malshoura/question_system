<?php
/**
 * Created by PhpStorm.
 * User: mostafa
 * Date: 23/04/17
 * Time: 23:24
 */
include ("DataBase.php");
$db=new DataBase('qstn_cmnt');
$db->delete(['qstn_cmnt_id'],[$_GET['commentid']]);

?>