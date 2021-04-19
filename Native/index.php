<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include('controller/includes/functions.php'); ?>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

 

    <title>CME Task</title>
</head>
<body class="bg-dark">
<!-- Include Header -->
<?php
  include_once('layout/header.php');

?>
<!--Navigation-->
<div class="container-fluid">
    <div class="row">
      <div class="col">
          <div class="card mt-4">
            <div class="card-title ml-4 my-2">
            <p id="message" class="text-danger"></p>
            <form id="regForm">
              <input type="text" class="form-control my-2" placeholder="User Name" id="UserName" style="width: 99%;" required>
              <input type="email" class="form-control my-2" placeholder="User Email" id="UserEmail" style="width: 99%;" required>
              <input type="company" class="form-control my-2" placeholder="Company" id="company" style="width: 99%;" required>
              <button   class="btn btn-success" onclick="register()" >Add Record</button>
            </form>

            </div>
            <div class="card-body">
              <div id="table" class="table-responsive"></div>
            </div>
            <div class="card-body">
              <div id="tableApi" class="table-responsive">
              <?php $res = display_api(); ?>
              <table  class="table table-bordered align-middle">
              <thead class="thead-dark">
              <tr>
                        <th> Name</th>
                        <th> Email</th>
                        <th> Company </th>
                    </tr>
              <tbody>
              
              <?php foreach($res as $r){?>
                <tr>
               <td><?= $r['name'];?></td>
               <td><?= $r['email'];?></td>
               <td><?= $r['company'];?></td>
               </tr>

              <?php } ?>

              </tbody>
              </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

</div> 
<?php
  include_once('layout/footer.php');

?>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>    <script src="js/myjs.js"></script>
    <script src="js/myjs.js"></script>
</html>