<div class="container">
    <div class="access-wrapper">
        <div class="box-op-register">
            <div class="title-box">
                <h2><span>Cadastro de Experiências</span></h2>
            </div>

            <form method="post">
                <!--linha com a descrição da experiência-->
                <div class="line">
                    <!--Grupo da esquerda-->
                    <div class="col-md-3">
                        <div class="col-1">
                            <label for="company_name">Empresa</label>
                            <input class="elem width-90" type="text" name="company_name" id="company_name"
                             onblur="validateText(this, 'cpn-name-error')" />
                        </div>

                        <div class="col-1 form-margin-top">
                            <label for="specialty">Ramo</label>
                            <input class="elem width-90" type="text" name="specialty" id="specialty">
                        </div>

                        <div class="col-1 form-margin-top">
                            <label for="func">Função</label>
                            <input class="elem width-90" type="text" name="func" id="func"
                             onblur="validateText(this, 'func-error')" />
                        </div>

                    </div>
                    <!--Grupo da direita-->
                    <div class="col-md-2">
                        <div class="col-1">
                            <label for="description">Atividades</label>
                            <textarea class="elem" style="font-size:large;" name="description" id="description" cols="30" rows="10"
                            placeholder="Descreva suas atividades"
                            onblur="validateText(this, 'desc-error')" ></textarea>
                        </div>
                    </div>
                </div>

                <!--separação-->
                <div class="col-1">
                    <div class="dividing-1"></div>
                </div>

                <!--linha com o tempo da experiência-->
                <div class="line">
                    <div class="col-md-2">
                        <div class="col-1">
                            <label for="date_entrance">Data de Entrada</label>
                            <input class="elem width-90" type="text" name="date_entrance" id="date_entrance"
                             placeholder="DD/MM/AAAA" maxlength="10"
                             onblur="validateForRegex(this,'dt-ent-error', /^\d{2}\/\d{2}\/\d{4}$/)"
                             onkeypress="mask(this, '##/##/####')" />
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="col-1">
                            <label for="date_exit">Data de Saída</label>
                            <input class="elem width-90" type="text" name="date_exit" id="date_exit" 
                            placeholder="DD/MM/AAAA" maxlength="10"
                            onblur="validateForRegex(this,'dt-exit-error', /^\d{2}\/\d{2}\/\d{4}$/)"
                            onkeypress="mask(this, '##/##/####')" />
                        </div>
                    </div>
                </div>

                <!--linha com o botão de adicionar esperiência-->
                <div class="line align-content">
                    <div class="col-md-1">
                        <div class="col-1">
                        <input class="btn-add" type="button" name="add" id="add" 
                          value="Adicionar Experiência" onclick="addExperience(this.form)" />
                        </div>
                    </div>
                </div>

            </form>
                
            <!--separação-->
            <div class="col-1">
                <div class="dividing-1"></div>
            </div>
            
            <!--cursos incluidos-->
            <div class="line align-content" id="included-experiences" style="display:none;">
                <h3>Suas Experiências</h3>

                <div class="col-md-8">
                    <div class="table_ed">
                        <div class="table-header">
                            <div class="tr-header">
                                <div class="th-header">Empresa</div>
                                <div class="th-header">Função</div>
                                <div class="th-header">Entrada</div>
                                <div class="th-header">Saída</div>
                                <div class="th-header"></div>
                            </div>
                        </div>
    
                        <div class="table-body" id="result">
                                
                        </div>
                    </div>
                </div>
            </div>

            <form action="<?php echo ROOT . '/'. 
                                     BEA_REGISTER . '/' . 
                                     WORKER_USER . '/' .
                                     WORKER_EDUCATION; ?>" 
                  method="post" onsubmit="return validateRegisterExperience(this)">
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
    require_once 'App/Views/templates/alert.php';
    require_once 'App/Views/templates/loader.php'; 
?>