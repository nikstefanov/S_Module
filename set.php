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
//$arrObjects = get_array_offices('bg');
$arrObjects = get_field_arr_table('nickname_'.$lang_code,'offices');
if (!$_POST['hidd']){
if (check_admin($_SESSION['user'])== True){
   $filename_check1 = 'conf/settings.php';
if (is_writable($filename_check1)) {
    
} else {
    echo 'The file '.$filename_check1.' is not writable';
} 
$filename_check1 = 'conf/set_lang_bg.php';
if (is_writable($filename_check1)) {
    
} else {
    echo 'The file '.$filename_check1.' is not writable';
} 
    
    
?>
<link href="css.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8;"/>
<div class="install_ppi">

<div class="header_ppi"><h4><b><?php echo $lang_chset_tit;?></b></h4></div>
		<div id="settings_1">
				<table>
				<form  method="POST" action="index.php?link=set" >
					<tr><td><?php echo $lang_firm;?>:</td><td><input type="text" name="firm" size="20" value="<?php echo $firm;?>"/></td><td rowspan="4"><?php echo $lang_rep_type;?>:</td><td>1 :<input type="text" size="80" name="rep_type1" value="<?php echo $lang_serv_type_cond1;?>"/></td></tr>
					<tr><td><?php echo $lang_town;?>:</td><td><input type="text" name="town" value="<?php echo $town;?>" /></td><td>2 :<input type="text" size="80" name="rep_type2" value="<?php echo $lang_serv_type_cond2;?>"/></td></tr>
					<tr><td><?php echo $lang_address;?>:</td><td><input type="text" name="address" value="<?php echo $address;?>"/></td><td>3 :<input type="text" size="80" name="rep_type3" value="<?php echo $lang_serv_type_cond3;?>"/></td></tr>
					<tr><td><?php echo $lang_tel;?>.:</td><td><input type="text" name="tel" value="<?php echo $tel;?>"/></td><td>4 :<input type="text" size="80" name="rep_type4" value="<?php echo $lang_serv_type_cond4;?>"/></td></tr>
                    <tr><td><?php echo $lang_path;?>:</td><td><input type="text" name="path_backup" value="<?php echo $path_backup;?>"/></td><td><?php echo $lang_currency;?></td><td><select name="currency"><option value="<?php echo $lang_cur;?>"><?php echo $lang_cur;?></option>
<?php
if($lang_cur=='лв'){
    $cur_change1="<option value='EUR'>EUR</option>";
    $cur_change2="<option value='USD'>USD</option>";
}
elseif($lang_cur=='EUR'){
    $cur_change1="<option value='лв'>лв</option>";
    $cur_change2="<option value='USD'>USD</option>";
}
elseif($lang_cur=='USD'){
    $cur_change1="<option value='лв'>лв</option>";
    $cur_change2="<option value='EUR'>EUR</option>";
    }
    echo $cur_change1.$cur_change2;
?>
                                            </td></tr>
                    <tr><td><?php echo $lang_language;?>:</td><td><select name="lng">
<?php
if($lang=='lang/lang_en.php'){
    $chlang1=$lang_set_lang1;
    $chlang2=$lang_set_lang2;
    $lang2='lang/lang_bg.php';
}	
if($lang=='lang/lang_bg.php'){
    $chlang1=$lang_set_lang2;
    $chlang2=$lang_set_lang1;
	$lang2='lang/lang_en.php';
    }
?>
                    <option value="<?php echo $lang;?>"><?php echo $chlang1;?></option>
                    <option value="<?php echo $lang2;?>"><?php echo $chlang2;?></option>
                    </select></td><td></td><td></td></tr>
<tr><td><?php echo $lang_cli_msg;?>:</td><td colspan="3"><textarea name="cli_msg" rows="4" cols="100"><?php echo $lang_cli_text;?></textarea></tr>
<tr><td><?php echo $lang_adm_msg;?>:</td><td colspan="3"><textarea name="adm_msg" rows="4" cols="100"><?php echo $lang_adm_text;?></textarea></tr>
					<tr><td><input type="hidden" name="hidd" value="1"/></td><td colspan="3"><input type="submit" value="<?php echo $lang_save;?>"/></td></tr>
		
		
				</form>
				</table>
		</div>

<?php
	
		
	
?>


<div><ins><?php echo $lang_users_tit;?></ins></div>
<div id="settings_all">
<div id="settings_u1">
<table>
<tr>
<td colspan="6"><?php echo $lang_useredit_tit;?>:</td>
</tr>
<tr>
	<td><?php echo $lang_id;?>:</td>
	<td><?php echo $lang_user;?>:</td>
    <td><?php echo $lang_name;?>:</td>
	<td><?php echo $lang_premission;?>:</td>
	<td><?php echo $lang_user_active;?>:</td>
    <td><?php echo $lang_edit;?>:</td>
</tr>
<?php
$res=$GLOBALS['conn']->query("SELECT * FROM login");
if(!$res){die($GLOBALS['conn']->error);}
while($row=$res->fetch_array()){
    
    if($row['admin']=='1'){
        $admin=$lang_administrator;
    }
    else{
        $admin=$lang_user;
    }
    if($row['active']=='1'){
        $active=$lang_user_active;
    }
    else{
        $active=$lang_user_inactive;
    }
    
    
    echo "<tr><td>".$row['id']."</td><td>".escape($row['user'])."</td><td>".$row['name']."</td><td>".$admin."</td><td>".$active."</td><td><form method='POST' action='index.php?link=set'><input type='hidden' name='hidd' value='2'><input type='hidden' name='id' value='".$row['id']."'/><input type='Submit' value='".$lang_change_cli."'/></form></td></tr>";
}

?>


</table>
</div>




<div id="settings_u2">
<table>
<tr>
	<td colspan="2"><?php echo $lang_user_add;?></td>
</tr>
<form method="POST" action="index.php?link=set">
<tr>
	<td><?php echo $lang_user_name;?>:</td>
	<td><input type="text"  name="user_log"/></td>
</tr>
<tr>
	<td><?php echo $lang_name;?>:</td>
	<td><input type="text"  name="user_nam"/></td>
</tr>
<tr>
	<td><?php echo $lang_premission;?>:</td>
	<td><select name="admin">
        <option value="0"><?php echo $lang_user;?></option>
        <option value="1"><?php echo $lang_administrator;?></option>
        </select>   
    </td>
</tr>
<tr>
	<td><?php echo $lang_stat;?>:</td>
	<td><select name="active">
        <option value="1"><?php echo $lang_user_active;?></option>
        <option value="0"><?php echo $lang_user_inactive;?></option>
        </select>
 </td>
</tr>
<tr>
	<td><?php echo $lang_password;?>:</td>
	<td><input type="password"  name="pass1"/></td>
</tr>
<tr>
	<td><?php echo $lang_password_repeat;?>:</td>
	<td><input type="password"  name="pass2"/></td>
</tr>
<tr>
	<td><?=$lang_object?>:</td>
	<td>
		<select name="office">
			<!--<option value='' />-->
			<? for( $i=0; $i<count($arrObjects); $i++ ){ ?>
				<option value="<?=($i+1)?>"<?if($_SESSION['office']==($i+1)) echo ' selected ';?>><?=$arrObjects[$i]?></option>
			<? } ?>
		</select>
	</td>
</tr>
<tr>
	<td><input type="hidden" name="hidd" value="6"/></td>
	<td><input type="submit" value="<?php echo $lang_add;?>"/></td>
    </form>
</tr>
</table>


</div>




</div>
<?php






}
else{
    


echo $lang_admin_perm_msg;

}
	}
	
	// I don't need this:
	// if ($_POST['hidd']=='1'){
		// $firm=addslashes($_POST['firm']);
		// $town=rep_q($_POST['town']);
		// $address=rep_q($_POST['address']);
		// $tel=rep_q($_POST['tel']);
        // $path_backup=rep_q($_POST['path_backup']);
		// $lng=rep_q($_POST['lng']);
				


				//$conn_file='conf/settings.php';
		// $write=fopen($conn_file, 'w') or die("$lang_error_settings_msg");
				// $data_conn = '<'.'?php'."\n";
		// fwrite($write, $data_conn);		
				// $data_conn = 	'$firm='."'".$firm."';\n";
		// fwrite($write, $data_conn);
				// $data_conn = '$town='."'".$town."';\n";
		// fwrite($write, $data_conn);
				// $data_conn = '$address='."'".$address."';\n";
		// fwrite($write, $data_conn);
				// $data_conn = '$tel='."'".$tel."';\n";
		// fwrite($write, $data_conn);
                // $data_conn = '$path_backup='."'".$path_backup."';\n";
		// fwrite($write, $data_conn);
                // $data_conn = '$lang='."'".$lng."';\n";
		// fwrite($write, $data_conn);
				// $data_conn = "?".">";
		// fwrite($write, $data_conn);
		
		// fclose($write);
		
        
        // $lang_serv_type_cond1=rep_q($_POST['rep_type1']);
        // $lang_serv_type_cond2=rep_q($_POST['rep_type2']);
        // $lang_serv_type_cond3=rep_q($_POST['rep_type3']);
        // $lang_serv_type_cond4=rep_q($_POST['rep_type4']);
        // $lang_cli_text=rep_q($_POST['cli_msg']);
        // $lang_adm_text=rep_q($_POST['adm_msg']);
        // $lang_cur=rep_q($_POST['currency']);
        
        
        
        // if ($lang=='lang/lang_bg.php'){
        // $conn_file='conf/set_lang_bg.php';
        // }
        // else{
        // $conn_file='conf/set_lang_en.php';
        // }
		
		// $write=fopen($conn_file, 'w') or die("$lang_error_settings_msg"."set_lang_file");
				// $data_conn = '<'.'?php'."\n";
		// fwrite($write, $data_conn);		
				// $data_conn = 	'$lang_serv_type_cond1='."'".$lang_serv_type_cond1."';\n";
		// fwrite($write, $data_conn);
				// $data_conn = 	'$lang_serv_type_cond2='."'".$lang_serv_type_cond2."';\n";
		// fwrite($write, $data_conn);
				// $data_conn = 	'$lang_serv_type_cond3='."'".$lang_serv_type_cond3."';\n";
		// fwrite($write, $data_conn);
				// $data_conn = 	'$lang_serv_type_cond4='."'".$lang_serv_type_cond4."';\n";
		// fwrite($write, $data_conn);
                // $data_conn = '$lang_cli_text='."'".$lang_cli_text."';\n";
		// fwrite($write, $data_conn);
                // $data_conn = '$lang_adm_text='."'".$lang_adm_text."';\n";
        // fwrite($write, $data_conn);
                // $data_conn = '$lang_cur='."'".$lang_cur."';\n";
		// fwrite($write, $data_conn);
				// $data_conn = '?'.'>';
		// fwrite($write, $data_conn);
		
		// fclose($write);
        
        
        
	// }
    
    if ($_POST['hidd']=='2'){

        $id=$_POST['id'];
        
    $res=$GLOBALS['conn']->query("SELECT * FROM login WHERE id='$id'");
if(!$res){die($GLOBALS['conn']->error);}
while($row=$res->fetch_array()){
    
    if($row['admin']=='1'){
        $admin1=$lang_administrator;
        $admin2=$lang_user;
        $adminins='0';
    }
    else{
        $admin1=$lang_user;
        $admin2=$lang_administrator;
        $adminins='1';
        
    }
    if($row['active']=='1'){
        $active1=$lang_user_active;
        $active2=$lang_user_inactive;
        $activeins='0';
    }
    else{
        $active1=$lang_user_inactive;
        $active2=$lang_user_active;
        $activeins='1';
    }
    
    echo "<table>";
    echo "<tr><form method='POST' action='index.php?link=set'><td>".$lang_delete.":</td><td><input type='hidden' name='hidd' value='4'><input type='hidden' name='id' value='".$row['id']."'/><input type='Submit' value='".$lang_delete."'/></form></td></tr><tr><form method='POST' action='index.php?link=set'><td>ID:</td><td>".$row['id']."</td></tr><tr><td>".$lang_user.":</td><td>".$row['user']."</td></tr><tr><td>".$lang_name.":</td><td><input type='text' name='name' value='".$row['name']."'/></td></tr><tr><td>".$lang_premission.":</td><td><select name='admin'><option value='".$row['admin']."'>".$admin1."</option><option value='".$adminins."'>".$admin2."</option></select></td></tr><tr><td>".$lang_user_active.":</td><td><select name='active'><option value='".$row['active']."'>".$active1."</option><option value='".$activeins."'>".$active2."</option></select></td></tr><tr><td>".$lang_password_new.":</td><td><input type='password' name='pass1'/></td></tr><tr><td>".$lang_password_repeat.":</td><td><input type='password' name='pass2'/></td></tr>
	<tr>
		<td>".$lang_object.":</td>
		<td>
			<select name='office'>
			<!--<option value='' />-->";
			for( $i=0; $i<count($arrObjects); $i++ ){ 
				echo "<option value=".($i+1).(($row['office']==($i+1))?" selected":"").">".$arrObjects[$i]."</option>\r\n";
			}
	echo
			"</select>
		</td>
	</tr>
	<tr><td></td><td><input type='hidden' name='hidd' value='3'><input type='hidden' name='id' value='".$row['id']."'/><input type='Submit' value='".$lang_change_cli."'/></form></td></tr>";
}    
        
       echo "</table>"; 
        
    }
    
    
    if ($_POST['hidd']=='3'){
        
        $id=$_POST['id'];
        $name=escape($_POST['name']);
        $admin=$_POST['admin'];
        $active=$_POST['active'];
		$office=$_POST['office'];
        $pass1=$GLOBALS['conn']->real_escape_string($_POST['pass1']);
        $pass2=$GLOBALS['conn']->real_escape_string($_POST['pass2']);
        
        if($pass1!=$pass2){
            echo $lang_password_dontm;
            echo "<form method='POST' action='index.php?link=set'><input type='hidden' name='hidd' value='2'/><input type='hidden' name='id' value='".$id."'/><input type='submit' value='".$lang_ok."'/></form>";
        }else{
        if ($pass1==''){
            
            $res=$GLOBALS['conn']->query("UPDATE login SET admin='$admin',name='$name',active='$active',office='$office' WHERE id='$id'");
        if(!$res){die($GLOBALS['conn']->error);}
       echo "<form method='POST' action='index.php?link=set'><input type='submit' value='".$lang_ok."'/></form>";
        }else{
        
        $res=$GLOBALS['conn']->query("UPDATE login SET admin='$admin',name='$name',active='$active',pass=MD5('$pass1'),office='$office' WHERE id='$id'");
        if(!$res){die($GLOBALS['conn']->error);}
       echo "<form method='POST' action='index.php?link=set'><input type='submit' value='".$lang_ok."'/></form>";
        }   
     }   
    }
    
    
    
    
    
    if ($_POST['hidd']=='4'){
        
       $id=$_POST['id'];
       echo $lang_deleteuser_question;
        echo "<form method='POST' action='index.php?link=set'><input type='hidden' name='hidd' value='5'/><input type='hidden' name='id' value='".$id."'/><input type='submit' value='".$lang_yes."'/></form>";
        echo "<form method='POST' action='index.php?link=set'><input type='hidden' name='hidd' value='2'/><input type='hidden' name='id' value='".$id."'/><input type='submit' value='".$lang_no."'/></form>";
    }
    
     if ($_POST['hidd']=='5'){
        
       $id=$_POST['id'];
       $dell=$GLOBALS['conn']->query("DELETE FROM login WHERE id='$id'");
        if(!$dell){die($GLOBALS['conn']->error);}
    echo $lang_delete_succ;
    echo "<form method='POST' action='index.php?link=set'><input type='submit' value='".$lang_ok."'/></form>";
    }
    
    
    
    if ($_POST['hidd']=='6'){
        
        
        
       $user_log=$GLOBALS['conn']->real_escape_string($_POST['user_log']);
       $user_nam=escape($_POST['user_nam']);
       $admin=$_POST['admin'];
       $active=$_POST['active'];
	   $office=$_POST['office'];
       $pass1=$GLOBALS['conn']->real_escape_string($_POST['pass1']);
       $pass2=$GLOBALS['conn']->real_escape_string($_POST['pass2']);
       
       
       if($pass1!=$pass2){
            echo $lang_password_dontm;
            echo "<a href='javascript:history.back(-1);'>".$lang_back."</a>";
        }
        else{
        if($pass1==''){
            echo $lang_empty_pass;
            echo "<a href='javascript:history.back(-1);'>".$lang_back."</a>";
        }
        else {
            $pass=MD5($pass1);
       $insert2=$GLOBALS['conn']->query("INSERT INTO login (user,name,pass,admin,active,office) VALUES ('$user_log','$user_nam','$pass','$admin','$active','$office')");
        if(!$insert2){die($GLOBALS['conn']->error);}
    echo $lang_add_succ;
    echo "<form method='POST' action='index.php?link=set'><input type='submit' value='".$lang_ok."'/></form>";
    }
    }
    }
?>
<div style="clear: both;"></div>