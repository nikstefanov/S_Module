<?
include 'conf/auth.php';
//$arrObjects = get_array_offices('bg');
$arrObjects = get_field_arr_table('nickname_'.$lang_code,'offices');

$res_array=array_from_table("name,telephone","users","LENGTH(TRIM(name)) > 0");
echo "<datalist id='telephones_list'>\r\n";
foreach($res_array as $row){
	echo "\t<option value='".$row['telephone']."'>\r\n";
}
echo "</datalist>\r\n";
echo "<datalist id='clients_list'>\r\n";
foreach($res_array as $row){
	echo "\t<option value='".$row['name']."'>\r\n";
}
echo "</datalist>\r\n";


$row=false;
if ($_GET['id']) {
	$row = get_card($_GET['id'],false);
}else{
	$row=array(
		"id"=>(get_last_card_id()+1),
		"product"=>"Лаптоп",
		"brand"=>"Друго",
		"serv_type"=>0,
		"priority"=>0,
		"guarantee"=>0,
		"object"=>'',
		'date_p'=>date('Y-m-d'),
		'active'=>1,
		'user_priel'=>$_SESSION['user'],
		'status'=>0,
		'office'=>$_SESSION['office'],
		'telephone'=>0		
	);
	$row['price_agreed']=
	$row['problem']=
	$row['client_name']=
	$row['guarantee_num']=
	$row['model']=
	$row['serial']=
	$row['outlook']=
	$row['problem']=
	$row['sendto']=
	$row['send_returned']=
	$row['send_courier']=
	$row['send_doc_no']=
	$row['status_note']=
	$row['claim_number']=
	$row['login_os']=
	$row['login_password']=
	$row['login_username']=
	'';
}
//var_dump($row);
?>
<div id="new">
<form method="POST" id ="card_form"
	action="index.php?link=<?if($_GET['id']) {echo 'search';}else{echo 'prnt';}?>">
<input type="hidden" name="action" value="<? echo (($_GET['id']) ? 'UPDATE':'INSERT');?>"/>
<?php if ($_GET['id']){
		echo "<input type='hidden' name='id' value='".$_GET['id']."'/>\r\n";
		echo "<input type='hidden' name='pre_active' value='".$row['active']."' />\r\n";
	}
?>
<table style='width:80%'>
<tr>
	<td><?php echo $lang_card_num;?>:</td>
	<td><span><?=$row['id']?></span></td>
</tr>
<? if($_GET['id']){ ?>
	<tr>
		<td><?php echo $lang_stat;?>:</td>
		<td><b><select name="active">
				<option value="1"<?if($row['active']==1)echo' selected';?>><?=$lang_active_arr[0]?></option>
				<option value="3"<?if($row['active']==3)echo' selected';?>><?=$lang_active_arr[2]?></option>
				<option value="2"<?if($row['active']==2)echo' selected';?>><?=$lang_active_arr[1]?></option>
            </select>			
		</b></td>
	</tr>
<? } ?>
<tr>
	<td><?php echo $lang_date_reg;?>:</td>
	<td><input type="date" name="date_p" value="<?=$row['date_p']?>" pattern="20\d{2}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01])" title="The date in format 'yyyy-mm-dd'." style="width:12em" required/></td>
</tr>
<tr>
	<td><?php echo $lang_object;?>:</td>
	<td><? if ($_SESSION['admin']){ ?>
    <select name="office">
		<!--<option value='' <?//if ($row['office']=='') echo 'selected';?> />-->
    	<? for( $i=0; $i<count($arrObjects); $i++ ){ ?>
			<option value="<?=($i+1)?>"<?if($row['office']==($i+1)) echo ' selected ';?>><?=$arrObjects[$i]?></option>
        <? } ?>
    </select>
	<? } else {
		echo $arrObjects[$row['office']-1]."<input type='hidden' name='office' value=".$row['office']." />";
		}
	?>
    </td>
</tr>
<tr>
	<td>
		<?php echo $lang_cli_name;?>:
	</td>
	<td>
		<div>
			<input list="clients_list" name="client2" style="width:60%" pattern="[^\v]+" title="The name of the client." value="<?=$row['client_name']?>" onchange="set_client_telephone(this.value)" required/>
			<?php echo $lang_tel;?>:
			<input list="telephones_list" name="telephone" style="width:25%" pattern="0\d{3,}" title="The phone of the client. Only digits,starting with 0. At least 4 digits." value="<?=$row['telephone']?>" onchange="tel_changed(this.value)" required/>
		</div>
		<div style='margin-top:1eX'>
			<input style="width:60%;visibility: hidden;"/>
			<?php echo "<span style='visibility: hidden;'>$lang_tel:</span>\r\n";?>
			<input name="telephone_2" style="width:25%" pattern="0\d{3,}" title="The phone of the client. Only digits,starting with 0. At least 4 digits." value="<?=$row['telephone_2']?>"/>
		</div>
	</td>
