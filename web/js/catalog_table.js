(function(){
    window.addEventListener('input', function(e){
        if(e.target.className.indexOf('catalog__quantity-input') < 0) return;
        var value = e.target.value;
        if(value === "") return;
    })
    window.addEventListener('change', function(e){
        if(e.target.className.indexOf('catalog__quantity-input') < 0) return;
        if(e.target.value === "") e.target.value = e.target.dataset.oldvalue;
    })
    window.addEventListener('click', function(e){
        if(e.target.className.indexOf('catalog-table__quantity-btn') < 0) return;
        var input = e.target.parentElement.getElementsByClassName('catalog__quantity-input')[0];
        var value = Number(input.value);
        var available = Number(input.dataset.available);
        var oldValue = Number(input.dataset.oldvalue);
        if(isNaN(value)){
            input.value = oldValue;
            return;
        }
    })
})()