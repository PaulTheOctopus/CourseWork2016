<?php 
include_once 'dbconnect.php';
include 'header.php';
session_start();
$sql = mysql_query("SELECT category_id, category_name From category");
            while ($row = mysql_fetch_array($sql)){
              switch ($_GET['action']) {
            case $row['category_name']:
            echo'         
            <a name="men"><h3 style="color:#F1684E;">'.$row['category_name'].'</h3></a>
            <div id="men" style="color:#222930;">'; 
            //Retrived from db///////////////////
            $cat_id = mysql_real_escape_string($row['category_id']);
            $sql = mysql_query("SELECT * FROM product where category_id='$cat_id'");
            while ($row = mysql_fetch_array($sql)){
                echo
                '<div id="item" style="float:left; margin:auto; margin-right:10px;margin-top:20px; border-radius:10px;
                 border:solid 2px #4EB1BA;background-color:#ECEAE0;  ">'.
                "<b><pre>". $row['product_name']." </b> <b>Цена: </b>". $row['price'].'&#8366;</pre>
                <p><img src="'.$row['source'].'" height=400px; width=380px; >
                <form name="toCart" action="cart.php" method="post">
                <input type="hidden" name="product_id" value="'.$row['product_id'].'">
                <input type="hidden" name="user_id" value="'.$_SESSION['user_id'].'">
                <table>
                    <tr><td><input type="number" name="quantity" placeholder="Количество" required></td> 
                    <td><input type="submit" name="to_cart" value="Добавить в корзину"> </td></tr>
                </table>

            </form> </div>';
        }
        echo '</div>';
        break;}
            } /*
switch ($_GET['action']) {
            case 'Men':
            echo'         
            <a name="men"><h3 style="color:#F1684E;">Мужская одежда</h3></a>
            <div id="men" style="color:#222930;">'; 
            //Retrived from db///////////////////
            $sql = mysql_query("SELECT * FROM product where category_id=5");
            while ($row = mysql_fetch_array($sql)){
                echo
                '<div id="item" style="float:left; margin:auto; margin-right:10px;margin-top:20px; border-radius:10px;
                 border:solid 2px #4EB1BA;background-color:#ECEAE0;  ">'.
                "<b><pre>". $row['product_name']." </b> <b>Price: </b>". $row['price'].'&euro;</pre>
                <p><img src="'.$row['source'].'" height=400px; width=380px; >
                <form name="toCart" action="cart.php" method="post">
                <input type="hidden" name="product_id" value="'.$row['product_id'].'">
                <input type="hidden" name="user_id" value="'.$_SESSION['user_id'].'">
                <table>
                    <tr><td><input type="number" name="quantity" placeholder="Количество" required></td> 
                    <td><input type="submit" name="to_cart" value="Добавить в корзину"> </td></tr>
                </table>

            </form> </div>';
        }
        echo '</div>';
        break;   
            case 'Women':
             echo'
            <a name="women"><h3 style="color:#F1684E;">Женская одежда</h3></a>
            <div id="women" style="color:#222930;" >'; 
            //Retrived from db///////////////////
            $sql = mysql_query("SELECT * From product where category_id=6");
            while ($row = mysql_fetch_array($sql)){
                echo
                '<div id="item" style="float:left; margin:auto; margin-right:10px;margin-top:20px; border-radius:10px;
                 border:solid 2px #4EB1BA;background-color:#ECEAE0;  ">'.
                "<b><pre>". $row['product_name']." </b> <b>Price: </b>". $row['price'].'&euro;</pre>
                <p><img src="'.$row['source'].'" height=400px; width=380px; >
                <form name="toCart" action="cart.php" method="post">
                <input type="hidden" name="product_id" value="'.$row['product_id'].'">
                <input type="hidden" name="user_id" value="'.$_SESSION['user_id'].'">
                <table>
                    <tr><td><input type="number" name="quantity" placeholder="Количество" required></td> 
                    <td><input type="submit" name="to_cart" value="Добавить в корзину"> </td></tr>
                </table>

            </form> </div>';
        }
        echo '</div>';
        break;     
            case 'Kid':
             echo'
             <a name="kids"><h3 style="color:#F1684E;">Детская одежда</h3>
             <div id="kids" style="color:#222930;"></a>'; 
            //Retrived from db///////////////////
            $sql = mysql_query("SELECT * FROM product where category_id=7");
            while ($row = mysql_fetch_array($sql)){
                echo
                '<div id="item" style="float:left; margin:auto; margin-right:10px;margin-top:20px; border-radius:10px;
                 border:solid 2px #4EB1BA;background-color:#ECEAE0;  ">'.
                "<b><pre>". $row['product_name']." </b> <b>Price: </b>". $row['price'].'&euro;</pre>
                <p><img src="'.$row['source'].'" height=400px; width=380px; >
                <form name="toCart" action="cart.php" method="post">
                <input type="hidden" name="product_id" value="'.$row['product_id'].'">
                <input type="hidden" name="user_id" value="'.$_SESSION['user_id'].'">
                <table>
                    <tr><td><input type="number" name="quantity" placeholder="Количество" required></td> 
                    <td><input type="submit" name="to_cart" value="Добавить в корзину"> </td></tr>
                </table>

            </form> </div>';
        }
        echo '</div>';   
        break;

    }*/

                //////////////
            

        echo'
    </div></div></div>
</div>
</div> 

<!-- /.container -->

<div class="container">

    <hr style="border-color:#F1684E;">

    <!-- Footer -->
    <footer>
        <div class="row">
            <div class="col-lg-12">
                <p>Copyright &copy; Kurs Shop</p>
            </div>
        </div>
    </footer>

</div>
<!-- /.container -->
<!-- js -- >
<script src="js/scripts.js"></script>
<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
</body>

</html>';
unset($_SESSION['unset']);
?>