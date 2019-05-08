<?php include "../inc/dbinfo.inc"; ?>
<?php
//get everything from the testJobs table and put it into an array for use in jobSearch.html

 $connect = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
 $database = mysqli_select_db($connect, DB_DATABASE);
 $query = "SELECT * FROM books";
 $result = mysqli_query($connect, $query);
 while($row = mysqli_fetch_assoc($result))
 {
    $data[] = $row;

 }

 function utf8ize($d) {
   if (is_array($d)) {
       foreach ($d as $k => $v) {
           $d[$k] = utf8ize($v);
       }
   } else if (is_string ($d)) {
       return utf8_encode($d);
   }
   return $d;
}

echo json_encode(utf8ize($data));

?>
