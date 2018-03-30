<?php
//fetch.php
//$connect = mysqli_connect("localhost", "root", "", "testing");
/*include("config.php");
$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($db, $_POST["query"]);
 $query = "
  SELECT * FROM users 
  WHERE fname LIKE '%".$search."%'
  OR lname LIKE '%".$search."%' 
  OR username LIKE '%".$search."%' 
  OR email_id LIKE '%".$search."%' 
 ";
}
else
{
 $query = "
  SELECT * FROM users ORDER BY user_id
 ";
}
$result = mysqli_query($db, $query);
if(mysqli_num_rows($result) > 0)
{
/* $output .= '
  <div class="table-responsive">
   <table class="table table bordered">
    <tr>
     <th>Fname</th>
     <th>Lname</th>
     <th>Username</th>
     <th>Email id</th>
    </tr>
 ';
 while($row = mysqli_fetch_array($result))
 {
  $output .= '
   <tr>
    <td>'.$row["fname"].'</td>
    <td>'.$row["lname"].'</td>
    <td>'.$row["username"].'</td>
    <td>'.$row["email_id"].'</td>
   </tr>
  ';
 }
 echo $output;
}
else
{
 echo 'Data Not Found';
}
*/
?>

<?php  
include("config.php");
 //$connect = mysqli_connect("localhost", "root", "", "testing");  
 if(isset($_POST["query"]))  
 {  
      $output = '';  
      $query = "SELECT * FROM users WHERE username LIKE '%".$_POST["query"]."%' OR
	  fname LIKE '%".$_POST["query"]."%' OR lname LIKE '%".$_POST["query"]."%'";  
      $result = mysqli_query($db, $query);  
      $output = '<ul class="list-unstyled">';  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '<li>'.$row["username"].' '.$row["lname"].'</li>';  
           }  
      }  
      else  
      {  
           $output .= '<li>User Not Found</li>';  
      }  
      $output .= '</ul>';  
      echo $output;  
 }  
 ?>  