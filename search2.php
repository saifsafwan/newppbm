<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$connect = mysqli_connect("localhost", "root", "", "ppbm");
 
// Check connection
if($connect === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
$output = '';
if(isset($_POST["query"]))
{
    $search = mysqli_real_escape_string($connect, $_POST["query"]);
    $query = "
    SELECT * FROM users 
    WHERE id<>4 AND firstName LIKE '%".$search."%'
    OR lastName LIKE '%".$search."%'
    OR username LIKE '%".$search."%'
    ";
}
else
{
    $query = "SELECT * FROM users WHERE id<>4 ORDER BY id";
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
    $output .= '<div class="table-responsive">
                    <table class="table table bordered">
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                        </tr>';
    $x = 1;
    while($row = mysqli_fetch_array($result))
    {
        
        $output .= '
            <tr>
                <td>'.$x.'</td>
                <td>'.$row["username"].'</td>
                <td>'.$row["firstName"].'</td>
                <td>'.$row["lastName"].'</td>
                <td>'.$row["email"].'</td>
            </tr>
        ';
        $x++;
    }
    echo $output;
}
else
{
    echo 'Data Not Found';
}

?>