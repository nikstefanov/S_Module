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
if (!($_GET['id'])){die($lang_page_gone);}
$id=$_GET['id'];
// $res=$GLOBALS['conn']->query("SELECT * FROM pcservice WHERE id='$id'");
// if (!$res){die($GLOBALS['conn']->error);}
// $row=$res->fetch_array();
// $id1=$row['client'];
// $res1=$GLOBALS['conn']->query("SELECT * FROM users WHERE id='$id1'");
// if (!$res1){die($GLOBALS['conn']->error);}
// $row1=$res1->fetch_array();
$row=get_card($id,false);
if ($row['brand_name']=='Computer Market'){
	$firm=$firm_c;
	$address=$address_c;
	$url_addr=$url_addr_c;
}elseif($row['brand_name']=='Leader Technologies'){
	$firm=$firm_l;
	$address=$address_l;
	$url_addr=$url_addr_l;
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
//if(!$_GET['hidd']){
?><link href="css.css" rel="stylesheet" type="text/css" />
<div id="content">

	<div class="prnt1">
			<div class="prnt2"><b><?php echo $firm;?></b><br />
												<div class="address"><?php echo $address;?><br/><?php echo $url_addr;?></div> </div>
			<div class="prnt3"><b><?php echo $lang_serv_c;?></b><br /><?php echo $lang_num;?>:<b><?php echo $row['id'];?>/<?php echo $row['date_p'];?></b></div>
	
	<div class="spacer"></div>
	</div>
	<div class="spacer"></div>
	<div  style="float:left;width:100%;border-top:1px dotted black;"></div>
	<div class="prnt6"><div class="prnt4"><?php echo $lang_client;?> :</div><div class="prnt5"><b><?php echo $row['name'];?></b></div></div>
	<div class="prnt6"><div class="prnt4"><?php echo $lang_telephone;?>:</div><div class="prnt5"><b><?php echo $row['telephone'];?></b></div></div>
	<div  style="float:left;width:100%;border-top:1px dotted black;"></div>
	<div class="spacer"></div>
	<div style="width:100%;background:#EBEDEC">
	<div  style="float:left;width:100%;border-top:1px dotted black;"></div>
		<div style="float:left;width:45%;text-align: left;">
			<div  style="float:left;width:100%;padding-left:10px;"><h3><?php echo $lang_descr_problem;?>:</h3></div>
			<div  style="float:left;width:100%;padding-left:10px;"><?php echo $row['problem'];?></div>
		</div>
					
		<div style="float:left;width:45%;text-align: left;">
			<div  style="float:left;width:100%;padding-left:10px;"><h3><?php echo $lang_item_recieved;?>:</h3></div>
			<div  style="float:left;width:100%;padding-left:10px;"><b><?php echo $lang_description;?>:</b><?php echo $row['product'];?></div>
			<div  style="float:left;width:100%;padding-left:10px;"><b><?php echo $lang_serial_no;?>:</b><?php echo $row['serial'];?></div>
		</div>
					
		<div  style="float:left;width:100%;border-top:1px dotted black;"></div>			
	</div>
	<div class="spacer"></div>
	<div style="width:100%;padding-left:10px;float:left;"><b><?php echo $lang_rep_type;?>:</b></div>
	<div style="width:100%;padding-left:10px;float:left;"><?php echo $serv_type;?></div>
	<div class="spacer"></div>
	
	<br clear="all"/>
	<form method="POST" action="index.php?link=prnt_p" style="text-align:center;">
		<table id="p_table">
			<colgroup>
				<col style="width=20%"/>
				<col style="width=30%"/>
				<col style="width=20%"/>
				<col style="width=30%"/>
			</colgroup>
			<tr>
				<td colspan="3">
					<?$res_array=array_from_table("name","login","active".($_SESSION['admin']?"":" AND office=".$_SESSION['office']));					
					//if(is_array($res_array) && count($res_array) > 0){
						echo $lang_tech_user;echo":&nbsp;&nbsp;";
						echo "<select name='user'>\r\n";
							foreach($res_array as $login){
								echo "<option value='".$login['name']
									.(($login['name']===$row['user'] || (empty($row['user']) && $login['name']===$_SESSION['user']))?"' selected>":"'>")
									.$login['name']."</option>\r\n";
							}
							echo "<option value='".$lang_non_hosted_service_2."'>".$lang_non_hosted_service_2."</option>\r\n";
						echo "</select>\r\n";
					//}?>					
				</td>
				<td colspan="1" style="text-align:center;">
					<?=$lang_date?>:<b><?php echo date('Y-m-d');?><input type="hidden" name="date_r" value="<?php echo date('Y-m-d');?>"/></b>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<?php echo $lang_problem_user;?>:<br />
					<textarea name="constat" cols="40" rows="10" id="constat_textarea"><?php echo $row['constat'];?></textarea>
				</td>
				<td colspan="2">					
					<?php echo $lang_solution;?>:<br />
					<textarea name="solved" cols="40" rows="10" id="solved_textarea"><?php echo $row['solved'];?></textarea>
				</td>
			</tr>
			<tr>
				<td>
					<?php echo $lang_guarantee_swap;?>
				</td>
				<td>
					<input type='checkbox' name='guarantee_swap' id='guarantee_swap' value='1' onchange="enable_swap_serial(this.checked)" <?if ($row['guarantee_swap']){echo 'checked';}?>/>
				</td>
				<td>
					<?echo $lang_swap_serial;?>:
				</td>
				<td><!--<span style="display:<?php echo (($row['swap'])?'inline':'none');?>" id="swap_serial_cell">-->
					<input type="text" name="swap_serial" id="swap_serial" pattern=".{4,}" title="The serial number of the new aticle. At least 4 symbols." size="12" value="<?=$row['swap_serial']?>" <?if($row['guarantee_swap']){echo 'required';}else{echo 'disabled';}?>/>
				</td>
			</tr>
			<tr>
				<td>					
				</td>
				<td>					
				</td>
				<td>
					<?php echo $lang_guarantee_note;?>:
				</td>
				<td>
					<input type="number" name="guarantee_note" value="<?php echo is_numeric($row['guarantee_note'])?$row['guarantee_note']:0;?>" min="0" size="5"/>&nbsp;<?=$lang_months_short?>
				</td>
			</tr>
			<tr>
				<td>
					<?php echo $lang_price_labour;?>:
				</td>
				<td>
					<input type="number" step=0.01 min="0" id="price_labour" name="price_labour" value="<? echo is_numeric($row['price'])?$row['price']:0; ?>" size="12" onchange="set_total_price()" style="text-align:right;"/>&nbsp;<?=$lang_levs_short?>
				</td>
				<td/>
				<td/>
			</tr>
			<tr>
				<td>
					<?php echo $lang_price_materials;?>:
				</td>
				<td>
					<input type="number" step=0.01 min="0" id="price_materials" name="price_materials" value="<?php echo is_numeric($row['price_materials'])?$row['price_materials']:0;?>" size="12" onchange="set_total_price()" style="text-align:right;"/>&nbsp;<?=$lang_levs_short?>
				</td>
				<td colspan=2>
					<?php echo $lang_total_price;?>:
				
					<span id="total_price" style="margin-left:1ex;"><? echo (is_numeric($row['price'])?$row['price']:0) + (is_numeric($row['price_materials'])?$row['price_materials']:0);?></span>&nbsp;<?=$lang_levs_short?>
				</td>
			</tr>			
			<tr>
				<td colspan="4" style="text-align:center;">
					<input type="hidden" name="id" value="<?php echo $id;?>"/>				
					<input type="hidden" name="active" value="2"/>
					<input type="submit"  value="<?php echo $lang_ok;?>" style="margin-top:2em;margin-bottom:6ex;"/>
				</td>
			</tr>
		</table>
	
	</form>
						
	<!--div style="color:firebrick;margin-top:4ex;">Промяна: Нов ред с "Enter", а не с ";".</div-->
	
<div style="clear:both"></div>	
	

<?php
	// }
	// if($_GET['hidd']=='1'){
		////unkonwn case!
		// $date_r=rep_q($_GET['date_r']);
		// $active=$_GET['active'];
		// $price=rep_q($_GET['price']);
		// $solved=rep_q($_GET['solved']);
		// $constat=rep_q($_GET['constat']);
		// $guarantee_note=rep_q($_GET['guarantee_note']);
		// $user=rep_q($_SESSION['user']);
		// $cons=str_replace(';','<br/>',$constat);
		// $solv=str_replace(';','<br/>',$solved);
		
		
		// $innsert=$GLOBALS['conn']->query("UPDATE pcservice SET date_r='$date_r',active='$active',price='$price',solved='$solv',constat='$cons',guarantee_note='$guarantee_note',user='$user' WHERE id=$id");
		// if(!$innsert){die($GLOBALS['conn']->error);}
	// }
	
	
	
?>
</div>
</div>
<!--
		<div style="float:left;width:90%;margin-bottom:1ex;margin-top:1ex;">
			<?php echo $lang_date_end_rep;?>:<b><?php echo date('Y-m-d');?><input type="hidden" name="date_r" value="<?php echo date('Y-m-d');?>"/></b>
		</div>
		<div style="float:left;width:45%;margin-bottom:1ex;margin-top:1ex;">
			<?php echo $lang_problem_user;?>:<br />
			<textarea name="constat" cols="40" rows="10"><?php echo $row['constat'];?></textarea>
		</div>		
			
		<div style="float:left;width:45%;margin-bottom:1ex;margin-top:1ex;">
			<?php echo $lang_solution;?>:<br />
			<textarea name="solved" cols="40" rows="10"><?php echo $row['solved'];?></textarea>
		</div>
			
		<div style="float:left;width:45%;margin-bottom:1ex;margin-top:1ex;">
			<?php echo $lang_rep_price;?>:<input type="text" name="price" value="<?php echo $row['price'];?>"/>лв.
		</div>			
		
		<div style="float:left;width:45%;margin-bottom:1ex;margin-top:1ex;">
			<?php echo $lang_guarantee_note;?>:<input type="text" name="guarantee_note" value="<?php echo $row['guarantee_note'];?>"/>мес.
		</div>			
			
			<div >
				<input type="hidden" name="id" value="<?php echo $id;?>"/>				
				<input type="hidden" name="active" value="2"/>
				<input type="submit"  value="<?php echo $lang_ok;?>"/>
			</div>
			<br clear="all"/>
			-->
<script language="javascript"> 
	var swap_serial_input = document.getElementById("swap_serial");
	//var swap_serial_cell = document.getElementById("swap_serial_cell");
	
	function enable_swap_serial(ckd){
		if(ckd){
			//swap_serial_cell.style.display="inline";
			swap_serial_input.disabled=false;
			swap_serial_input.required=true;
			swap_serial_input.value="";
		}else{
			//swap_serial_cell.style.display="none";
			swap_serial_input.disabled=true;
			swap_serial_input.required=false;
			swap_serial_input.value="";
		}
	}
	
	Number.prototype.round = function(places) {
		return +(Math.round(this + "e+" + places)  + "e-" + places);
	}
	
	function set_total_price(){
		var total = document.getElementById("total_price");
		var pr_labour = document.getElementById("price_labour").value;
		var pr_materials = document.getElementById("price_materials").value;
		
		total_price = (isNaN(Number(pr_labour))?0:Number(pr_labour)) + (isNaN(Number(pr_materials))?0:Number(pr_materials));
		total.innerHTML = total_price.round(2);
	}
</script>
