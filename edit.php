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
$id=$_GET['id'];

if (!isset($_GET['hidd'])){
$res_e=$GLOBALS['conn']->query("SELECT * FROM pcservice WHERE id='$id'");
	if(!$res_e){die($GLOBALS['conn']->error());}
	$row_e=$res_e->fetch_array();
	$id_cli=$row_e['client'];
	if ($row_e['serv_type']=='0'){
	$serv_type=$lang_serv_type_cond1;
}
elseif ($row_e['serv_type']=='1'){
	$serv_type=$lang_serv_type_cond2;
}
elseif ($row_e['serv_type']=='2'){
	$serv_type=$lang_serv_type_cond3;
}
elseif ($row_e['serv_type']=='3'){
	$serv_type=$lang_serv_type_cond4;
}

if ($row_e['priority']=='0'){
	$priority=$lang_serv_prior1;
}
elseif ($row_e['priority']=='1'){
	$priority=$lang_serv_prior2;
}
elseif ($row_e['priority']=='2'){
	$priority=$lang_serv_prior3;
}

	
?>

<script language="javascript"> 
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
<table>
<tr><form method="POST" action="index.php?link=edit">
	<td><?php echo $lang_card_num;?>:</td>
	<td><b><?php echo $row_e['id'];?></b></td>
</tr>
<tr>
	<td><?php echo $lang_stat;?>:</td>
    
    <?php
    if($row_e['active']=='1'){
        $status1=$lang_ord_stat1;
        $status2=$lang_ord_stat2;
        $val_switch='2';
    }
    else{$status1=$lang_ord_stat2;
         $status2=$lang_ord_stat1;
         $val_switch='1';
    }
    
    ?>
	<td><b><select name="active">
            <option value="<?php echo $row_e['active'];?>" ><?php echo $status1;?></option>
            <option value="<?php echo $val_switch;?>" ><?php echo $status2;?></option>
            </select>
    
    
    
    </b></td>
</tr>
<tr>	
<tr>
	<td><?php echo $lang_date_reg;?>:</td>
	<td><b><?php echo $row_e['date_p'];?></b></td>
</tr>
<tr>
	<td><?php echo $lang_object;?>:</td>
	<td>
    <select name="object">
    	<option value="" selected="selected"></option>
    	<? foreach($arrObjects as $value){ ?>
    	<option value="<?=$value?>" <? if($row_e['object']==$value) echo 'selected="selected"'; ?>><?=$value?></option>
        <? } ?>
    </select>
    </td>
</tr>
<tr>	
	<td><?php echo $lang_cli_name;?>:</td>
	<td><select name="client">
		<?php echo getcli1($id_cli);?>
		<option value="0" ></option>
		<?php echo getres("name","users");?>
		</select> </td>
</tr>
<tr>	
	<td><?php echo $lang_guarantee_flag;?>:</td>
	<td><select name="guarantee" id="guarantee" onchange="toggle2(this.options[this.selectedIndex].value)">
		<option value="0" <? if($row_e['guarantee']=='0') echo 'selected="selected"'; ?> >Не</option>
		<option value="1" <? if($row_e['guarantee']=='1') echo 'selected="selected"'; ?> >Да</option>
		</select>
        &nbsp;&nbsp;
        <span id="toggleText2" style="display: <? if($row_e['guarantee']=='1') echo 'inline'; else echo 'none'; ?>">
        <?php echo $lang_guarantee_num;?>:<input type="text" name="guarantee_num" value="<?php echo $row_e['guarantee_num'];?>" />
        </span></td>
</tr>
<tr>	
	<td>|-<?php echo $lang_cli_new;?>:</td>
	<td><input type="text" name="client1" /><?php echo $lang_tel;?>:<input type="text" name="telephone" /></td>
</tr>
<tr>	
	<td><?php echo $lang_item_recieved;?>:<br />Вид/Марка/Модел</td>
	<td><!--<input type="text" name="product" value="<?php echo $row_e['product'];?>"/>-->
    <select name="product">
		<option value="Видеокарта" <? if($row_e['product']=='Видеокарта') echo 'selected="selected"'; ?>>Видеокарта</option>
		<option value="Десктоп" <? if($row_e['product']=='Десктоп') echo 'selected="selected"'; ?>>Десктоп</option>
		<option value="Дъно" <? if($row_e['product']=='Дъно') echo 'selected="selected"'; ?>>Дъно</option>
		<option value="Захранване" <? if($row_e['product']=='Захранване') echo 'selected="selected"'; ?>>Захранване</option>
		<option value="Захранващ адаптор" <? if($row_e['product']=='Захранващ адаптор') echo 'selected="selected"'; ?>>Захранващ адаптор</option>
		<option value="Карта памет" <? if($row_e['product']=='Карта памет') echo 'selected="selected"'; ?>>Карта памет</option>
		<option value="Касов апарат" <? if($row_e['product']=='Касов апарат') echo 'selected="selected"'; ?>>Касов апарат</option>
		<option value="Лаптоп" <? if($row_e['product']=='Лаптоп') echo 'selected="selected"'; ?>>Лаптоп</option>
		<option value="Мобилен телефон" <? if($row_e['product']=='Мобилен телефон') echo 'selected="selected"'; ?>>Мобилен телефон</option>
		<option value="Монитор" <? if($row_e['product']=='Монитор') echo 'selected="selected"'; ?>>Монитор</option>
		<option value="Оптично устойство" <? if($row_e['product']=='Оптично устойство') echo 'selected="selected"'; ?>>Оптично устойство</option>
		<option value="Принтер" <? if($row_e['product']=='Принтер') echo 'selected="selected"'; ?>>Принтер</option>
		<option value="Рутер" <? if($row_e['product']=='Рутер') echo 'selected="selected"'; ?>>Рутер</option>
		<option value="Таблет" <? if($row_e['product']=='Таблет') echo 'selected="selected"'; ?>>Таблет</option>
		<option value="Тонер Касета" <? if($row_e['product']=='Тонер Касета') echo 'selected="selected"'; ?>>Тонер Касета</option>
		<option value="Хард Диск" <? if($row_e['product']=='Хард Диск') echo 'selected="selected"'; ?>>Хард Диск</option>
		<option value="GPS" <? if($row_e['product']=='GPS') echo 'selected="selected"'; ?>>GPS</option>
		<option value="RAM Памет" <? if($row_e['product']=='RAM Памет') echo 'selected="selected"'; ?>>RAM Памет</option>
		<option value="UPS" <? if($row_e['product']=='UPS') echo 'selected="selected"'; ?>>UPS</option>
		<option value="USB флаш памет" <? if($row_e['product']=='USB флаш памет') echo 'selected="selected"'; ?>>USB флаш памет</option>
    	<option value="Други" <? if($row_e['product']=='Други' or empty($row_e['product'])) echo 'selected="selected"'; ?>>Други</option>
		
    </select>
    <select name="brand">
		<option value="Acer" <? if($row_e['brand']=='Acer') echo 'selected="selected"'; ?>>Acer</option>
		<option value="AMD" <? if($row_e['brand']=='AMD') echo 'selected="selected"'; ?>>AMD</option>
		<option value="AOC" <? if($row_e['brand']=='AOC') echo 'selected="selected"'; ?>>AOC</option>
		<option value="APC" <? if($row_e['brand']=='APC') echo 'selected="selected"'; ?>>APC</option>
		<option value="Apple" <? if($row_e['brand']=='Apple') echo 'selected="selected"'; ?>>Apple</option>
		<option value="ASRock" <? if($row_e['brand']=='ASRock') echo 'selected="selected"'; ?>>ASRock</option>
		<option value="Asus" <? if($row_e['brand']=='Asus') echo 'selected="selected"'; ?>>Asus</option>
		<option value="ATI" <? if($row_e['brand']=='ATI') echo 'selected="selected"'; ?>>ATI</option>
		<option value="Belkin" <? if($row_e['brand']=='Belkin') echo 'selected="selected"'; ?>>Belkin</option>
		<option value="Brother" <? if($row_e['brand']=='Brother') echo 'selected="selected"'; ?>>Brother</option>
		<option value="Canon" <? if($row_e['brand']=='Canon') echo 'selected="selected"'; ?>>Canon</option>
		<option value="Canyon" <? if($row_e['brand']=='Canyon') echo 'selected="selected"'; ?>>Canyon</option>
		<option value="Crown" <? if($row_e['brand']=='Crown') echo 'selected="selected"'; ?>>Crown</option>
		<option value="Daisy" <? if($row_e['brand']=='Daisy') echo 'selected="selected"'; ?>>Daisy</option>
		<option value="DeepCoool" <? if($row_e['brand']=='DeepCoool') echo 'selected="selected"'; ?>>DeepCoool</option>
		<option value="DELL" <? if($row_e['brand']=='DELL') echo 'selected="selected"'; ?>>DELL</option>
		<option value="D-Link" <? if($row_e['brand']=='D-Link') echo 'selected="selected"'; ?>>D-Link</option>
		<option value="Eaton" <? if($row_e['brand']=='Eaton') echo 'selected="selected"'; ?>>Eaton</option>
		<option value="Fujitsu" <? if($row_e['brand']=='Fujitsu') echo 'selected="selected"'; ?>>Fujitsu</option>
		<option value="Fujitsu-Siemens" <? if($row_e['brand']=='Fujitsu-Siemens') echo 'selected="selected"'; ?>>Fujitsu-Siemens</option>
		<option value="Genius" <? if($row_e['brand']=='Genius') echo 'selected="selected"'; ?>>Genius</option>
		<option value="Gigabyte" <? if($row_e['brand']=='Gigabyte') echo 'selected="selected"'; ?>>Gigabyte</option>
		<option value="Hanns-G" <? if($row_e['brand']=='Hanns-G') echo 'selected="selected"'; ?>>Hanns-G</option>
		<option value="Hitachi" <? if($row_e['brand']=='Hitachi') echo 'selected="selected"'; ?>>Hitachi</option>
		<option value="HP" <? if($row_e['brand']=='HP') echo 'selected="selected"'; ?>>HP</option>
		<option value="IBM" <? if($row_e['brand']=='IBM') echo 'selected="selected"'; ?>>IBM</option>
		<option value="Intel" <? if($row_e['brand']=='Intel') echo 'selected="selected"'; ?>>Intel</option>
		<option value="Kingston" <? if($row_e['brand']=='Kingston') echo 'selected="selected"'; ?>>Kingston</option>
		<option value="Kyocera" <? if($row_e['brand']=='Kyocera') echo 'selected="selected"'; ?>>Kyocera</option>
		<option value="Lenovo" <? if($row_e['brand']=='Lenovo') echo 'selected="selected"'; ?>>Lenovo</option>
		<option value="Lexmark" <? if($row_e['brand']=='Lexmark') echo 'selected="selected"'; ?>>Lexmark</option>
		<option value="LG" <? if($row_e['brand']=='LG') echo 'selected="selected"'; ?>>LG</option>
		<option value="Linksys" <? if($row_e['brand']=='Linksys') echo 'selected="selected"'; ?>>Linksys</option>
		<option value="Lite-On" <? if($row_e['brand']=='Lite-On') echo 'selected="selected"'; ?>>Lite-On</option>
		<option value="Logitech" <? if($row_e['brand']=='Logitech') echo 'selected="selected"'; ?>>Logitech</option>
		<option value="MGE" <? if($row_e['brand']=='MGE') echo 'selected="selected"'; ?>>MGE</option>
		<option value="Microsoft" <? if($row_e['brand']=='Microsoft') echo 'selected="selected"'; ?>>Microsoft</option>
		<option value="MSI" <? if($row_e['brand']=='MSI') echo 'selected="selected"'; ?>>MSI</option>
		<option value="Netgear" <? if($row_e['brand']=='Netgear') echo 'selected="selected"'; ?>>Netgear</option>
		<option value="nVidia" <? if($row_e['brand']=='nVidia') echo 'selected="selected"'; ?>>nVidia</option>
		<option value="Packard Bell" <? if($row_e['brand']=='Packard Bell') echo 'selected="selected"'; ?>>Packard Bell</option>
		<option value="Philips" <? if($row_e['brand']=='Philips') echo 'selected="selected"'; ?>>Philips</option>
		<option value="Prestigio" <? if($row_e['brand']=='Prestigio') echo 'selected="selected"'; ?>>Prestigio</option>
		<option value="Razer" <? if($row_e['brand']=='Razer') echo 'selected="selected"'; ?>>Razer</option>
		<option value="Ricoh" <? if($row_e['brand']=='Ricoh') echo 'selected="selected"'; ?>>Ricoh</option>
		<option value="Samsung" <? if($row_e['brand']=='Samsung') echo 'selected="selected"'; ?>>Samsung</option>
		<option value="Seagate" <? if($row_e['brand']=='Seagate') echo 'selected="selected"'; ?>>Seagate</option>
		<option value="SOCOMEC" <? if($row_e['brand']=='SOCOMEC') echo 'selected="selected"'; ?>>SOCOMEC</option>
		<option value="SONY" <? if($row_e['brand']=='SONY') echo 'selected="selected"'; ?>>SONY</option>
		<option value="Tenda" <? if($row_e['brand']=='Tenda') echo 'selected="selected"'; ?>>Tenda</option>
		<option value="Toshiba" <? if($row_e['brand']=='Toshiba') echo 'selected="selected"'; ?>>Toshiba</option>
		<option value="Transcend" <? if($row_e['brand']=='Transcend') echo 'selected="selected"'; ?>>Transcend</option>
		<option value="Western Digital" <? if($row_e['brand']=='Western Digital') echo 'selected="selected"'; ?>>Western Digital</option>
    	<option value="Друго" <? if($row_e['brand']=='Друго' or empty($row_e['brand'])) echo 'selected="selected"'; ?>>Друго</option>
    </select>
    <input type="text" name="model" value="<?php echo $row_e['model'];?>"/>
    </td>
</tr>
<tr>	
	<td><?php echo $lang_serial_no;?>:</td>
	<td><input type="text" name="serial" value="<?php echo $row_e['serial'];?>"/></td>
</tr>
<tr>	
	<td><?php echo $lang_outlook;?>:</td>
	<td><textarea name="outlook"><?php echo $row_e['outlook'];?></textarea></td>
</tr>
<tr>	
	<td><?php echo $lang_problem;?>:</td>
	<td><textarea name="problem"><?php echo $row_e['problem'];?></textarea></td>
</tr>
<tr>	
	<td><?php echo $lang_rep_type;?>:</td>
	<td><select name="serv_type">
		<option value="<?php echo $row_e['serv_type'];?>" ><?php echo $serv_type;?></option>
<?php
if($row_e['serv_type']=='0'){
    $opt_cond1="<option value='1' >".$lang_serv_type_cond2."</option>";
    $opt_cond2="<option value='2' >".$lang_serv_type_cond3."</option>";
    $opt_cond3="<option value='3' >".$lang_serv_type_cond4."</option>";
    
}
elseif($row_e['serv_type']=='1'){
    $opt_cond1="<option value='0' >".$lang_serv_type_cond1."</option>";
    $opt_cond2="<option value='2' >".$lang_serv_type_cond3."</option>";
    $opt_cond3="<option value='3' >".$lang_serv_type_cond4."</option>";
    
}    
elseif($row_e['serv_type']=='2'){
    $opt_cond2="<option value='1' >".$lang_serv_type_cond2."</option>";
    $opt_cond1="<option value='0' >".$lang_serv_type_cond1."</option>";
    $opt_cond3="<option value='3' >".$lang_serv_type_cond4."</option>";
    
}    
elseif($row_e['serv_type']=='3'){
    $opt_cond2="<option value='1' >".$lang_serv_type_cond2."</option>";
    $opt_cond1="<option value='0' >".$lang_serv_type_cond1."</option>";
    $opt_cond3="<option value='2' >".$lang_serv_type_cond3."</option>";
    
} 
 
 echo $opt_cond1.$opt_cond2.$opt_cond3;     
?>
</tr>
<tr>	
	<td><?php echo $lang_price_agreed;?>:</td>
	<td><input type="text" name="price_agreed" value="<?php echo $row_e['price_agreed'];?>"/></td>
</tr>
<tr>	
	<td><?php echo $lang_priel;?>:</td>
	<td><?php echo $row_e['user_priel'];?></td>
</tr>
<? if($row_e['active']==2){ ?>
<tr>	
	<td><?php echo $lang_recived_by;?>:</td>
	<td><?php echo $row_e['user'];?></td>
</tr>
<? } ?>
<? if($row_e['active']==2 and $_SESSION['admin']==1){ ?>
<tr>	
	<td><?php echo $lang_izdal_by;?>:</td>
	<td><?php echo $row_e['user_izdal'];?></td>
</tr>
<? } ?>
<tr>	
	<td><?php echo $lang_priority;?>:</td>
	<td><select name="priority">
	<option value="<?php echo $row_e['priority'];?>" ><?php echo $priority?></option>
<?php
if($row_e['priority']=='0'){
    $prior_cond1="<option value='1' >".$lang_serv_prior2."</option>";
    $prior_cond2="<option value='2' >".$lang_serv_prior3."</option>";
}	    
elseif($row_e['priority']=='1'){
    $prior_cond1="<option value='0' >".$lang_serv_prior1."</option>";
    $prior_cond2="<option value='2' >".$lang_serv_prior3."</option>";
}	 
elseif($row_e['priority']=='2'){
    $prior_cond1="<option value='0' >".$lang_serv_prior1."</option>";
    $prior_cond2="<option value='1' >".$lang_serv_prior2."</option>";
}	     
    
    
echo $prior_cond1.$prior_cond2;
?>

		</select></td>
</tr>
<tr>	
	<td><input type="hidden" name="hidd" value="1" /><input type="hidden" name="id" value="<?php echo $id?>" /></td>
	<td><input type="submit" value="<?php echo $lang_change_cli;?>" /></td>
</tr>

</form>
	
</table>
<?php
	}
	if ($_POST['hidd']=='1'){
		if(empty($_POST['object'])) die('Въведете име на обект!');
		if ($_POST['client']=='0'){
			$client=rep_q($_POST['client1']);
			$telephone=rep_q($_POST['telephone']);
			$insertt1=mysql_query("INSERT INTO users (name,telephone) VALUES
		('$client','$telephone')");
		if (!$insertt1){die(mysql_error().$client);}
				$q1=mysql_query("SELECT * FROM users WHERE name='$client' AND telephone='$telephone'");
		$row1=mysql_fetch_array($q1);
		
		$client_id=$row1['id'];
		} 
		else{ $client_id=$_POST['client'];
		}

		
		$object=rep_q($_POST['object']);
		$active=$_POST['active'];
		$serial=rep_q($_POST['serial']);
		$serv_type=$_POST['serv_type'];
		$price_agreed=$_POST['price_agreed'];
		$product=rep_q($_POST['product']);
		$brand=rep_q($_POST['brand']);
		$model=rep_q($_POST['model']);
		$outlook=rep_q($_POST['outlook']);
		$guarantee=rep_q($_POST['guarantee']);
		if($guarantee) $guarantee_num=rep_q($_POST['guarantee_num']); else $guarantee_num='';
		$problem=rep_q($_POST['problem']);
		$priority=$_POST['priority'];
		$problem=rep_q(($problem));
		
		

		
		if($active=='1'){
		  
		
		$insertt=mysql_query("UPDATE pcservice SET object='$object',client='$client_id',serial='$serial',product='$product',brand='$brand',model='$model',outlook='$outlook',guarantee='$guarantee',guarantee_num='$guarantee_num',problem='$problem',serv_type='$serv_type',price_agreed='$price_agreed', priority='$priority', active='$active', date_r='0000-00-00' WHERE id='$id' ");
		if (!$insertt){die(mysql_error()."1");}
		
        }
        		
		if($active=='2'){
		  
		$date_r_n=date("Y-m-d");
		$insertt=mysql_query("UPDATE pcservice SET object='$object',client='$client_id',serial='$serial',product='$product',brand='$brand',model='$model',outlook='$outlook',guarantee='$guarantee',guarantee_num='$guarantee_num',problem='$problem',serv_type='$serv_type',price_agreed='$price_agreed', priority='$priority', active='$active', date_r='$date_r_n' WHERE id='$id' ");
		if (!$insertt){die(mysql_error()."1");}
		
        }

?>
<form action="index.php?link=prnt" method="post" >
<input type="hidden" value="1" name="check" /><input type="hidden" value="<?php echo $id;?>" name="id" />
<input type="submit" value="<?php echo $lang_print;?>" />
</form>
<?php
	}		
?>