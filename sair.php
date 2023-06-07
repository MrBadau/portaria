<?php
// Inicia a sessão
ini_set('display_errors', 0);
ini_set('session.save_path', getcwd() . '/tmp');

session_start();

// Destrói a sessão
session_destroy();

header("Location: index.php");
