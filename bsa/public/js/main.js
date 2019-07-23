function getElement(type, name) {
    switch (type) {
        case "id":
            return document.getElementById(name);
            break;
        case "class":
            return document.getElementsByClassName(name);
            break;
        case "name":
            return document.getElementsByName(name);
            break;
        case "tag":
            return document.getElementsByTagName(name);
            break;
    }

    return null;
}

function setContent(element, content) {
    element.innerHTML = content;
}

function validateNonEmpty(elem) {
    return elem.value.length > 0;
}

function mask(elem, mk, reverse = false) {
    if (elem.getAttribute('maxlength') && 
        elem.value.length >= mk.length)
        return;

    var key= (window.event)? event.keyCode : event.which;
    
    if (key > 47 && key < 58 || key == 8 || key == 0) {
        elem.value = MaskSpecialist.apply(elem.value, mk, reverse)
    } 
}

function reset() {
    var v = getElement('tag', 'input');

    for (var i = 0; i < v.length; i++) {
        if (v[i].type != "submit" &&
            v[i].type != "button") {
            v[i].value = '';
        }
    }

    v = getElement('tag', 'textarea');
    
    for (var i = 0; i < v.length; i++) {
        v[i].value = '';
    }

    v = getElement('tag', 'select');
    for (var i = 0; i < v.length; i++) {
        v[i].value = '';
    }
}

function addErrorInfo(parent, id, text) {
    if(getElement('id', id))
        return;

    var error = new Element('label');
    error.addAtt('class', 'error')
         .addAtt('id', id)
         .setContent(text);

    parent.appendChild(error.get());
}

function removeErrorInfo(parent, errorId) {
    var elemError = getElement('id', errorId);
    if (elemError)
        parent.removeChild(elemError);
}

function validateInfoExperienceRequested(form) {
    var valid = true;

    if (!validateNonEmpty(form["company_name"])) {
        form["company_name"].style.setProperty("border-color", "#F00");

        addErrorInfo(form["company_name"].parentElement, 
                     'cpn-name-error', 
                     '*Este campo é requerido');
        valid = false;
    } 
    if (!validateNonEmpty(form["func"])) {
        form["func"].style.setProperty("border-color", "#F00");

        addErrorInfo(form["func"].parentElement, 
                     'func-error', 
                     '*Este campo é requerido');
        valid = false;
    }
    if (!validateNonEmpty(form["description"])) {
        form["description"].style.setProperty("border-color", "#F00");
        
        addErrorInfo(form["description"].parentElement, 
                     'desc-error', 
                     '*Este campo é requerido');
        valid = false;
    } 
    if (!validateNonEmpty(form["date_entrance"])) {
        form["date_entrance"].style.setProperty("border-color", "#F00");
        
        addErrorInfo(form["date_entrance"].parentElement, 
                     'dt-ent-error', 
                     '*Este campo é requerido');
        valid = false;
    } else if(!(/^\d{2}\/\d{2}\/\d{4}$/).test(form["date_entrance"].value)) {
        form["date_entrance"].style.setProperty("border-color", "#F00");
        
        addErrorInfo(form["date_entrance"].parentElement, 
                     'dt-ent-error', 
                     '*Entrada inválida');
        valid = false;
    } else if(!validateDate(form["date_entrance"].value)) {
        form["date_entrance"].style.setProperty("border-color", "#F00");
        
        addErrorInfo(form["date_entrance"].parentElement, 
                     'dt-ent-error', 
                     '*Data informada inválida');
        valid = false;
    }
    if (validateNonEmpty(form["date_exit"])) {
        if (!(/^\d{2}\/\d{2}\/\d{4}$/).test(form["date_exit"].value)) {
            valid = false;
        } else if (!validateDate(form["date_exit"].value)) {
            form["date_exit"].style.setProperty("border-color", "#F00");
            
            addErrorInfo(form["date_exit"].parentElement, 
                         'dt-exit-error', 
                         '*Data informada inválida');
            valid = false;
        }
    }

    return valid;
}

