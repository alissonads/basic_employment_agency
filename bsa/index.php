<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>
    <body>
        <?php
            require_once 'App/data/Company.php';
            require_once 'App/data/Address.php';
            require_once 'App/data/Worker.php';
            require_once 'App/data/Announcement.php';
            require_once 'App/data/Interest.php';
            require_once 'App/utils/list/ListIterator.php';

			if (!empty($_POST)) echo 'post existe<br/>';
			
            $companys = array();
            $companys[] = new Company('Hospital do trabalhador', 'Saúde');
            $companys[] = new Company('Leogap', 'Metalurgia');
            $address = new Address('Fazenda Rio Grande', 'PR', 'sta. Terezinha');
            
            $courses = array();
            $courses[] = new Course('profissionalizante', 'Mecânica Básica Industrial',
                                    '2010', 'ETEP', 'Fazenda Rio Grande');
            $courses[] = new Course('profissionalizante', 'Inspetor de Qualidade (básico)',
                                    '2010', 'ETEP', 'Fazenda Rio Grande');

            $education = new Education(new Course('superior', 'Tecnologia em Jogos Digitais',
                                                  '2017', 'PUCPR', 'Curitiba'), 'Completo');
            
            $experiences = array();
            $experiences[] = new Experience($companys[0], 'Auxiliar de Almoxarifado',
                                            'Receber materiais, Guardar materiais, '. 
                                            'Separar, entregar nos setores.');
            $experiences[] = new Experience($companys[1], 'Auxiliar de Almoxarifado',
                                            'Receber materiais, Guardar materiais, '. 
                                            'Separar, entregar nos setores, dar entrada '. 
                                            'em notas fiscais.');

            $curriculum = new Curriculum();
            $curriculum->setDateBirth('18-11-1990');
            $curriculum->setSalaryPretension(1500.00);
            $curriculum->setMaritalStatus('Solteiro');
            $curriculum->setEducation($education);
            $curriculum->addPhone('celular', '(41) 98851-1581')
                       ->addPhone('recado', '(41) 3608-0860')
                       ->setCourses($courses)
                       ->setExperiences($experiences)
                       ->addFunc('Auxiliar de Almoxarifado')
                       ->addFunc('Auxiliar Administrativo')
                       ->addFunc('Programador Junior')
                       ->setAddress($address);
            $curriculum->setSummary('Sou formado em Tecnologia em jogos digitais.'.
                                    'Tenho muito interesse em aprender, gosto de desafios'.
                                    ' e quero aplicar o que aprendi durante o curso.');
            
            $worker = new Worker();
            $worker->setCod('068.630.689-90');
            $worker->setAccessLevel('worker');
            $worker->setName('Alisson Diego da Silva');
            $worker->setGender('Masculino');
            $worker->setEmail('alisson_magnanimo@yahoo.com.br');
            $worker->setCurriculum($curriculum);

            echo '<h2>' . $worker->getName() . '</h2>' .
                 '<hr/>Data de Nascimento: ' . $worker->getCurriculum()->getDateBirth() .
                 '<br/>CPF: ' . $worker->getCod() .
                 '<br/>Sexo: ' . $worker->getGender() .
                 '<br/>Endereço: ' . $worker->getCurriculum()->getAddress()->getNeighborhood() .
                 ', ' . $worker->getCurriculum()->getAddress()->getCity() . 
                 '/' . $worker->getCurriculum()->getAddress()->getState() .
                 '<br/>Celular: ' .  $worker->getCurriculum()->getPhone('celular') .
                 '  -  Recado: ' .  $worker->getCurriculum()->getPhone('recado') .
                 '<br/>E-mail: ' . $worker->getEmail() . '<br/>' .

                 '<hr/><h4>Esolaridade: ' . $worker->getCurriculum()->getEducation()->getCourse()->getType() . 
                 ' ' . $worker->getCurriculum()->getEducation()->getSituation() . ' pela ' .
                 $worker->getCurriculum()->getEducation()->getCourse()->getInstitution() . ' de ' .
                 $worker->getCurriculum()->getEducation()->getCourse()->getCity_State() . '</h4>' .
                 'Curso: ' . $worker->getCurriculum()->getEducation()->getCourse()->getName() .
                 '<br/>Ano de Conclusão: ' . $worker->getCurriculum()->getEducation()->getCourse()->getYearConclusion() .
                 
                 '<hr/><h4>Qualificações</h4> ' .
                 'Curso1: ' . $worker->getCurriculum()->getCourse(0)->getName() .
                 ' Ano de Conclusão: ' . $worker->getCurriculum()->getCourse(0)->getYearConclusion() .
                 '<br/>Curso2: ' . $worker->getCurriculum()->getCourse(1)->getName() .
                 ' Ano de Conclusão: ' . $worker->getCurriculum()->getCourse(0)->getYearConclusion() .
                 
                 '<hr/><h4>Experiencias</h4>' .
                 'Empresa: '. $worker->getCurriculum()->getExperience(0)->getCompany()->getName() . 
                 ' Ramo: ' . $worker->getCurriculum()->getExperience(0)->getCompany()->getSpecialty() . 
                 '<br/>Função: ' . $worker->getCurriculum()->getExperience(0)->getFunc() .
                 '<br/>Responsável por: ' . $worker->getCurriculum()->getExperience(0)->getDescription() . 
                 
                 '<br/><br/>Empresa: '. $worker->getCurriculum()->getExperience(1)->getCompany()->getName() . 
                 ' Ramo: ' . $worker->getCurriculum()->getExperience(1)->getCompany()->getSpecialty() . 
                 '<br/>Função: ' . $worker->getCurriculum()->getExperience(1)->getFunc() .
                 '<br/>Responsável por: ' . $worker->getCurriculum()->getExperience(1)->getDescription() . '<br/><br/><br/><br/>';

            $company = new Company('ADS Company', 'Tecnologia');
            $collaborator = new Collaborator();
            $collaborator->setCompany($company);
            $collaborator->setCod('100009856');
            $collaborator->setAccessLevel('collaborating');
            $collaborator->setName('Diego');
            $collaborator->setGender('Masculino');
            $collaborator->setEmail('d.Silva@gmail.com');

            $ann = new Announcement();
            $ann->setCompany($company)
                ->setAdvertiser($collaborator)
                ->setPhone('(41) 98635-8866')
                ->setPhoneVisible(true)
                ->setFunc('Programador PHP')
                ->setEmail('ads.company@hotmail.com')
                ->setEmailVisible(true)
                ->setSalary(3000.00)
                ->setAmount(2)
                ->setToReceiveEmail(false)
                ->setSummary('Desenvolver sistemas em PHP, Manutenção de sistemas em PHP, atendimento ao publico.');
            
            $interest = new Interest($worker, $ann);
            
            $list = new LinkedList();
            $list->pushBack(15);
            $list->pushBack(26);
            $list->pushBack(22);
            $list->pushFront(30);
            
            $it = new ListIterator($list);

            foreach ($it as $v) {
                echo "$v -> ";
            }
        ?>
    </body>
</html>