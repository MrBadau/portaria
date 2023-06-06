<?php

$idCon = preg_replace('/[^[:alnum:]_]/', '',$_SESSION['userCon']);

$query  = "SELECT Type, Nome, Documento FROM CONDOMINIO WHERE IDCO = ".$idCon;
$result = mysqli_query($con, $query);
$row    = mysqli_fetch_assoc($result);


if ($_SESSION['Access'] == 1){
    $menuTitle = "Administrador Portaria";
    $menuTypePeople = "Morador/Funcionário";
    $typeLocation = "Apartamento/Sala";
    // 1 - Condomínio
    // 2 - Empresa
    if ($row['Type'] == 1){
        $menuTypeCompany = "Condomínio";
    } else {
        $menuTypeCompany = "Empresa";
    }
} 

if ($_SESSION['Access'] <> 1) {
    
    $menuTitle = $row['Nome']." ".$row['Documento'];
    $menuSubTitle = "";
    // 1 - Condomínio
    // 2 - Empresa
    if ($row['Type'] == 1){
        
        $menuTypeCompany = "Condomínio";
        $menuTypePeople = "Morador";
        $typeLocation = "Apartamento";
    } else {
        $menuTypeCompany = "Empresa";
        $menuTypePeople = "Funcionário";
        $typeLocation = "Sala";
    }
}