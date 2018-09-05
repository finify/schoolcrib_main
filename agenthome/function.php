
<?php 


//this is a class to select all the row in adb table if a particular id is been parsed
class select_allcon{
   
    var $user_row;

    function get_row_user($id,$col){
        require('../phpfiles/dbconnect.php');//DBCONNECTION
        $query = "SELECT * FROM `sc_users` WHERE Email='$id' ";
        $result = mysqli_query($con,$query) ;
        $row = mysqli_fetch_array($result);
        $this->user_row = $row[$col];
    }
}



?>