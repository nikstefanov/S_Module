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
$arrObjects = get_field_arr_table('nickname_'.$lang_code,'offices');
if ($_POST['id']) {
// }elseif ($_POST['action'] == 'UPDATE') {
	$row = update_card(
		$_POST['id'],
		$_POST['active'],
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
		$_POST['sendto'],
		$_POST['send_returned'],
		$_POST['send_courier'],
		$_POST['send_doc_no'],
		$_POST['status_note'],
		$_POST['client2'], $_POST['telephone'], $_POST['telephone_2'],
		$_POST['claim_number'],
		$_POST['login_os'],
		$_POST['login_username'],
		$_POST['login_password'],
		$_POST['pre_active']
		
	);
}
	
	if(!$_GET['act']) {$act=1;}else {$act=$_GET['act'];}
	if(!$_GET['user']) {$user='';} else {$user=escape($_GET['user']);}
	if(!$_GET['product']){ $product='';} else{ $product=escape($_GET['product']);}
	if(!$_GET['id']) {$id=''; }else {$id=escape($_GET['id']);}
	if(!$_GET['date_p']) {$date_p=''; }else{ $date_p=escape($_GET['date_p']);}
	//if(!$_GET['office']) {$office='';} else {$office=escape($_GET['office']);}
	$office=$_GET['office'];
	if(!$_GET['guarantee']) {$guarantee=0;}else{$guarantee=$_GET['guarantee'];}
	if(!$_GET['guarantee_swap']) {$guarantee_swap=0;}else{$guarantee_swap=$_GET['guarantee_swap'];}
	if(!$_GET['serial']) {$serial='';}else{$serial=escape($_GET['serial']);}
	if(!$_GET['client']) {$client='';}else{$client=escape($_GET['client']);}
	if(!$_GET['telephone']) {$telephone='';}else{$telephone=escape($_GET['telephone']);}
	if(!$_GET['brand']) {$brand='';}else{$brand=escape($_GET['brand']);}
	if(!$_GET['model']) {$model='';}else{$model=escape($_GET['model']);}
	if(!$_GET['sendto']) {$sendto='';}else{$sendto=escape($_GET['sendto']);}
	if(!$_GET['returned']) {$returned=0;}else{$returned=$_GET['returned'];}
	if(!$_GET['checked']) {$checked=0;}else{$checked=$_GET['checked'];}
	if (!$_GET['page']) {$page = 1;} else {$page=$_GET['page'];}
	if (!($limit)){$limit = 10;}
	//echo "guarantee:".$guarantee.'<br/>';

?>
<div class="tursene"><?php echo $lang_search_title;?></div>

<table id="search_fil">
<tr><form method="GET" action="index.php?link=search">
	<input type="hidden" name="link" value="search" />
	
	
</tr>
<tr>
	<td><?php echo $lang_tech_user;?>:</td>
	<td><?php echo $lang_item_recieved;?>:</td>
    <td><?php echo $lang_model;?>:</td>
    <td><?php echo $lang_card_num;?>:</td>
	<td><?php echo $lang_client;?>:</td>
    <td><?php echo $lang_stat;?>:</td>
	<td><?php echo $lang_guarantee_flag;?>:</td> 
    <!--<td><?php echo $lang_description;?>:</td>-->
    <td><?php echo $lang_returned;?>:</td>
	<td></td>
