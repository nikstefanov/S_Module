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
$dbhost=$GLOBALS['dbhost'];
$dbuser=$GLOBALS['dbuser'];
$dbpass=$GLOBALS['dbpass'];
$db=$GLOBALS['db'];

if(!$_POST['hidd']){
    

$res=$GLOBALS['conn']->query("SELECT * FROM backup order by id DESC");
if(!$res){die($GLOBALS['conn']->error);}


?>
<div id="archive">
<form method="POST" action="index.php?link=back">.sql<input type="radio" name="chkbox" value="1"/>  |  <input type="radio" name="chkbox" value="2" checked="yes"  />.sql.gz<input type="hidden" name="hidd" value="1" /><br /><input type="submit" value="<?php echo $lang_new_arch;?>"/></form>
</div>
<div>
<div>
<table>
<tr>
	<td><?php echo $lang_date;?>:</td>
	<td><?php echo $lang_file;?>:</td>
	<td><?php echo $lang_down_b;?>:</td>
	<td><?php echo $lang_restore_b;?>:</td>
    <td><?php echo $lang_delete;?>:</td>
</tr>

<?php

if (check_admin($_SESSION['user'])== True){
$no_cyk='0';
$no_cyk1='0';
	while ($row=$res->fetch_array()){
	 $no_cyk++;  
     $no_cyk1++;  
    if (!file_exists('backup/'.$row['file_b'])){
    $font_style_start="<s>";
    $font_style_end="</s>";
    $down_but="<s>".$lang_down_b."</s>";
    $restore_but="<s>".$lang_restore_b."</s>";
    $delete_but="<form id='delete_".$no_cyk."' method='post' action='index.php?link=back'><input type='hidden' name='id_b' value='".$row['id']."'/><input type='hidden' name='hidd' value='3'/></form><a href='#' onclick='delete_".$no_cyk.".submit()'><img src='img/delete.gif' alt='delete' width='15' height='15' /></a>";
    }
    else {
    $font_style_start="";
    $font_style_end="";
    $down_but="<a href='backup/".$row['file_b']."'target='_blank'>".$lang_down_b."</a>";
    $restore_but="<form id='restoring".$no_cyk1."' method='post' action='index.php?link=back'><input type='hidden' name='id_b' value='".$row['id']."'/><input type='hidden' name='hidd' value='2'/></form><a href='#' onclick='restoring".$no_cyk1.".submit()'>".$lang_restore_b."</a>";
    $delete_but="<form id='delete_".$no_cyk."' method='post' action='index.php?link=back'><input type='hidden' name='id_b' value='".$row['id']."'/><input type='hidden' name='hidd' value='3'/></form><a href='#' onclick='delete_".$no_cyk.".submit()'><img src='img/delete.gif' alt='delete' width='15' height='15' /></a>";
    }
       
	   echo "<tr><td>".$row['date_b']."</td><td>".$font_style_start.$row['file_b'].$font_style_end."</td><td>".$down_but."</td><td>".$restore_but."</td><td>".$delete_but."</td></tr>";
       }
       }
       
       else{
        
        while ($row=$res->fetch_array()){
        echo "<tr><td>".$row['date_b']."</td><td>".$row['file_b']."</td><td>-</td><td>-</td><td>-</td></tr>";
        }
       }
    

?>
</table>



</div>
</div>
<?php
}
if($_POST['hidd']=='1'){
$backupDir  = $path_backup."/backup/";
$back_hand=genRandomString();
$back_str=date('YmdHis');
$chkbox=$_POST['chkbox'];

if($chkbox=='1'){
 $back_end_file='.sql';
  $opt1='';
  $opt2='';  
}
if($chkbox=='2'){
 $back_end_file='.sql.gz';
  $opt1='--compress';
  $opt2='| gzip -9 -c ';  
}

$backupFileName = $back_hand.$back_str.$back_end_file;
$back = $backupDir.$backupFileName;
$strCommand = sprintf("mysqldump --force --databases $opt1  $db -h%s -u%s -p%s $opt2 > %s ",$dbhost,$dbuser,$dbpass,$back) or die ($GLOBALS['conn']->error);
$res_exec=shell_exec($strCommand);
//echo $res_exec.'<br/>';
echo "Backupfile: $back";
$date_b=date('Y-m-d');
$insert1=$GLOBALS['conn']->query("INSERT INTO backup (date_b,file_b) VALUES ('$date_b','$backupFileName')");
if(!$insert1){die($GLOBALS['conn']->error);}

}