function addExperience(form) {
    if (validateInfoExperienceRequested(form)) {
        getElement("id", "included-experiences").style.removeProperty('display');
        var result = getElement("id", "result");
        var size = result.childElementCount;

        if (size > 0) {
            for (var i = 0; i < size; i++) {
                if (form["company_name"].value == result.children[i].children[0].innerHTML &&
                    form['func'].value == result.children[i].children[1].innerHTML) {
                    showInfo('Rgistro de Experiência', 'Experiência já cadastrado');
                    reset();
                    return;
                }
            }
        }

        var div = '<div class="tr-content" id="' + 'exp-' + size + '">'+
                      '<div class="td-content" data-heading="Empresa">'+ form['company_name'].value + '</div>' +
                      '<div class="td-content" data-heading="Função">' + form['func'].value + '</div>' +
                      '<div class="td-content" data-heading="Entrada">' + form['date_entrance'].value + '</div>' +
                      '<div class="td-content" data-heading="Saída">' + form['date_exit'].value + '</div>' +
                      '<div style="display:none;" data-heading="Ramo">' + form['specialty'].value + '</div>' +
                      '<div style="display:none;" data-heading="Atividades">' + form['description'].value + '</div>' +
                      '<div class="td-content">editar/excluir</div>'
                  '</div>';
        
        result.innerHTML += div;
        
        reset();
    }
}

function validateRegisterExperience(form) {
    var result = getElement('id', 'result');
    var size = result.childElementCount;

    var elements = '';
    for (var i = 0; i < size; i++) {
        elements += '<input type="hidden" name="' + result.children[i].id + '" value="';

        var s = result.children[i].childElementCount - 1;
        var c = result.children[i];
        for (var j = 0; j < s; j++) {
            elements +=  c.children[j].innerHTML;
            elements +=  ((j+1) < s)? '|' : ''
        }
        elements += '" />'
    }

    var content = form.innerHTML;
    form.innerHTML = elements;
    form.innerHTML += content;

    activeProgress();

    return true;
}

function testRegex(value, exp) {
    return exp.test(value);
}

function validateText(elem, errorId) {
    if (validateNonEmpty(elem)) {
        removeErrorInfo(elem.parentElement, errorId)
        elem.style.removeProperty("border-color");
    }
}

function createErrorInfo(elem, errorId, info) {
    var elemError = getElement('id', errorId);
    if (elemError) {
        elemError.innerHTML = info;
    } else {
        addErrorInfo(elem.parentElement, errorId, info);
        elem.style.setProperty("border-color", "#F00");
    }
}

function validateForRegex(elem, errorId, exp) {
    if (validateNonEmpty(elem)) {
        if (!exp.test(elem.value)) {
            var info = '*Entrada inválida';
            createErrorInfo(elem, errorId, info);
        } else {
            removeErrorInfo(elem.parentElement, errorId);
            elem.style.removeProperty("border-color");
        }
    }
}

function validatePassword(elem, errorId) {
    if (validateNonEmpty(elem)) {
        if (elem.value.length < 6) {
            var info = 'Senha pequena (minimo de caracteres 6)';
            createErrorInfo(elem, errorId, info);
        } else {
            removeErrorInfo(elem.parentElement, errorId);
            elem.style.removeProperty("border-color");
        }
    }
}

function validateRadio(elem, errorId) {
    if (elem.checked) {
        var elemError = getElement('id', errorId);
        if (elemError)
            elemError.parentElement.removeChild(elemError);
    }
}

function verifyUserInfoIsEmpty(form) {
    var empty = false;
    if (!validateNonEmpty(form['username'])) {
        var info = 'Este campo é requerido';
        createErrorInfo(form['username'], 'username-error', info);
        empty = true;
    }
    if (!validateNonEmpty(form['email'])) {
        var info = 'Este campo é requerido';
        createErrorInfo(form['email'], 'email-error', info);
        empty = true;
    }
    if (!validateNonEmpty(form['name'])) {
        var info = 'Este campo é requerido';
        createErrorInfo(form['name'], 'name-error', info);
        empty = true;
    }
    if (!validateNonEmpty(form['password'])) {
        var info = 'Este campo é requerido';
        createErrorInfo(form['password'], 'pw1-error', info);
        empty = true;
    }
    if (!validateNonEmpty(form['password2'])) {
        var info = 'Este campo é requerido';
        createErrorInfo(form['password2'], 'pw2-error', info);
        empty = true;
    }
    if (!form['gender-m'].checked && !form['gender-f'].checked) {
        var info = 'Você deve escolher uma das duas opções';
        createErrorInfo(form['gender-m'].parentElement.parentElement.parentElement, 'gender-error', info);
        empty = true;
    }

    return empty;
}

