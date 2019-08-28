<?php

////////////////////////////////////////////////////
////   CADASTRO DE USUÁRIOS/TURMAS/DISCIPLINAS  ////
////////////////////////////////////////////////////

$linha = NULL;
$conexao = DBConecta();

//  PROFESSORES E ADMINISTRADORES
if($_SESSION["tipo"] == "Professor" || $_SESSION["tipo"] == "Administrador"){
  $query = BuscaRetornaQuery($conexao, "calendario", "geral", "-1");
  $linha = mysqli_num_rows($query);
  if ($linha){
    while ($noticeTurmaNum = mysqli_fetch_assoc($query)){
      $noticeTurmaResults[] = $noticeTurmaNum;	// IDs DAS NOTICIAS QUE REFERENCIAM ESTA TURMA
    }
  }
}

// ALUNOS
if ($_SESSION["tipo"] == "Aluno"){
  //  BUSCA TURMAS DO ALUNO
  $idAluno = $_SESSION["id"];
  $query = BuscaRetornaQuery($conexao, "turma-aluno", "idAluno", $idAluno);
  $linha = mysqli_num_rows($query);
	if ($linha){
		while ($turmaAlunoNum = mysqli_fetch_assoc($query)){
      $query_1 = BuscaRetornaQuery($conexao, "calendario", "idTurma", $turmaAlunoNum["idTurma"]);
      if ($query_1){
        //  NOTICIAS VINCULADAS A(S) TURMA(S) DO ALUNO
        while($noticeTurmaNum = mysqli_fetch_assoc($query_1)){
          $disciplinaConfereAprovacao = ConfereAprovacao($conexao, $noticeTurmaNum["idDisciplina"], $idAluno);
          if ($disciplinaConfereAprovacao["conceitoDisciplina"] != "APTO"){
              $noticeTurmaResults[] = $noticeTurmaNum;
              
            }
        } 
      }
    }
	}
}
 ?>

 <script>
    function desabilita(){
      $("#conta").hide();
      
    }
 </script>

<li class="dropdown notifications-menu" >
  <a href="#" class="dropdown-toggle" data-toggle="dropdown" onclick="desabilita()">
    <i class="fa fa-bell-o"></i>
    <span class="label label-danger" id="conta"><?php if ($linha != 0) echo "!"; ?></span>
    <!--QUANDO HÁ NOTIFICAÇÕES NÃO LIDAS-->
  </a>
  <ul class="dropdown-menu">
    <?php if($linha){ ?>
    <li>
      <ul class="menu">
        <li>
          <?php if($linha){
            //var_dump($noticeTurmaResults);
            print_r($noticeTurmaResults);
            //for ($i = 0; $i > 3 || $i < sizeof($noticeTurmaResults) ; $i++){
          ?>
          <a>
          
            <i class="fa fa-users text-aqua"></i> <?php //echo $noticeTurmaResults[$i]["title"]." - ".date("d/m/Y", strtotime($noticeTurmaResults[$i]["start"]));  ?>
          </a>
          <?php
          } ?>
        </li>

      </ul>
    </li>
    <!--<li class="footer"><a href="#">Ver mais</a></li>-->
  <?php } ?>
  </ul>
</li>

