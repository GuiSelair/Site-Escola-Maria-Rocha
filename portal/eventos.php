<?php

session_start();


include_once("conexao/config.php");
include_once("conexao/conexao.php");
include_once("conexao/function.php");

if ($_SESSION["tipo"] == "Professor"){
	$sql_code = "SELECT * FROM `calendario` WHERE `geral`= '-1'";	// SELECIONA TODOS OS PROFESSORES
	$turmaAluno = mysqli_query(DBConecta(), $sql_code);
	$linha = mysqli_num_rows($turmaAluno);
	if ($linha){
		while ($noticeTurmaNum = mysqli_fetch_assoc($turmaAluno)){
		$noticeTurmaResults[] = $noticeTurmaNum;	// IDs DAS NOTICIAS QUE REFERENCIAM ESTA TURMA
		}
		echo json_encode($noticeTurmaResults);
  	}
	
}

if ($_SESSION["tipo"] == "Aluno"){
	//ACHA TURMA(s) DO ALUNO
	$sql_code = "SELECT `idTurma` FROM `turma-aluno` WHERE `idAluno`=".$_SESSION["id"];	//ENCONTRA AS TURMAS DO ALUNO

	$turmaAluno = mysqli_query(DBConecta(), $sql_code);
	if (mysqli_num_rows($turmaAluno)){
		while ($turmaAlunoNum = mysqli_fetch_assoc($turmaAluno)){
			$turmaAlunoResults[] = $turmaAlunoNum; // IDs DA TURMA DO ALUNO
		}
		for ($i = 0; $i < count($turmaAlunoResults); $i++){
			$sql_code = "SELECT * FROM `calendario` WHERE `idTurma`=".$turmaAlunoResults[$i]["idTurma"];	// ENCONTRA AS NOTICIAS LIGADAS A TURMA
			$noticeTurma = mysqli_query(DBConecta(), $sql_code);
			if (mysqli_num_rows($noticeTurma)){
				while ($noticeTurmaNum = mysqli_fetch_assoc($noticeTurma)){
					$noticeTurmaResults[] = $noticeTurmaNum;	// IDs DAS NOTICIAS QUE REFERENCIAM ESTA TURMA
				}
			}
		}
		echo json_encode($noticeTurmaResults);
	}
}
?>
