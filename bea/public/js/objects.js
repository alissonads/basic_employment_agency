var Element = function(tagName) {
    this.element = document.createElement(tagName);
}

Element.prototype.get = function() {
    return this.element;
}

Element.prototype.addAtt = function(type, attribute) {
    this.element.setAttribute(type, attribute);
    return this;
}

Element.prototype.setContent = function(content) {
    this.element.innerHTML = content;
    return this;
}

Element.prototype.setProperty = function(prop, value) {
    this.element.style.setProperty(prop, value);
    return this;
}

Element.prototype.create = function(parent) {
    parent.appendChild(this.element);
}

/*Mascara*/
var Mask = function(mask, reverse = false) {
    this.mask = mask;
    this.reverse = reverse;
    this.chrs = '#xX0';
}

Mask.prototype.get = function() {
    return this.mask;
}

Mask.prototype.getChrs = function() {
    return this.chrs;
}

Mask.prototype.isReverse = function() {
    return this.reverse;
}

Mask.prototype.size = function() {
    return this.mask.length;
}

Mask.prototype.set = function(mask) {
    this.mask = mask;
}

Mask.prototype.setReverse = function(reverse) {
    this.reverse = reverse;
}

Mask.prototype.existsChrsCompare = function(value) {
    return this.chrs.indexOf(value) != -1;
}

Mask.prototype.rIndexOf = function(values) {
    return this.mask.lastIndexOf(values);
}

Mask.prototype.lIndexOf = function(values) {
    return this.mask.indexOf(values);
}

Mask.prototype.createIterator = function() {
    return new MaskIterator(this);
}

Mask.prototype.lastNumber = function() {
    var last = -1;
    var aux = -1;

    for (var i = 0; i < this.chrs.length; i++) {
        aux = this.rIndexOf(this.chrs[i]);
        
        if (aux != -1 && aux > last)
            last = aux;
    }
    return last;
}

Mask.prototype.firstNumber = function() {
    var first = this.chrs.length;
    var aux = -1;

    for (var i = 0; i < this.chrs.length; i++) {
        aux = this.lIndexOf(this.chrs[i]);
        
        if (aux != -1 && aux < first)
            first = aux;
    }
    return first;
}

Mask.prototype.fragment = function(init = -1) {
    var result = '';
    var itr = this.createIterator();
    if (init != -1)
        itr.setKey(init);

    while (itr.valid()) {
        var r = itr.current();
        if (!this.existsChrsCompare(r))
            result += r;
        else
            return result;
        itr.next();
    }

    return result;
}

/*Iterator*/
var MaskIterator = function(mask) {
    this.mask = mask;
    /*variável para verificação se a iteração será circular;
     *só será circular se a máscara for aplicada de forma reversa
     *e se existir o caracter '#' na máscara
    */
    this.circulate = mask.isReverse() ? mask.rIndexOf('#') : -1;
    this.rewind();
}

MaskIterator.prototype.setKey = function(index) {
    if (index < 0)
        this.index = 0;
    else if (index >= this.mask.size())
        this.index = this.mask.size() - 1;
    else
        this.index = index;
}

MaskIterator.prototype.rewind = function() {
    this.index = this.front();
}

MaskIterator.prototype.front = function() {
    return this.mask.isReverse()?
                this.mask.size() - 1 : 0;
}

MaskIterator.prototype.end = function() {
    return this.mask.isReverse()?
                0 : this.mask.size() - 1;
}

MaskIterator.prototype.finish = function() {
    this.index = -1;
}

MaskIterator.prototype.current = function() {
    return this.mask.get()[this.index];
}

MaskIterator.prototype.key = function() {
    return this.index;
}

/**
 * Muda para o proximo elemento da string;
 * Se for circular (this.circular != -1) e estiver no
 * final da string, index terá o id do caracter '#'
 * encontrado na string
 */
MaskIterator.prototype.next = function() {
    this.mask.isReverse()? this.index-- : this.index++;
    if (this.circulate != -1 && this.index == this.end() - 1)
        this.index = this.circulate;
}

MaskIterator.prototype.valid = function() {
    return (this.index >=0 && this.index < this.mask.size());
}

var MaskSpecialist = function() {
}

MaskSpecialist.prototype.apply = function(values, mask, reverse = false) {
    var mk = new Mask(mask, reverse);
    return reverse? this.applyReverseMasK(mk, values) :
                    this.applyNormalMask(mk, values);
}

MaskSpecialist.prototype.applyNormalMask = function(mask, values) {
    var index = values.length;
    return values + mask.fragment(index);
}

MaskSpecialist.prototype.applyReverseMasK = function(mask, values) {
    var result = '';
    var itr = mask.createIterator();
    var numbers = this.reverseCopyNumbers(values);
    var id = numbers.length-1;
    
    itr.next();
    while (itr.valid()) {
        var r = itr.current();
        if (!mask.existsChrsCompare(r)) {
            result = r + result;
        } else if (numbers[id] && id >= 0) {
            result = numbers[id] + result;
            id--;
        }

        if (id < 0) {
            var firstNumber = mask.firstNumber();
            if (firstNumber != -1 && itr.key() > firstNumber)
                itr.finish();
        }

        itr.next();
    }

    return result;
}

MaskSpecialist.prototype.reverseCopyNumbers = function(values) {
    var numbers = '';
    for (var j = 0; j < values.length; j++)
    {
        if ((/^\d$/).test(values[j]))
             numbers += values[j];
    }
    return numbers;
}

MaskSpecialist = new MaskSpecialist();

