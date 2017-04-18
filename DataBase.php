<?php

/**
 * Created by PhpStorm.
 * User: Mostafa tarek
 * Date: 1/29/2017
 * Time: 6:08 PM
 */

//defining the acesses variables
define("HOST","localhost",false);
define("DB","doctorpatient",false);
define("USER","root",false);
define("PASSWORD","",false);
class DataBase
{
   private $table;
   private $conn;
//building contructor that iniziatlize table and connection
    function __construct($table)
    {

        $this->table=$table;
        $this->connect() ;



    }
//setup connection to database
    function  connect()
    {

       $this->conn=mysqli_connect(HOST,USER,PASSWORD,DB) or die("error in connecting");

    }


    /*insert new intity in the entity set
     * @param arrtable the attributes of entity array
     * @param arrinsert the value of atrribute entity array
     *
     *
     */
    function  insert($arrtable,$arrinsert)
    {


        try{
            //cheking the inputs are both arrays with equal size
            if(is_array($arrtable)&&is_array($arrinsert) &&sizeof($arrinsert)==sizeof($arrtable))
            {
            //imploding the contents of the both arrays

                $table=implode(",",$arrtable);
                $values=implode(",",$arrinsert);

                //settingup the sql command


                $sql="INSERT INTO {$this->table} ({$table}) VALUES  ({$values})";
                echo $sql ."<Br>" ;
                mysqli_query($this->conn,$sql) ;


            }
            else
                throw new mysqli_sql_exception();

        }
        catch (mysqli_sql_exception $e)
        {
            echo "you have error in inseration arrays ";
            return -1;
        }

    }



    /*update entity
    * @param arrtable the attributes of entity array
    * @param arrinsert the value of atrribute entity array
    * @param slctcol the checked attribute that has contrains
    * @param slctvalues the domain of attribute constrains
     *
     *


    */
    function update($arrtable,$arrinsert ,$slctcol,$slctvalues )
    {

        try{
            if(is_array($arrtable)&&is_array($arrinsert))
            {

               $counts=sizeof($arrtable);

               //setting sql  update value by concatination of arrtable and arrinsert into line sql
               $newval=" ";
               for($i=0;$i<$counts;$i++)
                   if($i<$counts-1)

                   $newval .= $arrtable[$i] ."='" . $arrinsert[$i] ."' , " ;
               else
                $newval .= $arrtable[$i] ."='" . $arrinsert[$i] ."' " ;

                $counts=sizeof($slctcol);

                //setting  constrain on the selected entities to be updated
                $where=" ";
                for($i=0;$i<$counts;$i++)

                    $where .= $slctcol[$i] ."='" . $slctvalues[$i] ."'and " ;




                 $sql="UPDATE {$this->table} SET" . $newval ."where" . $where ."1" ;
                // echo $sql;
                mysqli_query($this->conn,$sql) ;


            }
            else
                throw new mysqli_sql_exception();

        }
        catch (mysqli_sql_exception $e)
        {
            echo "you have error in inseration arrays ";
            return -1;
        }


    }
    function delete($slctcol,$slctvalues )
    {

        //setting  constrain on the selected entities to be updated
        $where=" ";
        $counts=sizeof($slctcol);
        for($i=0;$i<$counts;$i++)

            $where .= $slctcol[$i] ."='" . $slctvalues[$i] ."'and " ;




        $sql="Delete from {$this->table} WHERE ". $where ."1" ;

       // echo $sql;
        @mysqli_query($this->conn,$sql);

    }





    /*
     * read records from database and return multi-dimention associated array
     * having results
     *
     * @param slctcol the attributes that has constrain
     * @param slctvalues the constrains domain value
     * extrasql set an extrasql condition
     *
     *
     */
    function read($slctcol,$slctvalues ,$extrasql)
    {
        $where=" ";
        $counts=sizeof($slctcol);

//setup select constrain
        for($i=0;$i<$counts;$i++) {

            $where .= $slctcol[$i] . "='" . $slctvalues[$i] . "'and ";


        }





        $sql="SELECT * from {$this->table} WHERE ". $where ."1" .$extrasql;
       // echo "this is selecting sql " . $sql ;
;
        $res=@mysqli_query($this->conn,$sql)or die("query error". mysql_error());



//return multidimenision Associate array

        $ans=mysqli_fetch_all($res,1);

        return $ans;



    }


    function close()
    {
        mysqli_close($this->conn);

    }

    /**
     * @param mixed $table
     */
    public function setTable($table)
    {
        $this->table = $table;
    }



    function __destruct()
    {
        $this->close($this->conn);
    }

}