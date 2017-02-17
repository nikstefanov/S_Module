<?php
session_set_cookie_params(43200);
session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE /*| E_NOTICE*/);
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
include 'functions.php';
include 'conf/settings.php';
include $lang;
if (file_exists('install/install.php')){
    if ($lang=='lang/lang_bg.php'){
        echo "Моля, преименувайте или премахнете INSTALL директорията или изтрийте файла .INSTALL/install.php!!!!";
    }
    if ($lang=='lang/lang_en.php'){
        echo "PLEASE REMOVE/RENAME INSTALL FOLDER OR DELETE .INSTALL/install.php!!!!";
    }
    
    
}
else {
include 'conf/auth.php';
//include 'conf/conn.php';

if ($lang=='lang/lang_bg.php'){
include 'conf/set_lang_bg.php';
}
else {
    include 'conf/set_lang_en.php';
}

if (!isset ($_GET['link'])){ $link='home';}else{$link=$_GET['link'];}
if ($link == 'logout'){header("Location: login.php");}
?>
<html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<head>
<link href="css.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8;"/>
</head>
<body>
<div id="noprint">
	<div id="wrap">

		<div class="head_pp">
			<div class="firm"><?php echo $firm;?></div>
        		<div id="user1"><?php echo $lang_user." : ".$_SESSION['user'];?></div>
		</div>

		<div class="body_pp">
			<div class="menu_h_pp">
				<div class="menu_item">
			        	<a href="index.php?link=logout"><?php echo $lang_menu_exit;?></a>
        			</div>
				<div class="menu_item">
				        <a href="index.php?link=help"><?php echo $lang_menu_help;?></a>
			        </div>
                        	<div class="menu_item">
				        <a href="index.php?link=back"><?php echo $lang_menu_backup;?></a>
			        </div>
				<?php
				if (check_admin($_SESSION['user'])){
					echo "<div class='menu_item'><a href='index.php?link=set'>".$lang_menu_set."</a></div>\r\n";
					echo "<div class='menu_item'><a href='index.php?link=wage'>".$lang_wage."</a></div>\r\n";
				}
				?>
			        <div class="menu_item">
				        <a href="index.php?link=cli"><?php echo $lang_menu_cli;?></a>
			        </div>
                        	<div class="menu_item">
				        <a href="index.php?link=search"><?php echo $lang_menu_search;?></a>
			        </div>
                        	<div class="menu_item">
				        <a href="index.php?link=new"><?php echo $lang_menu_new;?></a>
				</div>
				<div class="menu_item">
					<a href="index.php?link=overdues"><?php echo $lang_overdues;?></a>
				</div>
				<div class="menu_item">
					<a href="index.php"><?php echo $lang_menu_home;?></a>
				</div>
			</div>

			<div class="content1">	
<?php
if(($link=='prnt')||($link=='prnt_p')){/*
	echo $lang_print.": <button onclick='window.print()' style='display:inline-block'><img src='img/print.gif' width='15' height='15' onclick=' window.print()'/></button>";
}elseif($link=='prnt_p'){
	echo $lang_print.": <button onclick='window.print()' style='display:inline-block;margin-right:20ex'><img src='img/print.gif' width='15' height='15' onclick=' window.print()'/></button>";
	if($row['status']=='0'){
        	$status_op=(($row['active']==2)?"<form method='GET' action='index.php'><input  type='hidden' name='link' value='izdai' /><input type='hidden' name='id' value='".$row['id']."'/><input type='submit' value='".$lang_status."'/></form>":"");
	}elseif($row['date_returned'] != '0000-00-00'){
		$status_op=$row['date_returned'];
	}else{
		$status_op=$lang_ord_izd2;
	}
	echo "<span style='display:inline-block;margin-left:20ex'>".$status_op."</span>";
*/}elseif($link=='new' or $link=='edit'){	
	include "new_new.php";
}else{
	include "$link.php";
}
?>
			</div>
		</div>
	</div>
    	<!--div class="footer"> All Rights Reserved. (c) Computer Market Ltd.</div-->
</div>    
<?php
if($link=='prnt'||$link=='prnt_p'){
include "$link.php";
} 
	}
?>

</body>
</html>
