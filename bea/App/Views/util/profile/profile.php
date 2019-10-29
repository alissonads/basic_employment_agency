<div class="container">
    <div class="access-wrapper">
        <div class="box-perfil">
            <div class="left-col col-md-4">
                <div id="left-nav" class="fixed size-nav" style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.3);">
                    <!--foto de perfil-->
                    <div style="border:1px solid; width:80%; height:180px;">

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

            <div class="right-col col-md-1">
                <div style="height:1600px; width:100%;">
                    <div class="panel-info">
                        <div class="data">
                            <?php
                                echo "Nome: " . $user->getName() . "<br>";
                                echo "CPF: " . $user->getUserName() . "<br>";

                                $data = $response->getDataList();

                                echo "Data de Nascimento: " . $data['date_birth'] . "<br>";
                                echo "Sexo: ";
                                echo ($data['gender'] == 'M')? 'Masculino' : 'Feminino';
                                echo "<br>";
                                echo "Endereço: " . $data['neighborhood'] . ' - ' . $data['city_name'] . '/' . $data['state'] . "<br>";
                            ?>
                        </div>
                    </div>

                    <div class="panel-info">
                        <div class="data">
                            <?php
                                foreach ($data as $key => $p) {
                                    if (strstr($key, 'phone')) {
                                        switch ($p['type']) {
                                            case '1':
                                                echo 'Celular: ';
                                                break;
                                            case '2':
                                            case '3':
                                                echo 'Phone: ';
                                                break;
                                        }
                                        echo $p['phone'] . '<br>';
                                    }
                                }
                                echo "Email: " . $data['email'] . "<br>";
                            ?>
                        </div>
                    </div>

                    <div class="panel-info">
                        <div class="data">
                            <?php
                                $count = count($data['intended_funcs']);

                                for ($i = 0; $i < $count; $i++) {
                                    echo 'Função ' . ($i + 1) . ': ' . $data['intended_funcs']['func-'.$i] . '<br>';
                                }

                                echo '<br>Pretenção Salárial: ' . number_format($data['salary_pretension'], 2, ",", ".") . '<br>';
                                
                            ?>
                        </div>
                    </div>

                    <div class="panel-info">
                        <div class="data">
                            <?php
                                $education = $data['educations'];
                                $count = count($education);

                                for ($i = 0; $i < $count; $i++) {
                                    if ($education['ed-'.$i] === "Médio") {
                                        echo 'Ensino ' . $education['ed-'.$i]['type'] . ' ' . $education['ed-'.$i]['situation'] . '<br>';
                                    } else {
                                        echo $education['ed-'.$i]['type'] . ' ' . $education['ed-'.$i]['situation'] . '<br>';
                                        echo 'Curso: ' . $education['ed-'.$i]['name'] . '<br>';
                                        echo 'Instituição: ' . $education['ed-'.$i]['institution'] . '<br>';
                                    }

                                    echo 'Ano de Conclusão: ' . $education['ed-'.$i]['year_conclusion'] . '<br><br>';
                                }
                            ?>
                        </div>
                    </div>

                    <div class="panel-info">
                        <div class="data">
                            <?php
                                $courses = $data['courses'];
                                $count = count($courses);

                                for ($i = 0; $i < $count; $i++) {
                                    echo 'Curso ' . $courses['course-'.$i]['type'] . ' - ' . $courses['course-'.$i]['name'] . '<br>';
                                    echo 'Instituição: ' . $courses['course-'.$i]['institution'] . '<br>';
                                    echo 'Ano de Conclusão: ' . $courses['course-'.$i]['year_conclusion'] . '<br><br>';
                                }
                            ?>
                        </div>
                    </div>

                    <div class="panel-info">
                        <div class="data">
                            <?php
                                $experiences = $data['experiences'];
                                $count = count($experiences);

                                for ($i = 0; $i < $count; $i++) {
                                    echo 'Empresa: ' . $experiences['exp-'.$i]['company_name'] . ' - Ramo: ' . $experiences['exp-'.$i]['specialty'] . '<br>';
                                    echo 'Função: ' . $experiences['exp-'.$i]['name'] . '<br>';
                                    echo 'Data de Entrade: ' . $experiences['exp-'.$i]['date_entrance'];
                                    if ($experiences['exp-'.$i]['date_exit'])
                                    echo ' - Data de Saida: ' . $experiences['exp-'.$i]['date_exit'];
                                    echo '<br>Descição: ' . $experiences['exp-'.$i]['description'] . '<br><br>';
                                }
                            ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>