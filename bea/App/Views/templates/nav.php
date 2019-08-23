<?php require_once 'App/utils/GlobalDefs.php'; ?>

<header>
    <section class="header-container header">
        <nav class="nav-bar col-md-7 nav-bar-exp-lg nav-bar-bg-color">
            <div class="nav-bar-links">
                <ul class="links mr-auto">
                    <!--index-->
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo ROOT; ?>"
                         onclick="navInfo(this, '<?php echo ROOT; ?>')">
                            <p>Home</p>
                        </a>
                    </li>
                    <!--trabalhador-->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#"
                         role="button" data-toggle="dropdown"
                         aria-haspopup="true" aria-expanded="false"
                         onclick="dropdownMenu(this);">
                            <p>Cadastrar</p>
                        </a>

                        <div class="dropdown-menu" style="display:none;">
                            <?php if (!is_object(getUser())) { ?>
                                <a class="dropdown-item" href="<?php echo ROOT . '/'. BEA_REGISTER . '/' . 
                                                                        WORKER_USER . '/' .
                                                                        LOGIN_USER; ?>"
                                onclick="navInfo(this, '<?php echo ROOT . '/'. BEA_REGISTER . '/' . 
                                                                    WORKER_USER . '/' .
                                                                    LOGIN_USER;?>'),
                                         activeProgress()">
                                    <p>Cadastrar Currículo</p>
                                </a>
                            <?php } ?>

                            <a class="dropdown-item" href="#">
                                <p>Cadastrar Empresa</p>
                            </a>
                            <a class="dropdown-item" href="#">
                                <p>Cadastrar Vagas</p>
                            </a>
                        </div>
                    </li>
                    <!--empregador-->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#"
                         onclick="dropdownMenu(this);">
                            <p>Buscar</p>
                        </a>

                        <div class="dropdown-menu" style="display:none;">
                            <a class="dropdown-item" href="#">
                                <p>Buscar Vagas</p>
                            </a>
                            <a class="dropdown-item" href="#">
                                <p>Buscar Trabalhadores</p>
                            </a>
                        </div>
                    </li>
                    <!--login/logout href="<?php /*echo ROOT . '/'. BEA_LOGIN;*/?>"-->
                    <?php if (!is_object(getUser())) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo ROOT . '/'. BEA_LOGIN;?>"
                             onclick="navInfo(this, '<?php echo ROOT . '/'. BEA_LOGIN;?>'),
                                      activeProgress()">
                                <p>Entrar</p>
                            </a>
                        </li>
                    <?php } else {?>
                                <?php if (getAccessLevel() == WORKER_USER) { ?>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#"
                                        onclick="dropdownMenu(this);">
                                            <p><?php echo getName();?></p>
                                        </a>

                                        <div class="dropdown-menu" style="display:none;">
                                            <a class="dropdown-item" href="<?php echo ROOT . '/'. BEA_PROFILE . '/' . 
                                                                                    WORKER_USER; ?>"
                                            onclick="navInfo(this, '<?php echo ROOT . '/'. BEA_PROFILE . '/' . 
                                                                                WORKER_USER;?>'),
                                                     activeProgress()">
                                                <p>Perfil</p>
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <p>Alterar Currículo</p>
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <p>Buscar Vagas Por Perfil</p>
                                            </a>
                                            <a class="dropdown-item" href="<?php echo ROOT . '/'. BEA_LOGOUT;?>"
                                            onclick="navInfo(this, '<?php echo ROOT . '/'. BEA_LOGOUT;?>'),
                                                     activeProgress()">
                                                <p>Sair</p>
                                            </a>
                                        </div>
                                    </li>
                                <?php } ?>
                    <?php } ?>

                </ul>
            </div>
        </nav>

        <form method="post" id="nav">
            <input type="hidden" name="nav-info" value="redirect">
        </form>

    </section>
</header>