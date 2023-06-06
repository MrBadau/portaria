<?php

$senha = '741';
$hash = '$2y$10$jkdxpLHTcTwPPS3fDVx7buS2e/qxvuSADwxwfrLmMjlqkR5GKs3cS';
$senhaSegura = password_hash($senha, PASSWORD_DEFAULT);

//echo $senhaSegura;


if(password_verify($senha, $hash)){
    echo "senha válida!";
} else {
    echo "senha inválida";
}