<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="public/css/style.css" media="screen">

    <script src="public/js/objects.js"></script>
    <script src="public/js/main.js"></script>
</head>
<body>
    <?php require_once 'App/Views/templates/nav.php';?>
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
                                        <a href="">Vagas Por Perfil</a>
                                    </li>
                                    <li class="li-top">
                                        <a href="">Minhas Vagas</a>
                                    </li>
                                    <li class="li-top">
                                        <a href="">Meu Currículo</a>
                                    </li>
                                    <li class="li-top">
                                        <a href="">Atualizar Perfil</a>
                                    </li>
                                    <li class="li-top">
                                        <a href="">Deletar Perfil</a>
                                    </li>
                                    <li class="li-top">
                                        <a href="">Sair</a>
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
</body>
</html>