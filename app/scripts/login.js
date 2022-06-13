const loginForm = document.getElementById("loginForm"),
	username = document.getElementById("username"),
	password = document.getElementById("password");
loginForm.addEventListener("submit", access);
function access(e) {
	e.preventDefault();
	const formData = new FormData($("#loginForm")[0]);
	$.ajax({
		url: "app/ajax/user.php?req=login",
		method: "POST",
		data: formData,
		contentType: false,
		processData: false,
		dataType: "JSON",
		success: (data) => {
			if (data === null) {
				Swal.fire({
					icon: "error",
					title: "Los datos no coinciden con nuestros registros",
					showConfirmButton: false,
					timer: 1500,
				});
				password.val = "";
			} else {
				location.href = "Administrador.php";
			}
		},
		error: (err) => {
			console.log(err.responseText);
		},
	});
}