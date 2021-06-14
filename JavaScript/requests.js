export async function POST_JSON_request(path, data)
{

  let response = await fetch(path, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json;charset=utf-8'
    },
    credentials: 'same-origin',
    body: JSON.stringify(data)
  });

  return await response.json();
}
