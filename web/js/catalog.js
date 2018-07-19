
(function(w){
    handlePageButtons(w);
	handleInputs(w);
	w.spinner = document.getElementById('spinner');
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
					target = target.parentElement;
					if(target === null){
						inSearch = false;
						return false;
					}
			}
		}
	});
}


//handle counter inputs
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


//show pop-up window with detail image
function showDetailImage(srcElem)
{	
    if(srcElem.dataset.full === 'not') return;
	var url = 'https://metropt.ru/upload/'+srcElem.dataset.full;
	var imgWrapper = document.createElement('div');
	//need for vertical align of image
	var imgWrapperHelper = document.createElement('span');
	var img = document.createElement('img');
	imgWrapper.className = 'image-modal__wrapper';
	imgWrapperHelper.className = 'image-modal__wrapper-helper';
    img.className = 'image-modal';
	imgWrapper.appendChild(imgWrapperHelper);
	var spinner = window.spinner.cloneNode(true);
	spinner.className = "spinner";
	imgWrapper.appendChild(spinner);
	document.body.appendChild(imgWrapper);
	imgWrapper.addEventListener('click', function(e){
		imgWrapper.remove();
	});
	img.src = url;
	img.onload = function(){
		spinner.remove();
		imgWrapper.appendChild(this);
	}
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
  	xhttp.open("POST", addToBasketUrl, true);
  	xhttp.send(dataF);
}