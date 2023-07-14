window.onload = getImage();

async function getImage() {
	console.log("loading new image");
	const response = await fetch("./php/randomImage.php");
	const data = await response.json();

	document.getElementById("displayImage").setAttribute("src", data.photos[0].src.medium);
}

function sendEmail() {
	const email = document.getElementById("email").value;
	const imageUrl = document.getElementById("displayImage").getAttribute("src");
	console.log(email);
	console.log(imageUrl);
	const string = `mailto:${email}?subject=cool image&body=Look at this cool image i found! ${imageUrl}`;
	window.open(string);
}