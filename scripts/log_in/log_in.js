$.getScript("/JavaScript/requests.js");

async function SendLogInForm()
{
  let form = document.forms.login;
  

  let user = {
    login: form.elements.login.value,
    password: form.elements.password.value
  };

  if (user['login'] &&
   user['password'] )
  {
    let response = await POST_JSON_request("/user/log_in", user);

    if (response.status == true) window.location.href = "http://shilov-shop";
    else alert(response.message);
  }
  else 
  {
    if (user['login'] == false) alert("Введите логин");
    else if (user['password'] == false) alert("Введите пароль");
  }
}

let button = document.getElementsByName("SendLogInForm")[0];

button.onclick = SendLogInForm;