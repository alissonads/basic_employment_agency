<div class="container">
    <div class="access-wrapper">
        <div class="box-op-register">
            <div class="title-box">
                <h2><span>Curso</span></h2>
            </div>

            <form action="" method="post">
                <!--linha com a descrição da Escolaridade-->
                <div class="line align-content">
                    <div class="col-md-2  form-margin-top">
                        <div class="col-1">
                            <label for="level">Nível do Curso</label>
                            <select class="elem" style="width:95%;" name="level" id="level"
                            onchange="validateText(this, 'level-error')">
                                <option value=""></option>
                                <option value="doutorado">Doutorado</option>
                                <option value="mestrado">Mestrado</option>
                                <option value="pos-graduacao">Pós-Graduação</option>
                                <option value="profissionalizante">Profissionalizante</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2  form-margin-top">
                        <div class="col-1">
                            <label for="institution">Instituição de Ensino</label>
                            <input class="elem width-90" type="text" name="institution" id="institution"
                             placeholder="Digite a instituição de ensino"
                             onblur="validateText(this, 'institution-error')" />
                        </div>
                    </div>
                    
                    <div class="col-md-2  form-margin-top">
                        <div class="col-1">
                            <label for="name_course">Nome do Curso</label>
                            <input class="elem width-90" type="text" name="name_course" id="name_course"
                             placeholder="Digite o nome do curso"
                             onblur="validateText(this, 'name_course-error')" />
                        </div>
                    </div>

                    <div class="col-md-2  form-margin-top">
                        <div class="col-1">
                            <label for="city">Cidade / Estado</label>
                            <input class="elem width-90" type="text" name="city" id="city"
                             placeholder="Digite sua cidade (ex: Cidade/Estado)"
                             onblur="validateForRegex(this,'city-error', /^[\w\s]+\s*\/\s*\w{2}$/)" />
                        </div>
                    </div>

                    <div class="col-md-2  form-margin-top">
                        <div class="col-1">
                            <label for="year_conclusion">Ano de Conclusão</label>
                            <input class="elem width-90" type="text" name="year_conclusion" id="year_conclusion"
                             placeholder="Digite o ano de conclusão" maxlength="4"
                             onblur="validateForRegex(this,'yc-error', /^\d{4}$/)" />
                        </div>
                    </div>

                    <div class="col-md-2  form-margin-top"></div>
                </div>

                <div class="line align-content">
                    <div class="col-md-1">
                        <div class="col-1">
                        <input class="btn-add" type="button" name="add" id="add" value="Adicionar Curso"
                        onclick="addCourse(this.form)" />
                        </div>
                    </div>
                </div>
            </form>
            
            <!--separação-->
            <div class="line">
                <div class="col-1">
                    <div class="dividing-1"></div>
                </div>
            </div>

            <!--cursos incluidos-->
            <div class="line align-content" id="included-courses" style="display:none;">
                <h3>Seus Cursos</h3>

                <div class="col-md-8">
                    <div class="table_ed">
                        <div class="table-header">
                            <div class="tr-header">
                                <div class="th-header">Nível do Curso</div>
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

            <form action="<?php echo ROOT . '/'.
                                     BEA_PROFILE . '/' . 
                                     WORKER_USER; ?>" 
                  method="post" onsubmit="return validateCourseRegister(this)">
                <!--linha com o botão de salvar-->
                <div class="line align-content">
                    <div class="col-md-1">
                        <div class="col-1">
                            <input class="btn" type="submit" name="submit" id="submit" 
                              value="CONCLUIR CADASTRO" />
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php 
    require_once 'App/Views/templates/alert.php';
    require_once 'App/Views/templates/loader.php'; 
?>