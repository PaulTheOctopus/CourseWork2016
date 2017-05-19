<?php
            include_once 'dbconnect.php';
            session_start();
            if ($_SESSION['access']!=1) {
                header("Location:index.php");
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

                <title >Админка</title>

                <!-- Bootstrap Core CSS -->
                <link href="css/bootstrap.min.css" rel="stylesheet">

                <!-- Custom CSS -->
                <link href="css/shop-homepage.css" rel="stylesheet">

                <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
                <!-- WARNING: Respond.js doesnt work if you view the page via file:// -->
                <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
                <![endif]-->

            </head>

            <body>';
                if ($_GET['status'])
                {header("Location:index.php")
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
                            <a class="navbar-brand" href="admin.php"  style="color:#F1684E;">Админка</a>
                        </div>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li>
                                    <a href="?action=admin_add">Добавить админа</a>
                                </li>
                                <li>
                                    <a href="?action=product_add">Добавить товар</a>
                                </li>
                                <li>
                                    <a href="?action=category_add">Добавить категорию</a>
                                </li>
                                <li>
                                    <a href="?action=admin_rem">Удалить админа</a>
                                </li>
                                <li>
                                    <a href="?action=product_rem">Удалить товар</a>
                                </li>
                                <li>
                                    <a href="?action=category_rem">Удалить категорию</a>
                                </li>
                                <li>
                                    ';

                                    if (isset($_SESSION['user'])) {
                                      echo '
                                      <a href="logout.php">Выйти(<b  style="color:#F1684E;"> '.$_SESSION['user'].' </b>) </a>
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
                        <p class="lead">Отчеты</p>
                        <div class="list-group">
                            <a href="?action=lat_pro" class="list-group-item">Последие добавленые товары</a>
                            <a href="?action=history" class="list-group-item">Последние заказы</a>
                            <a href="?action=order_date" class="list-group-item">Заказы в диапазоне дат</a>
                            <a href="?action=sum_price" class="list-group-item">Прибыль в диапазоне дат</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-10" id="tasker">';
                    switch ($_GET['action']) {
                        case 'admin_add':
                        if (isset($_POST['add'])) {
                            $username = mysql_real_escape_string($_POST['username']);
                            $email = mysql_real_escape_string($_POST['email']);
                            $password = md5(mysql_real_escape_string($_POST['password']));
                            $fname = mysql_real_escape_string($_POST['fname']);
                            $lname = mysql_real_escape_string($_POST['lname']);
                            if(mysql_query("INSERT INTO users(username,email,password,firstname, lastname, access)
                                VALUES('$username','$email','$password', '$fname', '$lname', 1)"))
                            {
                                ?>
        <script type="text/javascript">
            alert('Админ добавлен');
        </script>
        <?php
                            }
                            else
                            {
                                die(mysql_error());
                            }
                        } else {

                            echo'<h1>Добавить админа</h1>
                            <form action=""  method="post">
                                <table>
                                    <tr>
                                        <td>Логин: </td>
                                        <td>
                                            <input type="text" name="username">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td> Email:</td>
                                        <td>
                                            <input type="email" name="email">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> Пароль:</td>
                                        <td>
                                            <input type="text" name="password">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> Имя:</td>
                                        <td>
                                            <input type="text" name="fname">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> Фамилия:</td>
                                        <td>
                                            <input type="text" name="lname">
                                        </td>
                                    </tr>
                                    <tr><td><input type="submit" value="Add Admin" name="add"></td></tr>
                                </table>
                            </form>';
                        }

                        break;
                        case 'product_add':
                        if (isset($_POST['add'])) {
                            $category = (int) mysql_real_escape_string($_POST['category']);
                            $proname = mysql_real_escape_string($_POST['proname']);
                            $mfd = mysql_real_escape_string($_POST['mfd']);
                            $price = (int) mysql_real_escape_string($_POST['price']);
                            $prodesc = mysql_real_escape_string($_POST['prodesc']);

                            if (!isset($_FILES['source']['tmp_name'])) {
                                echo $location="img/notfound.jpg";
                            }else{
                                $file=$_FILES['source']['tmp_name'];
                                $image= addslashes(file_get_contents($_FILES['source']['tmp_name']));
                                $image_name= addslashes($_FILES['source']['name']);

                                move_uploaded_file($_FILES["source"]["tmp_name"],"img/" . $_FILES["source"]["name"]);

                                $location="img/" . $_FILES["source"]["name"];
                            }

                            if(mysql_query("INSERT INTO product(category_id,product_name,mfd,price,description,source)
                                VALUES($category, '$proname', '$mfd',$price,'$prodesc','$location')"))
                            {
                                 ?>
        <script type="text/javascript">
            alert('Товар добавлен');
        </script>
        <?php
                            }
                            else
                            {
                                die(mysql_error());
                            }
                        }

                        else {
                            echo'<h1>Добавить товар</h1>
                            <form action=""  method="post" enctype="multipart/form-data" name="addproduct">
                                <table>
                                    <tr>
                                        <td>Категория </td>
                                        <td>
                                           <select name="category">';
                                            $sql = mysql_query("SELECT category_id,category_name FROM category");
                                            while ($row = mysql_fetch_array($sql)){
                                                echo '<option value="'.$row['category_id'].'">'.$row['category_name'].'</option>';
                                            }
                                            echo'
                                            </select
                                        </td>
                                    </tr>

                                    <tr>
                                        <td> Название:</td>
                                        <td>
                                            <input type="text" name="proname">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> Дата выпуска</td>
                                        <td>
                                            <input type="date" name="mfd">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> Цена(&euro;):</td>
                                        <td>
                                            <input type="number" name="price">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> Описание:</td>
                                        <td>
                                            <input type="text" name="prodesc">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> Выбрать изображение </td>
                                        <td><input type="file" name="source" accept="images/*"></td>
                                        <tr><td><input type="submit" value="Add Product" name="add"></td></tr>
                                    </table>
                                </form>';
                            }
                            break;
                            case 'category_add':
                            if (isset($_POST['add'])) {
                                $catname = mysql_real_escape_string($_POST['catname']);
                                $catdesc = mysql_real_escape_string($_POST['catdesc']);
                                if(mysql_query("INSERT INTO category(category_name, category_description)
                                    VALUES('$catname', '$catdesc')"))
                                { ?>
        <script type="text/javascript">
            alert('Категория добавлена');
        </script>
        <?php
                                }
                                else
                                {
                                    die(mysql_error());
                                }

                            } else {


                                echo'<h1>Добавить категорию</h1>
                                <form action=""  method="post">
                                    <table>

                                        <tr>
                                            <td> Название:</td>
                                            <td>
                                                <input type="text" name="catname">
                                            </td>
                                        </tr>

                                        <td> Описание:</td>
                                        <td>
                                            <input type="text" name="catdesc">
                                        </td>
                                    </tr>
                                    <tr><td><input type="submit" value="Add Category" name="add"></td></tr>
                                </table>
                            </form>';
                        }
                        break;






                        case 'history':
                        $sql = mysql_query("SELECT * FROM product");
                      echo'
<style type="text/css">
.myTable { width:400px;background-color:#eee;border-collapse:collapse; }
.myTable th { background-color:#000;color:white;width:50%; }
.myTable td, .myTable th { padding:5px;border:1px solid #000; color:#222930; }
</style>
<!-- End Styles -->
<table class="myTable">
<tr>
<th>Пользователь</th>
<th>Товар</th>
<th>Количество</th>
<th>Цена(&euro;)</th>
<th>Номер телефона</th>
<th>Адресс</th>
</tr>';
                      $sql = mysql_query("SELECT * FROM order_details");

                        while ($row = mysql_fetch_array($sql)){
                            $pid=$row['product_id']; $uid=$row['user_id'];
                            $psql=mysql_fetch_array(mysql_query("SELECT * FROM product where product_id=$pid"));
                            $usql=mysql_fetch_array(mysql_query("SELECT * FROM users where user_id=$uid"));
                            echo'
                            <tr>
                              <td>'.$usql['username'].'  </td>
                              <td>'.$psql['product_name'].'</td>
                              <td>'.$row['quantity'].'</td>
                              <td>'.$row['order_price'].'</td>
                              <td>'.$usql['phone'].'</td>
                              <td>'.$usql['address'].'</td>

                          </tr>
                          ';
 }

echo'</table>';

                      break;







                    case 'order_date':

                    echo '
    <form action=""  method="post" enctype="multipart/form-data" name="search_by_date">
    </select
                        </td>
                            </tr>
                    <tr><td><input method="post" type="submit" value="Search"  name="search"></td></tr>
                                                        <tr>
                                                            <td> Дата от</td>
                                                            <td>
                                                                <input type="date" name="date1">
                                                            </td>
                                                            <td> До </td>
                                                            <td>
                                                                <input type="date" name="date2">
                                                            </td>
                                                        </tr>
                                                        </table>
                                                    </form>

<style type="text/css">
.myTable { width:400px;background-color:#eee;border-collapse:collapse; }
.myTable th { background-color:#000;color:white;width:50%; }
.myTable td, .myTable th { padding:5px;border:1px solid #000; color:#222930; }
</style>
<!-- End Styles -->
<table class="myTable">
<tr>
<th>Пользователь</th>
<th>Товар</th>
<th>Количество</th>
<th>Цена(&euro;)</th>
<th>Номер телефона</th>
<th>Адресс</th>
</tr>';
                    if (isset($_POST['search'])){
                    $date1 = mysql_real_escape_string($_POST['date1']);
                    $date2 = mysql_real_escape_string($_POST['date2']);
                    $sql = mysql_query("SELECT * FROM order_details WHERE order_date BETWEEN '$date1' AND '$date2'");
                        while ($row = mysql_fetch_array($sql)){
                            $pid=$row['product_id']; $uid=$row['user_id'];
                            $psql=mysql_fetch_array(mysql_query("SELECT * FROM product WHERE product_id=$pid"));
                            $usql=mysql_fetch_array(mysql_query("SELECT * FROM users WHERE user_id=$uid"));
                            echo'
                            <tr>
                              <td>'.$usql['username'].'  </td>
                              <td>'.$psql['product_name'].'</td>
                              <td>'.$row['quantity'].'</td>
                              <td>'.$row['order_price'].'</td>
                              <td>'.$usql['phone'].'</td>
                              <td>'.$usql['address'].'</td>
                          </tr>
                          ';
                        }


 }

echo'</table>';
                      break;
case 'sum_price':

                    echo '
    <form action=""  method="post" enctype="multipart/form-data" name="search_by_date">
    </select
                        </td>
                            </tr>
                    <tr><td><input method="post" type="submit" value="Search"  name="search"></td></tr>
                                                        <tr>
                                                            <td> Дата от</td>
                                                            <td>
                                                                <input type="date" name="date1">
                                                            </td>
                                                            <td> До </td>
                                                            <td>
                                                                <input type="date" name="date2">
                                                            </td>
                                                        </tr>
                                                        </table>
                                                    </form>

<style type="text/css">
.myTable { width:400px;background-color:#eee;border-collapse:collapse; }
.myTable th { background-color:#000;color:white;width:50%; }
.myTable td, .myTable th { padding:5px;border:1px solid #000; color:#222930; }
</style>
<!-- End Styles -->
<table class="myTable">
<tr>
<th>Прибыль</th>
</tr>';
                    if (isset($_POST['search'])){
                    $date1 = mysql_real_escape_string($_POST['date1']);
                    $date2 = mysql_real_escape_string($_POST['date2']);
                    $sql = mysql_query("SELECT SUM(order_price) FROM order_details WHERE order_date BETWEEN '$date1' AND '$date2'");
                    $sum = mysql_fetch_array($sql);
                    $sum = $sum[0];
                    echo'
                            <tr>
                              <td>'.$sum.'  </td>
                          </tr>
                          ';
                        /*while ($row = mysql_fetch_array($sql)){
                            $pid=$row['product_id']; $uid=$row['user_id'];
                            $psql=mysql_fetch_array(mysql_query("SELECT * FROM product WHERE product_id=$pid"));
                            $usql=mysql_fetch_array(mysql_query("SELECT * FROM users WHERE user_id=$uid"));
                            echo'
                            <tr>
                              <td>'.$usql['username'].'  </td>
                              <td>'.$psql['product_name'].'</td>
                              <td>'.$row['quantity'].'</td>
                              <td>'.$row['order_price'].'</td>
                              <td>'.$usql['phone'].'</td>
                              <td>'.$usql['address'].'</td>
                          </tr>
                          ';
                        }*/


 }

echo'</table>';
                      break;




                      case 'lat_pro':
                      $sql = mysql_query("SELECT * FROM product");
                      echo'
<style type="text/css">
.myTable { width:400px;background-color:#eee;border-collapse:collapse; }
.myTable th { background-color:#000;color:white;width:50%; }
.myTable td, .myTable th { padding:5px;border:1px solid #000; color:#222930; }
</style>
<!-- End Styles -->
<table class="myTable">
<tr>
<th>Товары</th>

<th>Цена(&euro;)</th>
<th>Категория</th>
</tr>';
                      while ($row = mysql_fetch_array($sql)){
                        $catid=$row['category_id'];
                        $catrow=mysql_fetch_array(mysql_query("SELECT category_name from category where category_id=$catid" ));


echo'
<tr>
<td>'.$row['product_name'].'</td>

<td>'.$row['price'].'</td>
<td>'.$catrow['category_name'].'</td>


</tr>
 ';
 }

echo'</table>';



                    break;

                    case 'admin_rem':
                    if (isset($_POST['rem'])) {
                     $uid=$_POST['admin'];
                     if (mysql_query("DELETE from users WHERE user_id=$uid")) {
                        ?>
        <script type="text/javascript">
            alert('Админ удален');
        </script>
        <?php
                    }else{
                        die(mysql_error());
                    }
                }else{
                    echo'  <form action=""  method="post" >
                    <table>
                        <tr>
                            <td>Выбрать админа для удаления</td>
                            <td>
                               <select name="admin">';
                                $sql = mysql_query("SELECT username, user_id FROM users where access=1");
                                while ($row = mysql_fetch_array($sql)){
                                    echo '<option value="'.$row['user_id'].'">'.$row['username'].'</option>';
                                }
                                echo'
                                </select
                            </td>
                        </tr>
                        <tr><td><input type="submit" value="Remove" name="rem"></td></tr>
                    </table></form>';
                }
                break;
                case 'product_rem':
                if (isset($_POST['rem'])) {
                     $uid=$_POST['product'];
                     if (mysql_query("DELETE from product WHERE product_id=$uid")) {
                         ?>
        <script type="text/javascript">
            alert('Товар удален');
        </script>
        <?php
                    }else{
                        die(mysql_error());
                    }
                }else{
                    echo'  <form action=""  method="post" >
                    <table>
                        <tr>
                            <td>Выбрать товар для удаления </td>
                            <td>
                               <select name="product">';
                                $sql = mysql_query("SELECT product_name, product_id FROM product");
                                while ($row = mysql_fetch_array($sql)){
                                    echo '<option value="'.$row['product_id'].'">'.$row['product_name'].'</option>';
                                }
                                echo'
                                </select
                            </td>
                        </tr>
                        <tr><td><input type="submit" value="Remove" name="rem"></td></tr>
                    </table></form>';
                }
                break;
                case'category_rem':
                if (isset($_POST['rem'])) {
                     $uid=$_POST['cat'];
                     if (mysql_query("DELETE from category WHERE category_id=$uid")) {

                     mysql_query("DELETE from product WHERE category_id=$uid");
                      ?>
        <script type="text/javascript">
            alert('Категория и товары в категории удалены);
        </script>
        <?php

                    }else{
                        die(mysql_error());
                    }
                }else{
                    echo'  <form action=""  method="post" >
                    <table>
                        <tr>
                            <td>Select Category to remove </td>
                            <td>
                               <select name="cat">';
                                $sql = mysql_query("SELECT category_name, category_id FROM category");
                                while ($row = mysql_fetch_array($sql)){
                                    echo '<option value="'.$row['category_id'].'">'.$row['category_name'].'</option>';
                                }
                                echo'
                                </select
                            </td>
                        </tr>
                        <tr><td><input type="submit" value="Remove" name="rem"></td></tr>
                    </table></form>';
                }
                break;

                default:
                break;
            }
            echo'
        </div>


    </div>
    <!-- /.container -->

    <div class="container">

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Yahontov P.K. 2015</p>
                </div>
            </div>
        </footer>

    </div>

    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>

</html>';
unset($_SESSION['unset']);
?>
