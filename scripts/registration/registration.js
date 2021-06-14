import { POST_JSON_request } from "/JavaScript/requests.js";

async function SendRegistrationForm()
{
  let path = "POST/user/registration.php";
  let form = document.forms.registration;
  

  let user = {
    login: form.elements.login.value,
    password: form.elements.password.value,
    email: form.elements.email.value
  };

  if (user['login'] &&
   user['password'] && 
   user['email']) 
  {
    let response = await POST_JSON_request(path, user);

    if (response.status == true) window.location.href = "http://shilov-shop";
    else alert(response.message);
  }
  else 
  {
    if (user['login'] == false) alert("Введите логин");
    else if (user['password'] == false) alert("Введите пароль");
    else if (user['email'] == false) alert("Введите почту");
  }

  
}

let button = document.getElementsByName("SendRegistrationForm")[0];

button.onclick = SendRegistrationForm;