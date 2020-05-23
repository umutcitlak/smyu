<?php
function view_public($values){
    include_once ("app/views/public/head.php");
    include_once ("app/views/public/header.php");
    include_once ("app/views/public/nav.php");
    include_once ($values["body"]);
    include_once ("app/views/public/footer.php");
}
function view_user($values){
    include_once ("app/views/public/head.php");
    include_once ("app/views/public/header.php");
    include_once ("app/views/public/nav.php");
    include_once ($values["body"]);
    include_once ("app/views/public/footer.php");
}
function view_message($values){
    include_once ("app/views/public/head.php");
    include_once ("app/views/public/header.php");
    include_once ("app/views/public/nav.php");
    include_once ($values["body"]);
    include_once ("app/views/public/footer.php");
}
?>


<?php //echo "<pre>"; print_r($aside); echo "</pre>"; ?>