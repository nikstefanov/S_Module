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
if ($_POST['action'] == 'INSERT'){
//if ($_POST['id']) {	
	$row = insert_card(		
		$_POST['date_p'],
		$_POST['office'],		
		$_POST['product'],
		$_POST['brand'],
		$_POST['model'],
		$_POST['outlook'],
		$_POST['guarantee'],
		$_POST['guarantee_num'],
		$_POST['serial'],		
		$_POST['problem'],		
		$_POST['serv_type'],
		$_POST['price_agreed'],
		$_POST['priority'],		
		$_POST['client2'], $_POST['telephone'], $_POST['telephone_2'],
		$_POST['claim_number'],
		$_POST['login_os'],
		$_POST['login_username'],
		$_POST['login_password']
	);	
// }elseif ($_POST['action'] == 'UPDATE') {
	// $row = update_card(
		// $_POST['id'],
		// $_POST['active'],
		// $_POST['date_p'],
		// $_POST['office'],		
		// $_POST['product'],
		// $_POST['brand'],
		// $_POST['model'],
		// $_POST['outlook'],
		// $_POST['guarantee'],
		// $_POST['guarantee_num'],
		// $_POST['serial'],		
		// $_POST['problem'],		
		// $_POST['serv_type'],
		// $_POST['price_agreed'],
		// $_POST['priority'],
		// $_POST['sendto'],
		// $_POST['send_returned'],
		// $_POST['send_courier'],
		// $_POST['send_doc_no'],
		// $_POST['status_note'],
		// $_POST['client2'], $_POST['telephone'],
		// $_POST['pre_active']
	// );//header("Location: index.php?link=search");
}else{
	$row = get_card($_GET['id'],false);
}
//echo $row['brand_name']."<br/>";
//The following solution is not the best, but is the easiest and fastest to make.
$firm_l='Лидер Технолоджис ЕООД';
$firm_c='Компютър маркет ЕООД';
$firm_i='ИТ Дистрибюшън АД';
$firm_k='Комакс ЕООД';

$address_l='<b>гр. Бургас</b><br/>бул. Демокрация 100, тел. 056/821 300<br/>ж.к. Славейков бл. 133, тел. 056/800 109';
$url_addr_l='<b>www.leadertechnologies.bg</b>';

$address_c='<b>София</b>, ул. Самоковско шосе No1, нац. телефон: 070020002<br/>Магазини:<br/><b>гр. Бургас</b>, пл. Царица Йоанна No 11-13, тел. 056/828 787<br/><b>гр. Пловдив</b>, ТЦ Форум, тел. 032/599 509<br/><b>гр. Сливен</b>, ул.Г.С.Раковски 39А, тел. 044/631 313';
$url_addr_c='<b>www.computermarket.bg</b>/service';

