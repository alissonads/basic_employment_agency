<div class="container">
    <div class="access-wrapper">
        <div class="box-op-register">
            <div class="title-box">
                <h2><span>Informações Adicionais</span></h2>
            </div>

            <form action="<?php echo $_SERVER['PHP_SELF'] . '/' . 
                                     BEA_REGISTER . '/' . 
                                     WORKER_USER . '/' .
                                     WORKER_EXPERIENCE; ?>" 
                method="post" id="form-add-inf"onsubmit="return validateAdditionalInfo(this)">
                <div class="line">
                    <!--Data de Nascimento-->
                    <div class="col-md-4">
                        <div class="col-1">
                            <label for="date_birth">Data de nascimento</label>
                            <input class="elem width-90" type="text" name="date_birth" id="date_birth"
                            placeholder="DD/MM/AAAA" maxlength="10"
                            onkeypress="mask(this, '##/##/####')"
                            onblur="validateForRegex(this,'date_birth-error', /^\d{2}\/\d{2}\/\d{4}$/)" />
                        </div>
                    </div>
                    <!--Estado civil-->
                    <div class="col-md-4">
                        <div class="col-1">
                            <label for="marital_status">Estado civil</label>
                            <select class="elem width-90" name="marital_status" id="marital_status">
                                <option value=""></option>
                                <option value="casado">Casado</option>
                                <option value="solteiro">Solteiro</option>
                            </select>
                        </div>
                    </div>
                    <!--Verificação de PCD-->
                    <div class="col-md-5">
                        <div class="col-1">
                            <div class="group">
                                <label for="isbpd">Possui deficiência?</label>
                                <div class="flex-row">
                                    <div class="radio">
                                        <input type="radio" class="check-radio" name="isbpd" id="isbpd-s"
                                         value="1" onchange="validateRadio(this, 'isbpd-error')"
                                         onclick="showInfoDeficiency()" />
                                        <label for="isbpd-s">Sim</label>
                                    </div>
    
                                    <div class="radio">
                                        <input type="radio" class="check-radio" name="isbpd" id="isbpd-n"
                                         value="0" onchange="validateRadio(this, 'isbpd-error')"
                                         onclick="removeEditDeficiency()" />
                                        <label for="isbpd-n">Não</label>
                                    </div>

                                    <div class="radio" style="display:none" id="edit-def">
                                        <label class="edit" onclick="showInfoDeficiency()">Editar</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="line">
                    <!--Celular-->
                    <div class="col-md-4" >
                        <div class="col-1">
                            <label for="cellular">Celular</label>
                            <input class="elem width-90" type="text" name="cellular" id="cellular" 
                             placeholder="(xx) xxxxx-xxxx" maxlength="15"
                             onkeypress="mask(this, '(xx) xxxxx-xxxx')"
                             onblur="validateForRegex(this,'cellular-error', /^\(\d{2}\) \d{5}-\d{4}$/)" />
                        </div>
                    </div>
                    <!--Telefone-->
                    <div class="col-md-4" >
                        <div class="col-1">
                            <label for="residential">Residencial</label>
                            <input class="elem width-90" type="text" name="residential" id="residential" 
                             placeholder="(xx) xxxx-xxxx" maxlength="14"
                             onkeypress="mask(this, '(##) ####-####')"
                             onkeyup="addObs(this, 14)"
                             onblur="validateForRegex(this,'residential-error', /^\(\d{2}\) \d{4}-\d{4}$/)" />
                        </div>
                    </div>
                    <!--Verificação se é de recado ou próprio-->
                    <div class="col-md-5" id="obs" style="display:none;">
                        <div class="col-1">
                            <div class="group">
                                <label for="observation">Observação</label>
                                <div class="flex-row">
                                    <div class="radio">
                                        <input type="radio" class="check-radio" name="observation" id="message"
                                         value="message" onchange="validateRadio(this, 'observation-error')" />
                                        <label for="message">Recado</label>
                                    </div>
    
                                    <div class="radio">
                                        <input type="radio" class="check-radio" name="observation" id="own"
                                         value="own" onchange="validateRadio(this, 'observation-error')" />
                                        <label for="own">Próprio</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="line">
                    <!--Cidade/Estado-->
                    <div class="col-md-2">
                        <div class="col-1">
                            <label for="city_state">Cidade/Estado</label>
                            <input class="elem width-90" type="text" name="city_state" id="city_state"
                            placeholder="Digite sua cidade"
                            onblur="validateForRegex(this,'city-error', /^[\w\s]+\s*\/\s*\w{2}$/)" />
                        </div>
                    </div>
                    <!--Bairro-->
                    <div class="col-md-2">
                        <div class="col-1">
                            <label for="neighborhood">Bairro</label>
                            <input class="elem width-90" type="text" name="neighborhood" id="neighborhood"
                            placeholder="Bairro onde mora"
                            onblur="validateText(this, 'neighborhood-error')" />
                        </div>
                    </div>
                </div>

                <div class="line">
                    <!--Função-->
                    <div class="col-md-3" style="display:flex;">
                        <div class="col-md-1">
                            <label for="func">Função</label>
                            <input class="elem width-90" type="text" id="func"
                            placeholder="Função Pretendida" />
                        </div>
                        <!--Botão para adicionar funções-->
                        <div class="col-md-5">
                            <input type="button" class="min-btn" id="add-func" value="Adicionar" 
                            onclick="addFunction(this.form)" />
                        </div>
                    </div>
                    <!--Pretenção Salárial-->
                    <div class="col-md-4">
                        <div class="col-1">
                            <label for="salary_pretension">Pretensão Salarial</label>
                            <input class="elem width-90" type="text" name="salary_pretension" id="salary_pretension"
                            onblur="validateSalary(this)" onkeypress="mask(this, '#.##0,00', true)"
                            placeholder="R$ " />
                        </div>
                    </div>
                </div>

                <!--Resultados das funções escolhidas-->
                <div class="line">
                    <div class="col-md-7" style="display:none">
                        <div class="col-1">
                            <div class="col-md-5">
                                <label>Funções:</label>
                            </div>
                        </div>
                        <div class="line" id="result-funcs">
                            <!--área para o resultado das funções-->
                        </div>
                    </div>
                </div>

                <div class="line">
                    <!--Resumo do candidato-->
                    <div class="col-md-1">
                        <div class="col-1">
                            <label for="summary">Resumo</label>
                            <textarea class="elem width-90" style="font-size:large;" name="description" id="description" cols="30" rows="10"
                            placeholder="Descreva um resumo sobre você" ></textarea>
                        </div>
                    </div>
                    <!--área para o arquivo de curriculo-->
                    <div class="col-md-4">
                        <div class="col-1">
                        </div>
                    </div>
                </div>

                <div class="line align-content">
                    <div class="col-md-1">
                        <div class="col-1">
                            <input class="btn" type="submit" name="submit" id="submit" value="Salvar e Continuar">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php 
    require_once 'App/view/templates/info_deficiency.php';
    require_once 'App/view/templates/alert.php';
    require_once 'App/view/templates/loader.php'; 
?>