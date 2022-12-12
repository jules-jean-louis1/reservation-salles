const modal = document.getElementById('modal');
const login = document.getElementById('login');
const password = document.getElementById('password');
const password_conf = document.getElementById('password_conf');

modal.addEventListener('submit', e => {
	e.preventDefault();
	
	checkInputs();
});

function checkInputs() {
	// trim to remove the whitespaces
	const loginValue = login.value.trim();
	const passwordValue = password.value.trim();
	const password_confdValue = password_conf.value.trim();
	
	if(loginValue === '') {
		setErrorFor(login, 'Ce Champs vide.');
	} else {
		setSuccessFor(login);
	}
	
	if(passwordValue === '') {
		setErrorFor(password, 'Ce Champs vide.');
	} else {
		setSuccessFor(password);
	}
	
	if(password_confdValue === '') {
		setErrorFor(password_conf, 'Ce Champs vide.');
	} else if(passwordValue !== password_confValue) {
		setErrorFor(password_conf, 'Password non conforme.');
	} else{
		setSuccessFor(password_conf);
	}
}

function setErrorFor(input, message) {
	const formControl = input.parentElement;
	const small = formControl.querySelector('small');
	formControl.className = 'form-control error';
	small.innerText = message;
}

function setSuccessFor(input) {
	const formControl = input.parentElement;
	formControl.className = 'form-control success';
}