</tr>
<tr>	
	<td><?php echo $lang_guarantee_flag;?>:</td>
	<td>
		<select name="guarantee" id="guarantee" onchange="toggle2(this.selectedIndex, '', '')">
			<option value='0'><?=$lang_no?></option>
			<option value='1'><?=$lang_yes?></option>
		</select>
        &nbsp;&nbsp;
        <span id="guarantee_num_span">
			<?php echo $lang_guarantee_num;?>:
			<input type="text" name="guarantee_num" id="guarantee_num" pattern=".{3,}" title="The guarantee number.At least 3 symbols."/>
        </span>
    </td>
</tr>
<tr id='claim_number_row'>
	<td><?php echo $lang_claim_number;?>:</td>
	<td><input type="number" name="claim_number" id='claim_number_input' min="0" title="The claim number.Only digits."/></td>
</tr>
<tr>	
	<td><?php echo $lang_item_recieved;?>:<br />Вид/Марка/Модел</td>
	<td>
    <select name="product">
		<?php foreach($product_array as $pr) {
			$selected = ($row['product']==$pr)?' selected':'';
			echo "<option value='".$pr."'".$selected.">".$pr."</option>\r\n";
		}?>
	</select>
    <select name="brand">
		<?php foreach($brand_array as $br) {
			$selected = ($row['brand']==$br)?' selected':'';
			echo "<option value='".$br."'".$selected.">".$br."</option>\r\n";
		}?>
	</select>
    <input type="text" name="model" value="<?=$row['model']?>"/>
    </td>
</tr>
<tr>	
	<td><?php echo $lang_serial_no;?>:</td>
	<td><input type="text" name="serial" pattern=".{4,}" title="The serial number of the aticle. At least 4 symbols." value="<?=$row['serial']?>" required/></td>
</tr>
<tr>	
	<td><?php echo $lang_outlook;?>:</td>
	<td><textarea name="outlook" style='width:80%'><?=$row['outlook']?></textarea></td>
</tr>
<tr>	
	<td><?php echo $lang_problem;?>:</td>
	<td><textarea name="problem" style='width:80%'><?=$row['problem']?></textarea></td>
</tr>
<tr>
	<td><?php echo $lang_credentials;?>:</td>
	<td>
		<?php echo $lang_username;?>:<input type="text" name="login_username" value="<?=$row['login_username']?>" size="10" style="margin:0 1ex"/>
		<?php echo $lang_password;?>:<input type="text" name="login_password" value="<?=$row['login_password']?>" size="10" style="margin:0 1ex"/>
		<?php echo $lang_os;?>:<input type="text" name="login_os" value="<?=$row['login_os']?>" size="10" style="margin:0 1ex"/>
	</td>
</tr>
<tr>	
	<td><?php echo $lang_rep_type;?>:</td>
	<td><select name="serv_type">
			<?php for ($i = 0; $i < 4; $i++) {
				$selected = ($row['serv_type']==$i)?' selected':'';
				echo "<option value='".$i."'".$selected.">".$lang_serv_type_cond[$i]."</option>\r\n";
			}?>
		</select></td>
</tr>
<tr>	
	<td><?php echo $lang_price_agreed;?>:</td>
	<td><input type="text" name="price_agreed" value="<?=$row['price_agreed']?>"/></td>
</tr>
<tr>	
	<td><?php echo $lang_priority;?>:</td>
	<td><select name="priority">
		<?php for ($i = 0; $i < 3; $i++) {
			$selected = ($row['priority']==$i)?' selected':'';
			echo "<option value='".$i."'".$selected.">".$lang_serv_prior[$i]."</option>\r\n";
			}?>
		</select>
        </td>
