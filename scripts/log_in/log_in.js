import { POST_JSON_request } from "/JavaScript/requests.js";

async function SendLogInForm()
{
  let path = "/POST/user/log_in.php";
  let form = document.forms.login;
  

  let user = {
    login: form.elements.login.value,
    password: form.elements.password.value
  };

  if (user['login'] &&
   user['password'] )
  {
    let response = await POST_JSON_request(path, user);

    if (response.status == true) window.location.href = "http://shilov-shop";
    else alert(response.message);
  }
  else 
  {
    if (user['login'] == false) alert("Введите логин");
    else if (user['password'] == false) alert("Введите пароль");
  }
}

function test()
{
  let button = document.getElementsByName("SendLogInForm")[0];

  button.onclick = SendLogInForm;
}


test();