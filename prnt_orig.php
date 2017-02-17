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
if (!($_POST['id'])){die("$lang_page_gone");}
//include 'conf/conn.php';
//include 'conf/settings.php';
//include 'functions.php';
$id=$_POST['id'];
$res=mysql_query("SELECT * FROM pcservice WHERE id='$id'");
if (!$res){die(mysql_error());}
$row=mysql_fetch_array($res);
$id1=$row['client'];
$res1=mysql_query("SELECT * FROM users WHERE id='$id1'");
if (!$res1){die(mysql_error());}
$row1=mysql_fetch_array($res1);
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
<div id="print">
<div class="border">
	<div class="prnt1">
			<div class="prnt2"><b><?php echo $firm;?></b><br />
<div class="address">
												<?php echo $town;?>, <?php echo $address;?>,<?php echo $lang_tel;?>: <?php echo $tel;?> <br /></div> </div>
			<div class="prnt3"><b><?php echo $lang_serv_c;?></b><br /><?php echo $lang_num;?>:<b><?php echo $row['id'];?>/<?php echo $row['date_p'];?></b></div>
	
	<div class="spacer"></div>
	</div>
	<!--div class="spacer"></div-->
	<div  style="float:left;width:100%;"><!--border-top:1px solid black--></div>
	<div class="prnt6"><div class="prnt4"><?php echo $lang_client;?> :</div><div class="prnt5"><b><?php echo $row1['name'];?></b></div></div>
	<div class="prnt6"><div class="prnt4"><?php echo $lang_telephone;?>:</div><div class="prnt5"><b><?php echo $row1['telephone'];?></b></div></div>
	<div  style="float:left;width:100%;border-top:1px solid black;"></div>
	<!--div class="spacer"></div-->
	<div style="width:100%;">
	<div  style="float:left;width:100%;border-top:1px solid black;"></div>
		<div style="float:left;width:55%;text-align: left;">
			<div  style="float:left;width:100%;padding-left:10px;"><h3><?php echo $lang_descr_problem;?>:</h3></div>
			<div  style="float:left;width:100%;padding-left:10px;"><?php echo $row['problem'];?></div>
			<div  style="float:left;width:100%;padding-left:10px;"><br /><b><?php echo $lang_outlook;?>:</b><br /><?php echo $row['outlook'];?></div>
		</div>
					
		<div style="float:left;width:35%;text-align: left;">
			<div  style="float:left;width:100%;padding-left:10px;"><h3><?php echo $lang_item_recieved;?>:</h3></div>
			<div  style="float:left;width:100%;padding-left:10px;"><b><?php echo $lang_description;?>:</b><?php echo $row['product'];?></div>
			<div  style="float:left;width:100%;padding-left:10px;"><b><?php echo $lang_brand;?>:</b><?php echo $row['brand'];?></div>
			<div  style="float:left;width:100%;padding-left:10px;"><b><?php echo $lang_model;?>:</b><?php echo $row['model'];?></div>
			<div  style="float:left;width:100%;padding-left:10px;"><b><?php echo $lang_serial_no;?>:</b><?php echo $row['serial'];?></div>
		</div>
					
		<div  style="float:left;width:100%;border-top:1px solid black;"></div>			
	</div>
	<div class="spacer"></div>
	<div style="width:45%;padding-left:10px;float:left;"><b><?php echo $lang_rep_type;?>:</b><br /><?php echo $serv_type;?></div>
	<div style="width:45%;padding-left:10px;float:left;"><b><?php echo $lang_guarantee_flag;?>: <?php if($row['guarantee']==1) echo 'Да'; else echo 'Не'; ?></b><br />номер: <?php echo $row['guarantee_num'];?></div>
	<div class="spacer"></div>
	<div style="clear:both;"></div>
	<div style="width:789px; border-top:1px solid; border-bottom: 1px solid; text-align: left; font-size:12px;padding-left:10px;"><b><?php echo $lang_important_txt;?></b>: <?php echo $lang_cli_text;?></div><br />
	<div class="spacer"></div>
	<div style="width:100%;">
		<div style="float:left;width:45%;text-align: left;">
			<div  style="float:left;width:100%;padding-left:10px;"><b><?php echo $lang_recived_by;?>: <?php echo $row['user'];?></b></div><div class="spacer"></div>
			<div  style="float:left;width:100%;padding-left:10px;">............</div>
		</div>
					
		<div style="float:left;width:45%;text-align: right;">
			<div  style="float:left;width:100%;padding-left:10px;"><b><?php echo $lang_client;?>: <?php echo $row1['name'];?></b></div><div class="spacer"></div>
			<div  style="float:left;width:100%;padding-left:10px;">.............</div>
		<div class="spacer"></div>	
			
		</div>
					
					
	</div>
		<div class="spacer"></div>
	<br />
	<div  style="float:left;width:100%;border-top:2px dotted black;"><b><?php echo $lang_client_cut;?></b></div>
	<div class="spacer"></div>
<div class="prnt1">
			<div class="prnt2"><b><?php echo $firm;?></b><br />
												<div class="address"> <?php echo $town;?>, <?php echo $address;?>,<?php echo $lang_tel;?>: <?php echo $tel;?></div> </div>
			<div class="prnt3"><b><?php echo $lang_serv_c;?></b><br /><?php echo $lang_num;?>:<b><?php echo $row['id'];?>/<?php echo $row['date_p'];?></b></div>
	
	<div class="spacer"></div>
	</div><div class="spacer"></div>
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
	<!--div style="width:789px;background:#E1FBF1;border-top:1px solid; border-bottom: 1px solid; font-size:12px;padding:5px;"><b></*?php echo $lang_important_txt;?></b>: </*?php echo $lang_cli_text;?></div><br /-->
	<div style="clear:both;"></div>
	<div style="width:100%;">
		<div style="float:left;width:45%;text-align: left;">
			<div  style="float:left;width:100%;padding-left:10px;"><b><?php echo $lang_recived_by;?>: <?php echo $row['user'];?></b></div><div class="spacer"></div>
			<div  style="float:left;width:100%;padding-left:10px;">............</div>
		</div>
					
		<div style="float:left;width:45%;text-align: right;">
			<div  style="float:left;width:100%;padding-left:10px;"><b><?php echo $lang_client;?>: <?php echo $row1['name'];?></b></div><div class="spacer"></div>
			<div  style="float:left;width:100%;padding-left:10px;">.............</div>
			
		</div>
					
					
	</div>	
	<div style="float:left;width:100%;text-align: left;font-size:9px;"><a title=" Print this page" href=" #" onclick=" window.print()" ><?php echo $lang_pcservice_adv;?></a></div>
	<div style="clear:both;"></div>
	</div>
    
 </div>