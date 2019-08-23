<div class="container">
    <div class="access-wrapper">
        <div class="box-op-register">
            <div class="title-box">
                    <h1><span>Apresentação</span></h1>
            </div>

            <?php if (!is_object(getUser())) { ?>
                <div class="title-box">
                    <h2><span>Seleção de Cadastro</span></h2>
                </div>
                <div class="line">
                    <div class="row">
                        <div class="info-button-option">
                            <span>Procurando um trabalho?</span>
                        </div>

                        <a href="<?php echo ROOT . '/'. BEA_REGISTER . '/' . 
                                            WORKER_USER . '/' .
                                            LOGIN_USER; ?>" 
                        onclick="navInfo(this, '<?php echo ROOT . '/'. BEA_REGISTER . '/' . 
                                                            WORKER_USER . '/' .
                                                            LOGIN_USER;?>'),
                                    activeProgress()">                            
                            <div class="btn-option">
                                <p>Cadastre Seu Curriculo</p>
                            </div>
                        </a>
                                
                    </div>

                    <div class="row">
                        <div class="info-button-option">
                            <span style="margin-left:25px;">Procurando um colaborador?</span>
                        </div>

                        <a href="#">
                            <div class="btn-option">
                                <p>Faça um Anuncio</p>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="dividing-1"></div>

                <div class="line" style="justify-content: center;
                                        padding: 5px;
                                        text-align: center;">
                    <span style="font-size: 10px;">
                        Você já possui um curriculo cadastrado?
                        <a class="link" href="<?php echo ROOT . '/'. BEA_LOGIN;?>"
                        onclick="navInfo(this, '<?php echo ROOT . '/'. BEA_LOGIN;?>'),
                                    activeProgress()">
                            Entrar
                        </a>
                    </span>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php 
    require_once 'App/Views/templates/alert.php';
    require_once 'App/Views/templates/loader.php';
    require_once 'App/Views/templates/footer.php'; 
?>