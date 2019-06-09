<?php
$linha = NULL;

if ($_SESSION["tipo"] == "Aluno"){
  $sql_code = "SELECT `idTurma` FROM `turma-aluno` WHERE `idAluno`=".$_SESSION["id"];	//ENCONTRA AS TURMAS DO ALUNO
	$turmaAluno = mysqli_query(DBConecta(), $sql_code);
  $linha = mysqli_num_rows($turmaAluno);
	if ($linha){
		while ($turmaAlunoNum = mysqli_fetch_assoc($turmaAluno)){
			$turmaAlunoResults[] = $turmaAlunoNum; // IDs DA TURMA DO ALUNO
		}
    for ($i = 0; $i < count($turmaAlunoResults); $i++){
  		$sql_code = "SELECT * FROM `calendario` WHERE `idTurma`=".$turmaAlunoResults[$i]["idTurma"];	// ENCONTRA AS NOTICIAS LIGADAS A TURMA
  		$noticeTurma = mysqli_query(DBConecta(), $sql_code);
      $linha = mysqli_num_rows($noticeTurma);
  		if ($linha){
  			while ($noticeTurmaNum = mysqli_fetch_assoc($noticeTurma)){
  				$noticeTurmaResults[] = $noticeTurmaNum;	// IDs DAS NOTICIAS QUE REFERENCIAM ESTA TURMA
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
    <span class="label label-danger" id="conta"><?php if ($linha != 0) echo $linha; ?></span>
    <!--QUANDO HÁ NOTIFICAÇÕES NÃO LIDAS-->
  </a>
  <ul class="dropdown-menu">
    <li class="header">Você tem <?php if ($linha != 0) echo $linha; else echo 0; ?> notificações</li>
    <?php if($linha){ ?>
    <li>
      <ul class="menu">
        <li>
          <?php if($linha){
            for ($i = 0; $i < count($noticeTurmaResults) || $i > 3; $i++){
          ?>
          <a href="#">
            <i class="fa fa-users text-aqua"></i> <?php echo $noticeTurmaResults[$i]["title"]." - ".date("d/m/Y", strtotime($noticeTurmaResults[$i]["start"])); ?>
          </a>
          <?php }} ?>
        </li>

      </ul>
    </li>
    <!--<li class="footer"><a href="#">Ver mais</a></li>-->
  <?php } ?>
  </ul>
</li>
