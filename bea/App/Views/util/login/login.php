<div class="container">
    <div class="acess-box">
        <!--Caixa de login-->
        <div class="box">
            <div class="title-box">
                <h2><span>Login</span></h2>
            </div>

            <?php if (!empty($error)) { ?>
                    <div class="line align-content">
                        <label class="error"><?php echo '*'.$error;?></label>
                    </div>
            <?php } ?>

            <form method="POST" action="<?php echo ROOT . '/'. BEA_PROFILE . '/'; ?>" 
                  onsubmit="activeProgress()">
                <div class="line">
                    <div class="data">
                        <input class="elem"  type="text" name="username" 
                               id="username"
                               placeholder="Usuário"
                               value="<?php echo $username; ?>"
                               style="<?php if (!empty($error)) echo 'border-color:#F00'; ?>" />
                    </div>
                </div>
                <div class="line">
                    <div class="data">
                        <input class="elem"  type="password" 
                               name="password" 
                               id="password"
                               placeholder="Senha"
                               value="<?php echo$password; ?>"
                               style="<?php if (!empty($error)) echo 'border-color:#F00'; ?>" />
                    </div>
                    <div style="margin-top: 2px;
                                font-size:10px;">
                        <a class="link" href="">Esqueceu a senha?</a>
                    </div>
                </div>

                <div class="dividing-1"></div>
                             
                <div class="line" style="padding:2px 0px 2px 2px !important;">
                    <div class="data">
                        <input class="btn" type="submit" name="submit" value="LOGIN" />
                    </div>    
                </div>
                        
            </form>

            <div class="dividing-1"></div>
            <div class="line" style="justify-content: center;
                                     text-align: center;">
                <span style="font-size: 10px;">
                    Você não possui um cadastro?
                    <a class="link" href="select.php">Cadastre-se</a>
                </span>
            </div>
        </div>
    </div>
</div>
        
<?php 
    require_once 'App/Views/templates/alert.php';
    require_once 'App/Views/templates/loader.php'; 
?>