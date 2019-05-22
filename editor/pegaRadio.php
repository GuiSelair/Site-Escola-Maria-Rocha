    
    
    <fieldset class="my-3">
        <h6>Marque a opção que deseja atualizar</h6>
        <hr />
        <form action="./editarCursos.php" method="POST">
            <div class="form-group col-xl-3">
                <select class="form-control" placeholder id="cursos" name="cursos" required>
                    <option value="" disabled selected>Escolha um curso</option>
                    <option value="cursoinformatica">Técnico em Informática</option>
                    <option value="cursocontabilidade">Técnico em Contabilidade</option>
                    <option value="cursosecretariado">Técnico em Secretariado</option>
                </select>
            </div>
            <div class="form-check ml-5">
                <input class="form-check-input" type="radio" name="opcao" value="perfilConclusao"
                    <?php echo ($opcao == "perfilConclusao") ? "checked" : null; ?>> <?php echo $opcao; ?>Perfil de
                Formação Profissional
            </div>
            <div class="form-check ml-5">
                <input class="form-check-input" type="radio" name="opcao" value="objetivoCurso"
                    <?php echo ($opcao == "objetivoCurso") ? "checked" : null; ?>> Objetivos do Curso
            </div>
            <div class="form-check ml-5">
                <input class="form-check-input" type="radio" name="opcao" value="estagio"
                    <?php echo ($opcao == "estagio") ? "checked" : null; ?>> Estágio
            </div>
            <div class="form-check ml-5">
                <input class="form-check-input" type="radio" name="opcao" value="gradeCurricular"
                    <?php echo ($opcao == "gradeCurricular") ? "checked" : null; ?>> Grade Curricular
            </div>
            <div class="form-check ml-5">
                <input class="form-check-input" type="radio" name="opcao" value="criteriosAvaliacao"
                    <?php echo ($opcao == "criteriosAvaliacao") ? "checked" : null; ?>> Criterios de Avaliação
            </div>
            <button type="submit" class="btn btn-dark btn-sm mt-2" name="atualizaRadio">Atualizar opções</button>
        </form>
    </fieldset>