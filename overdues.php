<div class="overdues">
<?php
include 'conf/auth.php';
if($_SESSION['admin']){$office_cond="";}
else{$office_cond = " AND office='".$_SESSION['office']."'";}
$res = $GLOBALS['conn']->query("SELECT *,DATEDIFF(SYSDATE(),date_p) AS date_diff FROM pcservice WHERE active='1' AND  DATEDIFF(SYSDATE(),date_p)>19".$office_cond." ORDER BY date_diff ASC");
if (!res) {die($GLOBALS['conn']->error);}
if (!$res->num_rows){
	echo $lang_no_overdues;
}else{
?>	
<table border="1">
<tr valign='middle'>
	<td width="3%"><?php echo $lang_num;?>:</td>
	<td width="5%"><?php echo $lang_date;?>:</td>
	<td width="3%"><?php echo $lang_days;?>:</td>
	<td width="15%"><?php echo $lang_client;?>:</td>
	<td width="17%"><?php echo $lang_problem;?>:</td>
	<td width="17%"><?php echo $lang_problem_user;?>:</td>
	<td width="17%"><?php echo $lang_solution;?>:</td>
	<td width="3%"><?php echo $lang_guarantee_flag;?>:</td>
	<td colspan="5" ><?php echo $lang_action_cli;?>:</td>
	
</tr>
<?
$overdue_class=0;
while ($row_get_pr=$res->fetch_array(MYSQLI_ASSOC)){
	if ($row_get_pr['date_diff']>45){$overdue_class=2;}
	elseif ($row_get_pr['date_diff']>30){$overdue_class=1;}
	else {$overdue_class=0;}
	echo "<tr valign='middle' class='overdues$overdue_class'>";
	echo "<td>".$row_get_pr['id']."</td>";
	echo "<td>".$row_get_pr['date_p']."</td>";
	echo "<td>".$row_get_pr['date_diff']."</td>";
	echo "<td>";
	getcl($row_get_pr['client']);
	echo "</td>";
	
	if($row_get_pr['active']=='1'){
		$closed_op="<form method='GET' action='index.php'><input type='hidden' name ='link' value='close' /><input type='hidden' name='id' value='".$row_get_pr['id']."'/><input type='submit' value='".$lang_close_cli."'/></form>";
	}
	else{$closed_op=$lang_ord_stat2;}
	if($row_get_pr['date_r']!='0000-00-00'){
		$closed_pr="<form method='GET' action='index.php'><input type='hidden' name='link' value='prnt_p' /><input type='hidden' name='id' value='".$row_get_pr['id']."'/><input type='submit' value='".$lang_protocol."'/></form>";
	}
	else{$closed_pr=$lang_ord_stat1;}
	
	
	echo "<td>".$row_get_pr['problem']."</td><td>".$row_get_pr['constat']."</td><td>".$row_get_pr['solved']."</td>";
	echo "<td>".(($row_get_pr['guarantee'])?$lang_yes:$lang_no)."</td>";
	echo "<td><form method='GET' action='index.php'><input type='hidden' name='link' value='edit'/><input type='hidden' name='id' value='".$row_get_pr['id']."'/><input type='submit' value='".$lang_change_cli."'/></form></td><td>".$closed_op."</td><td><form method='GET' action='index.php'><input type='hidden' name='link' value='prnt'/><input type='hidden' name='id' value='".$row_get_pr['id']."'/><input type='submit' value='".$lang_card."'/></form></td><td>".$closed_pr."</td>".(($_SESSION['admin']==1)?"<td><form method='GET' action='index.php'><input type='hidden' name='link' value='delete' /><input type='hidden' name='id' value='".$row_get_pr['id']."'/><input type='submit' value='".$lang_delete."'/></form></td>":"")."<tr>";
}
?>
</table>
<?
}
$res->close();	
?>
</div>
<div style="clear: both;"></div>