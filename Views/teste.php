<?php
require_once '../php/controller.php';

session_start();
$campo = $_POST['campo'];
$termo = trim($_POST['termo']);
$id_usuario = $_SESSION['id'];


if ($termo == ""){
    print_r(Controller::getEmails(array('id_usuario', $id_usuario)));   
} else{
   	print_r(Controller::getEmailsAjax(array($campo, "%".$termo."%")));
         
}


?>