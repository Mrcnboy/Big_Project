function sendMail() {
	var params = {
		name: document.getElementById('name').value,
		email: document.getElementById('email').value,
		message: document.getElementById('message').value,
	};

	const serviceId = 'service_eisx93q';
	const templateId = 'template_x71n60l';

	emailjs
		.send(serviceId, templateId, params)
		.then((res) => {
			document.getElementById('name').value = '';
			document.getElementById('email').value = '';
			document.getElementById('message').value = '';
			console.log(res);
			alert('Votre message à été envoyé avec succès');
		})
		.catch((err) => console.log(err));
	console.log(sendMail());
}
