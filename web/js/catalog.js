
(function(w){
    handlePageButtons(w);
    handleInputs(w);
})(window)

function handlePageButtons(w)
{
    w.addEventListener("click", function(e){
		var target = e.target;
		var inSearch = true;
		var counterUpper = 0;
		while(inSearch){
			className = target.className;
			switch (className){
				case "product-cart__btn-mns":
					minusBtn(target);
					inSearch = false;
					break;
				case  "product-cart__btn-pls":
					plusBtn(target);
					inSearch = false;
					break;
				case "product-cart__add-basket":
					addBasket(target);
					inSearch = false;
					break;
				case "product-cart__magnifier":
					showDetailImage(target);
					inSearch = false;
					break;
				case "product-cart__controll clearfix" || "product-cart__q-input":
					inSearch = false;
					return;
					break;
				default:
					counterUpper++;
					if(counterUpper > 3) inSearch = false;
					target = target.parentElement;
			}
		}
	});
}

function handleInputs(w)
{
    w.addEventListener('input', function(e){
        var newVal = Number(input.value);
        var available = Number(input.dataset.available);
        var oldVal = Number(input.dataset.old);
        if(newVal == NaN){
            input.value = oldValue;
        }else if(newVal < 1){
            input.value = 1;
        }else if(newVal > available){
            input.value = available;
        }else{
            input.value = newVal;
        }
    });
}

function showDetailImage(srcElem)
{	
    if(srcElem.dataset.full === 'not') return;
    var url = 'https://metropt.ru/upload/'+srcElem.dataset.full;
    var img = document.createElement('img');
    img.classList.add('image-modal');
    img.src = url;
    document.body.appendChild(img);
}
//return product id by control element
function getElementID(controlElem)
{
	return Number(controlElem.parentElement.id);
}
//return input element by control element
function getInput(controlElem)
{
	var id = getElementID(controlElem);
	inputID = "input-"+id;
	return document.getElementById(inputID);
}
//handle plus button
function plusBtn(controlElem)
{
	input = getInput(controlElem);
	var newVal = Number(input.value) + 1;
	if(Number(input.dataset.available) < Number(newVal)){
		return;
	}
	input.value++;
}
//handle minus button
function minusBtn(controlElem)
{
	input = getInput(controlElem);
	if(Number(input.value) === 1){
		return;
	}
	input.value--;
}

function addBasket(controlElem)
{
	var id = Number(getElementID(controlElem));
	var q = Number(getInput(controlElem).value);
	btn_catalog_add_to_basket(id, q)
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
  	xhttp.open("POST", "<?= Url::to(['catalog/addtobasketajax']) ?>", true);
  	xhttp.send(dataF);
}