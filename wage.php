<?php
include 'conf/auth.php';
$user = $_POST['user']?$_POST['user']:$_SESSION['user'];
$date_from = $_POST['date_from']?$_POST['date_from']:date("Y-m-d", strtotime("-1 month"));
$date_to = $_POST['date_to']?$_POST['date_to']:date("Y-m-d");
$res_array=array_from_table("name","login","active");
//$date_today=date("Y-m-d");
//$date_a_month_earlier=date("Y-m-d", strtotime("-1 month"));
echo "<form method='POST' action='index.php?link=wage' style='margin:2ex 0ex;'>\r\n";
echo "<div>\r\n";
	echo $lang_count_wage_of;	
	echo "<select name='user' style='margin:0ex 1ex'>\r\n";
	foreach($res_array as $row){
		echo "<option value='".$row['name'].(($row['name']===$user)?"' selected>":"'>").$row['name']."</option>\r\n";
	}
	echo "</select>\r\n";
	echo $lang_from;
	echo "<input type='date' name='date_from' value='$date_from' pattern='20\d{2}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01])' title='The date in format yyyy-mm-dd.' style='margin:0ex 1ex'>";
	echo $lang_to;
	echo "<input type='date' name='date_to' value='$date_to' pattern='20\d{2}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01])' title='The date in format yyyy-mm-dd.' style='margin:0ex 1ex'>";
	echo "<input type='submit' value='$lang_check_out_submit'style='margin:0ex 1ex'>";
echo "</div>\r\n";
echo "</form>";
unset($res_array);

if($_POST['user']){

	$res_array=array_from_table("SUM(price) as sum","pcservice","STRCMP(user,'$user')=0 AND date_r BETWEEN CAST('$date_from' AS DATE) AND CAST('$date_to' AS DATE)"); 
	$sum=$res_array[0]['sum']?$res_array[0]['sum']:'0.00';
	unset($res_array);
	
	
	echo "<div style='margin:4ex 0ex;'>\r\n";
	//echo $lang_calc_wage.' '.$_POST['user'].' '.$lang_for_period.' '.$lang_from.' '.$_POST['date_from'].' '.$lang_to.' '.$_POST['date_to'].' ';
	echo "<span>$lang_calc_wage</span>\r\n";
	echo "<span style='font-weight:bold'>$user</span>\r\n";
	echo "<span>$lang_for_period $lang_from</span>\r\n";
	echo "<span style='font-weight:bold'>$date_from</span>\r\n";
	echo "<span> $lang_to </span>\r\n";
	echo "<span style='font-weight:bold'>$date_to</span>\r\n";
	echo "<span> $lang_is </span>\r\n";
	echo "<span style='color:firebrick';font-weight:bold;>$sum</span>\r\n";
	echo "<span> $lang_levs_short</span>\r\n";
	echo "</div>\r\n";
	
	
	$res_array=array_from_table("id,date_r,price","pcservice","STRCMP(user,'$user')=0 AND date_r BETWEEN CAST('$date_from' AS DATE) AND CAST('$date_to' AS DATE)"); 	
	$iter=ceil(count($res_array)/3);
	if($iter>0){		
		echo "<table style='margin: 0px auto;'>\r\n";
			echo"<colgroup><col/><col/><col style='text-align:right'/></colgroup>\r\n";
			echo"<colgroup><col/><col/><col style='text-align:right'/></colgroup>\r\n";
			echo"<colgroup><col/><col/><col style='text-align:right'/></colgroup>\r\n";
			echo "<tr>\r\n";
				echo "<th>$lang_num</th><th>$lang_date</th><th>$lang_sum_1</th>\r\n";
				echo "<th>$lang_num</th><th>$lang_date</th><th>$lang_sum_1</th>\r\n";
				echo "<th>$lang_num</th><th>$lang_date</th><th>$lang_sum_1</th>\r\n";
			echo "</tr>\r\n";
		for($i=0;$i<$iter;$i++){
			echo "<tr>\r\n";
				echo"<td>".$res_array[$i]['id']."</td><td>".$res_array[$i]['date_r']."</td><td style='text-align:right'>".$res_array[$i]['price']."</td>\r\n";
				echo"<td>".$res_array[$iter+$i]['id']."</td><td>".$res_array[$iter+$i]['date_r']."</td><td style='text-align:right'>".$res_array[$iter+$i]['price']."</td>\r\n";
				echo"<td>".$res_array[2*$iter+$i]['id']."</td><td>".$res_array[2*$iter+$i]['date_r']."</td><td style='text-align:right'>".$res_array[2*$iter+$i]['price']."</td>\r\n";
			echo "</tr>\r\n";
		}
		echo "</table>\r\n";
	}
	unset($res_array);	
}
?>