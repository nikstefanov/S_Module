<?php
/*
# ------------------------------------------------------------------------#
# PCService v.1.1                                                         #
# ------------------------------------------------------------------------#
# Copyright (C) 2011 Designmark, Ltd. Some Rights Reserved.               #
# @license - GNU/GPL v3                                                   #
# Copyright Designmark, Ltd,  d.mark.eu@gmail.com                         #
# Authors:                                                                #
# Mihail Mihaylov - monolith14@gmail.com                                  #
# Tsanislav Kolev - tsanislav@gmail.com                                   #
# This file can be redistributed but may not be changed without the       #
# writtenpermission of its author.                                        #
# http://www.gnu.org/licenses/gpl.html                                    #
# ------------------------------------------------------------------------#
*/
include 'conf/auth.php';
if (!$_POST['id'] && !$_GET['id']){die("$lang_page_gone");}
if ($_POST['id']){
	$id=$_POST['id'];
	
	$date_r=escape($_POST['date_r']);
	$active=escape($_POST['active']);
	$price_labour=escape($_POST['price_labour']);if(!$price_labour)$price_labour=0;
	$price_materials=escape($_POST['price_materials']);
	$solved=escape($_POST['solved']);
	$constat=escape($_POST['constat']);
	$guarantee_note=$_POST['guarantee_note']?$_POST['guarantee_note']:0;
	$user=$_POST['user'];
	$guarantee_swap=$_POST['guarantee_swap']?1:0;
	$swap_serial=escape($_POST['swap_serial']);	
	// echo $swapped;
	//echo "UPDATE pcservice SET date_r='$date_r',active='$active',price=$price_labour,price_materials='$price_materials',solved='$solved',constat='$constat',guarantee_note='$guarantee_note',user='$user',guarantee_swap=$guarantee_swap, swap_serial='$swap_serial' WHERE id=$id";
	$innsert=$GLOBALS['conn']->query("UPDATE pcservice SET date_r='$date_r',active='$active',price=$price_labour,price_materials='$price_materials',solved='$solved',constat='$constat',guarantee_note='$guarantee_note',user='$user',guarantee_swap=$guarantee_swap, swap_serial='$swap_serial' WHERE id=$id");
	if(!$innsert){die($GLOBALS['conn']->error);}
}
if ($_GET['id']) {
	$id=$_GET['id'];
}
// $res=$GLOBALS['conn']->query("SELECT * FROM pcservice WHERE id='$id'");
// if (!$res){die($GLOBALS['conn']->error);}
// $row=$res->fetch_array();
// $id1=$row['client'];
// $res1=$GLOBALS['conn']->query("SELECT * FROM users WHERE id='$id1'");
// if (!$res1){die($GLOBALS['conn']->error);}
// $row1=$res1->fetch_array();
$row=get_card($id,false);

//The following solution is not the best, but is the easiest and fastest to make.
$firm_l='Лидер Технолоджис ЕООД';
$firm_c='Компютър маркет ЕООД';
$firm_i='ИТ Дистрибюшън АД';
$firm_k='Комакс ЕООД';

$address_l='<b>гр. Бургас</b><br/>бул. Демокрация 100, тел. 056/821 300<br/>ж.к. Славейков бл. 133, тел. 056/800 109';
$url_addr_l='<b>www.leadertechnologies.bg</b>';

$address_c='<b>София</b>, ул. Самоковско шосе № 1, нац. телефон: 070020002<br/>Магазини:<br/><b>гр. Бургас</b>, пл. Царица Йоанна № 11-13, тел. 056/828 787<br/><b>гр. Пловдив</b>, ТЦ Форум, тел. 032/599 509<br/><b>гр. Сливен</b>, ул.Г.С.Раковски 39А, тел. 044/631 313';
$url_addr_c='<b>www.computermarket.bg</b>/service';

