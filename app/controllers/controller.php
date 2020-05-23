<?php
include_once ("app/models/model.php");
include_once ("app/views/view.php");

if(!isset($_SESSION['user_role'])) $_SESSION['user_role']="guest";

function login(){
    if($_SESSION['user_role']=="guest"){
        if(!isset($_POST['user_no'])&&!isset($_POST['user_password'])){
            view_public(array(
                "title"=>"Giris",
                "body"=>"app/views/public/login.php"));
        } else db_user_login($_POST['user_no'], md5($_POST['user_password']));
    } else message("Basarisiz", "Daha once giris yapilmis. <a href='javascript:window.history.back();'>Geri donmek icin tiklayin</a>");
}
function logout(){
    session_destroy();
    header("location: index.php");
}
function register(){
    if($_SESSION['user_role']=="guest"){
        if(!isset($_POST['user_no'])&&!isset($_POST['user_name'])&&!isset($_POST['user_password_1'])&&!isset($_POST['user_password_2'])){
            view_public(array(
                "title"=>"Kayit",
                "body"=>"app/views/public/register.php"));
        } else if($_POST['user_password_1']!=$_POST['user_password_2']){
            message("Basarisiz", "Sifreler uyusmuyor. Lutfen tekrar deneyin. <a href='javascript:window.history.back();'>Geri donmek icin tiklayin</a>");
        } else if($_POST['user_no']==db_user_control($_POST['user_no'])){
            message("Basarisiz", "Boyle bir kullanici zaten var. Lutfen tekrar deneyin. <a href='javascript:window.history.back();'>Geri donmek icin tiklayin</a>");
        } else db_user_new($_POST['user_no'], $_POST['user_name'], md5($_POST['user_password_1']));
    } else message("Basarisiz", "Daha once kayit oldunuz <a href='javascript:window.history.back();'>Geri donmek icin tiklayin</a>");
}
function lostpassword(){
    if($_SESSION['user_role']=="guest"){
        if(!isset($_POST["user_no"])){
            view_public(array(
                "title"=>"Sifremi Unuttum",
                "body"=>"app/views/public/lostpassword.php"));
        } else if($_POST['user_no']!=db_user_control($_POST['user_no'])){
            message("Basarisiz", "Boyle bir kullanici kayitli degil. <a href='javascript:window.history.back();'>Geri donmek icin tiklayin</a>");
        } else {
            //functions...
            message("Basarili", "Yeni sifre istediniz. Yonetici onay verdikten sonra numaraniz ve yeni sifreniz ile giris yapabiliriniz");
        }
    } else message("Basarisiz", "Oncelikle cikis yapiniz <a href='javascript:window.history.back();'>Geri donmek icin tiklayin</a>");
}
function changepassword(){
    if($_SESSION['user_role']!="guest"){
        if(!isset($_POST["user_password"])&&!isset($_POST["user_password_1"])&&!isset($_POST["user_password_2"])){
            view_user(array(
                "title"=>"Sifremi Degistir",
                "body"=>"app/views/user/changepassword.php"));
        } else if($_POST['user_password_1']!=$_POST['user_password_2']){
            message("Basarisiz", "Sifreler uyusmuyor. Lutfen tekrar deneyin. <a href='javascript:window.history.back();'>Geri donmek icin tiklayin</a>");
        } else if(md5($_POST['user_password'])!=db_password_control($_SESSION['user_no'], md5($_POST['user_password']))){
            message("Basarisiz", "Mevcut sifreniz yanlis. Lutfen kontrol edin <a href='javascript:window.history.back();'>Geri donmek icin tiklayin</a>");
        } else db_changepassword($_SESSION['user_no'], md5($_POST['user_password_1']));
    } else message("Biraz utanç verici, değil mi?", "Görünen o ki, aradığınız her ne ise bulamıyoruz. Belki elastik arama yapabilirsiniz.");
}
function message($message_head=null, $message_body=null){
    view_message(array(
        "title"=>"Mesaj",
        "body"=>"app/views/public/message.php",
        "article_head"=>$message_head,
        "article_content"=>$message_body));
}
function home(){
    view_public(array(
        "title"=>"Anasayfa",
        "body"=>"app/views/public/home.php",
        "article2_content"=>db_contents_last5()));
}
function contents(){  
    view_public(array(
        "title"=>"Icerikler",
        "body"=>"app/views/public/contents.php",
        "article_content"=>db_contents_all(),
        "aside_content"=>db_contents_rand5()));
}
function content(){
    $count=db_content_count();
    if(isset($_GET["id"])&&1<=$_GET["id"]&&$_GET["id"]<=$count){
        $content_id=$_GET["id"];
        if(!isset($_POST['comment_body'])){
            view_public(array(
                "title"=>"Icerik",
                "body"=>"app/views/public/content.php",
                "article_content"=>db_content($content_id),
                "article_comments"=>db_content_comments($content_id)));
        } else db_comment_new($_POST['comment_body'], $_SESSION['user_id'], $content_id);
    } else message("Biraz utanç verici, değil mi?", "Görünen o ki, aradığınız her ne ise bulamıyoruz. Belki elastik arama yapabilirsiniz.");
}
function content_new(){
    if($_SESSION['user_role']!="guest"){
        if(!isset($_POST['content_head']) && !isset($_POST['content_body'])){
            view_user(array(
                "title"=>"Yeni Icerik",
                "body"=>"app/views/user/content_new.php"));
        } else db_content_new($_POST['content_head'], $_POST['content_body'], $_SESSION['user_id']);
    } else message("Biraz utanç verici, değil mi?", "Görünen o ki, aradığınız her ne ise bulamıyoruz. Belki elastik arama yapabilirsiniz.");
}
function requests(){ //kontrolleri eklenecek
    view_user(array(
        "title"=>"Ödevler",
        "body"=>"app/views/user/requests.php",
        "article_content"=>db_requests_all(),
        "aside_content"=>db_requests_rand5()));
}
function request(){
    $count=db_request_count();
    if(isset($_GET["id"])&&1<=$_GET["id"]&&$_GET["id"]<=$count){
        $request_id=$_GET["id"];
        if(!isset($_POST['respond_body'])){
            view_public(array(
                "title"=>"Ödev",
                "body"=>"app/views/user/request.php",
                "article_content"=>db_request($request_id),
                "article_comments"=>db_request_responds($request_id)));
        } else db_respond_new($_POST['respond_body'], $_SESSION['user_id'], $request_id);
    } else message("Biraz utanç verici, değil mi?", "Görünen o ki, aradığınız her ne ise bulamıyoruz. Belki elastik arama yapabilirsiniz.");
}
function request_new(){
    if($_SESSION['user_role']=="advisor"){
        if(!isset($_POST['request_end_date']) && !isset($_POST['request_li_id_fk']) && !isset($_POST['request_head']) && !isset($_POST['request_body']) && !isset($_POST['request_status'])){
            view_user(array(
                "title"=>"Yeni Ödev Ekle",
                "body"=>"app/views/advisor/request_new.php",
                "article_content"=>db_lesson($_SESSION['user_id'])));
        } else if($_POST['request_status']!="published"){
            $_POST['request_status']="unpublished";
        } else  db_request_new($_POST['request_end_date'], $_POST['request_li_id_fk'],  $_POST['request_head'], $_POST['request_body'], $_POST['request_status'],  $_SESSION['user_id']);
    } else message("Biraz utanç verici, değil mi?", "Görünen o ki, aradığınız her ne ise bulamıyoruz. Belki elastik arama yapabilirsiniz.");
}// ödevin yayınlanıp yayınlanmayacağında kaldık //
function notices(){  
    view_public(array(
        "title"=>"Duyurular",
        "body"=>"app/views/public/notices.php",
        "article_content"=>db_notices_all(),
        "aside_content"=>db_notices_rand5()));
}
function notice(){
    $count=db_notice_count();
    if(isset($_GET["id"])&&1<=$_GET["id"]&&$_GET["id"]<=$count){
        $notice_id=$_GET["id"];
            view_public(array(
                "title"=>"Duyuru",
                "body"=>"app/views/public/notice.php",
                "article_content"=>db_notice($notice_id)));
    } else message("Biraz utanç verici, değil mi?", "Görünen o ki, aradığınız her ne ise bulamıyoruz. Belki elastik arama yapabilirsiniz.");
}
function notice_new(){
    if($_SESSION['user_role']=="advisor"){
        if(!isset($_POST['content_head']) && !isset($_POST['content_body'])){
            view_user(array(
                "title"=>"Yeni Duyuru",
                "body"=>"app/views/advisor/notice_new.php"));
        } else db_notice_new($_POST['notice_status'], $_POST['notice_head'], $_POST['notice_body'], $_SESSION['user_id']);
    } else message("Biraz utanç verici, değil mi?", "Görünen o ki, aradığınız her ne ise bulamıyoruz. Belki elastik arama yapabilirsiniz.");
} // duyurunun yayınlanıp yayınlanmacağı
function user(){
    if($_SESSION['user_role']!="guest"){
        if(isset($_GET["no"])&&!empty($_GET['no'])&&is_numeric($_GET['no'])){
            $user_no=$_GET["no"];
            view_user(array(
                "title"=>"Kullanici",
                "body"=>"app/views/user/user.php",
                "article_content"=>db_user($user_no)));
        } else message("Biraz utanç verici, değil mi?", "Görünen o ki, aradığınız her ne ise bulamıyoruz. Belki elastik arama yapabilirsiniz.");
    } else message("Basarisiz", "Kullanici profillerini kayitli kullanicilar goruntuleyebilirler. <a href='?url=login'>Giris yapmak icin tiklayin</a>");
}
function image_edit($user_no){ //USER IMAGE CONTROL & UPLOAD
    if(isset($_FILES['user_image'])){
        if($_FILES['user_image']['error']){
            message("Basarisiz", "Yuklenirken bir hata gerceklesti.<br>Once 'Resim Degistir' ile cihazinizdan bir resim secin,<br>Resmi sectikten sonra 'RESMI KAYDET'e tiklayin<br><a href='?url=panel&no=$user_no'>Geri don</a>");
        } else {
           $size = $_FILES['user_image']['size'];
           if($size > (1024*1024*3)){
            message("Basarisiz", "Dosya 3MB den buyuk olamaz. <a href='?url=panel&no=$user_no'>Geri donmek icin tiklayin</a>");
           } else {
              $image_type = $_FILES['user_image']['type'];
              $image_name = $_FILES['user_image']['name'];
              $image_extension = explode('.', $image_name);
              $image_extension = $image_extension[count($image_extension)-1];
              if($image_type != 'image/jpeg' || $image_extension != 'jpg') {
                message("Basarisiz", "Yanlizca JPG dosyalari yukleyebilirsiniz. <a href='?url=panel&no=$user_no'>Geri donmek icin tiklayin</a>");
              } else {
                 $image_tmp_name = $_FILES['user_image']['tmp_name'];
                 copy($image_tmp_name, 'images/users/' . $_SESSION['user_no'].".jpg");
                 header("Refresh: 0; ");
                 //message("Basarili", "Profil resminiz degistirildi. <a href='?url=panel&no=$user_no'>Geri donmek icin tiklayin</a>");
                 
              }
           }
        }
     }
}  //USER IMAGE CONTROL & END         
function user_edit(){  // USER BIO & URL UPDATE
    if(isset($_POST['user_url']) && isset($_POST['user_bio'])){
        db_user_update($_SESSION['user_no'], $_POST['user_url'], $_POST['user_bio']);
    } // USER BIO & URL UPDATE END
}
function user_panel(){
    if($_SESSION['user_role']!="guest"){
        if(isset($_GET["no"])&&!empty($_GET['no'])&&is_numeric($_GET['no'])&&$_SESSION['user_no']==$_GET["no"]){
            $user_no=$_GET["no"];
            image_edit($user_no);
            user_edit();
            view_user(array(
                "title"=>"Kullanıcı Paneli",
                "body"=>"app/views/user/user_panel.php",
                "article_content"=>db_user($user_no)));
        } else message("Biraz utanç verici, değil mi?", "Görünen o ki, aradığınız her ne ise bulamıyoruz. Belki elastik arama yapabilirsiniz.");
    } else message("Basarisiz", "Yetkiniz olmayan bir talepte bulundunuz. <a href='?url=login'>Giris yapmak icin tiklayin</a>");
}
function advisor_panel(){
    if($_SESSION['user_role']="advisor"){
        if(isset($_GET["no"])&&!empty($_GET['no'])&&is_numeric($_GET['no'])&&$_SESSION['user_no']==$_GET["no"]){
            $user_no=$_GET["no"];
            image_edit($user_no);
            user_edit();
            view_user(array(
                "title"=>"Danışman Paneli",
                "body"=>"app/views/advisor/advisor_panel.php",
                "article_content"=>db_user($user_no)));
        } else message("Biraz utanç verici, değil mi?", "Görünen o ki, aradığınız her ne ise bulamıyoruz. Belki elastik arama yapabilirsiniz.");
    } else message("Basarisiz", "Yetkiniz olmayan bir talepte bulundunuz. <a href='?url=login'>Giris yapmak icin tiklayin</a>");
}
function admin_panel(){
    if($_SESSION['user_role']="admin"){
        if(isset($_GET["no"])&&!empty($_GET['no'])&&is_numeric($_GET['no'])&&$_SESSION['user_no']==$_GET["no"]){
            $user_no=$_GET["no"];
            image_edit($user_no);
            user_edit();
            view_user(array(
                "title"=>"Admin Paneli",
                "body"=>"app/views/admin/admin_panel.php",
                "article_content"=>db_user($user_no)));
        } else message("Biraz utanç verici, değil mi?", "Görünen o ki, aradığınız her ne ise bulamıyoruz. Belki elastik arama yapabilirsiniz.");
    } else message("Basarisiz", "Yetkiniz olmayan bir talepte bulundunuz. <a href='?url=login'>Giris yapmak icin tiklayin</a>");
}
/*
function comments(){
    $body="comments.php";
    $title="Tum Yorumlar";
    $article1_content=db_comments();
    $aside1_content=null;
    view_admin($body, $title, $article1_content, $aside1_content);
}
function users(){
    $body="users.php";
    $title="Tum Kullanicilar";
    $article1_content=db_users();
    $aside1_content=null;
    view_admin($body, $title, $article1_content, $aside1_content);
}
*/
?>