<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE /*| E_NOTICE*/);
// header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
// header('Cache-Control: no-store, no-cache, must-revalidate');
// header('Cache-Control: post-check=0, pre-check=0', FALSE);
// header('Pragma: no-cache');

$string_constant = array(
	"serv_card"=>array("bg"=>"Сервизна карта №","en"=>"Service card #"),
	"tel_number"=>array("bg"=>"Телефонен номер","en"=>"Telephone number"),
	"check"=>array("bg"=>"Направи проверка","en"=>"Check it!"),
	"databese_error"=>array("bg"=>"Грешка в базата данни.","en"=>"Database error."),
	"no_data"=>array("bg"=>"Няма данни за такава поръчка.","en"=>"No data for such order."),
	"item"=>array("bg"=>"Артикул","en"=>"Item")
	,"problem"=>array("bg"=>"Повреда","en"=>"Problem")
	,"guarantee"=>array("bg"=>"Гаранция","en"=>"Guarantee")
	,"yes"=>array("bg"=>"Да","en"=>"Yes")
	,"no"=>array("bg"=>"Не","en"=>"No")
	,"date_p"=>array("bg"=>"Дата на приемане","en"=>"Date received")
	,"priority"=>array("bg"=>"Приоритет","en"=>"Priority")
	,"priority_arr"=>array(array("bg"=>"Обикновена","en"=>"Normal"),array("bg"=>"Бърза","en"=>"High"),array("bg"=>"Експресна","en"=>"Urgent"))
	,"office"=>array("bg"=>"Офис","en"=>"Office")
	,"client"=>array("bg"=>"Клиент","en"=>"Client")
	,"neg_price"=>array("bg"=>"Съгласувана цена","en"=>"Negotiated price")
	,"sendto"=>array("bg"=>"Изпратен за гаранционно обслужване","en"=>"Send for repair to")
	,"note"=>array("bg"=>"Забележка","en"=>"Note")
	,"rep_kind"=>array("bg"=>"Вид на ремонта","en"=>"Repairment kind")
	,"rep_kind_arr"=>array(array("bg"=>"Без съгласуване на цената с клиента","en"=>"Without mutual agreement on the price with the client"),array("bg"=>"Съгласуване на цената с клиента","en"=>"With mutual agreement on the price with the client"),array("bg"=>"Диагностика","en"=>"Diagnosis and wastage recommendation"),array("bg"=>"За изкупуване","en"=>"Negotiable"))
	,"active"=>array("bg"=>"Статус","en"=>"Status")
	,"active_arr"=>array(array("bg"=>"Приета за сервиз","en"=>"Received for repair"),array("bg"=>"Приключен ремонт","en"=>"Repair done"),array("bg"=>"В процес на работа","en"=>"Repairing"))
	,"collected"=>array("bg"=>"Издадена","en"=>"Collected")
	,"leading_0"=>array("bg"=>"само цифри, започващи с 0","en"=>"digits only, with leading 0")
	
	//,"item"=>array("bg"=>"","en"=>"")
);
$lang=($_GET['lang'])?$_GET['lang']:"bg";
if ($_GET['brand_name']){
	$brand_name=$_GET['brand_name'];
}else{
	$brand_name='cm';
}
if ($brand_name=='cm'){
	$brand_name_name='Computer Market';
	$anchor_image="<a href='http://www.computermarket.bg/'><img src='img/CM_logo_AA.gif' style='border-width: 0px;' /></a>";
}elseif ($brand_name=='lt'){
	$brand_name_name='Leader Technologies';
	$anchor_image="<a href='http://www.leadertechnologies.bg/'><img src='img/LT_logo_AA.png' style='border-width: 0px;' /></a>";
}elseif ($brand_name=='it'){
	$brand_name_name='IT Distribution';
	$anchor_image="<a href='http://itdistribution.bg/'><img src='img/IT_logo_no.png' style='border-width: 0px;' /></a>";	
}
include 'functions.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<head>
	<link href="clients.css" rel="stylesheet" type="text/css" />	
	<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate, max-stale=0, post-check=0, pre-check=0" />
	<meta http-equiv="Pragma" content="no-cache" />
	<meta http-equiv="Expires" content="-1" />
	<meta http-equiv="Vary" content="*" />
	
</head>
<body>
<div style="padding-left:1em">
	<?=$anchor_image?>