$address_i='<b>гр. София</b><br/>бул. Христофор Колумб №56, тел. 02 4666 751';
$url_addr_i='<b>http://itdistribution.bg</b>/service';

$address_k='<b>гр. Бургас</b>, пл. Царица Йоанна № 11-13, биз.център "Бриз", ет.5, тел. 056 999 929';
$url_addr_k='<b>http://www.komaks.com</b>';

if ($row['brand_name']=='Computer Market'){
	$firm=$firm_c;
	$address=$address_c;
	$url_addr=$url_addr_c;
}elseif($row['brand_name']=='Leader Technologies'){
	$firm=$firm_l;
	$address=$address_l;
	$url_addr=$url_addr_l;
}elseif($row['brand_name']=='IT Distribution'){
	$firm=$firm_i;
	$address=$address_i;
	$url_addr=$url_addr_i;
}elseif($row['brand_name']=='Komaks'){
	$firm=$firm_k;
	$address=$address_k;
	$url_addr=$url_addr_k;
}else{
	$firm=$firm_c;
	$address=$address_c;
	$url_addr=$url_addr_c;
}

if ($row['serv_type']=='0'){
	$serv_type=$lang_serv_type_cond1;
}
elseif ($row['serv_type']=='1'){
	$serv_type=$lang_serv_type_cond2;
}
elseif ($row['serv_type']=='2'){
	$serv_type=$lang_serv_type_cond3;
}
elseif ($row['serv_type']=='3'){
	$serv_type=$lang_serv_type_cond4;
}
?>

<link href="css.css" rel="stylesheet" type="text/css" />
<body style="background:#fff;">
<div id="noprint">
	<div id="wrap1">
		<div class="body_pp">
			<div class="content1">	
			<?php
				echo $lang_print.": <button onclick=' window.print()' style='display:inline-block;margin-right:20ex;'><img src='img/print.gif' width='15' height='15' onclick=' window.print()'/></button>";
	if($row['status']=='0'){
        	$status_op=(($row['active']==2)?"<form method='GET' action='index.php'><input  type='hidden' name='link' value='izdai' /><input type='hidden' name='id' value='".$row['id']."'/><input type='submit' value='".$lang_status."'/></form>":"");
	}elseif($row['date_returned'] != '0000-00-00'){
		$status_op=$row['date_returned'];
	}else{
		$status_op=$lang_ord_izd2;
	}
				echo "<span style='display:inline-block;margin-left:20ex'>".$status_op."</span>";
			?>
			</div>
		</div>
	</div>
    	<div class="footer"> All Rights Reserved. (c) Computer Market Ltd.</div>
</div>

