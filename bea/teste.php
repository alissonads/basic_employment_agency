<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php
        /*$a = (array)$_POST['exp-0'] ?? '';

        print_r($a);*/
    ?>

    <input type="text" onkeypress="mask(this, '##.##0,00', true);" />
    <script>
        /*Mask*/
        var Mask = function(mask, reverse = false) {
            this.mask = mask;
            this.reverse = reverse;
            this.chrs = '#xX0';
        }

        Mask.prototype.getMask = function() {
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

        Mask.prototype.setMask = function(mask) {
            this.mask = mask;
        }

        Mask.prototype.setReverse = function(reverse) {
            this.reverse = reverse;
        }

        Mask.prototype.existsChrsCompare = function(values) {
            return this.chrs.indexOf(values) != -1;
        }

        Mask.prototype.rIndexOf = function(values) {
            return this.mask.indexOf(values);
        }

        Mask.prototype.lIndexOf = function(values) {
            return this.mask.lastIndexOf(values);
        }

        Mask.prototype.chrsCompareConfig = function(chrs) {
            this.chrs = chrs;
        }

        Mask.prototype.createIterator = function() {
            return new MaskIterator(this);
        }

        Mask.prototype.fragment = function(init = 0) {
            /*var result = '';
            var itr = this.createIterator();
            itr.init(init);

            while (itr.valid()) {
                var r = itr.next();
                if (this.chrs.indexOf(r) == -1) 
                    result += r;
                else
                    return result;
            }
            
            return result;*/
        }

        /*Iterator*/        
        var MaskIterator = function(mask) {
            this.mask = mask;
            this.rewind();
        }

        MaskIterator.prototype.init = function(index) {
            if (index < 0)
                this.front();
            else if (index >= this.mask.size())
                this.end();
            else
                this.index = index;
        }

        MaskIterator.prototype.rewind = function() {
            if (this.mask.isReverse())
                this.end()
            else
                this.front();
        }

        MaskIterator.prototype.front = function() {
            this.index = 0;
        }

        MaskIterator.prototype.end = function() {
            this.index = this.mask.size() - 1;
        }

        MaskIterator.prototype.finish = function() {
            this.index = -1;
        }

        MaskIterator.prototype.current = function() {
            return this.mask.getMask()[this.index];
        }

        MaskIterator.prototype.key = function() {
            return this.index;
        }

        MaskIterator.prototype.next = function() {
            return this.mask.isReverse()? 
                        this.index-- : this.index++;
        }

        MaskIterator.prototype.valid = function() {
            return (this.index >= 0 &&
                        this.index < this.mask.size());
        } 

        /*Aplicar mascara*/
        function mask(elem, mk, reverse = false) {
            var key= (window.event)? event.keyCode : event.which;
            
            if (key > 47 && key < 58 || key == 8 || key == 0) {
                applyMask(elem, mk, reverse);
            } else if (key == 8 || key == 0){
                applyMask(elem, mk, reverse);
            }
        }

        function applyMask(elem, mk, reverse) {
            reverse ? applyMaskReverse(elem, mk) :
                      applyMaskNormal(elem, mk);
        }

        function applyMaskNormal(elem, mk) {
            var m = new Mask(mk);
            var itr = m.createIterator();
            itr.init(elem.value.length);

            while (itr.valid()) {
                var r = itr.current();
                
                if (!m.existsChrsCompare(r)) 
                    elem.value += r;
                else
                    return;

                itr.next();
            }
        }

        function applyMaskReverse(elem, mk) {
            var result = '';
            var m = new Mask(mk, true);
            var itr = m.createIterator();
            var r = '';
            var numbers = '';
            
            for (var j = 0; j < elem.value.length; j++)
            {
                if ((/^\d$/).test(elem.value[j]))
                    numbers += elem.value[j];
            }
            
            var i = numbers.length-1;

            itr.next();
            while (true) {
                r = itr.current();
                if (!m.existsChrsCompare(r))
                    result = r + result;
                else if (numbers[i]) {
                    result = numbers[i] + result;
                    i--;
                }
                if (i < 0) break;

                itr.next(); 
                if (!itr.valid()) {
                    var id = m.lIndexOf('#');
                    itr.init(id-1);
                }
            }

            //'#.##0,00' - 0000051  l=1 1
            elem.value = result;
        }
    </script>
</body>
</html>