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
//resultat v input box





 
function getres($ii,$tt){
	
	if ($ii=='id'){
	$res=$GLOBALS['conn']->query("SELECT * FROM $tt ORDER by id desc LIMIT 1");
        $check_empty=$res->num_rows;
	   if ($check_empty >'0'){
	$row=$res->fetch_array();
			echo $row['id']+1;
		}
        else{ echo "1";}
        
	}
	elseif($ii=='name'){
		$res=$GLOBALS['conn']->query("SELECT * FROM $tt where name=$ii order by name");
		while ($row=$res->fetch_array()){
			echo "<option value='".$row['id']."'>".$row["$ii"]."-".$row['telephone']."</option>";
		}
		}
		
	elseif($ii=='user'){
		$res=$GLOBALS['conn']->query("SELECT * FROM $tt group by $ii");
		while ($row=$res->fetch_array()){
			echo "<option value='".$row["$ii"]."'>".$row["$ii"]."</option>";
		}
	}
	elseif ($ii=='date_p'||$ii=='date_r'){
		echo date('Y-m-d');
	}
}


//izvejdane klient ot tablicata
function getcl($ii){
	
	
	$res22=$GLOBALS['conn']->query("SELECT * FROM users WHERE id='$ii'");
	
		$row22=$res22->fetch_array();
			echo $row22['name'];
		
	}
	
	//zamqna na <br> s ;
function rembr($aa){
	$aa=str_replace('<br/>',';',$aa);
	echo $aa;
}

function getcli1($ii){
	
		$res33=$GLOBALS['conn']->query("SELECT * FROM users where id='$ii'");
		while ($row33=mysql_fetch_array($res33)){
			echo "<option value='".$row33['id']."'>".$row33['name']."-".$row33['telephone']."</option>";
		}
	
}


//random4letterfunction
function genRandomString() {
    $length = 4;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string ='';    

    for ($p = 0; $p < $length; $p++) {
        $string.=$characters[mt_rand(0, strlen($characters))];
    }

    return $string;
}
//function replace quot
 function rep_q($a){
    $a=str_replace('"','&quot;',$a);
    $a=str_replace("'",'&#39;',$a);
    return $a;
    
 }
 ///////////////////////////////////////////////////////////////
//function for pages
 function pages() {
	 $ia="<form method='POST' action='index.php?link=search' style='display:inline;'>".
	 "<input type='hidden' name='page' value='".$i."'/>".
	 "<input type='hidden' name='hidd' value='1'/>".
	 "<input type='hidden' name='client' value='".$client."'/>".
	 "<input type='hidden' name='id' value='".$id."'/>".
	 "<input type='hidden' name='date_p' value='".$date_p."'/>".
	 "<input type='hidden' name='user' value='".$user."'/>".
	 "<input type='hidden' name='serial' value='".$serial."'/>".
	 "<input type='hidden' name='product' value='".$product."'/>".
	 "<input type='hidden' name='act' value='".$act."'/>".
	 "</form>".
	 "<a href='#' onclick='search".$sr.".submit()'>".$i."-</a>"; 
 }

function get_last_card_id() {
	$res = $GLOBALS['conn']->query("select max(id) from pcservice");
	if (!$res){
		return 0;
	}else{
		$row = $res->fetch_row();
		$id = $row[0];
		$res->close();
		return $id;
	}
}



function get_connection() {

	$dbhost=$GLOBALS['dbhost'];
	$dbuser=$GLOBALS['dbuser'];
	$dbpass=$GLOBALS['dbpass'];
	$db=$GLOBALS['db'];
	$conn=new mysqli($dbhost,$dbuser,$dbpass);
	if(!$conn){die( $GLOBALS['conn']->error);}
	$conn->query("SET NAMES utf8");
	$conn->query("SET CHARACTER SET utf8");
	$conn->query("SET collation_connection = utf8_general_ci");	
	$conn_db=$conn->select_db($db);
	if(!$conn_db){die ("cant select database");}
	return $conn;
}

function check_admin($ia) {	
	$check_adm=$GLOBALS['conn']->query("SELECT * FROM login WHERE name='$ia' and admin='1' and active='1'");
	if(!$check_adm){die($GLOBALS['conn']->error);}
	$rowcnt = $check_adm->num_rows;
	if ($rowcnt == 1) {
		return true;
	}
}

function get_field_by_id($id,$field_name) {
	$res = $GLOBALS['conn']->query("SELECT ".$field_name." FROM pcservice WHERE id=".$id);
	if ($res){
		$row = $res->fetch_row();
		$field_value = $row[0];
		$res->close();
		return $field_value;
	}else{
		return false;
	}
}

