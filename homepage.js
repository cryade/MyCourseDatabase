var go_to_login = () => {
	document.getElementById('register_page_div').style.display = "none";
	document.getElementById('login_page_div').style.display = "block";
	document.getElementById('reset_password_page_div').style.display = "none";
}
var go_to_register = () => {
	document.getElementById('register_page_div').style.display = "block";
	document.getElementById('login_page_div').style.display = "none";
	document.getElementById('reset_password_page_div').style.display = "none";
}
var go_to_reset_password = () => {
	document.getElementById('register_page_div').style.display = "none";
	document.getElementById('login_page_div').style.display = "none";
	document.getElementById('reset_password_page_div').style.display = "block";
}