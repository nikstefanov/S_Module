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
error_reporting(0);
include '../functions.php';
if ((!$_POST['hidd'])&&!($_GET['lang'])){

?>
<link href="css.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8;"/>
<div class="install_ppi">

<div class="header_ppi"><h4><b>Инсталация на pcService v 1.01  /  Installing pcService v 1.01</b></h4></div>
		<div>
				<table align="center">
<tr><td colspan="2">Изберете език:/Choose Your language:</td></tr>
<tr><td><a href="install.php?lang=bg"><img src="bg.gif" width="30" height="18" /></a></td><td><a href="install.php?lang=en"><img src="en.gif" width="30" height="18" /></a></td></tr>
				</table>
		</div>


</div>
<?php
	}
if ((!$_POST['hidd'])&&($_GET['lang'])){
if ($_GET['lang']=='bg'){
    $lang='lang/lang_bg.php';
?>
<link href="css.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8;"/>
<div class="install_ppi">

<div class="header_ppi"><h4><b>Инсталация на pcService v 1.01</b></h4></div>
		<div>
<?php
if (!((is_writable('../conf/'))&&(is_writable('../backup/')))) {
    echo "Моля, променете правата за запис на следните директории:<br />.<br />";
    }
if (!is_writable('../backup/')) {
?>
        
        .backup/     -   "#chmod 777 backup/"<br />
<?php
}
if (!is_writable('../conf/')) {
?>
        .conf/        -   "#chmod 777 conf/"<br />
<?php
}
if ((is_writable('../conf/'))&&(is_writable('../backup/'))) {
    $submit_but="<input type='submit' value='Напред'/>";
    }
    else{
        $submit_but="<a href='install.php?lang=bg'/>Презареди</a>";
    }
?>
<br /><br /><br />
				<table>
				<form  method="POST" action="install.php" >
					<tr><td colspan="2" bgcolor="#FAEAB4" align="center">Настройки на сървър и база данни</td><td colspan="2" bgcolor="#FAEAB4" align="center">Данни за фирмата</td></tr>
					<tr><td>Сървър база данни:</td><td><input type="text" name="dbsrv" value="localhost" size="20"/><input type="hidden" name="hidd" value="1"/><input type="hidden" name="lang" value="<?php echo $lang;?>"/></td><td>Фирма:</td><td><input type="text" name="firm" size="20"/></td></tr>
					<tr><td>Потребител:</td><td><input type="text" name="dbuser" size="20"/></td><td>Град:</td><td><input type="text" name="town" /></td></tr>
					<tr><td>Парола:</td><td><input type="password" name="dbpass" size="21"/></td><td>Адрес:</td><td><input type="text" name="address" /></td></tr>
					<tr><td>Име на база данни:</td><td><input type="text" name="dbname" size="20"/></td><td>Тел.:</td><td><input type="text" name="tel"/></td></tr>
                    <tr><td>Път на инсталацията:</td><td><input type="text" name="path_backup" size="20"/></td><td></td><td>пример:/var/www/htdocs без"/" в края</td></tr>
					<tr><td></td><td><?php echo $submit_but;?></td><td></td><td></td></tr>
		
		
				</form>
				</table>
		</div>

</div>
<?php
}
elseif ($_GET['lang']=='en'){
    $lang='lang/lang_en.php';
?>    
 <link href="css.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8;"/>
<div class="install_ppi">

<div class="header_ppi"><h4><b>Installing pcService v 1.01</b></h4></div>
		<div>
<?php
if (!((is_writable('../conf/'))&&(is_writable('../backup/')))) {
    echo " Please, set  permission to 777  of the following directories:<br />.<br />";
    }
if (!is_writable('../backup/')) {
?>
       
        .backup/     -   "#chmod 777 backup/"<br />
<?php
}
if (!is_writable('../conf/')) {
?>
        .conf/       -  "#chmod 777 conf/"<br />
<?php
}
if ((is_writable('../conf/'))&&(is_writable('../backup/'))) {
    $submit_but="<input type='submit' value='Submit'/>";
    }
    else{
        $submit_but="<a href='install.php?lang=bg'/>Refresh</a>";
    }
?>
<br /><br /><br />
				<table>
				<form  method="POST" action="install.php" >
					<tr><td colspan="2" bgcolor="#FAEAB4" align="center">Server settings and database</td><td colspan="2" bgcolor="#FAEAB4" align="center">Owner data:</td></tr>
					<tr><td>Database server:</td><td><input type="text" name="dbsrv" value="localhost" size="20"/><input type="hidden" name="hidd" value="1"/><input type="hidden" name="lang" value="<?php echo $lang;?>"/></td><td>Company name:</td><td><input type="text" name="firm" size="20"/></td></tr>
					<tr><td>Database user:</td><td><input type="text" name="dbuser" size="20"/></td><td>Town:</td><td><input type="text" name="town" /></td></tr>
					<tr><td>Database password:</td><td><input type="password" name="dbpass" size="21"/></td><td>Address:</td><td><input type="text" name="address" /></td></tr>
					<tr><td>Database name:</td><td><input type="text" name="dbname" size="20"/></td><td>Telephone No:</td><td><input type="text" name="tel"/></td></tr>
                    <tr><td>Install path:</td><td><input type="text" name="path_backup" size="20"/></td><td></td><td>example:/var/www/htdocs without"/" at the end</td></tr>
					<tr><td></td><td><?php echo $submit_but;?></td><td></td><td></td></tr>
		
		
				</form>
				</table>
		</div>


</div>   
    
    
    
<?php  
}



	}
	
	if ($_POST['hidd']=='1'){
		
		$dbsrv=$_POST['dbsrv'];
		$dbuser=$_POST['dbuser'];
		$dbpass=$_POST['dbpass'];
		$dbname=$_POST['dbname'];
		$firm=rep_q($_POST['firm']);
		$town=rep_q($_POST['town']);
        $path_backup=rep_q($_POST['path_backup']);
		$address=rep_q($_POST['address']);
		$tel=rep_q($_POST['tel']);
        $lang=$_POST['lang'];
		
				$con = mysql_connect($dbsrv,$dbuser,$dbpass);
				if (!$con)
				  {
				  die('<br/>Грешка при свързване:' . mysql_error());
				  }
				
				if (mysql_query("CREATE DATABASE $dbname DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci",$con))
				  {
				  echo "<br/>Успешно създадена база данни - ".$dbname;
				  }
				else
				  {
				  echo "<br/>Грешка при създаване на база данни: " . mysql_error();
				  }
				
				
				
				
				
					mysql_select_db($dbname);
					$sql_pc = "CREATE TABLE pcservice (
					`id` INT NOT NULL, 
					`date_p` DATE NOT NULL, 
					`client` VARCHAR(60) NOT NULL,
					`product` VARCHAR(120) NOT NULL, 
					`serial` VARCHAR(60) NOT NULL, 
					`problem` TEXT NOT NULL, 
					`user` VARCHAR(60) NOT NULL,
					`serv_type` INT(1) NOT NULL DEFAULT 0,
					`solved` TEXT NOT NULL, 
					`date_r` DATE NOT NULL DEFAULT '0000-00-00',
					`price` DECIMAL(10,2) NOT NULL,
				 	`constat` TEXT NOT NULL,
				 	`active` INT(1) NOT NULL DEFAULT 1,
				 	`priority` INT(1) NOT NULL DEFAULT 0, 
					UNIQUE (`id`)) ENGINE = MyISAM";
					
					
					
					
					$res_pc=mysql_query($sql_pc,$con);
					if(!$res_pc){die("Грешка при създаване на таблица !pcservice!".mysql_error());}
					echo "<br/>Успешно създадена таблица  !pcservice!!";
					
					
					$sql_us = "CREATE TABLE users (
					`id` INT NOT NULL AUTO_INCREMENT, 
					`name` VARCHAR(60) NOT NULL,
					`telephone` VARCHAR(20) NOT NULL, 
					`ip` VARCHAR(16) NOT NULL, 
				 	`comment` TEXT NOT NULL,
	 				PRIMARY KEY (`id`),
  					UNIQUE KEY `mid` (`name`,`telephone`)) ENGINE = MyISAM";
					
					
					
					
					$res_us=mysql_query($sql_us,$con);
					if(!$res_us){die("Грешка при създаване на таблица !users!".mysql_error());}
					echo "<br/>Успешно създадена таблица !users!";
                    
                    
                    $sql_bc = "CREATE TABLE backup (
					`id` INT NOT NULL AUTO_INCREMENT, 
					`date_b` DATE NOT NULL, 
					`file_b` VARCHAR(25) NOT NULL,
	 				PRIMARY KEY (`id`)) ENGINE = MyISAM";
                    
                    $res_bc=mysql_query($sql_bc,$con);
					if(!$res_bc){die("Грешка при създаване на таблица !backup!".mysql_error());}
					echo "<br/>Успешно създадена таблица !backup!";
					
					$sql_login = ("CREATE TABLE login (
					`id` INT NOT NULL AUTO_INCREMENT, 
					`user` VARCHAR(40) NOT NULL UNIQUE,
                    `name` VARCHAR(60) NOT NULL UNIQUE, 
					`pass` VARCHAR(100) NOT NULL, 
					`admin` INT(1) NOT NULL DEFAULT 0,
                    `active` INT(1) NOT NULL DEFAULT 1, 
					 PRIMARY KEY (`id`), 
					 UNIQUE (`id`)) ENGINE = MyISAM;");
					
					$res_login=mysql_query($sql_login,$con);
					if(!$res_login){die("Грешка при създаване на таблица !users!".mysql_error());}
					echo "<br/>Успешно създадена таблица !login!";
					
					$ins_adm=mysql_query("INSERT INTO login (user,name,pass,admin,active) VALUES ('admin',                                                       'Administrator',	'116610d4f73d3f763768976141fe9299','1','1')");
					if(!$ins_adm){die("Грешка при създаване на потебител !admin!".mysql_error());}
					
					mysql_close($con);
					
		$conn_file='../conf/conn.php';
		$write=fopen($conn_file, 'w') or die("<br/>Грешка при създаване на конфигурационния файл conn.php!");
				$data_conn = '<?php'."\n";
		fwrite($write, $data_conn);
				$data_conn = '$dbhost='."'".$dbsrv."';\n";
		fwrite($write, $data_conn);
				$data_conn = '$dbuser='."'".$dbuser."';\n";
		fwrite($write, $data_conn);
				$data_conn = '$dbpass='."'".$dbpass."';\n";
		fwrite($write, $data_conn);
				$data_conn = '$db='."'".$dbname."';\n";
		fwrite($write, $data_conn);
		
			
			
		$data_conn = 	'$conn=mysql_connect($dbhost,$dbuser,$dbpass);'."\n";
		fwrite($write, $data_conn);
		$data_conn = 	'if(!$conn){die( mysql_error());}'."\n";
		fwrite($write, $data_conn);
		$data_conn = 	'mysql_query'.'("SET NAMES '.'utf8'.'");'."\n";
		fwrite($write, $data_conn);
		$data_conn = 	'mysql_query("SET CHARACTER SET utf8");'."\n";
		fwrite($write, $data_conn);
		$data_conn = 	'mysql_query("SET collation_connection = utf8_general_ci");	'."\n";
		fwrite($write, $data_conn);
		$data_conn = 	'$conn_db=mysql_select_db($db);'."\n";
		fwrite($write, $data_conn);
		$data_conn = 	'if(!$conn_db){die ("cant select database");}'."\n";
		fwrite($write, $data_conn);		
		$data_conn = '?>';
		fwrite($write, $data_conn);
		
	
		fclose($write);


				$conn_file='../conf/settings.php';
		$write=fopen($conn_file, 'w') or die("<br/>Грешка при създаване на конфигурационния файл settings.php!");
				$data_conn = '<?php'."\n";
		fwrite($write, $data_conn);		
				$data_conn = 	'$firm='."'".$firm."';\n";
		fwrite($write, $data_conn);
				$data_conn = '$town='."'".$town."';\n";
		fwrite($write, $data_conn);
				$data_conn = '$address='."'".$address."';\n";
		fwrite($write, $data_conn);
				$data_conn = '$tel='."'".$tel."';\n";
		fwrite($write, $data_conn);
                $data_conn = '$path_backup='."'".$path_backup."';\n";
		fwrite($write, $data_conn);
                $data_conn = '$lang='."'".$lang."';\n";
		fwrite($write, $data_conn);
				$data_conn = '?>';
		fwrite($write, $data_conn);
		
		fclose($write);
        
        
        
        $conn_file='../conf/set_lang_en.php';
		$write=fopen($conn_file, 'w') or die("$lang_error_settings_msg"."set_lang_file");
				$data_conn = '<?php'."\n";
		fwrite($write, $data_conn);		
				$data_conn = 	'$lang_serv_type_cond1='."'Without mutual agreement on the price with the client (up to 100 EUR net without VAT)';\n";
		fwrite($write, $data_conn);
				$data_conn = 	'$lang_serv_type_cond2='."'With mutual agreement on the price with the client';\n";
		fwrite($write, $data_conn);
				$data_conn = 	'$lang_serv_type_cond3='."'Diagnosis and wastage recommendation';\n";
		fwrite($write, $data_conn);
				$data_conn = 	'$lang_serv_type_cond4='."'Negotiable';\n";
		fwrite($write, $data_conn);
                $data_conn = '$lang_cli_text='."'Please, keep your papercut. Presenting it is the only way you can get your PC back after the repairment. Repairments with value over 100 lv. will be executed only with the mutual agreement of the client /by phone or in written/. We are not to be held responisble for PCs, which are not looked after for 4 weeks after the due date. If a repairment is denied or canceled by the client, the labour for diagnosis and disassambling the PC /20 EUR/ is to be paid in all cases.';\n";
		fwrite($write, $data_conn);
                $data_conn = '$lang_adm_text='."'Welcome to the PcService v. 1.01';\n";
        fwrite($write, $data_conn);
                $data_conn = '$lang_cur='."'EUR';\n";
		fwrite($write, $data_conn);
				$data_conn = '?>';
		fwrite($write, $data_conn);
		
		fclose($write);
        
        
        $conn_file='../conf/set_lang_bg.php';
		$write=fopen($conn_file, 'w') or die("$lang_error_settings_msg"."set_lang_file");
				$data_conn = '<?php'."\n";
		fwrite($write, $data_conn);		
				$data_conn = 	'$lang_serv_type_cond1='."'Без съгласуване на цената с клиента (до 100 лв. нето без ДДС)';\n";
		fwrite($write, $data_conn);
				$data_conn = 	'$lang_serv_type_cond2='."'Съгласуване на цената с клиента';\n";
		fwrite($write, $data_conn);
				$data_conn = 	'$lang_serv_type_cond3='."'Диагностика и издаване препоръка за бракуване';\n";
		fwrite($write, $data_conn);
				$data_conn = 	'$lang_serv_type_cond4='."'По договаряне на максималната стойност на ремонта';\n";
		fwrite($write, $data_conn);
                $data_conn = '$lang_cli_text='."'пазете Вашия отрязък. Срещу него ще получите компютъра  обратно. Ремонти на стойност над 100 лв. се извършват след потвърждение от клиента /по телефона или писмено/. За непотърсени машини в срок от 4 седмици сервизът не носи отговорност. При отказ от ремонт, клиентът заплаща при всички случаи стойността на труда за разглобяване и диагностика – 20лв.';\n";
		fwrite($write, $data_conn);
                $data_conn = '$lang_adm_text='."'Топло приветствие от администратора...';\n";
        fwrite($write, $data_conn);
                $data_conn = '$lang_cur='."'лв';\n";
		fwrite($write, $data_conn);
				$data_conn = '?>';
		fwrite($write, $data_conn);
		
		fclose($write);
        
        if ($lang=='lang/lang_en.php'){
            
            echo " <br/>PLEASE REMOVE INSTALL DIRECTORY OR RENAME IT! YOU MAY LOG IN WITH USERNAME : admin  AND PASSWORD: pcservice  -> <a href='../index.php'>Login page</a>";
            
            
        }
        if ($lang=='lang/lang_bg.php'){
            
            echo " <br/>МОЛЯ ИЗТРИЙТЕ ИЛИ ПРЕИМЕНУВАЙТЕ  INSTALL ДИРЕКТОРИЯТА! ЗА ВХОД В СИСТЕМАТА ИЗПОЛЗВАЙТЕ USERNAME : admin  И  PASSWORD: pcservice  -> <a href='../index.php'>Начална страница</a>";
            
            
        }
	}
?>