// function get_field($field_name) {
	// $res = $GLOBALS['conn']->query("SELECT ".$field_name." FROM users");
	// if (!res) {die($GLOBALS['conn']->error);}
	// if ($res){
		// $field_array = $res->fetch_all(MYSQLI_NUM);
		// $res->close();
		// return $field_array;
	// }else{
		// return false;
	// }
// }

// function get_field_table($field_name,$table) {
	// $res = $GLOBALS['conn']->query("SELECT ".$field_name." FROM ".$table);
	// if (!res) {die($GLOBALS['conn']->error);}	
	// $field_array = $res->fetch_all(MYSQLI_NUM);
	// $res->close();
	// return $field_array;	
// }

function get_field_arr_table($field_name,$table){
	$res = $GLOBALS['conn']->query("SELECT ".$field_name." FROM ".$table." ORDER BY id ASC");
	if (!res) {die($GLOBALS['conn']->error);}	
	$res1=array();
	while($row=$res->fetch_array(MYSQLI_NUM)){
		$res1[]=$row[0];
	}
	$res->close();
	return $res1;
}

function check_client( $client, $telephone, $telephone_2) {
	$res = $GLOBALS['conn']->query("SELECT id,telephone_2 FROM users WHERE name='".
		escape($client)."' AND telephone='".
		escape($telephone)."'");
	if(!$res) { die($GLOBALS['conn']->error); }
	if ($res->num_rows == 0) { 
		$res->close();
		return false;
	}
	$row = $res->fetch_row();	
	$res->close();	
	if(strcmp($row[1],escape($telephone_2))!=0){		
		update_client_tel2($row[0], escape($telephone_2));
	}
	return $row[0];	
}

function insert_client( $client, $telephone, $telephone_2) {
	$client_es = escape($client);
	$telephone_es = escape($telephone);
	$telephone_2_es = escape($telephone_2);
	$res = $GLOBALS['conn']->query("INSERT INTO users (name,telephone,telephone_2,ip,comment) VALUES ('$client_es','$telephone_es','$telephone_2_es','','')");
	if (!$res){ die($GLOBALS['conn']->error); }
	return check_client( $client, $telephone ,$telephone_2);	
}

function update_client_tel2($cl_id, $telephone_2){	
	$res = $GLOBALS['conn']->query("UPDATE users SET telephone_2='$telephone_2' WHERE id=$cl_id");
	if (!$res){die($GLOBALS['conn']->error);}
}


