<!doctype html>
<?php
session_start();
include_once ("app/controllers/controller.php");

if(!empty($_GET["url"])){
	$url=$_GET["url"];
	switch($url){
		case "login": login(); break;
		case "logout": logout(); break;
		case "register": register(); break;
		case "user": user(); break;
		case "panel": user_panel(); break;
		case "advisor": advisor_panel(); break;
		case "admin": admin_panel(); break;
		case "lostpassword": lostpassword(); break;
		case "changepassword": changepassword(); break;
		case "notices": notices(); break;
		case "notice": notice();break;
		case "notice/new": notice_new(); break;
		case "requests": requests(); break;
		case "request": request();break;
		case "request/new": request_new(); break;
		default: message("Biraz utanç verici, değil mi?", "Görünen o ki, aradığınız her ne ise bulamıyoruz. Belki elastik arama yapabilirsiniz.");
	}
}
else{
	home();
}

?>