function validateUserRegister(form) {
    if (verifyUserInfoIsEmpty(form)) {
        return false;
    }
    if ((form['password'].value.length == form['password2'].value.length) &&
        (form['password'].value ==  form['password2'].value)) {
        activeProgress();
        return true;
    }

    form['password'].style.setProperty("border-color", "#F00");
    form['password2'].style.setProperty("border-color", "#F00");

    if (!getElement('id', 'pw-error-info-eq')) {
        var info = '*As duas senhas devem ser iguais';
            
        var parent = form['password'].parentElement.parentElement;
        var elem = new Element('div');
        elem.addAtt('id', 'pw-error-info-eq')
            .setProperty('color', '#F00')
            .setProperty('font-size', 'x-small')
            .setProperty('font-style', 'italic')
            .setProperty('width', '100%')
            .setProperty('text-align', 'center')
            .setProperty('margin-top', '5px')
            .setContent(info);

        parent.appendChild(elem.get());
    }

    return false;
}

function addFunction(form) {
    if (!form['func'].value) {
        var info = '*Escolha uma função para adicionar';
        createErrorInfo(form['func'], 'func-error', info);
        return;
    }

    removeErrorInfo(form['func'].parentElement, 'func-error');
    form['func'].style.removeProperty("border-color");

    var parent = getElement('id', 'result-funcs');
    var size = parent.childElementCount;

    if (size >= 3) {
        showInfo('Registro de Informações Adicionais', 
                 'Você pode cadastrar no máximo 3 funções');
        form['func'].value = '';
        return;
    }

    for (var i = 0; i < size; i++) {
        if (parent.children[i].children[0].innerHTML ==  form['func'].value) {
            //alert('Função (' + form['func'].value + ') já cadastrada');
            showInfo('Registro de Informações Adicionais', 
                     'Função (' + form['func'].value + ') já cadastrada');
            form['func'].value = '';
            return;
        }
    }

    parent.parentElement.style.removeProperty('display');
    
    var id = 'func-' + size;

    var elem = new Element('div');
    elem.addAtt('id', id)
        .addAtt('name', id)
        .addAtt('class', 'col-md-5')
        .addAtt('style', 'margin-left:8px; margin-top:5px;')
        .get().appendChild((new Element('div'))
                               .addAtt('class', 'col-1 width-90 result')
                               .setContent(form['func'].value).get());
    elem.get().appendChild((new Element('div'))
                                .addAtt('class', 'mini-btn-close')
                                .addAtt('onclick', 'removeFunction(this)')
                                .setContent('X').get());

    parent.appendChild(elem.get());

    form['func'].value = '';
}

function removeFunction(elem) {
    var parent = elem.parentElement;
    var sParent = parent.parentElement;
    sParent.removeChild(parent);

    /*renomeia os elementos */
    var size = sParent.childElementCount;

    for (var i = 0; i < size; i++) {
        sParent.children[i].id = 'func-' + i;
        sParent.children[i].name = 'func-' + i;
    }
}

function addObs(elem, size) {
    if (elem.value.length == size) {
        getElement('id', 'obs').style.removeProperty("display");
    } else if (elem.value.length == 0) {
        getElement('id', 'obs').style.setProperty('display', 'none');
        getElement('id', 'message').checked = false;
        getElement('id', 'own').checked = false;
    }
}

function validateYear(year, date) {
    var y = date.getFullYear();
    if (year > y || year < (y - 60)) return -1;
    if (year == y) return 0;
    return 1;
}

function validateMonth(month, date) {
    var m = date.getMonth() + 1;
    if (month > 12 || month < 0) return -1;
    if (month == m) return 0;
    if (month > m) return 2;
    return 1;
}

