<div class="container">
    <div class="access-wrapper">
        <div class="box-op-register">
            <div class="title-box">
                <h2><span>Escolaridade</span></h2>
            </div>

            <form method="post">
                <!--linha com a descrição da Escolaridade-->
                <div class="line align-content" id="group">
                    <!--Grupo da esquerda-->
                    <div class="col-md-2  form-margin-top">
                        <div class="col-1">
                            <label for="level">Nível de Formação</label>
                            <select class="elem width-90" name="level" id="level"
                             style="width:95%;"
                             onchange="validateEducationLevel(this), validateText(this, 'level-error')" >
                                <option value=""></option>
                                <option value="medio">Médio</option>
                                <option value="medio-tecnico">Médio-Técnico</option>
                                <option value="pos-medio">Técnico/Pós-Médio</option>
                                <option value="superior">Superior</option>
                                <option value="tecnologo">Técnologo</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2  form-margin-top">
                        <div class="col-1">
                            <label for="situation">Situação</label>
                            <select class="elem width-90" name="situation" id="situation"
                             style="width:95%;" onchange="validateText(this, 'situation-error')">
                                <option value=""></option>
                                <option value="completo">Completo</option>
                                <option value="cursando">Cursando</option>
                                <option value="trancado">Trancado</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2  form-margin-top">
                        <div class="col-1">
                            <label for="institution">Instituição de Ensino</label>
                            <input class="elem width-90" type="text" name="institution" id="institution"
                            onblur="validateText(this, 'institution-error')" />
                        </div>
                    </div>
                    
                    <!--Grupo da direita-->
                    <div class="col-md-2  form-margin-top">
                        <div class="col-1">
                            <label for="name_course">Nome do Curso</label>
                            <input class="elem width-90" type="text" name="name_course" id="name_course"
                            onblur="validateText(this, 'name_course-error')" />
                        </div>
                    </div>

                    <div class="col-md-2  form-margin-top">
                        <div class="col-1">
                            <label for="city">Cidade / Estado</label>
                            <input class="elem width-90" type="text" name="city" id="city"
                            onblur="validateForRegex(this,'city-error', /^\w+\s*\/\s*\w{2}$/)" />
                        </div>
                    </div>

                    <div class="col-md-2  form-margin-top">
                        <div class="col-1">
                            <label for="year_conclusion">Ano de Conclusão</label>
                            <input class="elem width-90" type="text" name="year_conclusion" id="year_conclusion"
                            maxlength="4"
                            onblur="validateForRegex(this,'yc-error', /^\d{4}$/)" />
                        </div>
                    </div>

                    <div class="col-md-2  form-margin-top"></div>
                </div>

                <div class="line align-content">
                    <div class="col-md-1">
                        <div class="col-1">
                        <input class="btn-add" type="button" name="add" id="add" value="Adicionar Escolaridade"
                        onclick="addEducation(this.form)" />
                        </div>
                    </div>
                </div>

                <!--separação-->
                <div class="line">
                    <div class="col-1">
                        <div class="dividing-1"></div>
                    </div>
                </div>
            </form>

            <form action="<?php echo ROOT . '/'.
                                     BEA_REGISTER . '/' .
                                     WORKER_USER . '/' . 
                                     WORKER_COURSES; ?>" 
                method="post" onsubmit="return validateEducationRegister(this)">
                <!--cursos incluidos-->
                <div class="line align-content" id="included-education" style="display:none;">
                    <h3>Sua Escolaridade</h3>
                    <!--<div class="col-md-8">
                        <div class="box-info">
                            <label>Sua Escolaridade</label>
                        </div>
                    </div>-->

                    <div class="col-md-8">
                        <div class="table_ed">
                            <div class="table-header">
                                <div class="tr-header">
                                    <div class="th-header">Nível de Formação</div>
                                    <div class="th-header">Instituição de Ensino</div>
                                    <div class="th-header">Nome do Curso</div>
                                    <div class="th-header">Ano de Conclusão</div>
                                    <div class="th-header"></div>
                                </div>
                            </div>
    
                            <div class="table-body" id="result">
                                
                            </div>
                        </div>
                    </div>
                </div>

                <!--linha com o botão de salvar-->
                <div class="line align-content">
                    <div class="col-md-1">
                        <div class="col-1">
                            <input class="btn" type="submit" name="submit" id="submit" value="Salvar e Prosseguir" />
                        </div>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</div>

<?php 
    require_once 'App/view/templates/alert.php';
    require_once 'App/view/templates/loader.php';
?>

<script type="text/javascript">
    var el = getElement("id", "group");
    var size = el.childElementCount;
    var children = el.children;

    for (var i = 2; i < size; i++) {
        children[i].style.setProperty("display", "none");
    }
</script>