<div id="print">
<div class="border">
	<div class="prnt1">
			<div class="prnt2"><b><?php echo $firm;?></b><br />
				<!--div class="address"><?php echo $address;?></div-->
			</div>
			<div class="prnt3"><b><?php echo $lang_serv_p;?></b><br /><?php echo $lang_num;?>:<b><?php echo $row['id'];?>/<?php echo $row['date_r'];?></b></div>
	
	<div class="spacer"></div>
	</div>
	<!--div class="spacer"></div-->
	<div  style="float:left;width:100%;border-top:1px solid black;"></div>
	<div class="prnt6"><div class="prnt4"><?php echo $lang_client;?> :</div><div class="prnt5"><b><?php echo $row['name'];?></b></div></div>
	<div class="prnt6"><div class="prnt4"><?php echo $lang_telephone;?>:</div><div class="prnt5"><b><?php echo $row['telephone'];?></b></div></div>
	<div  style="float:left;width:100%;border-top:1px solid black;"></div>
	<div class="spacer"></div>
		<!--div class="spacer"></div>
			<!div class="spacer"></div-->
	<div style="width:100%;background:transparent">
	<div  style="float:left;width:100%;border-top:1px solid black;"></div>
		<div style="float:left;width:55%;text-align: left;">
			<div  style="float:left;width:100%;padding-left:10px;"><h3><?php echo $lang_descr_problem;?>:</h3></div>
			<div  style="float:left;width:100%;padding-left:10px;"><?php echo $row['problem'];?></div>
			<div  style="float:left;width:100%;padding-left:10px;"><br /><b><?php echo $lang_outlook;?>:</b><br /><?php echo $row['outlook'];?></div>
		</div>
					
		<div style="float:right;width:35%;text-align: left;">
			<div  style="float:right;width:100%;padding-left:10px;"><h3><?php echo $lang_item_recieved;?>:</h3></div>
			<div  style="float:right;width:100%;padding-left:10px;"><b><?php echo $lang_description;?>:</b><?php echo $row['product'];?></div>
			<div  style="float:right;width:100%;padding-left:10px;"><b><?php echo $lang_brand;?>:</b><?php echo $row['brand'];?></div>
			<div  style="float:right;width:100%;padding-left:10px;"><b><?php echo $lang_model;?>:</b><?php echo $row['model'];?></div>
			<div  style="float:right;width:100%;padding-left:10px;"><b><?php echo $lang_serial_no;?>:</b><?php echo $row['serial'];?></div>
		</div>
					
		<div  style="float:left;width:100%;border-bottom:1px solid black;"></div>			
	</div>
	
	
	<div class="spacer"></div>
	<div style="width:45%;padding-left:10px;float:left;"><b><?php echo $lang_rep_type;?>:</b><br /><?php echo $serv_type;?></div>	
	<div style="width:45%;padding-left:10px;float:left;">
		<span style="font-weight:bold"><?php echo $lang_guarantee_flag;?>: <?=($row['guarantee'])?$lang_yes:$lang_no?></span>
		<?if($row['guarantee']){
			echo "<span style='margin-left:2ex'>№ ".$row['guarantee_num']."</span>\r\n";			
			if($row['claim_number']){
				echo "<div>".$lang_claim_number_short.": ".$row['claim_number']."</div>\r\n";
			}
		}?>
	</div>
	<div class="spacer"></div>
	
	
		<div style="width:100%;background:transparent">
	<div  style="float:left;width:100%;border-top:1px solid black;"></div>
		<div style="float:left;width:45%;text-align: left;">
			<div  style="float:left;width:100%;padding-left:10px;"><h3><?php echo $lang_problem_user;?>:</h3></div>
			<div  style="float:left;width:100%;padding-left:10px;"><?php echo preg_replace("/\r\n|\n|\r/", "<br/>", $row['constat']);?></div>
		</div>
					
		<div style="float:right;width:45%;text-align: left;">
			<div  style="float:right;width:100%;padding-left:10px;">
				<h3><?php echo $lang_descr_repair;?>:</h3>
			</div>
			<div  style="float:right;width:100%;padding-left:10px;">
				<?php echo preg_replace("/\r\n|\n|\r/", "<br/>", $row['solved']);?>
			</div>
			<?if($row['guarantee_swap']){?>				
				<div  style="float:right;width:100%;padding-left:10px;">
					<?php echo $lang_swapped_with." ".$lang_swap_serial.": ".$row['swap_serial'];?>
				</div>
			<?}?>
		</div>
					
		<div  style="float:left;width:100%;border-bottom:1px solid black;"></div>			
	</div>
	
	
	
		
		<div class="spacer"></div>
		<div style="float:left;width:100%;">
			<span style="margin-right:2ex;"><?php echo $lang_price_labour.': '.(is_numeric($row['price'])?$row['price']:'0.00').' '.$lang_levs_short;?></span>
			<span><?php echo $lang_price_materials.': '.(is_numeric($row['price_materials'])?$row['price_materials']:'0.00').' '.$lang_levs_short;?></span>
		</div>
		<!--div class="spacer"></div-->			
		<div style="background: #E1FBF1;float:left;width:100%;">
			<div style="margin-left:10px;"><?php echo $lang_price_rep;?>: <b><font style="bold" color="red" ><?php echo (is_numeric($row['price'])?$row['price']:0) + (is_numeric($row['price_materials'])?$row['price_materials']:0);?></font> <?php echo $lang_cur;?>.</b></div>
		</div>
		<div style="background: #E1FBF1;float:left;width:100%;">
			<div style="margin-left:10px;"><?php echo $lang_guarantee_note;?>: <b><font style="bold" color="red" ><?php echo $row['guarantee_note'];?></font> <?=$lang_months_short?></b></div>
		</div>
	
		<div class="spacer"></div>			
			<!--div class="spacer"></div-->
			<div style="width:100%;">				
		</div>
	


	<div style="width:100%;">
		<div style="float:left;width:45%;text-align: left;">
			<div  style="float:left;width:100%;padding-left:10px;"><b><?php echo $lang_tech_user;?>: <?php echo $row['user'];?></b></div><div class="spacer"></div>
			<div  style="float:left;width:100%;padding-left:10px;">............</div>
		</div>
		<div style="float:left;width:45%;text-align: right;">
			<div  style="float:left;width:100%;padding-left:10px;"><b><?php echo $lang_client;?>: <?php echo $row['name'];?></b></div><div class="spacer"></div>
			<div  style="float:left;width:100%;padding-left:10px;">.............</div>
			
		</div>

						<div class="spacer"></div>
					
	<div  style="float:left;width:100%;border-top:2px dotted black;"><b><?php echo $lang_client_cut;?></b></div>
		<!--div class="spacer"></div-->
	<div class="prnt1">
			<div class="prnt2"><b><?php echo $firm;?></b><br />
				<div class="address">
					<?php echo $address;?><br/><?echo $url_addr/*.' - '.$lang_check_status*/;?>	
				</div>
			</div>
			<div class="prnt3">
				<div style="font-weight:bold"><?php echo $lang_serv_p;?></div>
				<div><span><?=$lang_num.':'?></span><span style='font-weight:bold'><?=$row['id'].'/'.$row['date_p']?></span></div>
				<?if($row['claim_number']){
					echo "<div>".$lang_claim_number_short.": ".$row['claim_number']."</div>\r\n";
				}?>
			</div>
						
	