</tr>   
<tr>
	<td id="technik">
		<?$res_array=array_from_table("name","login","active".($_SESSION['admin']?"":" AND office=".$_SESSION['office']));										
			echo "<select name='user'>\r\n";
			echo "<option value=''".($user===''?' selected':'')."/>\r\n";
			foreach($res_array as $row){
				echo "<option value='".$row['name'].(($row['name']===$user)?"' selected>":"'>").$row['name']."</option>\r\n";
			}			
			echo "</select>\r\n";
		?>			
	</td>
	<td>
    <select name="product">
		<option value=""<?if($product=='') echo ' selected ';?>/>
		<?php foreach($product_array as $pr) {
			$selected = ($product==$pr)?' selected ':'';
			echo "<option value='".$pr."'".$selected.">".$pr."</option>\r\n";
		}?>
    </select>
    </td>
	<td><input type="text" name="model" value="<?=$model;?>"/></td>
	<td><input type="text" name="id" value="<?=$id;?>"/></td>
	<td><input type="text" name="client" value="<?=$client;?>"/></td>
    <td id="status"><select name="act">
		<option value="1" <?if ($act=='1') echo 'selected';?> ><?php echo $lang_stat_all;?></option>
		<option value="2" <?if ($act=='2') echo 'selected';?> ><?php echo $lang_stat_open;?></option>
		<option value="4" <?if ($act=='4') echo 'selected';?> ><?php echo $lang_stat_repairing;?></option>
		<option value="3" <?if ($act=='3') echo 'selected';?> ><?php echo $lang_stat_closed;?></option>
	</select></td>
	<td><select name="guarantee">
		<option value="0" <? if($guarantee=='0') echo ' selected '; ?>/>
		<option value="1" <? if($guarantee=='1') echo ' selected '; ?>><?=$lang_no?></option>
		<option value="2" <? if($guarantee=='2') echo ' selected '; ?>><?=$lang_yes?></option>
	</select></td>
	<td>
		<select name="returned">
			<option value="0" <? if($returned=='0') echo ' selected '; ?>/>
			<option value="1" <? if($returned=='1') echo ' selected '; ?>><?=$lang_no?></option>
			<option value="2" <? if($returned=='2') echo ' selected '; ?>><?=$lang_yes?></option>
		</select>
	</td>
	<td><input type="submit" value="<?php echo $lang_filter;?>"/></td>
</tr>
<tr>
	<td><?php echo $lang_object;?>:</td>
    <td><?php echo $lang_brand;?>:</td>
	<td><?php echo $lang_serial_no;?>:</td>
	<td><?php echo $lang_date;?>:</td>
	<td><?php echo $lang_tel;?>:</td>
    <td style='white-space: nowrap;'><?php echo $lang_non_hosted_service;?>:</td>   
    <td><?=$lang_swapped?>:</td>
	<td><?if($_SESSION['admin']){echo $lang_checked.':';}?></td>
	<td></td>
</tr> 
<tr>
	<td>
	<?if($_SESSION['admin']){?>
    <select name="office">
    	<option value=""<?if(!$office) echo ' selected ';?>/>
    	<? for( $i=0; $i<count($arrObjects); $i++ ){ ?>
    	<option value="<?=($i+1)?>"<?if($office==($i+1)) echo ' selected ';?>><?=$arrObjects[$i]?></option>
        <? } ?>
    </select>
	<?}else{
		echo $arrObjects[$_SESSION['office']-1];
		//echo "<input type='hidden' name='office' value='".$_SESSION['office']."' />\r\n";
	}
	?>
	</td>	
    <td>
		<select name="brand">
			<option value=""<?if($brand=='') echo ' selected ';?>/>
			<?php foreach($brand_array as $br) {
				$selected = ($brand==$br)?' selected ':'';
				echo "<option value='".$br."'".$selected.">".$br."</option>\r\n";
			}?>
		</select>
	</td>    
    <td><input type="text" name="serial" value="<?=$serial;?>"/></td>
	<td><input type="date" name="date_p" value="<?=$date_p;?>" pattern="20\d{2}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01])" title="The date in format 'yyyy-mm-dd'."/></td>
    <td><input type="text" name="telephone" value="<?=$telephone;?>"/></td>
	<td>
		<select name="sendto">
			<option value="" <?if ($sendto=='') echo 'selected';?> />
			<option value="<?=$lang_sent?>" <?if ($sendto===$lang_sent) echo 'selected';?>><?=$lang_sent?></option>
			<option value="<?=$lang_in_host?>" <?if ($sendto===$lang_in_host) echo 'selected';?>><?=$lang_in_host?></option>			
			<? foreach($sendto_array as $value){ ?>
				<option value="<?=$value?>" <?=(($value==$sendto)?'selected':'')?>>
					<?=$value?>				
				</option>
			<? } ?>
		</select>
	</td>
    <td>
		<select name="guarantee_swap">
			<option value="0" <? if($guarantee_swap=='0') echo ' selected '; ?>/>
			<option value="1" <? if($guarantee_swap=='1') echo ' selected '; ?>><?=$lang_no?></option>
			<option value="2" <? if($guarantee_swap=='2') echo ' selected '; ?>><?=$lang_yes?></option>
		</select>
	</td>
	<td><?if($_SESSION['admin']){?>
		<select name="checked">
			<option value="0" <? if($checked=='0') echo ' selected '; ?>/>
			<option value="1" <? if($checked=='1') echo ' selected '; ?>><?=$lang_no?></option>
			<option value="2" <? if($checked=='2') echo ' selected '; ?>><?=$lang_yes?></option>
		</select>
		<?}?>
	</td>
	<td></td>