</tr>
<? if($_GET['id']){ ?>
	<tr>
		<td><?php echo $lang_send_to_other;?>:</td>
		<td>
			<select name="sendto" id="sendto" onchange="enable_send_returned(this.value)">
				<option value='' <?if ($row['sendto']=='') echo 'selected';?> />
				<? foreach($sendto_array as $value){ ?>
					<option value="<?=$value?>" <?=(($value==$row['sendto'])?'selected':'')?>>
						<?=$value?>				
					</option>
				<? } ?>
			</select>
			<span style="padding-left:5%"><?= $lang_returned ?>:</span>
			<input type='checkbox' name='send_returned' id='send_returned' value='1' <?if ($row['send_returned']){echo 'checked';} if (!$row['sendto']){echo 'disabled';}?> />
		</td>
	</tr>
	<tr>
		<td><?= $lang_courier ?>:</td>
		<td>
			<input type='text' name='send_courier' value='<?=$row['send_courier']?>' style='width:34%'/>
			<span style="padding-left:5%"><?= $lang_courier_no ?>:</span>
			<input type='text' name='send_doc_no' value='<?=$row['send_doc_no']?>' style='width:34%' />
		</td>
	</tr>
	<tr>
		<td><?= $lang_not_for_client ?>:</td>
		<td>
			<textarea name='status_note' style='width:80%'><?=$row['status_note']?></textarea>
		</td>
	</tr>
<? } ?>
<tr>	
	<td><?php echo $lang_priel;?>:</td>
	<td><?php echo $row['user_priel'];?></td>
</tr>
<? if($row['active']==2){ ?>
	<tr>	
		<td><?php echo $lang_recived_by;?>:</td>
		<td><?php echo $row['user'];?></td>
	</tr>
<? } ?>
<? if($row['status']=='1' and $row['active']==2){ ?>
	<tr>	
		<td><?php echo $lang_izdal_by;?>:</td>
		<td><span style="margin-right:3ex;"><?php echo $row['user_izdal'];?></span>
			<?php if ($row['date_returned'] != '0000-00-00'){?>
				<span><?=$row['date_returned'];?></span>
			<?}?>
		</td>
	</tr>
<? } ?>
<tr>	
	<td><input type="hidden" name="hidd" value="1" /></td>
	<td><input type="submit" value="<?php echo ($_GET['id']) ? $lang_change_cli : $lang_add;?>" /></td>
</tr>
</table>
</form>	
</div>
<script language="javascript">
function toggle2(i, gn, cn) {
	var ele = document.getElementById("guarantee_num_span");
	var guarantee_num_el = document.getElementById("guarantee_num");
	var claim_number_row_el = document.getElementById("claim_number_row");
	var claim_number_input_el = document.getElementById("claim_number_input");

	if (i){
		ele.style.display = "inline";
		guarantee_num_el.value = gn;
		guarantee_num_el.required = true;
		claim_number_row_el.style.display = <?= ($_SESSION['office']!=7) ? '"table-row"' : '"none"' ?>;
		claim_number_input_el.value = <?= ($_SESSION['office']!=7) ? 'cn' : '""' ?>;
		claim_number_input_el.required = <?= ($_SESSION['office']!=7) ? 'true' : 'false' ?>;
	}else{
		ele.style.display = "none";
		guarantee_num_el.value = "";
		guarantee_num_el.required = false;
		claim_number_row_el.style.display = "none";
		claim_number_input_el.value = "";
		claim_number_input_el.required = false;
	}
}

var client_name_input = document.getElementById("card_form").querySelector("input[name='client2']");
var client_telephone_input = document.getElementById("card_form").querySelector("input[name='telephone']");
var client_name_option_array = document.getElementById("clients_list").getElementsByTagName('option');
var client_telephone_option_array = document.getElementById("telephones_list").getElementsByTagName('option');
var i = 0;

function set_client_name(client_telephone){	
	i=client_telephone_option_array.length;
	while (i-- > 0 && client_telephone_option_array[i].value != client_telephone);
	if (i >= 0){
		client_name_input.value = client_name_option_array[i].value;
	}
}

function set_client_telephone(client_name){
	i=client_name_option_array.length;
	while (i-- > 0 && client_name_option_array[i].value != client_name);
	if (i >= 0){
		client_telephone_input.value = client_telephone_option_array[i].value;
	}
}

//var sendto_input = document.getElementById("card_form").getElementById("sendto");
var send_returned_input = document.getElementById("send_returned");

function enable_send_returned(value){
	if (value.length==0) {
		send_returned_input.checked=false;
		send_returned_input.disabled=true;
	}else{
		send_returned_input.disabled=false;
	}
}

function tel_changed(value){
	client_telephone_input.value = value.replace(/\D/g,"");
	//console.log(client_telephone_input.value);
	set_client_name(client_telephone_input.value);
}

toggle2(<?=$row['guarantee']?>, '<?=$row['guarantee_num']?>', '<?=$row['claim_number']?>');
document.getElementById("guarantee").selectedIndex = <?=$row['guarantee']?>;

</script>