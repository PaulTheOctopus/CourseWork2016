<?php 
include_once 'dbconnect.php';
//include 'header.php';
session_start();
 if ($_SESSION['access']==1) {
                header("Location:admin.php");
            }
 echo'
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Kurs Shop</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/shop-homepage.css" rel="stylesheet">



</head>

<body style="background-color:#222930; color:#E9E9E9;">';
    if ($_GET['status'])
    {
        ?>
        <script type="text/javascript">
            alert('Успешный выход');
        </script>
        <?php
    }
    echo'

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><b style="color:#F1684E;"><i>Kurs Shop</i></b></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="orders.php">Заказ</a>
                    </li>
                    <li>
                        <a href="cart.php">Корзина</a>
                    </li>
                    <li>';

                     if (isset($_SESSION['user'])) {
                      echo '
                      <a href="logout.php" >Выход (<b style="color:#F1684E;"> '.$_SESSION['user'].'</b> ) </a>
                  </li>';
                  ?>
                  <?php } else {
                      echo '<a href="login.php">Вход</a>';
                  }
                  echo'
              </li>
          </ul>

      </div>
      <!-- /.navbar-collapse -->
  </div>
  <!-- /.container -->
</nav>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <div class="col-md-3">
            <p class="lead"><i><b>Категории</b></i></p>
            <div class="list-group">'; 

            $sql = mysql_query("SELECT category_id, category_name From category");
            while ($row = mysql_fetch_array($sql)){
              echo '<a href="?action='.$row['category_name'].'" class="list-group-item">'.$row['category_name'].'</a>';
            }
            echo'
                <!-- <a href="?action=Man" class="list-group-item">Мужская одежда</a>
                <a href="?action=Woman" class="list-group-item">Женская одежда</a>
                <a href="?action=Kids" class="list-group-item">Детская одежда</a> -->
            </div>
        </div>
        <div class="col-md-9">
                <div class="row carousel-holder">

                <div class="col-md-12">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="item active">
                                <img class="slide-image" src="img/ban1.png" alt="">
                            </div>
                            <div class="item">
                                <img class="slide-image" src="img/ban3.jpg" alt="">
                            </div>
                        </div>
                        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>
                    </div>
                </div>
                </div>
                ' ;
                ?>