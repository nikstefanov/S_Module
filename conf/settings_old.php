<?php
// if ($_SESSION['office']==2 || $_SESSION['office']==4 || $_SESSION['office']==5 || $_SESSION['office']==6){
	// $firm='Компютър маркет ЕООД';
// } elseif ($_SESSION['office']==1 || $_SESSION['office']==3){
	// $firm='Лидер Технолоджис ЕООД';
// }
if ($_SESSION['brand_name']=='Computer Market') {
	$firm='Компютър маркет ЕООД';
}elseif ($_SESSION['brand_name']=='Leader Technologies') {
	$firm='Лидер Технолоджис ЕООД';
}elseif ($_SESSION['brand_name']=='IT Distribution') {
	$firm='ИТ Дистрибюшън АД';
}else{
	$firm='Сервизен модул';
}

//$tel='';
$path_backup='';
$lang='lang/lang_bg.php';
if ($lang=='lang/lang_en.php'){
	$lang_code='en';
}else{
	$lang_code='bg';
}
//Valid values - 'bg', 'en'.
//$arrObjects = get_array_offices('bg');
//var_dump($arrObjects);
//$arrObjects = array('Лидер Технолоджис','КМ - Бургас', 'КМ - Сливен', 'КМ - Пловдив', 'КМ - Славейков', 'Онлайн магазин' );
$product_array = array(
"Видеокарта",
"Десктоп",
"Други",
"Дъно",
"Захранване",
"Захранващ адаптор",
"Карта памет",
"Касов апарат",
"Лаптоп",
"Мобилен телефон",
"Монитор",
"Оптично устойство",
"Принтер",
"Рутер",
"Таблет",
"Тонер Касета",
"Хард Диск",
"GPS",
"RAM Памет",
"UPS",
"USB флаш памет");

$brand_array = array(
"Acer",
"AMD",
"AOC",
"APC",
"Apple",
"ASRock",
"Asus",
"ATI",
"Belkin",
"Brother",
"Canon",
"Canyon",
"Crown",
"Daisy",
"DeepCoool",
"DELL",
"D-Link",
"Eaton",
"Foxconn",
"Fujitsu",
"Fujitsu-Siemens",
"Genius",
"Gigabyte",
"Hanns-G",
"Hitachi",
"HP",
"IBM",
"Intel",
"Kingston",
"Kyocera",
"Lenovo",
"Lexmark",
"LG",
"Linksys",
"Lite-On",
"Logitech",
"MGE",
"Microsoft",
"MSI",
"Netgear",
"Nokia",
"nVidia",
"N-9500",
"Packard Bell",
"Perfect",
"Philips",
"Prestigio",
"Privileg",
"Razer",
"Ricoh",
"Samsung",
"Seagate",
"SOCOMEC",
"SONY",
"Tenda",
"Toshiba",
"TP-LINK",
"Transcend",
"Western Digital",
"Xerox",
"Друго");

$sendto_array = array(
"Асбис","Вюпоинт","Солитрон","Стантек","Стемо");
?>