function month_31_days(month) {
    return (month <= 7 && month % 2 == 1) ||
           (month >= 8 && month % 2 == 0);
}

function leapYear(year) {
    return (year % 4 == 0);
}

function february(year, month, day) {
    if (leapYear(year)) {
        if (month == 2 && day > 29) return false;
    } else {
        if (month == 2 && day > 28) return false;
    }
    return true;
}

function otherMonths(month, day) {
    if (month_31_days(month)) {
        if (day > 31) return false;
    } else {
        if (day > 30) return false;
    }
    return true;
}

function validateDate(value) {
    var date = new Date();
    var day     = date.getDate();

    //divide a string onde encontrar o caracter "/"
    var v = value.split("/");
    dt = new Array(parseInt(v[0]), parseInt(v[1]), parseInt(v[2]));
    var y = validateYear(dt[2], date);
    var m = validateMonth(dt[1], date);

    if (y == -1 || m == -1 || day < 1) return false;

    if (y == 0) {
        if (m == 0) {
            if (dt[0] > day) return false;
        } else if (m == 2) {
            return false;
        } else if (!february(dt[2], dt[1], dt[0])) {
            return false;
        } else if (!otherMonths(dt[1], dt[0])) {
            return false;
        }
    } else {
        if (!february(dt[2], dt[1], dt[0])) {
            return false;
        } else if (!otherMonths(dt[1], dt[0])) {
            return false;
        }
    }

    return true;
}

function validateAdditionalInfo(form) {
    var valid = true;
    
    if (!validateNonEmpty(form['date_birth'])) {
        var info = '*Este campo é requerido';
        createErrorInfo(form['date_birth'], 'date_birth-error', info);
        valid = false;
    } else {
        if (!validateDate(form["date_birth"].value)) {
            var info = '*Data informada inválida';
            createErrorInfo(form['date_birth'], 'date_birth-error', info);
            valid = false;
        }
    }
    if (!form['isbpd-s'].checked && !form['isbpd-n'].checked) {
        var info = '*Você deve escolher uma das opções';
        createErrorInfo(form['isbpd-s'].parentElement.parentElement.parentElement, 'isbpd-error', info);
        valid = false;
    }
    if (!validateNonEmpty(form['cellular'])) {
        var info = '*Este campo é requerido';
        createErrorInfo(form['cellular'], 'cellular-error', info);
        valid = false;
    }
    if (validateNonEmpty(form['residential']) && 
        (!form['message'].checked && !form['own'].checked)) {
        var info = '*Você deve escolher uma das opções';
        createErrorInfo(form['message'].parentElement.parentElement.parentElement, 'observation-error', info);
        valid = false; 
    }
    if ((form['message'].checked || form['own'].checked) &&
        !validateNonEmpty(form['residential'])) {
        var info = '*Este campo é requerido';
        createErrorInfo(form['residential'], 'residential-error', info);
        valid = false; 
    }
    if (!validateNonEmpty(form['city_state'])) {
        var info = '*Este campo é requerido';
        createErrorInfo(form['city_state'], 'city_state-error', info);
        valid = false;
    }
    if (!validateNonEmpty(form['neighborhood'])) {
        var info = '*Este campo é requerido';
        createErrorInfo(form['neighborhood'], 'neighborhood-error', info);
        valid = false;
    }
    if (getElement('id', 'result-funcs').childElementCount == 0) {
        var info = '*Escolha pelo menos uma função';
        createErrorInfo(form['func'], 'func-error', info);
        valid = false;
    } else {
        var parent = getElement('id', 'result-funcs');
        var size = parent.childElementCount;

        var elem = new Element('input');
        var funcs = "";
        for (var i = 0; i < size; i++) {
            funcs += parent.children[i].firstElementChild.innerHTML;
            funcs += (i+1 < size)? '|' : '';
        }

        form.children[4].appendChild(elem.addAtt('type', 'hidden')
                                          .addAtt('id', 'funcs')
                                          .addAtt('name', 'funcs')
                                          .addAtt('value', funcs)
                                          .get());
    }
    if (validateNonEmpty(form['salary_pretension'])) {
        valid = validateSalary(form['salary_pretension']);
    }

    if (valid) activeProgress();

    return true;
}