$address_i='<b>гр. София</b><br/>бул. Христофор Колумб №56, тел. 02 4666 751';
$url_addr_i='<b>http://itdistribution.bg</b>';

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
<body style="background:#fff;">
<div id="noprint">
	<div id="wrap1">
		<div class="body_pp">
			<div class="content1">	
			<?php
				echo $lang_print.": <button onclick=' window.print()'><img src='img/print.gif' width='15' height='15' onclick=' window.print()'/></button>";
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
			<!--div class="address">
				<?php echo $address;?>
			</div-->
			</div>
			<div class="prnt31">
				<b><?php echo $lang_serv_c;?></b><br/>
				<?php echo $lang_num;?>:&nbsp;<b><?php echo $row['id'];?>&nbsp;/&nbsp;<?php echo $row['date_p'];?></b><br/>
				<?php echo $lang_priority;?>:&nbsp;<b><?php echo $lang_serv_prior[$row['priority']];?></b>
			</div>
	
			<!--div class="spacer"/-->
	</div>
	<!--div class="spacer"></div-->
	<div  style="float:left;width:100%;"><!--border-top:1px solid black--></div>
	<div class="prnt6"><div class="prnt4"><?php echo $lang_client;?> :</div><div class="prnt5"><b><?php echo $row['client_name'];?></b></div></div>
	<div class="prnt6"><div class="prnt4"><?php echo $lang_telephone;?>:</div><div class="prnt5"><b><?php echo $row['telephone'];?></b></div></div>
	<div  style="float:left;width:100%;border-top:1px solid black;"></div>
	<!--div class="spacer"></div-->
	<div style="width:100%;">
		<div style="float:left;width:100%;border-top:1px solid black;"></div>
		<div style="float:left;width:55%;text-align: left;">
			<div  style="float:left;width:100%;padding-left:10px;"><h3><?php echo $lang_descr_problem;?>:</h3></div>
			<div  style="float:left;width:100%;padding-left:10px;"><?php echo $row['problem'];?></div>
			<div  style="float:left;width:100%;padding-left:10px;"><br /><b><?php echo $lang_outlook;?>:</b><br /><?php echo $row['outlook'];?></div>
		</div>
					
		<div style="float:left;width:35%;text-align:left;padding-top:2ex;">
			<!--div  style="float:left;width:100%;padding-left:10px;"><h3><?php echo $lang_item_recieved;?>:</h3></div-->
			<div  style="float:left;width:100%;padding-left:10px;"><b><?php echo $lang_description;?>:</b>&nbsp;<?php echo $row['product'];?></div>
			<div  style="float:left;width:100%;padding-left:10px;"><b><?php echo $lang_brand;?>:</b>&nbsp;<?php echo $row['brand'];?></div>
			<div  style="float:left;width:100%;padding-left:10px;"><b><?php echo $lang_model;?>:</b>&nbsp;<?php echo $row['model'];?></div>
			<div  style="float:left;width:100%;padding-left:10px;"><b><?php echo $lang_serial_no;?>:</b>&nbsp;<?php echo $row['serial'];?></div>			
			<?if($row['login_username']){?><div  style="float:left;width:100%;padding-left:10px;"><b><?php echo $lang_username;?>:</b>&nbsp;<?php echo $row['login_username'];?></div><?}?>
			<?if($row['login_password']){?><div  style="float:left;width:100%;padding-left:10px;"><b><?php echo $lang_password;?>:</b>&nbsp;<?php echo $row['login_password'];?></div><?}?>
			<?if($row['login_os']){?><div  style="float:left;width:100%;padding-left:10px;"><b><?php echo $lang_os;?>:</b>&nbsp;<?php echo $row['login_os'];?></div><?}?>
		</div>
					
		<div style="float:left;width:100%;border-top:1px solid black;"></div>
	</div>
	<!--div class="spacer"></div-->
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
	<!--div class="spacer"></div-->
	<div style="clear:both;"></div>
	<div style="width:789px; border-top:1px solid; border-bottom: 1px solid; text-align: left; font-size:12px;padding-left:10px;"><b><?php echo $lang_important_txt;?></b>: <?php echo $lang_cli_text;?></div><br />
	<div style="width:100%;padding-bottom:4ex">
		<div style="float:left;width:45%;text-align: left;">
			<span  style="padding-left:10px;font-weight:bold"><?php echo $lang_recived_by;?>: <?php echo $row['user_priel'];?></span>
			<span  style="padding-left:10px;">............</span>
		</div>
					
		<div style="float:left;width:45%;text-align: right;">
			<span  style="padding-left:10px;font-weight:bold"><?php echo $lang_client;?>: <?php echo $row['client_name'];?></span>
			<span  style="padding-left:10px;">.............</span>
		</div>					
	</div>

	<br />
	<div  style="float:left;width:100%;border-top:2px dotted black;"><b><?php echo $lang_client_cut;?></b></div>
	<!--div class="spacer"></div-->
	<div class="prnt1" style="position: relative;">
		<div class="prnt2"><b><?php echo $firm;?></b></div>
		<div class="prnt3" style="position: absolute;right:4%;">
			<div style="font-weight:bold"><?php echo $lang_serv_c;?></div>
			<div><span><?=$lang_num.':&nbsp;'?></span><span style='font-weight:bold'><?=$row['id'].'&nbsp;/&nbsp;'.$row['date_p']?></span></div>
			<div><span><?=$lang_priority;?>:&nbsp;</span><span style='font-weight:bold'><?=$lang_serv_prior[$row['priority']];?></span></div>
			<?if($row['claim_number']){
				echo "<div>".$lang_claim_number_short.": ".$row['claim_number']."</div>\r\n";
			}?>
		</div>
		<div class="address">
			<?php echo $address;?><br/><?echo $url_addr.' - '.$lang_check_status.' '.$row['id'].' '.$lang_and.' '.$lang_telephone1.' '.preg_replace('/\\D/','',$row['telephone']);?>
		</div>	
	<!--div class="spacer"></div-->
	</div>
	<div class="spacer"></div>
		<div style="width:100%;">
					
		<div style="float:left;width:90%;text-align: left;">
			<div  style="float:left;width:100%;padding-left:10px;"><b><?php echo $lang_item_recieved;?>:</b></div>
			<div  style="float:left;width:100%;padding-left:10px;"><b><?php echo $lang_description;?>:</b><?php echo $row['product'];?></div>
			<div  style="float:left;width:100%;padding-left:10px;"><b><?php echo $lang_serial_no;?>:</b><?php echo $row['serial'];?></div>
			<div  style="float:left;width:100%;padding-left:10px;"><b><?php echo $lang_rep_type;?>:</b> <?php echo $serv_type;?></div>
		</div>
		<div style="clear:both;"></div>			
					
	</div>
	<br />
	<div style="clear:both;"></div>
	<!--div style="width:100%;">
		<div style="float:left;width:45%;text-align: left;">
			<div  style="float:left;width:100%;padding-left:10px;"><b><?php echo $lang_recived_by;?>: <?php echo $row['user_priel'];?></b></div><div class="spacer"></div>
			<div  style="float:left;width:100%;padding-left:10px;">............</div>
		</div>
					
		<div style="float:left;width:45%;text-align: right;">
			<div  style="float:left;width:100%;padding-left:10px;"><b><?php echo $lang_client;?>: <?php echo $row['client_name'];?></b></div><div class="spacer"></div>
			<div  style="float:left;width:100%;padding-left:10px;">.............</div>
			
		</div>
	</div-->
	<div style="width:100%;padding-bottom:4ex">
		<div style="float:left;width:45%;text-align: left;">
			<span  style="padding-left:10px;font-weight:bold"><?php echo $lang_recived_by;?>: <?php echo $row['user_priel'];?></span>
			<span  style="padding-left:10px;">............</span>
		</div>
					
		<div style="float:left;width:45%;text-align: right;">
			<span  style="padding-left:10px;font-weight:bold"><?php echo $lang_client;?>: <?php echo $row['client_name'];?></span>
			<span  style="padding-left:10px;">.............</span>
		</div>					
	</div>
	
	<div style="float:left;width:100%;text-align: left;font-size:9px;"><a title=" Print this page" href=" #" onclick=" window.print()" ><?php echo $lang_pcservice_adv;?></a></div>
	<div style="clear:both;"></div>
	</div>
    
 </div>
