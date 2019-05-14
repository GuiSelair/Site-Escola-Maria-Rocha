<?php

    function DBConecta() {
        $sql = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) or die(mysqli_error());
        mysqli_set_charset($sql, CHARSET) or die (mysqli_error($sql));
        
        return $sql;
    }

    function DBClose($sql) {
        mysqli_close($sql) or die(mysqli_error($sql));
    }

?>