function validateSalary(elem) {
    var numbers = '';
    
    for (var j = 0; j < elem.value.length; j++)
    {
        if ((/^\d$/).test(elem.value[j]))
            numbers += elem.value[j];
    }

    numbers = parseInt(numbers);

    if (!(/^(\d?\d\.)?\d{3},\d{2}$/).test(elem.value)) {
        var info = '*Entrada inválida';

        if (numbers > 3000000 || numbers < 100000) {
            info += '(mínimo: 1.000,00; máximo: 30.000,00)';
        }
        createErrorInfo(elem, 'salary-error', info);
        return false;
    } else if (numbers > 3000000 || numbers < 100000) {
        var info = '(mínimo: 1.000,00; máximo: 30.000,00)';
        createErrorInfo(elem, 'salary-error', info);
        return false;
    } else {
        removeErrorInfo(elem.parentElement, 'salary-error');
        elem.style.removeProperty("border-color");
    }

    return true;
}

function validateEducationLevel(elem) {
    var el = getElement("id", "group");
    var size = el.childElementCount;
    var children = el.children;

    if (elem.value == "") {
        if (children[1].children[0].childElementCount >= 3) {
            removeErrorInfo(children[1].children[0], children[1].children[0].children[2].id)
            children[1].children[0].children[1].style.removeProperty("border-color");
        }
        for (var i = 2; i < size; i++) {
            children[i].style.setProperty("display", "none");
            
            if (children[i].children[0].childElementCount >= 3) {
                removeErrorInfo(children[i].children[0], children[i].children[0].children[2].id)
                children[i].children[0].children[1].style.removeProperty("border-color");
            }
        } 
    }
    else if (elem.value == "medio") {
        for (var i = 2; i < size-2; i++) {
            children[i].style.setProperty("display", "none");
        }
        children[size-1].style.setProperty("display", "");
        children[size-2].style.setProperty("display", "");
    }
    else {
        for (var i = 2; i < size-1; i++) {
            children[i].style.setProperty("display", "");
        }
        children[size-1].style.setProperty("display", "none");
    }
}

function verifyEducation(form) {
    var valid = true;
    var date = new Date();

    if (!validateNonEmpty(form['level'])) {
        var info = '*Escolhe o nivel do curso';
        createErrorInfo(form['level'], 'level-error', info);
        valid = false;
    }
    if (!validateNonEmpty(form['situation'])) {
        var info = '*Escolhe o situação do curso';
        createErrorInfo(form['situation'], 'situation-error', info);
        valid = false;
    }
    if (!validateNonEmpty(form['institution']) &&
        !form['institution'].parentElement.parentElement.style.getPropertyValue('display')) {
        var info = '*Este campo é requerido';
        createErrorInfo(form['institution'], 'institution-error', info);
        valid = false;
    } 
    if (!validateNonEmpty(form['name_course']) &&
        !form['name_course'].parentElement.parentElement.style.getPropertyValue('display')) {
        var info = '*Este campo é requerido';
        createErrorInfo(form['name_course'], 'name_course-error', info);
        valid = false;
    }
    if(validateNonEmpty(form['city']) &&
       !(/^\w+\s*\/\s*\w{2}$/).test(form['city'].value) &&
       !form['city'].parentElement.parentElement.style.getPropertyValue('display') ) {
        var info = '*Entrada inválida';
        createErrorInfo(form['city'], 'city-error', info);
        valid = false;
    }
    if (!validateNonEmpty(form['year_conclusion']) &&
        !form['year_conclusion'].parentElement.parentElement.style.getPropertyValue('display') ) {
        var info = '*Este campo é requerido';
        createErrorInfo(form['year_conclusion'], 'yc-error', info);
        valid = false;
    } else if(!(/^\d{4}$/).test(form['year_conclusion'].value) &&
              !form['year_conclusion'].parentElement.parentElement.style.getPropertyValue('display') ) {
        var info = '*Entrada inválida';
        createErrorInfo(form['year_conclusion'], 'yc-error', info);
        valid = false;
    } else if(form['year_conclusion'].value > date.getFullYear()) {
        var info = '*Ano superior ao ano atual (' + date.getFullYear() + ')';
        createErrorInfo(form['year_conclusion'], 'yc-error', info);
        valid = false;
    }
    return valid;
}

