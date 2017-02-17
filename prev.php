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
die("forbidden");//NS
if (!$_POST['hidd']){
?>
<table>
<tr><form method="POST" action="index.php?link=prev">
	<td colspan="2"><?php echo $lang_menu_search;?>:</td>
	
</tr>
<tr>
	<td><?php echo $lang_stat;?>:</td>
	<td><select name="act">
	<option value="1"><?php echo $lang_stat_all;?></option>
	<option value="2"><?php echo $lang_stat_open;?></option>
	<option value="3"><?php echo $lang_stat_closed;?></option>
	</select></td>
</tr>
<tr>
	<td><input type="submit"value="<?php echo $lang_search_but;?>"/></td>
	<td><input type="hidden" name="hidd" value="1" /></td>
</tr>
</form>
</table>

<?php
	}
	else{	
	$act=$_POST['act'];
	if($act=='1'){
		$cond_a='active > 0';
	}
	elseif($act=='2'){
		$cond_a='active=1';
	}
	elseif($act=='3'){
		$cond_a='active=2';
	}
	
	$res=$GLOBALS['conn']->query("SELECT * FROM pcservice WHERE $cond_a ORDER  BY id DESC");
	if(!$res){die($GLOBALS['conn']->error()."1111");}
?>
<table border="1">
<tr valign='middle'>
	<td width="3%"><?php echo $lang_num;?>:</td>
	<td width="5%"><?php echo $lang_date;?>:</td>
	<td width="15%"><?php echo $lang_client;?>:</td>
	<td width="17%"><?php echo $lang_problem;?>:</td>
	<td width="17%"><?php echo $lang_problem_user;?>:</td>
	<td width="17%"><?php echo $lang_solution;?>:</td>
	<td colspan="5" ><?php echo $lang_action_cli;?>:</td>
	
</tr>
<?php	
	while ($row=$res->fetch_array()){

		echo "<tr valign='middle'><td>".$row['id']."</td><td>".$row['date_p']."</td><td>";
		getcl($row['client']);
		echo "</td><td>".$row['problem']."</td><td>".$row['constat']."</td><td>".$row['solved']."</td><td><form method='POST' action='index.php?link=edit'><input type='hidden' name='id' value='".$row['id']."'/><input type='submit' value='".$lang_change_cli."'/></form></td><td><form method='POST' action='index.php?link=close'><input type='hidden' name='id' value='".$row['id']."'/><input type='submit' value='".$lang_close_cli."'/></form></td><td><form method='POST' action='prnt.php'target='_blank'><input type='hidden' name='id' value='".$row['id']."'/><input type='submit' value='".$lang_card."'/></form></td><td><form method='POST' action='prnt_p.php'target='_blank'><input type='hidden' name='id' value='".$row['id']."'/><input type='submit' value='".$lang_protocol."'/></form></td><td><form method='POST' action='index.php?link=delete'><input type='hidden' name='id' value='".$row['id']."'/><input type='submit' value='".$lang_delete."'/></form></td><tr>";
	}
	echo "</table>";
	}
?>