//restore backup
if($_POST['hidd']=='2'){
$id_b=$_POST['id_b'];
$getid=$GLOBALS['conn']->query("SELECT * FROM backup WHERE id='$id_b'");
$row=$getid->fetch_array();
if(!$getid){die($GLOBALS['conn']->error);}      
?>
<table>
<tr>
	<td colspan="2"><?php echo $lang_restore_archive;?>: <?php echo $row['date_b'];?> ?</td>
	
</tr>
<tr>
	<td><form action="index.php?link=back" method="post">
<input type="hidden" name="id_b" value="<?php echo $row['id'];?>" /><input type="hidden" name="hidd" value="22" /><input  type="submit" value="<?php echo $lang_yes;?>"/>
</form></td>
	<td><form action="index.php?link=back" method="post">
<input  type="submit" value="<?php echo $lang_no;?>"/>
</form></td>
</tr>
</table>


<?php
}
if($_POST['hidd']=='22'){
$backupDir  = $path_backup."/backup/";
$back_hand=genRandomString();
$back_str=date('YmdHis');
$rest_id='Rs_';
 $back_end_file='.sql';
  $opt1='';
  $opt2=''; 
$backupFileName = $rest_id.$back_hand.$back_str.$back_end_file;
$back = $backupDir.$backupFileName;
$strCommand = sprintf("mysqldump --force --databases $opt1  $db -h%s -u%s -p%s $opt2 > %s ",$dbhost,$dbuser,$dbpass,$back) or die ($GLOBALS['conn']->error);
$res_exec = shell_exec($strCommand);
//echo $res_exec.'<br/>';

echo $back;


$id_b=$_POST['id_b'];
$getid=$GLOBALS['conn']->query("SELECT * FROM backup WHERE id='$id_b'");
$row=$getid->fetch_array();
if(!$getid){die($GLOBALS['conn']->error());}


$filename_c=$row['file_b'];
$bkpfile=$backupDir.$filename_c;


$check_ext=explode('.',$filename_c);


if($check_ext[2]=='gz'){
$strCommand = sprintf("gunzip -c  $bkpfile | mysql -u $dbuser -p$dbpass $db ") or die ($GLOBALS['conn']->error);
$method='gz file';
}
if($check_ext[2]==''){
$strCommand = sprintf("mysql -u $dbuser -p$dbpass $db < $bkpfile") or die ($GLOBALS['conn']->error);
$method='sql file';
}
$res_exec = shell_exec($strCommand);
//echo $res_exec.'<br/>';
echo $method;

}

if($_POST['hidd']=='3'){

$id_b=$_POST['id_b'];

echo $lang_delete."?<br/><form id='delete_c' method='post' action='index.php?link=back'><input type='hidden' name='id_b' value='".$id_b."'/><input type='hidden' name='hidd' value='4'/></form><a href='#' onclick='delete_c.submit()'>".$lang_yes."</a><form id='delete_c1' method='post' action='index.php?link=back'></form><a href='#' onclick='delete_c1.submit()'>".$lang_no."</a>";
}

if($_POST['hidd']=='4'){

$id_b=$_POST['id_b'];
$remfile=$GLOBALS['conn']->query("SELECT * FROM backup WHERE id='$id_b'") or die($GLOBALS['conn']->error);
$row_f=$remfile->fetch_array();
$del_file="backup/".$row_f['file_b'];
unlink($del_file);


$del_q=$GLOBALS['conn']->query("DELETE FROM backup WHERE id='$id_b'");
if(!$del_q){die($GLOBALS['conn']->error);}





}
?> 