<?php
    $page_title = 'Seleção de tipo de cadastro';
    require_once 'App/Views/templates/header.php';
?>
<div class="container">
    <div class="access-wrapper">
        <div class="box-op-register">
            <div class="title-box">
                <h2><span>Seleção de Cadastro</span></h2>
            </div>
            <div class="line">
                <div class="row">
                    <div class="info-button-option">
                        <span>Procurando um trabalho?</span>
                    </div>

                    <?php require_once 'App/utils/AccessVar.php'; ?>
                    <a href="register_user.php?type_access=<?php echo WORKER; ?>" onclick="activeProgress()">                            
                        <div class="btn-option">
                            <p>Cadastre Seu Curriculo</p>
                        </div>
                    </a>
                            
                </div>

                <div class="row">
                    <div class="info-button-option">
                        <span style="margin-left:25px;">Procurando um colaborador?</span>
                    </div>
                    <div class="btn-option">
                        <p>Faça um Anuncio</p>
                    </div>
                </div>
            </div>

            <div class="dividing-1"></div>

            <div class="line" style="justify-content: center;
                                    padding: 5px;
                                    text-align: center;">
                <span style="font-size: 10px;">
                    Você já possui um curriculo cadastrado?
                    <a class="link" href="login.php">Entrar</a>
                </span>
            </div>
        </div>
    </div>
</div>
<?php 
    require_once 'App/Views/templates/alert.php';
    require_once 'App/Views/templates/loader.php';
    require_once 'App/Views/templates/footer.php'; 
?>