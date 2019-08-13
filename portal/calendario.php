<?php

/////////////////////////////////////////////
////     MOSTRA EVENTOS FULLCALENDAR     ////
////////////////////////////////////////////

session_start();
include_once("conexao/config.php");
include_once("conexao/conexao.php");

// VERIFICA SE O USUÁRIO ESTA LOGADO
if (!isset($_SESSION["id"])){
	header("location: ./loginUser.php");
}

$conexao = DBConecta();

//FUNÇÃO CASO O USUARIO SEJA PROFESSOR, VERIFICA SE NÃO HÁ NENHUM REGISTRO NO CALENDARIO QUE MARQUE TODOS PROFESSORES.
if ($_SESSION["tipo"] == "Professor" || $_SESSION["tipo"] == "Administrador"){
	$sql_code = "SELECT * FROM `calendario` WHERE `geral`= '-1'";	// SELECIONA TODOS OS PROFESSORES
	$turmaAluno = mysqli_query($conexao, $sql_code);
	if (mysqli_num_rows($turmaAluno)){
		while ($noticeTurmaNum = mysqli_fetch_assoc($turmaAluno)){
			$noticeTurmaResults[] = $noticeTurmaNum;	// IDs DAS NOTICIAS QUE REFERENCIAM ESTA TURMA
		}
		echo json_encode($noticeTurmaResults);
  	}
}

//FUNÇÃO CASO O USUARIO SEJA ALUNO, VERIFICA NÃO HÁ NENHUM REGISTRO COM A TURMA DO ALUNO, CASO TENHA, RETONA O EVENTO PARA SER EXIBIDO
if ($_SESSION["tipo"] == "Aluno"){
	$sql_code = "SELECT `idTurma` FROM `turma-aluno` WHERE `idAluno`=".$_SESSION["id"];	//ENCONTRA AS TURMAS DO ALUNO
	$turmaAluno = mysqli_query($conexao, $sql_code);
	if (mysqli_num_rows($turmaAluno)){
		while ($turmaAlunoNum = mysqli_fetch_assoc($turmaAluno)){
			$turmaAlunoResults[] = $turmaAlunoNum; // IDs DA TURMA DO ALUNO
		}
		for ($i = 0; $i < count($turmaAlunoResults); $i++){
			$sql_code = "SELECT * FROM `calendario` WHERE `idTurma`=".$turmaAlunoResults[$i]["idTurma"];	// ENCONTRA AS NOTICIAS LIGADAS A TURMA
			$noticeTurma = mysqli_query($conexao, $sql_code);
			if (mysqli_num_rows($noticeTurma)){
				while ($noticeTurmaNum = mysqli_fetch_assoc($noticeTurma)){
					$sql_code = "SELECT * FROM `aluno-disciplina` WHERE idDisciplina = ".$noticeTurmaNum["idDisciplina"]." AND `idAluno`=".$_SESSION["id"];
					$results = mysqli_query($conexao, $sql_code);
					if ($results && mysqli_num_rows($results)){
					  $conceito = mysqli_fetch_assoc($results);
					  if ($conceito["conceito"] != "Apto"){
						$noticeTurmaResults[] = $noticeTurmaNum;
					  }
					}
					else{
					  $noticeTurmaResults[] = $noticeTurmaNum;	// IDs DAS NOTICIAS QUE REFERENCIAM ESTA TURMA
					}
				}
			}
		}
		echo json_encode($noticeTurmaResults);
	}
}
?>
