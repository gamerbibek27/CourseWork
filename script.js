function validateForm() {
	// Get form input values
	const username = document.getElementById("username").value.trim();
	const email = document.getElementById("email").value.trim();
	const password = document.getElementById("password").value;
  
	// Simple validation checks
	if (username === "") {
	  alert("Please enter a username.");
	  return false;
	}
  
	if (email === "") {
	  alert("Please enter an email address.");
	  return false;
	}
  
	// Email format validation using a regular expression
	const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
	if (!emailPattern.test(email)) {
	  alert("Please enter a valid email address.");
	  return false;
	}
  
	if (password === "") {
	  alert("Please enter a password.");
	  return false;
	}
  
	// Additional password validation logic can be added here
  
	// If the form is valid, return true
	return true;
  }
  