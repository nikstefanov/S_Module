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
?>
<div class="tursene"><?php echo $lang_search_cli;?></div>

<table>
<tr><form method="POST" action="index.php?link=cli">
	
	
</tr>

	<td><?php echo $lang_id;?>:</td>
    <td><?php echo $lang_name;?>:</td>
    <td><?php echo $lang_tel;?>:</td>
    <td><?php echo $lang_ip;?>:</td>
    <td><?php echo $lang_comment;?>:</td>
    <td><input type="hidden" name="hidd" value="1" /></td>

</tr>
<tr>	
    
    <td><input type="text" name="id" value="<?php echo $_POST['id'];?>"/></td>


	
	<td><input type="text" name="name" value="<?php echo $_POST['name'];?>"/></td>
	
	<td><input type="text" name="tel" value="<?php echo $_POST['tel'];?>"/></td>
	
	<td><input type="text" name="ip" value="<?php echo $_POST['ip'];?>"/></td>
	
	<td><textarea name="comment" rows="1" cols="20"><?php echo $_POST['comment'];?></textarea></td>
    <td><input type="submit"value="<?php echo $lang_filter;?>"/></td>
</tr>
</form>
</table>









<?php
if (!$_POST['hidd']){
    
  if (!($limit)){
$limit = 10;} 
if (!($_POST['page'])){
$page = 1;}
else {$page=$_POST['page'];}   
  
  
  $res=$GLOBALS['conn']->query("SELECT * FROM users");
      if(!$res){die($GLOBALS['conn']->error);}  
$numrows = $res->num_rows;
 $start_from = ($page-1) * $limit;    
$total_pages = ceil($numrows / $limit);

$res=$GLOBALS['conn']->query("SELECT * FROM users LIMIT $start_from,$limit");

?>


<table border="1">
<tr valign='middle'>
	<td width="3%"><?php echo $lang_id;?>:</td>
	<td width="5%"><?php echo $lang_name;?>:</td>
	<td width="15%"><?php echo $lang_tel;?>:</td>
	<td width="17%"><?php echo $lang_ip;?>:</td>
	<td width="17%"><?php echo $lang_comment;?>:</td>
	<td colspan="5" ><?php echo $lang_action_cli;?>:</td>
	
</tr>
<?php
      while($row=$res->fetch_array()){
        
      echo "<tr><form method='POST' action='index.php?link=cli'><td>".$row['id']."</td><td><input type='text' name='name' value='".$row['name']."'/></td><td><input type='text' name='tel' value='".$row['telephone']."'/></td><td><input type='text' name='ip' value='".$row['ip']."'/></td><td><textarea name='comment' cols='20' rows='3'>".$row['comment']."</textarea></td><td><input type='submit' value='".$lang_change_cli."'/><input type='hidden' name='hidd' value='2'/><input type='hidden' name='id' value='".$row['id']."'/></form></td></tr>";
        
        
      } 
       
  echo"</table>";     

$sr=0;   
echo "<div id='pager'>".$lang_page." : ";    
for ($i=1; $i<=$total_pages; $i++) {
$ia=$i;
$sr++;

if($ia==$page){
$ia="<font color='#FF6600'><b>".$i." </b></font>";
}
else{
       $ia="<form method='POST' action='index.php?link=cli' name='cli".$sr."'style='display:inline;'><input type='hidden' name='page' value='".$i."'/><a href='#'onclick='cli".$sr.".submit()'>".$i." </a></form> ";    
}
 echo  $ia;
            
}
echo "</div><div style='clear:both;'></div>";


	}
	elseif ($_POST['hidd']=='1'){
            $id=escape($_POST['id']);
            $name=escape($_POST['name']);
            $tel=escape($_POST['tel']);
            $ip=escape($_POST['ip']);
            $comment=escape($_POST['comment']);
		
       if($id!=''){
        $cond_id="AND id='$id'";
       }
       else{$cond_id='';
       }
       
              if($name!=''){
        $cond_name="AND name like '%$name%'";
       }
       else{$cond_name='';
       }
       
              if($tel!=''){
        $cond_tel="AND telephone like '%$tel%'";
       }
       else{$cond_tel='';
       }
       
              if($ip!=''){
        $cond_ip="AND ip='$ip'";
       }
       else{$cond_ip='';
       }
       
              if($comment!=''){
        $cond_comment="AND comment like '%$comment%'";
       }
       else{$cond_comment='';
       }
       
if (!($limit)){
$limit = 10;} 
if (!$_POST['page']){
$page = 1;}
else {$page=$_POST['page'];}       
$res=$GLOBALS['conn']->query("SELECT * FROM users WHERE id > 0 $cond_id $cond_name $cond_tel $cond_ip $cond_comment");
      if(!$res){die($GLOBALS['conn']->error);}       
$numrows = $res->num_rows;
if ($numrows == '0'){
echo  $lang_no_results; 
}    
else{
 $start_from = ($page-1) * $limit;    
$total_pages = ceil($numrows / $limit);       
       
       
       
      $res=$GLOBALS['conn']->query("SELECT * FROM users WHERE id > 0 $cond_id $cond_name $cond_tel $cond_ip $cond_comment LIMIT $start_from,$limit");
      if(!$res){die($GLOBALS['conn']->error);}
      
      
      
?>


<table border="1">
<tr valign='middle'>
	<td width="3%"><?php echo $lang_id;?>:</td>
	<td width="5%"><?php echo $lang_name;?>:</td>
	<td width="15%"><?php echo $lang_tel;?>:</td>
	<td width="17%"><?php echo $lang_ip;?>:</td>
	<td width="17%"><?php echo $lang_comment;?>:</td>
	<td colspan="5" ><?php echo $lang_action_cli;?>:</td>
	
</tr>
<?php
      while($row=$res->fetch_array()){
        
      echo "<tr><form method='POST' action='index.php?link=cli'><td>".$row['id']."</td><td><input type='text' name='name' value='".$row['name']."'/></td><td><input type='text' name='tel' value='".$row['telephone']."'/></td><td><input type='text' name='ip' value='".$row['ip']."'/></td><td><textarea name='comment' cols='20' rows='3'>".$row['comment']."</textarea></td><td><input type='submit' value='".$lang_change_cli."'/><input type='hidden' name='hidd' value='2'/><input type='hidden' name='id' value='".$row['id']."'/></form></td></tr>";
        
        
      } 
       
  echo"</table>";     
       
$sr=0;   
echo "<div id='pager'>".$lang_page." : ";    
for ($i=1; $i<=$total_pages; $i++) {
$ia=$i;
$sr++;

if($ia==$page){
$ia="<font color='#FF6600'><b>".$i." </b></font>";
}
else{
   
       $ia="<form method='POST' action='index.php?link=cli' name='cli".$sr."' style='display:inline;'><input type='hidden' name='page' value='".$i."'/><input type='hidden' name='hidd' value='1'/><input type='hidden' name='id' value='".$id."'/><input type='hidden' name='name' value='".$name."'/><input type='hidden' name='tel' value='".$tel."'/><input type='hidden' name='ip' value='".$ip."'/><input type='hidden' name='comment' value='".$comment."'/></form><a href='#' onclick='cli".$sr.".submit()'>".$i." </a>";    
}
 echo  $ia;
            
}
echo "</div><div style='clear:both;'></div>";     
       }
       
       
       
       }
       
     	elseif ($_POST['hidd']=='2'){
            $id=escape($_POST['id']);
            $name=escape($_POST['name']);
            $tel=escape($_POST['tel']);
            $ip=escape($_POST['ip']);
            $comment=escape($_POST['comment']);
            
            $update1=$GLOBALS['conn']->query("UPDATE IGNORE users SET name='$name',telephone='$tel',ip='$ip',comment='$comment' WHERE id='$id'");
            if(!$update1){die($GLOBALS['conn']->error);}
            else{
                echo $lang_msg_succ_change."<br /><form method='POST' action='index.php?link=cli'><input type='hidden' name='hidd' value='1'/><input type='hidden' name='id' value='".$id."'/><input type='submit' value='".$lang_ok."'/></form>";
            }
		  
          }     
?>