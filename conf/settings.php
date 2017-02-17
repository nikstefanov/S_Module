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
"Електронен четец",
"Захранване",
"Захранващ адаптор",
"Звукова карта",
"Карта памет",
"Касов апарат",
"Клавиатура",
"Лаптоп",
"Мишка",
"Мобилен телефон",
"Монитор",
"MP3 плеър",
"Оптично устойство",
"Преоб. напрежение",
"Принтер",
"Процесор",
"Рутер",
"Скенер",
"Сървър",
"Таблет",
"ТВ Тунер",
"Телевизор",
"Тонер Касета",
"Хард Диск",
"GPS",
"RAM Памет",
"UPS",
"USB флаш памет");

$brand_array = array(
"Acer",
"Advent",
"Amazon",
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
"Corsair",
"Cooler Master",
"Creative",
"Crown",
"Daisy",
"DeepCoool",
"DELL",
"D-Link",
"Eaton",
"Exper",
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
"PNY",
"Prestigio",
"Privileg",
"Razer",
"Ricoh",
"Samsung",
"Seagate",
"SOCOMEC",
"SONY",
"TDK",
"Tenda",
"Thermaltake",
"Titan",
"Toshiba",
"TP-LINK",
"Transcend",
"Velocity",
"VLINE",
"Western Digital",
"Xerox",
"Друго");

$sendto_array = array(
"Ай Би Ес България","Асбис","Булграм","Валентин Лидер","Вали","Вюпоинт","Макс Сервиз","Поликомп","Солитрон","Стантек","Стемо","Друг");
?>
