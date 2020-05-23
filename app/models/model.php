<?php
$servername = "localhost";
$username = "root";
$password = "123456";
$database = "smyu";
$conn = new mysqli($servername, $username, $password, $database);
mysqli_set_charset($conn, "utf8");
if ($conn->connect_error) die("Connection Failed: " . $conn->connect_error);

function db_user_new($user_no, $user_name, $user_password_1){
    global $conn;
    $query = mysqli_query($conn, "INSERT INTO smyu_users (user_no, user_name, user_image, user_password, user_role, user_bio, user_url) VALUES ('$user_no', '$user_name', 'images/users/default.jpg', '$user_password_1', 'user', '', '')") or die(mysqli_error($conn));
    if($query){
        $id=$conn->insert_id;
        message("Basarili", "Tebrikler! Kayit oldunuz numaraniz ve sifreniz ile giris yapabiliriniz <a href='?url=login'>Giriş yapmak tıklayın</a>");
    } else message("Basarisiz", "Uzgunuz! Kayit olusturulamadi");
}
function db_user_login($no, $password){
    global $conn;
    $query = mysqli_query($conn, "SELECT * FROM smyu_users WHERE user_no = $no") or die (mysqli_error($conn));
    //$num_rows=mysqli_num_rows($query);
    if (mysqli_affected_rows($conn)) {
        while( $fetch_assoc = mysqli_fetch_assoc($query)){
            $user_id=$fetch_assoc["user_id"];
            $user_no=$fetch_assoc["user_no"];
            $user_name=$fetch_assoc["user_name"];
            $user_image=$fetch_assoc["user_image"];
            $user_password=$fetch_assoc["user_password"];
            $user_role=$fetch_assoc["user_role"];
        }
    } else message("Basarisiz", "Boyle bir kullanici kayitli degil. <a href='javascript:window.history.back();'>Geri donmek icin tiklayin</a>");
    if($no==$user_no&&$password==$user_password){
        $_SESSION["user_id"]= $user_id;
        $_SESSION["user_no"]= $user_no;
        $_SESSION["user_name"]= $user_name;
        $_SESSION["user_image"]= $user_image;
        $_SESSION["user_password"]= $user_password;
        $_SESSION["user_role"]= $user_role;
        header("Location: ?url=user&no=$no");
    }
    else message("Basarisiz", "Giris yapilamadi. Lutfen bilgilerinizi kontrol edin. <a href='javascript:window.history.back();'>Geri donmek icin tiklayin</a>");
}
function db_contents_last5(){
    global $conn;
    $query = mysqli_query($conn, "SELECT DISTINCT smyu_contents.*, smyu_images.image_href FROM smyu_contents LEFT JOIN smyu_images ON smyu_contents.content_id = smyu_images.image_content_id_fk ORDER BY content_id DESC LIMIT 5") or die(mysqli_error($conn));
    if (mysqli_affected_rows($conn)) {
        $fetch_assoc = $query->fetch_all(1);
    } else return false;
    return $fetch_assoc;
}
function db_contents_all(){
    global $conn;
    $query = mysqli_query($conn, "SELECT DISTINCT smyu_contents.*, smyu_images.image_href FROM smyu_contents LEFT JOIN smyu_images ON smyu_contents.content_id = smyu_images.image_content_id_fk ORDER BY content_id DESC") or die(mysqli_error($conn));
    if (mysqli_affected_rows($conn)) {
        $fetch_assoc = $query->fetch_all(1);
    } else return false;
    return $fetch_assoc;
}
function db_contents_rand5(){
    global $conn;
    $query = mysqli_query($conn, "SELECT * FROM smyu_contents ORDER BY RAND() LIMIT 5") or die(mysqli_error($conn));
    if (mysqli_affected_rows($conn)) {
        $fetch_assoc = $query->fetch_all(1);
    } else return false;
    return $fetch_assoc;
}
function db_content($id){
    global $conn;
    $query = mysqli_query($conn, "SELECT * FROM smyu_contents INNER JOIN smyu_users ON smyu_contents.content_user_id_fk=smyu_users.user_id WHERE content_id = $id") or die(mysqli_error($conn));
    if (mysqli_affected_rows($conn)) {
        $fetch_assoc = $query->fetch_all(1);
    } else return false;
    return $fetch_assoc;
}
function db_content_comments($id){
    global $conn;
    $query = mysqli_query($conn, "SELECT * FROM smyu_comments INNER JOIN smyu_users ON smyu_comments.comment_user_id_fk=smyu_users.user_id  WHERE comment_content_id_fk = $id") or die(mysqli_error($conn));
    if (mysqli_affected_rows($conn)) {
        $fetch_assoc = $query->fetch_all(1);
    } else return null;
    return $fetch_assoc;
}
function db_content_count(){
    global $conn;
    $rows=mysqli_query($conn, "SELECT content_id FROM smyu_contents") or die(mysqli_error($conn));
    return $rows->num_rows;
}
function db_user_count(){
    global $conn;
    $rows=mysqli_query($conn, "SELECT user_id FROM smyu_users") or die(mysqli_error($conn));
    return $rows->num_rows;
}
function db_user_control($no){
    global $conn;
    $query = mysqli_query($conn, "SELECT user_no FROM smyu_users WHERE user_no = $no") or die(mysqli_error($conn));
    if (mysqli_affected_rows($conn)) {
        $fetch_assoc = $query->fetch_all(1);
    } else return false;
    return $fetch_assoc[0]["user_no"];
}
function db_password_control($no, $password){
    global $conn;
    $query = mysqli_query($conn, "SELECT user_password FROM smyu_users WHERE user_no = $no") or die(mysqli_error($conn));
    if (mysqli_affected_rows($conn)) {
        $fetch_assoc = $query->fetch_all(1);
    } else message("Basarisiz", "Mevcut sifreniz yanlis. Lutfen kontrol edin. <a href='javascript:window.history.back();'>Geri donmek icin tiklayin</a>");
    return $fetch_assoc[0]["user_password"];
}
function db_changepassword($no, $password){
    global $conn;
    $query = mysqli_query($conn, "UPDATE smyu_users SET user_password = '$password' WHERE user_no = $no") or die(mysqli_error($conn));
    if($query){
        header("Refresh: 10; ?url=logout");
        message("Basarili", "Tebrikler! Sifreniz degistirildi. 10 saniye sonra cikisa yonlendirileceksiniz. Yeni sifrenizle yeniden giris yapiniz");
    } else message("Basarisiz", "Uzgunuz! Sifre degistirilemedi");
}
function db_content_new($content_head, $content_body, $content_user_id){
    global $conn;
    $query = mysqli_query($conn, "INSERT INTO smyu_contents (content_date, content_head, content_body, content_status, content_comment_status, content_user_id_fk) VALUES (CURDATE(), UPPER('$content_head'), '$content_body', 'publish', 'open', '$content_user_id')") or die(mysqli_error($conn));
    if($query){
        $id=$conn->insert_id;
        message("Basarili", "Tebrikler! Iceriginiz olusturuldu. <a href='?url=content&id=$id'>Icerigi goruntule</a>");
    } else message("Basarisiz", "Uzgunuz! Icerik olusturulamadi");
}
function db_user($no){
    global $conn;
    $query = mysqli_query($conn, "SELECT * FROM smyu_users WHERE user_no = $no") or die(mysqli_error($conn));
    if (mysqli_affected_rows($conn)) {
        $fetch_assoc = $query->fetch_all(1);
    } else return false;
    return $fetch_assoc;
}
function db_user_update($no, $image, $url, $bio){
    global $conn;
    $query=mysqli_query($conn,"UPDATE smyu_users SET  user_image='$image', user_url='$url', user_bio='$bio' WHERE user_no =$no") or die(mysqli_error($conn));
    if($query){
        message("Basarili", "Tebrikler! Profiliniz güncellendi <a href='?url=user&no=$no'>Profili gormek icin tiklayin</a>");
    } else message("Basarisiz", "Uzgunuz! Profiliniz güncellenemedi");
}
function db_comment_new($comment_body, $comment_user_id, $content_id){
    global $conn;
    $query = mysqli_query($conn, "INSERT INTO smyu_comments (comment_date, comment_body, comment_user_id_fk, comment_content_id_fk) VALUES (CURDATE(), '$comment_body', '$comment_user_id', '$content_id')") or die(mysqli_error($conn));
    if($query){
        header("location: ?url=content&id=$content_id");
        //message("Basarili", "Tebrikler! Yorumunuz gonderildi. <a href='javascript:window.history.back();'>Geri donmek icin tiklayin</a>");
    } else message("Basarisiz", "Uzgunuz! Yorumunuz gonderilemedi");
}
function db_requests_all(){
    global $conn;
    $query = mysqli_query($conn, "SELECT DISTINCT ots_requests.*, ots_request_files.request_file_href FROM ots_requests LEFT JOIN ots_request_files ON ots_requests.request_id = ots_request_files.request_file_request_id_fk ORDER BY request_id DESC") or die(mysqli_error($conn));
    if (mysqli_affected_rows($conn)) {
        $fetch_assoc = $query->fetch_all(1);
    } else return false;
    return $fetch_assoc;
}
function db_requests_rand5(){
    global $conn;
    $query = mysqli_query($conn, "SELECT * FROM ots_requests ORDER BY RAND() LIMIT 5") or die(mysqli_error($conn));
    if (mysqli_affected_rows($conn)) {
        $fetch_assoc = $query->fetch_all(1);
    } else return false;
    return $fetch_assoc;
}
function db_request_count(){
    global $conn;
    $rows=mysqli_query($conn, "SELECT request_id FROM ots_requests") or die(mysqli_error($conn));
    return $rows->num_rows;
}
function db_request($id){
    global $conn;
    $query = mysqli_query($conn, "SELECT * FROM ots_requests INNER JOIN smyu_users ON ots_requests.request_user_id_fk=smyu_users.user_id WHERE request_id = $id") or die(mysqli_error($conn));
    if (mysqli_affected_rows($conn)) {
        $fetch_assoc = $query->fetch_all(1);
    } else return false;
    return $fetch_assoc;
}
function db_request_responds($id){
    global $conn;
    $query = mysqli_query($conn, "SELECT * FROM ots_responds INNER JOIN smyu_users ON ots_responds.respond_user_id_fk=smyu_users.user_id  WHERE respond_request_id_fk = $id") or die(mysqli_error($conn));
    if (mysqli_affected_rows($conn)) {
        $fetch_assoc = $query->fetch_all(1);
    } else return null;
    return $fetch_assoc;
}
function db_respond_new($respond_body, $respond_user_id, $request_id){
    global $conn;
    $query = mysqli_query($conn, "INSERT INTO ots_responds (respond_date, respond_body, respond_user_id_fk, respond_request_id_fk) VALUES (CURDATE(), '$respond_body', '$respond_user_id', '$request_id')") or die(mysqli_error($conn));
    if($query){
        header("location: ?url=request&id=$request_id");
        //message("Basarili", "Tebrikler! Cevabınız gonderildi. <a href='javascript:window.history.back();'>Geri donmek icin tiklayin</a>");
    } else message("Basarisiz", "Uzgunuz! Yorumunuz gonderilemedi");
}
function db_request_new($request_end_date, $request_li_id_fk, $request_head, $request_body, $request_status, $request_user_id){
    global $conn;
    $query = mysqli_query($conn, "INSERT INTO ots_requests (request_begin_date, request_end_date, request_head, request_body, request_status, request_respond_status, request_user_id_fk, request_li_id_fk) VALUES (CURDATE(), '$request_end_date',  UPPER('$request_head'), '$request_body', '$request_status', 'open', '$request_user_id',  '$request_li_id_fk')") or die(mysqli_error($conn));
    if($query){
        $id=$conn->insert_id;
        message("Basarili", "Tebrikler! Ödeviniz olusturuldu. <a href='?url=request&id=$id'>Ödevi goruntule</a>");
    } else message("Basarisiz", "Uzgunuz! Ödev olusturulamadi");
}
function db_lesson($id){
    global $conn;
    $query = mysqli_query($conn, "SELECT li_id, li_name FROM smyu_menu WHERE li_advisor_id_fk=$id") or die(mysqli_error($conn));
    if (mysqli_affected_rows($conn)) {
        $fetch_assoc = $query->fetch_all(1);
    } else return false;
    return $fetch_assoc;
}
function db_notices_last5(){
    global $conn;
    $query = mysqli_query($conn, "SELECT DISTINCT smyu_notices.*, smyu_notice_files.notice_file_href FROM smyu_notices LEFT JOIN smyu_notice_files ON smyu_notices.notice_id = smyu_notice_files.notice_file_notice_id_fk ORDER BY notice_id DESC LIMIT 5") or die(mysqli_error($conn));
    if (mysqli_affected_rows($conn)) {
        $fetch_assoc = $query->fetch_all(1);
    } else return false;
    return $fetch_assoc;
}
function db_notices_all(){
    global $conn;
    $query = mysqli_query($conn, "SELECT DISTINCT smyu_notices.*, smyu_notice_files.notice_file_href FROM smyu_notices LEFT JOIN smyu_notice_files ON smyu_notices.notice_id = smyu_notice_files.notice_file_notice_id_fk ORDER BY notice_id DESC") or die(mysqli_error($conn));
    if (mysqli_affected_rows($conn)) {
        $fetch_assoc = $query->fetch_all(1);
    } else return false;
    return $fetch_assoc;
}
function db_notices_rand5(){
    global $conn;
    $query = mysqli_query($conn, "SELECT * FROM smyu_notices ORDER BY RAND() LIMIT 5") or die(mysqli_error($conn));
    if (mysqli_affected_rows($conn)) {
        $fetch_assoc = $query->fetch_all(1);
    } else return false;
    return $fetch_assoc;
}
function db_notice_count(){
    global $conn;
    $rows=mysqli_query($conn, "SELECT notice_id FROM smyu_notices") or die(mysqli_error($conn));
    return $rows->num_rows;
}
function db_notice($notice_id){
    global $conn;
    $query = mysqli_query($conn,"SELECT * FROM smyu_notices INNER JOIN smyu_users ON smyu_notices.notice_user_id_fk=smyu_users.user_id WHERE notice_id = $notice_id") or die(mysqli_error($conn));
    if (mysqli_affected_rows($conn)) {
        $fetch_assoc = $query->fetch_all(1);
    } else return false;
    return $fetch_assoc;
}
//YAPILIYOR...
function db_notice_new($notice_head, $notice_body, $notice_status, $notice_user_id){
    global $conn;
    $query = mysqli_query($conn, "INSERT INTO smyu_notice (notice_date, notice_head, notice_body, notice_status, notice_user_id_fk) VALUES (CURDATE(),  UPPER('$notice_head'), '$notice_body', '$notice_status', '$notice_user_id')") or die(mysqli_error($conn));
    if($query){
        $id=$conn->insert_id;
        message("Basarili", "Tebrikler! Duyurunuz olusturuldu. <a href='?url=notice&id=$id'>Duyuruyu goruntule</a>");
    } else message("Basarisiz", "Uzgunuz! Duyuru olusturulamadi");
}

/*
function db_comments(){
    global $conn;
    $query = mysqli_query($conn, "SELECT * FROM smyu_comments ORDER BY comment_id DESC LIMIT 10") or die(mysqli_error($conn));
    if (mysqli_affected_rows($conn)) {
        $fetch_assoc = $query->fetch_all(1);
    } else return false;
    return $fetch_assoc;
}
function db_users(){
    global $conn;
    $query = mysqli_query($conn, "SELECT * FROM smyu_users ORDER BY user_id DESC LIMIT 10") or die(mysqli_error($conn));
    if (mysqli_affected_rows($conn)) {
        $fetch_assoc = $query->fetch_all(1);
    } else return false;
    return $fetch_assoc;
}

*/
?>