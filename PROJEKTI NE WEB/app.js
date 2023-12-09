const arrows = document.querySelectorAll(".arrow");
const movieLists = document.querySelectorAll(".movie-list");

// Merr Modalin ne DOM
var signupModal = document.getElementById('signupModal');
var loginModal = document.getElementById('loginModal');

// Merr butonin i cili duhet me hap modalin
var btn = document.querySelector('.btn');

// Merr span (X) qe mbyll modalin
var span = document.getElementsByClassName('close')[0];

document.getElementById('signupForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
  
    // Perform regex validation for email and password
    const emailRegex = /^\S+@\S+\.\S+$/;
    const passwordRegex = /.{8,}/;
  
    if (!emailRegex.test(email)) {
      alert('Please enter a valid email address');
      return;
    }
  
    if (!passwordRegex.test(password)) {
      alert('Password must be at least 8 characters');
      return;
    }
  
    if (password !== confirmPassword) {
      alert('Passwords do not match');
      return;
    }
  
    // Save the user in a local variable
    const user = {
      email: email,
      password: password
    };

    localStorage.setItem('user', JSON.stringify(user));
  
    alert('User signed up successfully!');
    modal.style.display = 'none';
    document.getElementById('email').value = "";
    document.getElementById('password').value = "";
    document.getElementById('confirmPassword').value = "";
});

arrows.forEach((arrow, i) => {
  const itemNumber = movieLists[i].querySelectorAll("img").length;
  let clickCounter = 0;
  arrow.addEventListener("click", () => {
    const ratio = Math.floor(window.innerWidth / 270);
    clickCounter++;
    if (itemNumber - (4 + clickCounter) + (4 - ratio) >= 0) {
      movieLists[i].style.transform = `translateX(${
        movieLists[i].computedStyleMap().get("transform")[0].x.value - 300
      }px)`;
    } else {
      movieLists[i].style.transform = "translateX(0)";
      clickCounter = 0;
    }
  });

  console.log(Math.floor(window.innerWidth / 270));
});


document.getElementById('signupForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
  
    // Perform regex validation for email and password
    const emailRegex = /^\S+@\S+\.\S+$/;
    const passwordRegex = /.{8,}/;
  
    if (!emailRegex.test(email)) {
      alert('Please enter a valid email address');
      return;
    }
  
    if (!passwordRegex.test(password)) {
      alert('Password must be at least 8 characters');
      return;
    }
  
    if (password !== confirmPassword) {
      alert('Passwords do not match');
      return;
    }
  
    // Save the user in a local variable
    const user = {
      email: email,
      password: password
    };
  
    // You can store the user in app state or local storage for later use
    // Example: localStorage.setItem('user', JSON.stringify(user));
  
    alert('User signed up successfully!');
    document.querySelector('.btn').textContent = 'Log In';
  });

// Open modal with login form when "Log In" button is clicked
document.querySelector('.btn').addEventListener('click', function() {
    loginModal.style.display = 'block'; // Open the modal
    document.getElementById('email').value = ""; // Clear the email input
    document.getElementById('password').value = ""; // Clear the password input
    document.getElementById('confirmPassword').value = ""; // Clear the confirm password input
});

document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    // Retrieve user data from local storage
    const storedUser = JSON.parse(localStorage.getItem('user'));

    if (storedUser && storedUser.email === email && storedUser.password === password) {
        // Show profile avatar
        document.querySelector('.profile-picture').style.display = 'block';
        // Hide the "Log In" button
        document.querySelector('.btn').style.display = 'none';
        alert('Logged in successfully!');
    } else {
        alert('Invalid email or password');
    }
});

//TOGGLE

const ball = document.querySelector(".toggle-ball");
const items = document.querySelectorAll(
  ".container,.movie-list-title,.navbar-container,.sidebar,.left-menu-icon,.toggle"
);

ball.addEventListener("click", () => {
  items.forEach((item) => {
    item.classList.toggle("active");
  });
  ball.classList.toggle("active");
});

// Kur useri te klikon butonin, te hapet modali
btn.onclick = function() {
    if(btn.textContent === "Sign Up"){
        signupModal.style.display = 'block';
        loginModal.style.display = 'none';
    } else {
        loginModal.style.display = 'block';
        signupModal.style.display = 'none';
    }
}

// Kur user klikon X
span.onclick = function() {

    signupModal.style.display = 'none';
    loginModal.style.display = 'none';

}

// Kur user klikon kudo jashte modalit, ai duhet te mbyllet
window.onclick = function(event) {
    if (event.target == modal) {
        signupModal.style.display = 'none';
        loginModal.style.display = 'none';
    }
}