function insert_card(
	$date_p,
	$office,	
	$product,
	$brand,
	$model,
	$outlook,
	$guarantee,
	$guarantee_num,
	$serial,
	$problem,
	$serv_type,
	$price_agreed,
	$priority,
	$client_name,
	$telephone,
	$telephone_2,
	$claim_number,
	$login_os,
	$login_username,
	$login_password
) {	
	$date_p_es = escape($date_p);
	$office_es = escape($office);	
	$product_es = escape($product);
	$brand_es = escape($brand);
	$model_es = escape($model);
	$outlook_es = escape($outlook);
	$guarantee_es = escape($guarantee);
	$guarantee_num_es = escape($guarantee_num);
	$serial_es = escape($serial);
	$problem_es = escape($problem);	
	$user_priel_es = escape($_SESSION['user']);	
	$serv_type_es = escape($serv_type);
	$price_agreed_es = escape($price_agreed);
	$priority_es = escape($priority);
	$object_es = get_old_object_from_office($office);
	$claim_number_es = escape($claim_number);
	$login_os_es = escape($login_os);
	$login_username_es = escape($login_username);
	$login_password_es = escape($login_password);
	
	$cl_id = check_client( $client_name, $telephone, $telephone_2);
	if (!$cl_id) {
		$cl_id = insert_client( $client_name, $telephone, $telephone_2);	
	}
	
	// $res = $GLOBALS['conn']->query("SELECT * FROM pcservice WHERE client='".$cl_id.
	// "' AND date_p='".$date_p_es."' AND serial='".$serial_es."' AND user_priel='".$user_priel_es."'");
	// if (!$res){die($GLOBALS['conn']->error);}
	// if ($res->num_rows > 0) {die($lang_alrady_inserted);}
	
	$insertt=$GLOBALS['conn']->query("INSERT INTO pcservice (date_p,object,client,product,brand,model,outlook,guarantee,guarantee_num,serial,problem,user,user_priel,user_izdal,serv_type,price_agreed,solved,date_r,price,constat,guarantee_note,active,priority,status,checked,sendto,office,claim_number,login_os,login_username,login_password) VALUES
	('$date_p_es','$object_es','$cl_id','$product_es','$brand_es','$model_es','$outlook_es','$guarantee_es','$guarantee_num_es','$serial_es','$problem_es','','$user_priel_es','','$serv_type_es','$price_agreed_es','','0000-00-00','0.00','','',1,'$priority_es',0,0,'','$office_es','$claim_number','$login_os','$login_username','$login_password')");
	if (!$insertt){die($GLOBALS['conn']->error);}
	
	$res = $GLOBALS['conn']->query("SELECT *,pcservice.id as pid ".
		"FROM pcservice ".
		"LEFT OUTER JOIN offices ON pcservice.office=offices.id ".
		"WHERE client='".$cl_id.
		"' ORDER BY pcservice.id DESC LIMIT 1");
	if (!$res){die($GLOBALS['conn']->error);}
	if ($res->num_rows == 0) return false;
	$row = $res->fetch_assoc();
	$res->close();
	
	$row['id'] = $row['pid'];
	$row['client_name'] = escape($client_name);
	$row['telephone'] = escape($telephone);
	
	return $row;
}

function get_card($id,$decode) {
	$res = $GLOBALS['conn']->query("SELECT * ".
		"FROM pcservice ".
		"LEFT OUTER JOIN users ON pcservice.client=users.id ".
		"LEFT OUTER JOIN offices ON pcservice.office=offices.id ".
		"WHERE pcservice.id=".$id);
	if (!$res){die($GLOBALS['conn']->error);} 
	if ($res->num_rows == 0) {die("No such card!");}
	$row = $res->fetch_assoc();
	$res->close();
	
	//echo "TEl:".$row['telephone']."<br/>";	
	$row['client_name'] = $row['name'];
	$row['id'] = $id;
	
	if($decode){
		foreach($row as $cell){
			$cell = unescape($cell);
		}
	}
	return $row;
}


function update_card(
$id,
$active,
$date_p,
$office,
$product,
$brand,
$model,
$outlook,
$guarantee,
$guarantee_num,
$serial,
$problem,
$serv_type,
$price_agreed,
$priority,
$sendto,
$send_returned,
$send_courier,
$send_doc_no,
$status_note,
$client_name,
$telephone,
$telephone_2,
$claim_number,
$login_os,
$login_username,
$login_password,
$pre_active
) {	
	$active_es = escape($active);
	$date_p_es = escape($date_p);	
	$office_es = $office;
	$product_es = escape($product);
	$brand_es = escape($brand);
	$model_es = escape($model);
	$outlook_es = escape($outlook);
	$guarantee_es = escape($guarantee);
	$guarantee_num_es = escape($guarantee_num);
	$serial_es = escape($serial);
	$problem_es = escape($problem);		
	$serv_type_es = escape($serv_type);
	$price_agreed_es = escape($price_agreed);	
	$priority_es = escape($priority);
	$sendto_es = escape($sendto);
	$send_returned_es = ($send_returned)?'TRUE':'FALSE';
	$send_courier_es = escape($send_courier);
	$send_doc_no_es = escape($send_doc_no);
	$status_note_es = escape($status_note);
	$object_es = get_old_object_from_office($office);
	$claim_number_es = escape($claim_number);
	$login_os_es = escape($login_os);
	$login_username_es = escape($login_username);
	$login_password_es = escape($login_password);
	
	$cl_id = check_client( $client_name, $telephone, $telephone_2);
	if (!$cl_id) {
		$cl_id = insert_client( $client_name, $telephone, $telephone_2);	
	}
	 
	$close_update = "";
	if ($pre_active != 2 && $active_es == 2){
		$close_update = ", date_r = '".date('Y-m-d')."', user = '".escape($_SESSION['user'])."' ";
	}
	//if ($active_es){$active_update = ",active='$active'";}
	//echo 
	$query_str = 	
	"UPDATE pcservice SET
	active=			'$active_es',
	date_p=         '$date_p_es',
	object=			'$object_es',
	office=         '$office_es',
	client=         '$cl_id',
	product=        '$product_es',
	brand=          '$brand_es',
	model=          '$model_es',
	outlook=        '$outlook_es',
	guarantee=      '$guarantee_es',
	guarantee_num=  '$guarantee_num_es',
	serial=         '$serial_es',
	problem=        '$problem_es',	
	serv_type=      '$serv_type_es',
	price_agreed=   '$price_agreed_es',	
	priority=       '$priority_es',
	sendto=			'$sendto_es',
	send_returned=   $send_returned_es,
	send_courier=   '$send_courier_es',
	send_doc_no=    '$send_doc_no_es',
	status_note=    '$status_note_es',
	claim_number=	'$claim_number_es',
	login_os = '$login_os_es',
	login_username = '$login_username_es',
	login_password = '$login_password_es'
	"
	.$close_update.
	//$active_update.
	"WHERE id=       '$id'";
	
	// "
	// #user=           '',
	// #user_priel=     '',
	// #user_izdal=     '',
	// #solved=         '',
	// #date_r=         '0000-00-00',//?
	// #price=          '0.00',
	// #constat=        '',
	// #guarantee_note= '',
	// #active=         1,
	// #status=         0,
	// #checked=        0 "
	//echo $query_str.'<br/>';
	
	$insertt=$GLOBALS['conn']->query($query_str);
	if (!$insertt){die($GLOBALS['conn']->error);}
	
	return get_card($id,false);
}

function escape($str) {
	return htmlspecialchars($str,ENT_QUOTES,"UTF-8",false);
}

function unescape($str) {
	return htmlspecialchars_decode ($str, ENT_QUOTES);
}
function pager_form_inputs(
$page,
$act,
$id,
$date_p,
$client,
$user,
$telephone,			
$office,
$product,
$brand,
$model,
$sendto,
$serial,
$guarantee,
$guarantee_swap,
$returned,
$checked,
$submit_text
){
	$str=
	"<input type='hidden' name='link' value='search' />\r\n".
	"<input type='hidden' name='act' value='".$act."'/>\r\n".
	"<input type='hidden' name='id' value='".$id."'/>\r\n".
	"<input type='hidden' name='date_p' value='".$date_p."'/>\r\n".	
	"<input type='hidden' name='client' value='".$client."'/>\r\n".	
	"<input type='hidden' name='user' value='".$user."'/>\r\n".
	"<input type='hidden' name='telephone' value='".$telephone."'/>\r\n".
	"<input type='hidden' name='office' value='".$office."'/>\r\n".
	"<input type='hidden' name='product' value='".$product."'/>\r\n".
	"<input type='hidden' name='brand' value='".$brand."'/>\r\n".
	"<input type='hidden' name='model' value='".$model."'/>\r\n".
	"<input type='hidden' name='sendto' value='".$sendto."'/>\r\n".
	"<input type='hidden' name='serial' value='".$serial."'/>\r\n".
	"<input type='hidden' name='guarantee' value='".$guarantee."'/>\r\n".
	"<input type='hidden' name='guarantee_swap' value='".$guarantee_swap."'/>\r\n".
	"<input type='hidden' name='returned' value='".$returned."'/>\r\n".
	"<input type='hidden' name='checked' value='".$checked."'/>\r\n".
	"<input type='submit' value='".$submit_text."' style='background: transparent;border-style:none'>\r\n";	   
	if ($page > 0){
		$str=$str."<input type='hidden' name='page' value='".$page."'/>\r\n";
	}
	return $str;
}
/*
function get_array_offices($lang){
	$res = $GLOBALS['conn']->query("SELECT nickname_".$lang." FROM offices ORDER by id ASC");
	if (!$res){die($GLOBALS['conn']->error);}	
	$res1=array();
	while($row=$res->fetch_array(MYSQLI_NUM)){
		$res1[]=$row[0];
	}
	$res->close();
	return $res1;
}*/

function get_old_object_from_office($office){		
	if ( $office > 0  && $office < 7 ) {
		$old_arrObjects = get_field_arr_table('old_nickname','offices');
		return $old_arrObjects[($office-1)];
	}else{
		return "";
	}
}

/*
function get_login_for_office($office_id,$admin){	
	$res=$GLOBALS['conn']->query("SELECT user,name FROM login".($admin?"":" where office=$office_id"));
	if (!$res){die($GLOBALS['conn']->error);}
	if ($res->num_rows == 0) return false;
	while ($row=mysql_fetch_array($res)){
		echo "<option value='".$row['user']."'>".$row['name']."</option>";
	}	
}*/


function array_from_table($columns,$table,$constrains){
	$res=$GLOBALS['conn']->query("SELECT $columns FROM $table".($constrains?" where $constrains":""));
	if (!$res){die($GLOBALS['conn']->error);}
	$res1=array();
	while($row=$res->fetch_assoc()){
		$res1[]=$row;
	}
	$res->close();
	return $res1;	
}



$dbhost='localhost';
$dbuser='pcservice';
$dbpass='pcservice1234';
$db='pcservice';

// $dbhost='192.168.1.4';
// $dbuser='pcservice';
// $dbpass='pcservice1234';
// $db='pcservice_tmp';

$conn=get_connection();
?>