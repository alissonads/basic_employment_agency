<div class="container">
    <div class="access-wrapper">
        <div class="box-perfil">
            <div class="left-col col-md-4">
                <div id="left-nav" class="fixed">
                    <!--foto de perfil-->
                    <div style="border:1px solid; width:15%; height:180px;">

                    </div>
                    <!--links-->
                    <div>
                        <div id="left-nav">
                            <ul class="ul-top">
                                <li class="li-top">
                                    <a class="nav-link" href=""><p>Vagas Por Perfil</p></a>
                                </li>
                                <li class="li-top">
                                    <a class="nav-link" href=""><p>Minhas Vagas</p></a>
                                </li>
                                <li class="li-top">
                                    <a class="nav-link" href=""><p>Meu Currículo</p></a>
                                </li>
                                <li class="li-top">
                                    <a class="nav-link" href=""><p>Atualizar Perfil</p></a>
                                </li>
                                <li class="li-top">
                                    <a class="nav-link" href=""><p>Deletar Perfil</p></a>
                                </li>
                                <li class="li-top">
                                    <a class="nav-link" href="<?php echo ROOT . '/'. BEA_LOGOUT;?>"
                                       onclick="navInfo(this, '<?php echo ROOT . '/'. BEA_LOGOUT;?>'),
                                                activeProgress()">
                                        <p>Sair</p>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="right-col col-md-1" style="border: 1px solid">
                <div style="height:1600px; width:100%;">

                </div>
            </div>
        </div>
    </div>
</div>