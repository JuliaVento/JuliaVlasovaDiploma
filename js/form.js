function validate(myForm)
	{
	x = document.getElementById("form_reg").getElementsByTagName("span");
	for (var i = x.length - 1; i >= 0; i--)
	{
		x[i].parentNode.removeChild(x[i]);
		console.log(i)
	}
	console.log(myForm.username)
	
	for (var i = 0; i < myForm.length; i++)
	{
	  if(myForm[i].type != "submit")
	  {
	    myForm[i].style.backgroundColor = "white";
	  }
	}
	
	var username = isFullText(myForm.username);
	var surname = isFullText(myForm.surname);
	
	var pasFull = isFullText(myForm.pass1);
	var pasw = pass(myForm.pass1);
	var logFull = isFullText(myForm.login);
	
		
	var log = login(myForm.login);
	var mailFull = isFullText(myForm.mail);
	var mailtrue = mail(myForm.mail);
	
	
	
	var passCoin = passRepCoin(myForm.pass2);
	var passRepFull = isFullText(myForm.pass2);
	
	return username && surname && pasw && pasFull && log && logFull && mailtrue && mailFull && passRepFull && passCoin;
	}
	

 
	function isFullText(text)
	{
		//console.log(text);
		if (text.value == "")
		{
			var item = document.createElement("span");
			item.innerHTML = " Поле не должно быть пустым.";
			text.style.backgroundColor = "rgba(125, 227, 156, 0.38)";
			text.parentNode.appendChild(item);
			return false;
		}
		return true;
	}
	
	function isCorrect(text)
	{ 
		var num = +text.value;
		console.log(num)
		if (isNaN(num) || num <= 6 || num > 120)
		{
			var item = document.createElement("span");
			item.innerHTML = " Возраст должен быть от 6 до 120.";
			text.parentNode.appendChild(item);
			text.style.backgroundColor = "rgba(125, 227, 156, 0.38)";
			return false;
		}
		return true;
	
	}	
	
	function pass(text) {
		var num = text.value;
		console.log(num)
		if(num.length < 7) {
			var item = document.createElement("span");
			item.innerHTML = " Пароль должен состоять более чем из 6 символов. ";
			text.parentNode.appendChild(item);
			text.style.backgroundColor = "rgba(125, 227, 156, 0.38)";
			return false;
		}
		return true;
	}
	
	function login(text) {
		
		var num = text.value;
	
		if(!/^[a-z0-9]+$/.test(num)) {
			var item = document.createElement("span");
			item.innerHTML = " В логине могут быть только цифры и буквы латинского алфавита.";
			text.parentNode.appendChild(item);
			text.style.backgroundColor = "rgba(125, 227, 156, 0.38)";
			return false;
		}
		return true;		
	
		
	}
	
	function mail(text) {
		
		var num = text.value;
		console.log(num)
		if(!/^([a-z0-9_\.-]+)@([a-z0-9_\.-]+)\.([a-z\.]{2,6})$/.test(num)) {
			var item = document.createElement("span");
			item.innerHTML = " Поле e-mail должно быть реальным.";
			text.parentNode.appendChild(item);
			text.style.backgroundColor = "rgba(125, 227, 156, 0.38)";
			return false;
		}
		return true;	
	}
	
	
	function passRepCoin(text) {
		
		var num2 = text.value;
		var pass1 = document.getElementsByName("pass1");
		var num1 = pass1[0].value;
	
		if(num2 != num1) {
			var item = document.createElement("span");
			item.innerHTML = " Пароли не совпадают!";
			text.parentNode.appendChild(item);
			text.style.backgroundColor = "rgba(125, 227, 156, 0.38)";
			return false;
		}
		return true;
	
		
	}
	
	



 

function check() {
	  var checkpassword = false;
	  var log = document.getElementsByName("login")[0].value; // Эта переменная хранится где-то на сервере, а здесь ее значение = ""
	  var yourLog = document.getElementsByName("yourlogin")[0].value;
	  var pass = document.getElementsByName("pass2")[0].value; // Эта переменная хранится где-то на сервере, а здесь ее значение = ""
	  var yourPass = document.getElementsByName("pas")[0].value;
	
		if (yourLog == "" || yourLog != log ) {
			document.getElementById("e_login").style.display = "inline";
			
			if(yourPass != pass || yourPass == "") {
				document.getElementById("e_pas").style.display = "inline";
				
			}				
			else {
				document.getElementById("e_pas").style.display = "none";
				checkpassword = true;
			}									 									
		}
		else {
			document.getElementById("e_login").style.display = "none";
			checkpassword = true;
		}

		if(checkpassword) {	
			document.getElementById("form_enter").submit();
		}	

		else {
			alert("Вы не сможете войти! А-ха-ха-ха! (Злостный смех)");
			return false;
			
		}	
		
}
	