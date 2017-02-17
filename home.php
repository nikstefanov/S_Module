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
if($_SESSION['admin']){$office_cond="";}
else{$office_cond = " AND office='".$_SESSION['office']."'";}

$q_all=$GLOBALS['conn']->query("SELECT * FROM pcservice WHERE true".$office_cond);
$q_all_count=$q_all->num_rows;
$q_open=$GLOBALS['conn']->query("SELECT * FROM pcservice WHERE active='1'".$office_cond);   
$q_open_count=$q_open->num_rows;    
$q_closed_count=$q_all_count-$q_open_count;
$q_high=$GLOBALS['conn']->query("SELECT * FROM pcservice WHERE priority='1' AND active='1'".$office_cond);   
$q_high_count=$q_high->num_rows;    
$q_urgent=$GLOBALS['conn']->query("SELECT * FROM pcservice WHERE priority='2' AND active='1'".$office_cond);   
$q_urgent_count=$q_urgent->num_rows;
$q_normal=$GLOBALS['conn']->query("SELECT * FROM pcservice WHERE priority='0' AND active='1'".$office_cond);   
$q_normal_count=$q_normal->num_rows; 
?>
<div id="statistic">
<div id="stat_msg">
<?php echo $lang_adm_text.$firm;?>


</div>
<div id="stat_tbl">
<table align="right">
<tr>
	<td colspan="5"><?php echo $lang_db_stat;?></td>
</tr>
<tr>
	<td colspan="2"><?php echo $lang_card_stat;?></td>
	<td colspan="2"><?php echo $lang_priority;?></td>
</tr>
<tr>

	<td><?php echo $lang_open_stat;?>:</td>
	<td><?php echo $q_open_count;?></td>
	<td><?php echo $lang_serv_prior1;?>:</td>
	<td><?php echo $q_normal_count;?></td>
</tr>
<tr>

	<td><?php echo $lang_closed_stat;?>:</td>
	<td><?php echo $q_closed_count;?></td>
	<td><?php echo $lang_serv_prior2;?>:</td>
	<td><?php echo $q_high_count;?></td>
</tr>
<tr>

	<td><?php echo $lang_total;?>:</td>
	<td><?php echo $q_all_count;?></td>
	<td><?php echo $lang_serv_prior3;?>:</td>
	<td><?php echo $q_urgent_count;?></td>
</tr>

</table>

</div>

</div>
<div id="empty_100"></div>
<?php
if($q_urgent_count > '0'){
$get_prior=$GLOBALS['conn']->query("SELECT * FROM pcservice WHERE priority='2' and active='1'".$office_cond." order by date_p");
?>
	<div class="urgent_home">
	
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
	while ($row_get_pr=$get_prior->fetch_array()){
		if(!$get_prior){die($GLOBALS['conn']->error);}
		echo "<tr valign='middle'><td>".$row_get_pr['id']."</td><td>".$row_get_pr['date_p']."</td><td>";
		getcl($row_get_pr['client']);
        
        
            if($row_get_pr['active']=='1'){
        $closed_op="<form method='GET' action='index.php'><input type='hidden' name ='link' value='close' /><input type='hidden' name='id' value='".$row_get_pr['id']."'/><input type='submit' value='".$lang_close_cli."'/></form>";
    }
    else{$closed_op=$lang_ord_stat2;}
    if($row_get_pr['date_r']!='0000-00-00'){
        $closed_pr="<form method='GET' action='index.php'><input type='hidden' name='link' value='prnt_p' /><input type='hidden' name='id' value='".$row_get_pr['id']."'/><input type='submit' value='".$lang_protocol."'/></form>";
    }
    else{$closed_pr=$lang_ord_stat1;}
        
        
		echo "</td><td>".$row_get_pr['problem']."</td><td>".$row_get_pr['constat']."</td><td>".$row_get_pr['solved']."</td><td><form method='GET' action='index.php'><input type='hidden' name='link' value='edit'/><input type='hidden' name='id' value='".$row_get_pr['id']."'/><input type='submit' value='".$lang_change_cli."'/></form></td><td>".$closed_op."</td><td><form method='GET' action='index.php'><input type='hidden' name='link' value='prnt'/><input type='hidden' name='id' value='".$row_get_pr['id']."'/><input type='submit' value='".$lang_card."'/></form></td><td>".$closed_pr."</td>".(($_SESSION['admin']==1)?"<td><form method='GET' action='index.php'><input type='hidden' name='link' value='delete' /><input type='hidden' name='id' value='".$row_get_pr['id']."'/><input type='submit' value='".$lang_delete."'/></form></td>":"")."<tr>";
	}
	echo "</table>";
    }
    else{
        echo "<div class='urgent_home'>";
        echo $lang_no_urgent;
    }
?>
	
	</div>
    <div style="clear: both;"></div>