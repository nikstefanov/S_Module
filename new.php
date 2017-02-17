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
if (!isset($_POST['hidd'])){
?>
<script language="javascript"> 
function toggle() {
	var ele = document.getElementById("toggleText");
	var text = document.getElementById("displayText");
	var elea = document.getElementById("toggleTexta");
	var texta = document.getElementById("displayTexta");
	if(ele.style.display == "block") {
    		ele.style.display = "none";
            elea.style.display = "block";
		text.innerHTML = "<?php echo $lang_add_new_cli;?>";
        client1.value="";
  	}
	else {
		ele.style.display = "block";
        elea.style.display = "none";
		text.innerHTML = "<?php echo $lang_add_db_cli;?>";
        client.value="0";
	}
} 
function toggle2() {
	var ele = document.getElementById("toggleText2");
	if(ele.style.display == "inline") {
    	ele.style.display = "none";
  	}
	else {
		ele.style.display = "inline";
	}
} 
</script>
<div id="new">
<table>
<tr><form method="POST" action="index.php?link=new">
	<td><?php echo $lang_card_num;?>:</td>
	<td><input type="text" name="id" value="<?php echo getres("id","pcservice");?>"/></td>
</tr>
<tr>
	<td><?php echo $lang_date_reg;?>:</td>
	<td><input type="text" name="date_p" value="<?php echo getres("date_p","pcservice");?>"/></td>
</tr>
<tr>
	<td><?php echo $lang_object;?>:</td>
	<td>
    <select name="object">
    	<option value="" selected="selected"></option>
    	<? foreach($arrObjects as $value){ ?>
    	<option value="<?=$value?>"><?=$value?></option>
        <? } ?>
    </select>
    </td>
</tr> 
<tr>	
	<td><?php echo $lang_cli_name;?>:</td>
	<td><div id="toggleTexta" style="display: block"><select name="client" id="client">
		<option value="0" ></option>
		<?php echo getres("name","users");?>
		</select> <br /></div><a id="displayText" href="javascript:toggle();"><?php echo $lang_add_new_cli;?></a>
        <br />
        <div id="toggleText" style="display: none">
        <input type="text" name="client1" id="client1" /><?php echo $lang_tel;?>:<input type="text" name="telephone" />
        </div>
        </td>
</tr> <!--
<tr>
	<td>
		<?php echo $lang_cli_name;?>:
	</td>
	<td>
		<input type="text" name="client1" id="client1" />
	</td>
</tr>
<tr>
	<td>
		<?php echo $lang_tel;?>:
	</td>
	<td>
		<input type="text" name="telephone" />
	</td>
</tr> -->
<tr>	
	<td><?php echo $lang_guarantee_flag;?>:</td>
	<td><select name="guarantee" id="guarantee" onchange="toggle2(this.options[this.selectedIndex].value)">
		<option value="0" selected="selected" >Не</option>
		<option value="1" >Да</option>
		</select>
        &nbsp;&nbsp;
        <span id="toggleText2" style="display: none">
        <?php echo $lang_guarantee_num;?>:<input type="text" name="guarantee_num" />
        </span>
        </td>
</tr>             
<tr>	
	<td><?php echo $lang_item_recieved;?>:<br />Вид/Марка/Модел</td>
	<td>
    <select name="product">
    	<option value="Видеокарта">Видеокарта</option>
		<option value="Десктоп">Десктоп</option>
		<option value="Други">Други</option>
		<option value="Дъно">Дъно</option>
		<option value="Захранване">Захранване</option>
		<option value="Захранващ адаптор">Захранващ адаптор</option>
		<option value="Карта памет">Карта памет</option>
		<option value="Касов апарат">Касов апарат</option>
		<option value="Лаптоп" selected="selected">Лаптоп</option>
		<option value="Мобилен телефон">Мобилен телефон</option>
		<option value="Монитор">Монитор</option>
		<option value="Оптично устойство">Оптично устойство</option>
		<option value="Принтер">Принтер</option>
		<option value="Рутер">Рутер</option>
		<option value="Таблет">Таблет</option>
		<option value="Тонер Касета">Тонер Касета</option>
		<option value="Хард Диск">Хард Диск</option>
		<option value="GPS">GPS</option>
		<option value="RAM Памет">RAM Памет</option>
		<option value="UPS">UPS</option>
		<option value="USB флаш памет">USB флаш памет</option>
		
    </select>
    <select name="brand">
		<option value="Acer">Acer</option>
		<option value="AMD">AMD</option>
		<option value="AOC">AOC</option>
		<option value="APC">APC</option>
		<option value="Apple">Apple</option>
		<option value="ASRock">ASRock</option>
		<option value="Asus">Asus</option>
		<option value="ATI">ATI</option>
		<option value="Belkin">Belkin</option>
		<option value="Brother">Brother</option>
		<option value="Canon">Canon</option>
		<option value="Canyon">Canyon</option>
		<option value="Crown">Crown</option>
		<option value="Daisy">Daisy</option>
		<option value="DeepCoool">DeepCoool</option>
		<option value="DELL">DELL</option>
		<option value="D-Link">D-Link</option>
		<option value="Eaton">Eaton</option>
		<option value="Fujitsu">Fujitsu</option>
		<option value="Fujitsu-Siemens">Fujitsu-Siemens</option>
		<option value="Genius">Genius</option>
		<option value="Gigabyte">Gigabyte</option>
		<option value="Hanns-G">Hanns-G</option>
		<option value="Hitachi">Hitachi</option>
		<option value="HP">HP</option>
		<option value="IBM">IBM</option>
		<option value="Intel">Intel</option>
		<option value="Kingston">Kingston</option>
		<option value="Kyocera">Kyocera</option>
		<option value="Lenovo">Lenovo</option>
		<option value="Lexmark">Lexmark</option>
		<option value="LG">LG</option>
		<option value="Linksys">Linksys</option>
		<option value="Lite-On">Lite-On</option>
		<option value="Logitech">Logitech</option>
		<option value="MGE">MGE</option>
		<option value="Microsoft">Microsoft</option>
		<option value="MSI">MSI</option>
		<option value="Netgear">Netgear</option>
		<option value="nVidia">nVidia</option>
		<option value="Packard Bell">Packard Bell</option>
		<option value="Philips">Philips</option>
		<option value="Prestigio">Prestigio</option>
		<option value="Razer">Razer</option>
		<option value="Ricoh">Ricoh</option>
		<option value="Samsung">Samsung</option>
		<option value="Seagate">Seagate</option>
		<option value="SOCOMEC">SOCOMEC</option>
		<option value="SONY">SONY</option>
		<option value="Tenda">Tenda</option>
		<option value="Toshiba">Toshiba</option>
		<option value="Transcend">Transcend</option>
		<option value="Western Digital">Western Digital</option>
    	<option value="Друго" selected="selected">Друго</option>
    </select>
    <input type="text" name="model"/>
    </td>
</tr>
<tr>	
	<td><?php echo $lang_serial_no;?>:</td>
	<td><input type="text" name="serial"/></td>
</tr>
<tr>	
	<td><?php echo $lang_outlook;?>:</td>
	<td><textarea name="outlook"></textarea></td>
</tr>
<tr>	
	<td><?php echo $lang_problem;?>:</td>
	<td><textarea name="problem"></textarea></td>
</tr>
<tr>	
	<td><?php echo $lang_rep_type;?>:</td>
	<td><select name="serv_type">
		<option value="0" ><?php echo $lang_serv_type_cond1;?></option>
		<option value="1" ><?php echo $lang_serv_type_cond2;?></option>
		<option value="2" ><?php echo $lang_serv_type_cond3;?></option>
		<option value="3" ><?php echo $lang_serv_type_cond4;?></option>
		</select></td>
</tr>
<tr>	
	<td><?php echo $lang_price_agreed;?>:</td>
	<td><input type="text" name="price_agreed" value=""/></td>
</tr>
<tr>	
	<td><?php echo $lang_priority;?>:</td>
	<td><select name="priority">
		<option value="0" selected="selected" ><?=$lang_serv_prior1?></option>
		<option value="1" ><?=$lang_serv_prior2?></option>
		<option value="2" ><?=$lang_serv_prior3?></option>
		</select>
        </td>
</tr> 
<tr>	
	<td><?php echo $lang_recived_by;?>:</td>
	<td><?php echo $_SESSION['user'];?></td>
</tr>
<tr>	
	<td><input type="hidden" name="hidd" value="1" /></td>
	<td><input type="submit" value="<?php echo $lang_add;?>" /></td>
</tr>
</form>	
</table>
</div>
<?php
	}
	if ($_POST['hidd']=='1'){
		if(empty($_POST['object'])) die('Въведете име на обект!');
		if ($_POST['client']=='0'){
			$client=rep_q($_POST['client1']);
			if(empty($client)) die('Въведете име на клиент!');
			$telephone=rep_q($_POST['telephone']);
			$insertt1=mysql_query("INSERT INTO users (name,telephone,ip,comment) VALUES
				('$client','$telephone','','')");//Added ip and comment values.
			if (!$insertt1){die(mysql_error());}
			$q1=mysql_query("SELECT * FROM users WHERE name='$client' AND telephone='$telephone'");
			$row1=mysql_fetch_array($q1);
		
			$client_id=$row1['id'];
		} 
		else{ $client_id=$_POST['client'];
		}
		//if ($_POST['user']=='0'){
		//	$user=rep_q($_POST['user1']);
		//} 
		//else{ $user=$_POST['user'];
		//}
		$id=rep_q($_POST['id']);
		$date_p=rep_q($_POST['date_p']);
		$object=rep_q($_POST['object']);
		$serial=rep_q($_POST['serial']);
		$serv_type=$_POST['serv_type'];
		$price_agreed=$_POST['price_agreed'];
		$product=rep_q($_POST['product']);
		$brand=rep_q($_POST['brand']);
		$model=rep_q($_POST['model']);
		$outlook=rep_q($_POST['outlook']);
		$guarantee=rep_q($_POST['guarantee']);
		if($guarantee) $guarantee_num=rep_q($_POST['guarantee_num']); else $guarantee_num='';
		$priority=rep_q($_POST['priority']);
		$problem=rep_q($_POST['problem']);
		$problem=rep_q($problem);
		$user_priel=$_SESSION['user'];
        
		$insertt=mysql_query("INSERT INTO pcservice (id,date_p,object,client,product,brand,model,outlook,guarantee,guarantee_num,serial,problem,user,user_priel,user_izdal,serv_type,price_agreed,solved,date_r,price,constat,guarantee_note,active,priority,status,checked) VALUES
		('$id','$date_p','$object','$client_id','$product','$brand','$model','$outlook','$guarantee','$guarantee_num','$serial','$problem','','$user_priel','','$serv_type','$price_agreed','','0000-00-00','0.00','','',1,'$priority',0,0)");//Added values for all fields.
		if (!$insertt){die(mysql_error());}
?>
<form action="index.php?link=prnt" method="post" >
<input type="hidden" value="1" name="check" /><input type="hidden" value="<?php echo $id;?>" name="id" />
<input type="submit" value="<?php echo $lang_print;?>" />
</form>
<?php
}	
?>