function addEducation(form) {
    if (verifyEducation(form)) {
        getElement("id", "included-education").style.removeProperty('display');
        var result = getElement("id", "result");
        var size = result.childElementCount;

        if (size > 0) {
            for (var i = 0; i < size; i++) {
                if (result.children[i].children[0].innerHTML == (form['level'].value + ' ' + form['situation'].value)) {
                    if (form['level'].value == 'medio' ||
                        form['name_course'].value == result.firstElementChild.children[2].innerHTML) {
                        showInfo('Registro de Escolaridade', 'Curso já cadastrado');
                        reset();
                        return;
                    }
                }
            }
        }

        var div = '<div class="tr-content" id="' + 'ed-' + size + '">'+
                      '<div class="td-content" data-heading="Nível de Formação">'+ 
                            form['level'].selectedOptions[0].textContent + ' ' + 
                            form['situation'].selectedOptions[0].textContent + '</div>' +
                      '<div class="td-content" data-heading="Instituição de Ensino">' + form['institution'].value + '</div>' +
                      '<div class="td-content" data-heading="Nome do Curso">' + form['name_course'].value + '</div>' +
                      '<div class="td-content" data-heading="Ano de Conclusão">' + form['year_conclusion'].value + '</div>' +
                      '<div style="display:none;" data-heading="Cidade / Estado">' + form['city'].value + '</div>' +
                      '<div class="td-content">editar/excluir</div>'
                  '</div>';
        
        result.innerHTML += div;

        reset();
    }
}

function validateEducationRegister(form) {
    var result = getElement('id', 'result');
    var size = result.childElementCount;

    if (size == 0) {
        alert('Você precisa registrar pelo menos 1 formação');
        return false;
    }

    var elements = '';
    for (var i = 0; i < size; i++) {
        elements += '<input type="hidden" name="' + result.children[i].id + '" value="';

        var s = result.children[i].childElementCount - 1;
        var c = result.children[i];
        for (var j = 0; j < s; j++) {
            elements +=  c.children[j].innerHTML;
            elements +=  ((j+1) < s)? '|' : ''
        }
        elements += '" />'
    }

    var content = form.innerHTML;
    form.innerHTML = elements;
    form.innerHTML += content;

    activeProgress();  

    return true;
}

function verifyCourse(form) {
    var valid = true;
    var date = new Date();

    if (!validateNonEmpty(form['level'])) {
        var info = '*Escolhe o nivel do curso';
        createErrorInfo(form['level'], 'level-error', info);
        valid = false;
    }
    if (!validateNonEmpty(form['institution'])) {
        var info = '*Este campo é requerido';
        createErrorInfo(form['institution'], 'institution-error', info);
        valid = false;
    }
    if (!validateNonEmpty(form['name_course'])) {
        var info = '*Este campo é requerido';
        createErrorInfo(form['name_course'], 'name_course-error', info);
        valid = false;
    }
    if (validateNonEmpty(form['city']) &&
        !(/^[\w\s]+\s*\/\s*\w{2}$/).test(form['city'].value)) {
        var info = '*Entrada inválida';
        createErrorInfo(form['city'], 'city-error', info);
        valid = false;
    }
    if (!validateNonEmpty(form['year_conclusion'])) {
        var info = '*Este campo é requerido';
        createErrorInfo(form['year_conclusion'], 'yc-error', info);
        valid = false;
    } else if(!(/^\d{4}$/).test(form['year_conclusion'].value) &&
              !form['year_conclusion'].parentElement.parentElement.style.getPropertyValue('display') ) {
        var info = '*Entrada inválida';
        createErrorInfo(form['year_conclusion'], 'yc-error', info);
        valid = false;
    } else if(form['year_conclusion'].value > date.getFullYear()) {
        var info = '*Ano superior ao ano atual (' + date.getFullYear() + ')';
        createErrorInfo(form['year_conclusion'], 'yc-error', info);
        valid = false;
    }

    return valid;
}

