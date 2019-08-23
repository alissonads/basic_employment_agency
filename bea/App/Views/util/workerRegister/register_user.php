<div class="container">
    <div class="access-wrapper">
        <div class="box-op-register">
            <div class="title-box">
                <h2><span><?php echo $this->getTitle(); ?></span></h2>
            </div>

            <form action="<?php echo ROOT . '/'. BEA_REGISTER . '/' . 
                                     WORKER_USER . '/' .
                                     WORKER_ADD_INFO; ?>" 
              method="post" onsubmit="return validateUserRegister(this)">
                <!--CPF e EMAIL-->
                <div class="line">
                    <div class="col-md-4">
                        <label for="username">CPF</label>
                        <input class="elem" type="text" name="username" id="username"
                         placeholder="xxx.xxx.xxx-xx" maxlength="14"
                         onkeypress="mask(this, '###.###.###-##')"
                         onblur="validateForRegex(this,'username-error', /^\d{3}\.\d{3}\.\d{3}-\d{2}$/)" />
                    </div>

                    <div class="col-md-1">
                        <label for="email">EMAIL</label>
                        <input class="elem" type="email" name="email" id="email"
                         placeholder="exemplo@email.com"
                         onblur="validateForRegex(this,'email-error', /^[\w\.-_\+]+@[\w-]+(\.\w{2,4})+$/)" />
                    </div>
                </div>

                <!--Nome e Sexo-->
                <div class="line">
                    <div class="col-md-1">
                        <label for="name">Nome</label>
                        <input class="elem" type="text" name="name" id="name"
                         placeholder="Digite seu nome completo"
                         onblur="validateText(this, 'name-error')" />
                    </div>
                    <div class="col-md-4">
                        <div class="group">
                            <label>Sexo</label>
                            <div class="flex-row">
                                <div class="radio">
                                    <input type="radio" class="check-radio" name="gender" id="gender-m" 
                                    value="M" onchange="validateRadio(this, 'gender-error')" />
                                    <label for="gender-m">Masculino</label>
                                </div>

                                <div class="radio">
                                    <input type="radio" class="check-radio" name="gender" id="gender-f" 
                                    value="F" onchange="validateRadio(this, 'gender-error')" />
                                    <label for="gender-f">Feminino</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Senha-->
                <div class="line">
                    <div class="col-md-2">
                        <label for="password">Senha</label>
                        <input class="elem"  type="password" name="password" id="password" 
                         placeholder="Senha 1 - min 6 caracteres" maxlength="20"
                         onblur="validatePassword(this, 'pw1-error')" />
                    </div>

                    <div class="dividing-2" style="margin: 35px 16px 35px 32px;"></div>

                    <div class="col-md-2">
                        <label for="password2">Confirmação de senha</label>
                        <input class="elem"  type="password" name="password2" id="password2"
                         placeholder="Senha 2 - min 6 caracteres"  maxlength="20"
                         onblur="validatePassword(this, 'pw2-error')" />
                    </div>
                </div>

                <div class="line align-content">
                    <div class="col-md-1">
                        <input class="btn" type="submit" name="submit" id="submit" value="Cadastrar" />
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