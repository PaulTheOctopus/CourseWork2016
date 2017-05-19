<?php 
session_start();
include_once 'dbconnect.php';
if (!isset($_SESSION['user_id'])) {
	header('location:login.php');
}
include 'header.php';
$user=$_SESSION['user_id'];
if (isset($_POST['order'])) {
	$product_id=$_POST['product_id'];
	$user_id=$_POST['user_id'];
	$quantity=$_POST['quantity'];
	$order_price=$_POST['order_price'];

	if(mysql_query("INSERT INTO order_details(product_id, user_id, quantity, order_price, order_date) 
		VALUES($product_id, $user_id, $quantity, $order_price, now())"))
	{
		echo'<b>Ваши заказ в обработке, ждите звонка.</b>';
		mysql_query("DELETE from cart where product_id=$product_id");
	}
	else
	{
		die(mysql_error());
	}
}
echo '<h3>Все заказы</h3>
<style type="text/css">
.myTable { width:400px;background-color:#eee;border-collapse:collapse; }
.myTable th { background-color:#000;color:white;width:50%; }
.myTable td, .myTable th { padding:5px;border:1px solid #000; color:#222930; }
</style>
<!-- End Styles -->
<table class="myTable">
<tr>
<th>Товар</th>
<th>Количество</th>
<th>Цена</th>
<th>Дата заказа</th>
</tr>'; 
$sql = mysql_query("SELECT * FROM order_details where user_id=$user");
while ($row = mysql_fetch_array($sql)){
	$proid=$row['product_id'];
	$psql=mysql_query("SELECT * FROM product where product_id=$proid");
	$proarr=mysql_fetch_array($psql);
 echo'
 <tr>
<td>'.$proarr['product_name'].'</td>
<td>'.$row['quantity'].'</td>
<td>'.$row['order_price'].'</td>
<td>'.$row['order_date'].'</td>
</tr>';
}
echo "</table>";
?>