<?php require_once 'App/utils/GlobalDefs.php'; ?>

<header>
    <section class="header-container header">
        <nav class="nav-bar col-md-7 nav-bar-exp-lg nav-bar-bg-color">
            <div class="nav-bar-links">
                <ul class="links mr-auto">
                    <!--index-->
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo ROOT; ?>">
                            <p>Home</p>
                        </a>
                    </li>
                    <!--trabalhador-->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#"
                         role="button" data-toggle="dropdown"
                         aria-haspopup="true" aria-expanded="false"
                         onclick="dropdownMenu(this);">
                            <p>Trabalhador</p>
                        </a>

                        <div class="dropdown-menu" style="display:none;">
                            <a class="dropdown-item" href="#">
                                <p>Perfil</p>
                            </a>
                            <a class="dropdown-item" href="<?php echo ROOT . '/'. BEA_REGISTER . '/' . 
                                                                      WORKER_USER . '/' .
                                                                      LOAGIN_USER; ?>">
                                <p>Cadastrar Currículo</p>
                            </a>
                            <a class="dropdown-item" href="#">
                                <p>Alterar Currículo</p>
                            </a>
                            <a class="dropdown-item" href="#">
                                <p>Buscar Vagas</p>
                            </a>
                        </div>
                    </li>
                    <!--empregador-->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#"
                         onclick="dropdownMenu(this);">
                            <p>Empregador</p>
                        </a>

                        <div class="dropdown-menu" style="display:none;">
                            <a class="dropdown-item" href="#">
                                <p>Perfil</p>
                            </a>
                            <a class="dropdown-item" href="#">
                                <p>Cadastrar Empresa</p>
                            </a>
                            <a class="dropdown-item" href="#">
                                <p>Anunciar uma Vaga</p>
                            </a>
                            <a class="dropdown-item" href="#">
                                <p>Buscar Trabalhadores</p>
                            </a>
                        </div>
                    </li>
                    <!--login/logout-->
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <p>Entrar</p>
                        </a>
                    </li>

                </ul>
            </div>
        </nav>
    </section>
</header>