<div class="spacer"></div>
			<!--div class="spacer"></div-->			
			<!--div style="background: #E1FBF1;float:left;width:100%;"><div style="margin-left:10px;"><?php echo $lang_price_rep;?>: <font style="bold" color="red" ><b><?php echo $row['price'];?></font> <?php echo $lang_cur;?>.</b></div></div-->
			<div style="background: #E1FBF1;float:left;width:100%;"><div style="margin-left:10px;"><?php echo $lang_guarantee_note;?>: <font style="bold" color="red" ><b><?php echo $row['guarantee_note'];?></font> мес.</b></div></div>
	
	<div class="spacer"></div>			
		<!--div class="spacer"></div-->
		<div style="width:100%;">				
	</div>
	


	<div style="width:100%;">
		<div style="float:left;width:45%;text-align: left;">
			<div  style="float:left;width:100%;padding-left:10px;"><b><?php echo $lang_tech_user;?>: <?php echo $row['user'];?></b></div><div class="spacer"></div>
			<div  style="float:left;width:100%;padding-left:10px;">............</div>
		</div>
		<div style="float:left;width:45%;text-align: right;">
			<div  style="float:left;width:100%;padding-left:10px;"><b><?php echo $lang_client;?>: <?php echo $row['name'];?></b></div><div class="spacer"></div>
			<div  style="float:left;width:100%;padding-left:10px;">.............</div>
			
		</div>	
	</div>	
	<div style="float:left;width:100%;text-align: left;font-size:9px;"><a title=" Print this page" href=" #" onclick=" window.print()" ><?php echo $lang_pcservice_adv;?></a></div>
	<div style="clear:both;"></div>
	</div>
 </div>