</tr> </form>
</table>
<?php

		
		
	if ($client!='' || $telephone!=''){			
		$getcl=$GLOBALS['conn']->query(
			"SELECT * FROM users WHERE name LIKE '%$client%' AND telephone LIKE '%$telephone%'");
		if(!$getcl){die($GLOBALS['conn']->error()."where client");}
		$cond_c=" AND (client LIKE '% %'";
		while ($row1=$getcl->fetch_array()){
			$cond_c=$cond_c." OR client='".$row1['id']."'";
		}
		$cond_c=$cond_c.")";
	}else{
		$cond_c='';
	}
	
	if($id!=''){
		$cond_id=" AND id='$id'";
	}else{
		$cond_id='';
	}
	
	if($date_p!=''){
		$cond_dp=" AND date_p='$date_p'";
	}else{
		$cond_dp='';
	}
	
	// if($object!=''){
		// $cond_obj=" AND object='$object'";
	// }
	// else{
		// $cond_obj='';
	// }
	
	if($office && $_SESSION['admin']){
		$cond_off=" AND office='$office'";
	}elseif(!$office && $_SESSION['admin']){
		$cond_off='';
	}else{
		$cond_off=" AND office='".$_SESSION['office']."'";
	}
	
	if($guarantee){
		$cond_grnt=" AND guarantee=".($guarantee-1);
	}else{
		$cond_grnt='';
	}
	
	if($guarantee_swap){
		$cond_grnt_swp=" AND guarantee_swap=".($guarantee_swap-1);
	}else{
		$cond_grnt_swp='';
	}
	
	if($user!=''){
		$cond_us=" AND user='$user'";
	}else{
		$cond_us='';
	}
	
	if($serial!=''){
		$cond_sn=" AND (serial LIKE '%$serial%' OR swap_serial LIKE '%$serial%')";
	}else{
		$cond_sn='';
	}
	
	if($product!=''){
		$cond_pd=" AND product LIKE '%$product%'";
	}else{
		$cond_pd='';
	}
	
	if($brand!=''){
		$cond_brand=" AND brand = '$brand'";
	}else{
		$cond_brand='';
	}
	
	if($model!=''){
		$cond_model=" AND model LIKE '%$model%'";
	}else{
		$cond_model='';
	}
	
	if(!$sendto){
		$cond_sendto='';		
	}elseif($sendto===$lang_sent){
		$cond_sendto=" AND (LENGTH(sendto)>0) AND !send_returned";
	}elseif($sendto===$lang_in_host){
		$cond_sendto=" AND (LENGTH(sendto)=0 OR send_returned)";
	}else{
		$cond_sendto=" AND sendto LIKE '$sendto' AND !send_returned";
	}
	
	if($returned){
		$cond_returned=" AND status=".($returned-1);
	}else{
		$cond_returned='';
	}
	
	if($checked){
		$cond_checked=" AND checked=".($checked-1);
	}else{
		$cond_checked='';
	}
	
	if($act=='1'){
		$cond_a="active > '0'";
	}elseif($act=='2'){
		$cond_a="active='1'";
	}elseif($act=='3'){
		$cond_a="active='2'";
	}elseif($act=='4'){
		$cond_a="active='3'";
	}else{
		$cond_a="active > '0'";
	}
 //echo $cond_grnt.'<br/>';
