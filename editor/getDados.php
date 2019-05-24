<?php
//Include database configuration file
include_once("../conexao/conexao.php");
include_once("../conexao/config.php");
include_once("../conexao/function.php");


if(isset($_POST["tabela_ID"]) && isset($_POST["coluna_ID"])){
    //Get all city data
    $tabela = $_POST["tabela_ID"];
    $coluna = $_POST["coluna_ID"];
    $sql_code = "SELECT * FROM $tabela;";
    $sql = mysqli_query(DBConecta(), $sql_code);
    //Count total number of rows
    //$rowCount = mysqli_num_rows($sql);

    //Display cities list
    //if($rowCount > 0){
        /*
        while($row = $query->fetch_assoc()){
            echo '<option value="'.$row['city_id'].'">'.$row['city_name'].'</option>';
        }*/
        $row = mysqli_fetch_assoc($sql);
        echo $row[$coluna];
    //}
}
?>
