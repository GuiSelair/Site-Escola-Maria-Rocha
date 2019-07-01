<?php

//////////////////////////////////////////
////   CONEXÃO COM BANCO DE DADOS     ////
/////////////////////////////////////////

// EFETUA CONEXÃO COM O BANCO DE DADOS (CRIADO PELO WILLIAM VARGAS)
function DBConecta() {
    $sql = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) or die(mysqli_error());
    mysqli_set_charset($sql, CHARSET) or die (mysqli_error($sql));
    return $sql;
}

// FECHA CONEXÃO COM O BANCO DE DADOS (CRIADO PELO WILLIAM VARGAS)
function DBClose($sql) {
    mysqli_close($sql) or die(mysqli_error($sql));
}

?>