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
if ($_POST['id']){
	$id=$_POST['id'];
}else{
	$id=$_GET['id'];
}
if (!isset($_POST['hidd'])){

	
?>
	
	<div style="width:100%;background:#FFCC99">
<div style="width:100%;background:#FFCC99;text-align:center;"><h3><?php echo $lang_izdai_confirm;?>:<?php echo $id;?>!</h3></div>
<div><table align="center">
<tr>
	<td><form action="index.php?link=izdai" method="POST"><input type="submit" value="<?php echo $lang_ok;?>" /><input type="hidden" value="3" name="hidd" /><input type="hidden" name="id" value="<?php echo $id;?>" /></form></td>
	<td><form action="index.php" method="GET"><input type="submit" value="<?php echo $lang_reject;?>" /></form></td>
</tr>
</table></div>
</div>
	
<?php
	}
	
	
	if ($_POST['hidd']=='3'){
	$updaterow=$GLOBALS['conn']->query("UPDATE pcservice SET status=1, user_izdal='".$_SESSION['user']."', date_returned='".date('Y-m-d')."' WHERE id='$id'");
		if (!$updaterow){die($GLOBALS['conn']->error);}
?>
	
	<div style="width:100%;background:#CCFFCC">
<div style="width:100%;text-align:center;"><h4><?php echo $lang_izdai_succ;?></h4></div>
<div><table align="center">
<tr>
	<td><form action="index.php" method="GET"><input type='hidden' name='link' value='search'/><input type="submit" value="<?php echo $lang_ok;?>" /></form></td>
	<td></td>
</tr>
</table></div>
</div>	
<?php
}
?>