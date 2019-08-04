<?php 
    $page_title = 'Login';
    require_once 'App/Views/templates/header.php'; 
?>
    <div class="container">
        <div class="acess-box">
            <!--Caixa de login-->
            <div class="box">
                <div class="title-box">
                    <h2><span>Login</span></h2>
                </div>
                    
                <form method="POST" action="" onsubmit="activeProgress()">
                    <div class="line">
                        <div class="data">
                            <input class="elem"  type="text" name="username" 
                                   id="username"
                                    placeholder="Usuário" />
                        </div>
                    </div>
                    <div class="line">
                        <div class="data">
                            <input class="elem"  type="password" 
                                   name="password" 
                                   id="password"
                                    placeholder="Senha" />
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
    require_once 'scripts/view/loader.php';
    require_once 'scripts/utils/footer.php'; 
?>