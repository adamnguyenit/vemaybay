function checkRole()
{
}

function setAccessToken(accessToken)
{
  localStorage.setItem('access-token', accessToken);
}

function getAccessToken()
{
  return localStorage.getItem('access-token');
}
