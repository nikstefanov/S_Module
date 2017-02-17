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
if($lang=='lang/lang_bg.php'){
?>
<div id="help_1">


PcService е уеб-базирано приложение, което ще Ви улесни в издаването на сервизни карти. Системата е специализирана за работа в сервиз за компютърна техника. На кратко - завеждате приетата техника от клиента с описаните от него проблеми, сериен номер, предварителната договорка за вида на ремонта, имената и телофонен номер, след което издавате сервизна карта, която има отрязък за клиента. След диагностика и преглед на техниката се въвежда описание на констатираната повреда и ремонта, който е извършен. Издава се протокол за ремонт с описана цена и извършен ремонт или подмяна на части. 

Описание на менютата:

<ol start="1">
	<li><strong>Начало:</strong></li>
    - извеждат се поръчките за ремонт, които са със приоритет "спешно";<br />
    - табличка със статистика за картите и техния статус;<br />
    - съобщение от администратора, което е достъпно от меню "Настройки";<br />
	<li><strong>Нов:</strong></li>
    - добавяне на нова сервизна карта, описва се техниката, сериен номер,вида на ремонта, възможност за избор на съществуващ вече клиент или добавяне на нов/ако е необходимо да се добави нов клиент, горното поле се оставя празно. Не е възможно да има съвпадение на името на клиента и тел. номер/
	<li><strong>Търсене:</strong></li>
    - търсене в базата данни, възможност за извеждане на резултат по няколко критерия. След извеждане на резултата има възможност да закриете активна карта, отпечатване на протокол, промяна на статуса на съществуваща, изтриване и др.;
	<li><strong>Клиенти:</strong></li>
    - база данни с клиентите на сервиза, възможност за промяна на телефон, име на клиента, IP адрес и коментар;
	<li><strong>Настройки:</strong></li>
    - до това меню има достъп само администраторски акаунт, възможност за добавяне на нов потребител/техник/, промяна на парола, промяна на информацията за сервиза;<br />
    - възможност за редактиране на условията за ремонта, както и текста в отрязъка на клиента;<br />
    - редактиране  на съобщението от администратора;<br />
    - промяна на вида на валутата и езика;
	<li><strong>Архив:</strong></li>
    - възможност за архивиране на базата и връщане от съществуващ архив, изтриване на архив /достъпно само за администраторски акаунт. При връщане на архив се прави автоматичен такъв на съществуващата база до момента, файла започва с Rs_ ....sql и не се появява в табличката с архивите.

</ol>
</div>
<?php
	}
    if($lang=='lang/lang_en.php'){
        
?>
<div id="help_1">


PcService is a web-based application which goal is to ease your work in making service cards for your clients and your computer maintaining service station. In short, you describe the problem of the computer you receive for maintenance along with its serial number, the preliminary agreement of the type of repairment, the name of the client and his or her phone number. After you have filled all of the neccessary information, you can print the service card. It is separated in two parts - one papercut for the client and one for your service. After the diagnosis and repairment of the computer, you can fill the description of the problem found and the way of fixing it. Then you can print a protocol of the repairment with that information, plus the total cost for repairment.

Navigation:

<ol start="1">
	<li><strong>Home:</strong></li>
- all repairment orders marked as "urgent";<br />
- database statistics table with the current status of the cards;<br />
- message from the administrator, which can be altered under the Settings section;<br />
	<li><strong>New:</strong></li>
    - in this section you can make a new service card with description of the computer, serial number, type of the repairment with an option to choose between an existing client or new one. A match between the telephone number and the name of the client will result in an error;
	<li><strong>Search:</strong></li>
    - in this section you can search through your database with an option to choose between several criteria. With the output of your search, you can choose to close an active card, to print or delete a protocol and etc.;
	<li><strong>Clients:</strong></li>
   - in this section you can see the complete database of your clients with an option to change the phone number, the name or the IP address of a client or add a comment;
	<li><strong>Settings:</strong></li>
   - this section is accessible only to the administrator. Here you can add a new technician, change the password of a user or alter the details of your service station;<br />
- here you can change the terms of repairment and the text in the papercut for the client;<br />
- the message from the administrator is altered from here;<br />
- you can also change the currency and the language;
	<li><strong>Backup:</strong></li>
- in this section you can make an archive of all of your database or restore it to a previous state. This is accessible only to the administrator.
When an archive is restored the system automatically makes a new copy of the existing database. The copied database is stored in a file, which starts with Rs_......sql and is not shown in the archives table.

</ol>
</div>

<?php
        
        
        
        }
?>