function addCourse(form) {
    if (verifyCourse(form)) {
        getElement("id", "included-courses").style.removeProperty('display');
        var result = getElement("id", "result");
        var size = result.childElementCount;

        if (size > 0) {
            for (var i = 0; i < size; i++) {
                if (form['name_course'].value == result.children[0].children[2].innerHTML) {
                    showInfo('Registro de Cursos', 'Curso já cadastrado');
                    //alert('Curso já cadastrado');
                    reset();
                    return;
                }
            }
        }

        var div = '<div class="tr-content" id="' + 'course-' + size + '">'+
                      '<div class="td-content" data-heading="Nível do Curso">'+ form['level'].selectedOptions[0].textContent + '</div>' +
                      '<div class="td-content" data-heading="Instituição de Ensino">' + form['institution'].value + '</div>' +
                      '<div class="td-content" data-heading="Nome do Curso">' + form['name_course'].value + '</div>' +
                      '<div class="td-content" data-heading="Ano de Conclusão">' + form['year_conclusion'].value + '</div>' +
                      '<div style="display:none;" data-heading="Cidade / Estado">' + form['city'].value + '</div>' +
                      '<div class="td-content">editar/excluir</div>'
                  '</div>';
        
        result.innerHTML += div;

        reset();  
    }
}

function validateCourseRegister(form) {
    var result = getElement('id', 'result');
    var size = result.childElementCount;

    var elements = '';
    for (var i = 0; i < size; i++) {
        elements += '<input type="hidden" name="' + result.children[i].id + '" value="';

        var s = result.children[i].childElementCount - 1;
        var c = result.children[i];
        for (var j = 0; j < s; j++) {
            elements +=  c.children[j].innerHTML;
            elements +=  ((j+1) < s)? '|' : ''
        }
        elements += '" />'
    }

    var content = form.innerHTML;
    form.innerHTML = elements;
    form.innerHTML += content;

    activeProgress();     

    return true;
}

function activeProgress() {
    getElement('id', 'loader').style.removeProperty('display');
}

function showInfo(title, info) {
    getElement('id', 'alert_cont').style.removeProperty('display');

    var elem = getElement('id', 'title');
    elem.innerHTML = title;

    elem = getElement('id', 'info');
    elem.innerHTML = info;
}

function closeInfo() {
    getElement('id', 'alert_cont').style.setProperty('display', 'none');
}

function showInfoDeficiency() {
    getElement('id', 'info_def').style.removeProperty('display');
    getElement('id', 'edit-def').style.removeProperty('display');
}

function closeInfoDeficiency() {
    getElement('id', 'info_def').style.setProperty('display', 'none');
}

function removeEditDeficiency() {
    getElement('id', 'edit-def').style.setProperty('display', 'none');
    var elem = getElement('id', 'resume-deficiency');
    if (elem) {
        elem.parentElement.removeChild(elem); 
    }
}

function configInfoDeficiency() {
    var parent = getElement('id', 'def');

    var children = parent.children;
    var resume = '';
    
    for (var c = 0; c < children.length; c++) {
        var ch1 = children[c].children;
        for (var i = 1; i < ch1.length; i++) {
            var ch2 = ch1[i].children;
            for (var j = 0; j < ch2.length; j++) {
                if (ch2[j].children[0].checked) {
                    resume += ch2[j].children[1].innerHTML;
                    resume += ', ';
                }
            }
        }
    }
    
    if (resume != '') {
        var form = getElement('id', 'form-add-inf');
        var input = getElement('id', 'resume-deficiency');
        
        if (!input) {
            var r = form.innerHTML;
            var elem = new Element('input');
            elem.addAtt('type', 'hidden')
                .addAtt('name', 'resume-deficiency')
                .addAtt('id', 'resume-deficiency')
                .addAtt('value', resume.substring(0, resume.length-2));
            
            form.children[5].appendChild(elem.get());

            /*form.innerHTML = '<input type="hidden" name="resume-deficiency"' + 
                               ' id="resume-deficiency"' + 
                               ' value="' + resume.substring(0, resume.length-2) + '">';
            form.innerHTML += r;*/
        } else {
            input.value = resume.substring(0, resume.length-2);
        }
    }

    closeInfoDeficiency();
}
