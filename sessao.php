<?php
ini_set('display_errors', 0);
ini_set('session.save_path', getcwd() . '/tmp');
session_start();
echo $_SESSION['userLogged'] . "-var";
