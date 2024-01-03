window.onload = function(){
    let login = document.getElementById('login');
    let signup = document.getElementById('signup');
    let container = document.getElementById('form-container');
  

    login.onclick = function(){
        login.classList.add('selectedForm');
        signup.classList.remove('selectedForm');
        container.classList.add('loginForm');
        container.classList.remove('signupForm');
    }
    signup.onclick = () => {
        signup.classList.add('selectedForm');
        login.classList.remove('selectedForm');
        container.classList.add('signupForm');
        container.classList.remove('loginForm'); 
    }
}