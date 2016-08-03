

function showError(container, errorMessage) {
      container.className = 'error';
      var msgElem = document.createElement('span');
      msgElem.className = "error-message";
      msgElem.innerHTML = errorMessage;
      container.appendChild(msgElem);
}
function resetError(container) {
    container.className = '';
    if (container.lastChild.className == "error-message") {
       container.removeChild(container.lastChild);
    }
}

    function validate(form) {
		var elems = form.elements;
		var ret = true;
       resetError(elems.posName.parentNode);
        if (!elems.posName.value) {
          showError(elems.posName.parentNode, 'Укажите ваше имя!');
		  ret = false;
        }
	    else {
		    ret = ret&&true;
	   }

        resetError(elems.posEmail.parentNode);
	    var re = /^([a-z,._,0-9])+@([a-z,._,0-9])+(.([a-z])+)+$/;
        if (!elems.posEmail.value) {
			showError(elems.posEmail.parentNode, ' Укажите ваш e-mail');
			ret = false;
        }
	    else if (!re.test(elems.posEmail.value)) {
			showError(elems.posEmail.parentNode, ' e-mail неверный');
			ret = false;
        }
	    else {
		    ret = ret&&true;
	    }

        /*resetError(elems.posRegard.parentNode);
        if (!elems.posRegard.value) {
			showError(elems.posRegard.parentNode, ' Укажите тему сообщения');
			ret = false;
        }
	    else {
		    ret = ret&&true;
	    } */
	  
        resetError(elems.posText.parentNode);
        if (!elems.posText.value) {
			showError(elems.posText.parentNode, ' Отсутствует текст');
			ret = false;
        }
	    else {
		    ret = ret&&true;
	    }

		if (!ret) {
			return false;
		}
    }