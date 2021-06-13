async function test2()
{
  let user = {
    name: 'John',
    surname: 'Smith'
  };

  let response = await fetch("/test/my_script", {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json;charset=utf-8'
    },
    credentials: 'same-origin',
    body: JSON.stringify(user)
  });

  let result = await response.json();
  console.log(result);
}

function test()
{
  let form = document.forms.login;
  console.log(form.elements.login.value);
  alert(form.elements.login.value);
}
