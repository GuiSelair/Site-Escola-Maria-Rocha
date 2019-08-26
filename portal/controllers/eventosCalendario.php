<?php

/////////////////////////////////////////////
////     MOSTRA EVENTOS FULLCALENDAR     ////
////////////////////////////////////////////

session_start();
include_once("../conexao/config.php");
include_once("../conexao/conexao.php");
include_once("../../conexao/function.php");

// VERIFICA SE O USUÁRIO ESTA LOGADO
if (!isset($_SESSION["id"])){
	header("location: ./loginUser.php");
}

$conexao = DBConecta();

//	FUNÇÃO CASO O USUARIO SEJA PROFESSOR, VERIFICA SE NÃO HÁ NENHUM REGISTRO NO CALENDARIO QUE MARQUE TODOS PROFESSORES.
if ($_SESSION["tipo"] == "Professor" || $_SESSION["tipo"] == "Administrador"){
	$eventos = BuscaRetornaQuery($conexao, "calendario", "geral", "-1");
	if ($eventos){
		while ($noticeTurmaNum = mysqli_fetch_assoc($eventos)){
			$noticeTurmaResults[] = $noticeTurmaNum;	// IDs DAS NOTICIAS QUE REFERENCIAM ESTA TURMA
		}
		echo json_encode($noticeTurmaResults);
  	}
}

//	FUNÇÃO CASO O USUARIO SEJA ALUNO, VERIFICA NÃO HÁ NENHUM REGISTRO COM A TURMA DO ALUNO, CASO TENHA, RETONA O EVENTO PARA SER EXIBIDO
if ($_SESSION["tipo"] == "Aluno"){
	$noticeTurmaResults = [];
	$turmas = BuscaRetornaQuery($conexao, "turma-aluno", "idAluno", $_SESSION["id"]);
	if ($turmas){
		while ($turmaAlunoNum = mysqli_fetch_assoc($turmas)){
			$notificacoes = BuscaRetornaQuery($conexao, "calendario", "idTurma", $turmaAlunoNum["idTurma"]);
			if ($notificacoes){
				while ($disciplinas = mysqli_fetch_assoc($notificacoes)){
					$aprovado = ConfereAprovacao($conexao, $disciplinas["idDisciplina"], $_SESSION["id"]);
					if ($aprovado["conceitoDisciplina"] != "APTO"){
						if (!in_array($disciplinas, $noticeTurmaResults))
							$noticeTurmaResults[] = $disciplinas;
					}
				}
			}
		}
		/*
		for ($i = 0; $i < count($turmaAlunoResults); $i++){
			$query = BuscaRetornaQuery($conexao, "calendario", "idTurma", $turmaAlunoResults[$i]["idTurma"]);
			if ($query){
				while ($noticeTurmaNum = mysqli_fetch_assoc($query)){
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
		*/
		//var_dump($noticeTurmaResults);
		echo json_encode($noticeTurmaResults);
	}
}
?>