//echo "SELECT * FROM pcservice WHERE $cond_a $cond_id $cond_dp $cond_off $cond_us $cond_sn $cond_pd $cond_brand $cond_model $cond_grnt $cond_grnt_swp $cond_c ORDER BY id DESC<br/>";
$res_count = $GLOBALS['conn']->query("SELECT * FROM pcservice WHERE $cond_a $cond_id $cond_dp $cond_off $cond_us $cond_sn $cond_pd $cond_brand $cond_model $cond_sendto $cond_grnt $cond_grnt_swp $cond_c $cond_returned $cond_checked ORDER BY id DESC");
if(!$res_count){die($GLOBALS['conn']->error . "where cond");}
//echo $res_count->num_rows.'<br/>';
if ($res_count->num_rows == 0){
	echo  $lang_no_results; 
}else{	
	$total_pages = ceil($res_count->num_rows / $limit);
    $res_count->data_seek(($page-1) * $limit);	
?>
		
		<table border="1">
			<tr valign='middle'>
				<td width="3%"><?php echo $lang_num;?>:</td>
				<td width="5%"><?php echo $lang_date;?>:</td>
				<td width="15%"><?php echo $lang_client;?>:</td>
				<td width="13%"><?php echo $lang_item_recieved;?>:</td>
				<td width="13%"><?php echo $lang_brand;?>:</td>
				<td width="17%"><?php echo $lang_problem;?>:</td>
				<td width="13%"><?php echo $lang_non_hosted_service_2;?>:</td>
				<td colspan="7" ><?php echo $lang_action_cli;?>:</td>			
			</tr>
			
<?php
	
	for ($ii=0;$ii<min($limit, $res_count->num_rows-($page-1)*$limit);$ii++){
		$row=$res_count->fetch_array();

    if($row['active']!='2'){
		$promeni_op= "<form method='GET' action='index.php'><input type='hidden' name='link' value='edit'/><input type='hidden' name='id' value='".$row['id']."'/><input type='submit' value='".$lang_change_cli."'/></form>";
        $closed_op="<form method='GET' action='index.php'><input type='hidden' name ='link' value='close' /><input type='hidden' name='id' value='".$row['id']."'/><input type='submit' value='".$lang_close_cli."'/></form>";
    }
    else{
		$promeni_op= ($_SESSION['admin']==1)?"<form method='GET' action='index.php'><input type='hidden' name='link' value='edit'/><input type='hidden' name='id' value='".$row['id']."'/><input type='submit' value='".$lang_change_cli."'/></form>":'';
		$closed_op=$lang_ord_stat2;
	}
	
	if($row['status']=='0'){
        	$status_op=(($row['active']==2)?"<form method='GET' action='index.php'><input  type='hidden' name='link' value='izdai' /><input type='hidden' name='id' value='".$row['id']."'/><input type='submit' value='".$lang_status."'/></form>":"");
	}elseif($row['date_returned'] != '0000-00-00'){
		$status_op=$row['date_returned'];
	}else{
		$status_op=$lang_ord_izd2;
	}
	
    if($row['checked']!=1){
        $check_op="<form method='GET' action='index.php'><input type='hidden' name='link' value='check' /><input type='hidden' name='id' value='".$row['id']."'/><input type='submit' value='".$lang_check."'/></form>";
    }
    else{$check_op=$lang_ord_check;}
	
    if($row['date_r']!='0000-00-00'){
        $closed_pr="<form method='GET' action='index.php'><input type='hidden' name='link' value='prnt_p' /><input type='hidden' name='id' value='".$row['id']."'/><input type='submit' value='".$lang_protocol."'/></form>";
    }
    else{$closed_pr=$lang_ord_stat1;}

	$sendto_value = $row['sendto'];
	if(strlen($row['sendto'])===0 || $row['send_returned']){$sendto_value=""/*$lang_in_host*/;}


		echo "<tr valign='middle'><td>".$row['id']."</td><td style='white-space:nowrap;'>".$row['date_p']."</td><td>";
		getcl($row['client']);
		echo "</td><td>".$row['product']."</td><td>".$row['brand']."</td><td>".$row['problem']."</td><td>".$sendto_value."</td><td>".$promeni_op."</td><td>".$closed_op."</td><td><form method='GET' action='index.php'><input type='hidden' name='link' value='prnt'/><input type='hidden' name='id' value='".$row['id']."'/><input type='submit' value='".$lang_card."'/></form></td><td>".$closed_pr."</td><td style='text-align: center; white-space: nowrap;'>".$status_op."</td>".(($_SESSION['admin']==1)?"<td><form method='GET' action='index.php'><input type='hidden' name='link' value='delete' /><input type='hidden' name='id' value='".$row['id']."'/><input type='submit' value='".$lang_delete."'/></form></td><td style='text-align: center;'>".$check_op."</td>":"")."</tr>";
	}
	echo "</table>";

	echo "<div id='pager'>".$lang_page." : ";
	echo "<span style='font-size:120%;color:#FF6600;padding-left:1%;'>".$page."</span>"."\r\n";
	echo "<span>$lang_from</span>\r\n";
	echo "<span style='font-size:120%;color:#FF6600;padding-right:1.5%;'>".$total_pages."</span>"."\r\n";
	if ($page > 1){
		echo "<form method='GET' action='index.php?link=search' style='display:inline;'>".
		pager_form_inputs(
			1,
			$act,
			$id,
			$date_p,
			$client,
			$user,
			$telephone,			
			$office,
			$product,
			$brand,
			$model,
			$sendto,
			$serial,
			$guarantee,
			$guarantee_swap,
			$returned,
			$checked,
			$lang_first
		).		  
		"</form>"."\r\n";
		echo "<form method='GET' action='index.php?link=search' style='display:inline;'>".
		pager_form_inputs(
			$page-1,
			$act,
			$id,
			$date_p,
			$client,
			$user,
			$telephone,			
			$office,
			$product,
			$brand,
			$model,
			$sendto,
			$serial,
			$guarantee,
			$guarantee_swap,
			$returned,
			$checked,
			$lang_previous
		).		
		"</form>\r\n";
	}
	if ($page < $total_pages) {
		echo "<form method='GET' action='index.php?link=search' style='display:inline;'>".
		pager_form_inputs(
			$page+1,
			$act,
			$id,
			$date_p,
			$client,
			$user,
			$telephone,			
			$office,
			$product,
			$brand,
			$model,
			$sendto,
			$serial,
			$guarantee,
			$guarantee_swap,
			$returned,
			$checked,
			$lang_next
		).		
		"</form>\r\n";
		echo "<form method='GET' action='index.php?link=search' style='display:inline;'>".
		pager_form_inputs(
			$total_pages,
			$act,
			$id,
			$date_p,
			$client,
			$user,
			$telephone,			
			$office,
			$product,
			$brand,
			$model,
			$sendto,
			$serial,
			$guarantee,
			$guarantee_swap,
			$returned,
			$checked,
			$lang_last
		).		
		"</form>\r\n";
	}
	if ($total_pages != 1) {
		echo "<form method='GET' action='index.php?link=search' style='display:inline;'>\r\n".
		"<input type='number' min='1' max='$total_pages' name='page' style='width:5%;'/>\r\n".
		pager_form_inputs(
			0,
			$act,
			$id,
			$date_p,
			$client,
			$user,
			$telephone,			
			$office,
			$product,
			$brand,
			$model,
			$sendto,
			$serial,
			$guarantee,
			$guarantee_swap,
			$returned,
			$checked,
			'-->>'
		).		
		"</form>\r\n";
	}
	echo "</div><div style='clear:both;'></div>\r\n";
	}
?>
