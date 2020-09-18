<form action="#" method="post" id="demoForm" class="demoForm">

    
    <select id="items" name="scripts">
        <option value="200">Banana</option>
        <option value="300">Apple</option>
        <option value="400">Mango</option>
        <option value="500">Guava</option>
        
    </select>
    
    <input type="text" size="30" name="display" id="display" readonly>
    <input type="number" size="30" name="quanity" id="quanity">
    <input type="number" size="30" name="total" id="total" readonly>


</form>


<script>


(function() {


    var typingTimer;                
    var doneTypingInterval = 500;

    var items = document.getElementById('items');
    var el = document.getElementById('display');
    var qty = document.getElementById('quanity');
    var ttl = document.getElementById('total');

    

    // function getSelectedOption(items) {
    // var opt;
    // for ( var i = 0, len = items.options.length; i <len; i++ ) {
    //     opt = items.options[i];
    //     if ( opt.selected === true ) {
    //         break;
    //     }
    // }
    // return opt;
    // }


    items.onclick = function () {
        el.value = items.value; 
    }

    qty.onkeyup = function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(calcTotal, doneTypingInterval);
    }

    function calcTotal () {
        //var x = "<?php ?>";
        if(Number.isInteger(parseInt(qty.value)) ){
            ttl.value = el.value * qty.value;
            
        }else{
            ttl.value =0;
        }
    }



}());

</script>