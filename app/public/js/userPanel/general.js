function setEditableType(element) {
  if (element.isContentEditable) {
    element.contentEditable = 'false';
    element.classList.remove(
      'outline',
      'outline-2',
      'outline-[#121212]',
      'rounded-md'
    );
  } else {
    element.contentEditable = 'true';
    element.classList.add(
      'outline',
      'outline-2',
      'outline-[#121212]',
      'rounded-md'
    );
  }
}

function delay(time) {
  return new Promise((resolve) => setTimeout(resolve, time));
}

async function postForm(url = '', form) {
  const response = await fetch(url, {
    method: 'POST',
    mode: 'cors',
    cache: 'no-cache',
    credentials: 'same-origin',
    redirect: 'follow',
    referrerPolicy: 'no-referrer',
    body: form,
  });
  console.log(response);
}

async function postData(url = '', data = {}) {
  const response = await fetch(url, {
    method: 'POST',
    mode: 'cors',
    cache: 'no-cache',
    credentials: 'same-origin',
    headers: {
      'Content-Type': 'application/json',
    },
    redirect: 'follow',
    referrerPolicy: 'no-referrer',
    body: JSON.stringify(data),
  });
  console.log(response);
}

async function getData(url = '') {
  const response = await fetch('http://localhost/api' + url);
  return await response.json();
}

function loadCustomPageTabs() {
  getData('/pages').then((objects) => {
    objects.forEach((element) => {
      insertCustomPageTab(element.name, element.title);
    });
  });
}

function insertCustomPageTab(name, title) {
  dropDownMenu = document.getElementById('dropDownPagesOption');
  container = document.createElement('li');

  a = document.createElement('a');
  a.innerHTML = title;
  a.classList.add(
    'block',
    'px-4',
    'py-2',
    'hover:bg-gray-100',
    'dark:hover:bg-gray-600',
    'dark:hover:text-white'
  );
  a.setAttribute('href', 'http://localhost/cms?page=' + name);

  container.appendChild(a);
  dropDownMenu.appendChild(container);
}


loadYummieData('reservations');
loadCustomPageTabs();