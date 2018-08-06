(function(w){
    w.addEventListener('click', function(e){
        var link = e.target;
        if(link.className.indexOf('basket__quantity-link') < 0) return;
        var parent = link.parentElement;
        var input = parent.getElementsByTagName('input')[0];
        var newValue = Number(input.value);
        if(isNaN(newValue)){
            input.value = input.dataset.oldvalue;
            return;
        }
        link.href = link.href.replace(/q=\d/, 'q='+newValue)
    })
})(window)