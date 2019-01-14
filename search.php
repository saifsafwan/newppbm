<?php 
  session_start(); 
  $currentUsername = $_SESSION['username'];
  if (!isset($currentUsername)) {
    header('location: login.php');
  }

  include('config.php');
  // DB CONNECTION
  $link = mysqli_connect($host,$user,$pw,$db);
  $primeQuery = "SELECT * FROM users WHERE username='$currentUsername'";
  $result = mysqli_query($link, $primeQuery);
  $row = mysqli_fetch_array($result);

  if($row['approved']==0){
    header('location: home.php');
  }
  if($row['isAdmin']==0){
    header('location: home.php');
  }
?>

<html>
    <head>
        <title>Search</title>
        <script src="jquery/jquery-3.3.1.min.js"></script>
        <script src="bootstrap/bootstrap.min.js"></script>
        <link href="bootstrap/bootstrap.min.css" rel="stylesheet" />
    </head>
    <body>
        <style type="text/css">
            .input-group input {
                margin-left: 20px;
            }
            .input-group span {
                margin-top: 5px;
            }
        </style>
        <div class="container">
            <br />
            <br />
            <br />
            <h2 align="center">Search Users</h2><br />
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">Search</span>
                    <input type="text" name="search_text" id="search_text" placeholder="Search Everywhere..." class="form-control" />
                </div>
            </div>
            <br />
            <div id="result"></div>
        </div>
        <div style="clear:both"></div>
        <br />
        
        <br />
        <br />
        <br />
    </body>
</html>


<script>
$(document).ready(function(){
    load_data();
    function load_data(query)
    {
        $.ajax({
            url:"search2.php",
            method:"post",
            data:{query:query},
            success:function(data)
            {
                $('#result').html(data);
            }
        });
    }
    
    $('#search_text').keyup(function(){
        var search = $(this).val();
        if(search != '')
        {
            load_data(search);
        }
        else
        {
            load_data();            
        }
    });
});
</script>