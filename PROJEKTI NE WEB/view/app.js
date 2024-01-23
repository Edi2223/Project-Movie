const arrows = document.querySelectorAll(".arrow");
const movieLists = document.querySelectorAll(".movie-list");
const profileAvatar = document.getElementsByClassName('profile-avatar');


// Merr Modalin ne DOM
var signupModal = document.getElementById('signupModal');
var loginModal = document.getElementById('loginModal');

// Merr butonin i cili duhet me hap modalin
var btn = document.querySelector('.btn');

// Merr span (X) qe mbyll modalin
var spanSignup = document.getElementsByClassName('close')[0];
var spanLogin = document.getElementsByClassName('close')[1];

//  By default User nuk eshte logged in
let loggedIn = false;

localStorage.setItem('isLoggedIn', loggedIn)

document.getElementById('signupForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const email = document.getElementById('signup-email').value;
    const password = document.getElementById('signup-password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
  
    // Krijojme validim me REGEX
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
  
    // Rujm userin e sapo krijuar ne nje variabel
    const user = {
      email: email,
      password: password
    };

    //Rujm variablen e userit ne local storage
    localStorage.setItem('user', JSON.stringify(user));
  
    alert('User Data successfully stored in Local Storage.');
    signupModal.style.display = 'none';
    loginModal.style.display = 'none';
    document.getElementById('signup-email').value = "";
    document.getElementById('signup-password').value = "";
    document.getElementById('confirmPassword').value = "";
    document.querySelector('.btn').textContent = 'Log In';
});


//  Carousel 
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

//   console.log(Math.floor(window.innerWidth / 270));
});

document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const email = document.getElementById('login-email').value;
    const password = document.getElementById('login-password').value;

    // Marrim user data nga localstorage
    const storedUser = JSON.parse(localStorage.getItem('user'));
    // console.log("user",storedUser)

    if (storedUser && storedUser.email === email && storedUser.password === password) {
        
        document.querySelector('.profile-avatar').style.display = 'block';
       
        document.querySelector('.btn').textContent = 'Logout';
        document.getElementById('loginModal').style.display = 'none'
        document.getElementById('profile-text').textContent = storedUser.email;
        alert('Logged in successfully!');
        localStorage.setItem("isLoggedIn", true)
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
    } else if (btn.textContent === "Log In"){
        loginModal.style.display = 'block'; 
        document.getElementById('email').value = "";
        document.getElementById('password').value = "";
        document.getElementById('confirmPassword').value = "";
    } else if (btn.textContent === 'Logout'){
        loggedIn = false;
        document.querySelector('.profile-avatar').style.display = 'none';
        document.getElementById('profile-text').textContent = "Profile";
        localStorage.setItem("isLoggedIn", false)
        btn.textContent = "Log In";
    }
}

// Kur user klikon X
spanSignup.onclick = function() {

    signupModal.style.display = 'none';
    
}

spanLogin.onclick = function() {
    
    loginModal.style.display = 'none';
}
// Kur user klikon kudo jashte modalit, ai duhet te mbyllet
window.onclick = function(event) {
    if (event.target == signupModal) {
        signupModal.style.display = 'none';
    }else if(event.target == loginModal){
        loginModal.style.display = 'none';
    }
}
