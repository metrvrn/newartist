(function(w){
    var productCart = document.getElementById('productCart');
var productID = productCart.dataset.id;
var detailControl = document.getElementById('detailControl');
var plusBtn = document.getElementById('plusBtn');
var minusBtn = document.getElementById('minusBtn');
var qInput = document.getElementById('quantityInput');
var oldValue = Number(qInput.dataset.oldvalue);
var basketBtn = document.getElementById('addBasketBtn');
var available = Number(document.getElementById('available').innerText);

detailControl.addEventListener('click', function(e){
    var target = e.target;
    var actionDefined = false;
    while(!actionDefined){
        switch(target){
            case plusBtn:
                actionDefined = true;
                handlePlusBtn(target);
                break;
            case minusBtn:
                actionDefined = true;
                handleMinusBtn(target);
                break;
            case basketBtn:
                addBasketBtn(target);
                actionDefined = true;
                break;
            default:
                if(target == detailControl || target == qInput) return;
                target = target.parentElement;
                break;
        }
    }
});

qInput.addEventListener('input', handleInput);

function handlePlusBtn(btn)
{
    var newVal = Number(qInput.value) + 1;
    if(isNaN(newVal)){
        qInput.value = qInput.dataset.oldvalue;
    }
    else if(newVal > available){
        qInput.value = qInput.dataset.oldvalue;
    }
    else{
        qInput.dataset.oldvalue = newVal;
        qInput.value = newVal;
    }
}

function handleMinusBtn(btn)
{
    var newVal = Number(qInput.value) - 1;
    if(isNaN(newVal)){
        qInput.value = qInput.dataset.oldvalue;
    }
    else if(newVal < 1){
        qInput.value = qInput.dataset.oldvalue;
    }
    else{
        qInput.dataset.oldvalue = newVal;
        qInput.value = newVal;
    }
}

function handleInput(e)
{
    var curVal = Number(qInput.value);
    if(isNaN(curVal)){
        qInput.value = oldValue;
    }else if(curVal <= 0){
        qInput.value = 1;
    }else if(curVal > available){
        qInput.value = available;
    }
}

function addBasketBtn()
{
    btn_catalog_add_to_basket(productID, Number(qInput.value));
}

function btn_catalog_add_to_basket(id, q)
{
	var xhttp = new XMLHttpRequest();
	var dataF = new FormData();
	dataF.append('elementid', id);
	dataF.append('quanty', q);
	xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		console.log("Response text:------------------");
		console.log(this.responseText);
		}
	};
  	xhttp.open("POST", addToBasketUrl, true);
  	xhttp.send(dataF);
}

})(window)