</div>
<?php if (!$_POST['card']) { ?>
	<form method="POST" action='client_check.php?lang=<?=$lang?>&brand_name=<?=$brand_name?>'>
	<table class="login">
		<tr>
			<td><?=$string_constant['serv_card'][$lang]?></td>
			<td>
				<input type='text' name='card' />
			</td>
		</tr>
		<tr>
			<td>
				<div><?=$string_constant['tel_number'][$lang]?></div>
				<div style='font-size:small;'>(<?=$string_constant['leading_0'][$lang]?>)</div>
			</td>
			<td>
				<input type='text' name='tel' value='0'/>
			</td>
		</tr>
		<tr>
			<td/>
			<td>
				<input type='submit' value='<?=$string_constant['check'][$lang]?>' />
			</td>
		</tr>
	</table>
	</form>
	<div class="lang_link">
	<?if ($lang=="bg"){?>
		<a href="client_check.php?lang=en&brand_name=<?=$brand_name?>" >English</a>	
	<?}else{?>
		<a href="client_check.php?lang=bg&brand_name=<?=$brand_name?>" >Български език</a>
	<?}?>
	</div>

<?}else{
	$id = $GLOBALS['conn']->escape_string($_POST['card']);
	$tel = $GLOBALS['conn']->escape_string($_POST['tel']);
	$tel = preg_replace('/\\D/','',$tel);//remove non-digits!
	$tel_regex = preg_replace('/^|\\B|$/',"[^0-9]*",$tel);
	//echo $tel_regex;
	//echo date('H:i:s:u');
	$res=$GLOBALS['conn']->query("SELECT * FROM pcservice
	INNER JOIN users ON pcservice.client=users.id
	INNER JOIN offices ON pcservice.office=offices.id 
	WHERE pcservice.id=$id
	AND offices.brand_name LIKE '$brand_name_name'
	AND users.telephone RLIKE '$tel_regex'");
	// "AND offices.brand_name = '$brand_name_name'"
	
	if (!$res) {
		echo($GLOBALS['conn']->error);
		echo "<div class=error>".$string_constant['databese_error'][$lang]."</div>";
		die();
	}
	if (!$res->num_rows){
		echo "<div class=error>".$string_constant['no_data'][$lang]."</div>";
		die();
	}
	$row = $res->fetch_array(MYSQLI_ASSOC);
?>
	<table class="info">
		<colgroup>
			<col class="col_0"/>
			<col class="col_1"/>
		</colgroup>
		
		<tr>
			<td><?=$string_constant['office'][$lang]?></td>
			<td><?=$row['nickname_'.$lang]?></td>
		</tr>
		<tr>
			<td><?=$string_constant['serv_card'][$lang]?></td>
			<td><?=$id?></td>
		</tr>
		<tr>
			<td><?=$string_constant['client'][$lang]?></td>
			<td><?=$row['name']?></td>
		</tr>
		<tr>
			<td><?=$string_constant['item'][$lang]?></td>
			<td><?echo $row['product']." ".$row['brand']." ".$row['model'];?></td>
		</tr>
		<tr>
			<td><?=$string_constant['date_p'][$lang]?></td>
			<td><?=$row['date_p']?></td>
		</tr>
		<tr>
			<td><?=$string_constant['problem'][$lang]?></td>
			<td><?=$row['problem']?></td>
		</tr>
		<tr>
			<td><?=$string_constant['guarantee'][$lang]?></td>
			<td><? echo (($row['guarantee']) ? $string_constant['yes'][$lang] : $string_constant['no'][$lang]);?></td>
		</tr>		
		<?if(!$row['guarantee']){?>
			<tr>
				<td><?=$string_constant['priority'][$lang]?></td>
				<td><?=$string_constant['priority_arr'][$row['priority']][$lang]?></td>
			</tr>
		<?}?>
		<tr>
			<td><?=$string_constant['rep_kind'][$lang]?></td>
			<td><?=$string_constant['rep_kind_arr'][$row['serv_type']][$lang]?></td>
		</tr>		
		<?if($row['serv_type']==1){?>
			<tr>
				<td><?=$string_constant['neg_price'][$lang]?></td>
				<td><?=$row['price_agreed']?></td>
			</tr>
		<?}?>
		<?if($row['sendto'] && !$row['send_returned']){?>
			<tr>
				<td><?=$string_constant['sendto'][$lang]?></td>
				<td><?=$row['sendto']?></td>
			</tr>
		<?}?>
		<?if($row['status_note']){?>
			<tr>
				<td><?=$string_constant['note'][$lang]?></td>
				<td><?=$row['status_note']?></td>
			</tr>
		<?}?>
		<tr>
			<td><?=$string_constant['active'][$lang]?></td>
			<td><?=$string_constant['active_arr'][$row['active']-1][$lang]?></td>
		</tr>
		<tr>
			<td><?=$string_constant['collected'][$lang]?></td>
			<td><? echo (($row['status'])?$string_constant['yes'][$lang]:$string_constant['no'][$lang])?></td>
		</tr>
		<tr>
			<td colspan='2'>
				<img src="img/tablet_h200.gif"/>
				<img src="img/desktop_h200.gif"/>
		</tr>
	</table>
<?	
}
?>
</body>
</html>
