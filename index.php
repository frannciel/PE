﻿<?php

require_once 'controller.php';

$usuario = Controller::getUsuario(array('email', 'frannciel@gmail.com'));

var_dump($usuario)
?>
