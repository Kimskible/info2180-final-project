var email,passwrd;
window.onload = function(){
	 email = document.getElementById("email");
	 passwrd = document.getElementById("password");
	 var button = document.getElementById("log");
	 button.onclick = handleLogin;
	
	
	
}


function handleLogin(){
	var xhr = new XMLHttpRequest();
	xhr.open('POST', '/login.php', true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhr.onload = function () {
    // do something to response
    console.log(this.responseText);
};
xhr.send('email='+email.value+'&psw='+passwrd.value);
	
	
	
	
	
	
}
        
