const inputSearch = document.getElementById('searchInput');

async function loadUserData() {
  var objects = await getDataFromUserAPI();
  createUserList(objects);
  addUserSearch();
}
// USER FUNCTIONALITY --START

async function loadUserData(type) {
  //show / hide panes
  userPane = document.getElementById('UserPane');
  userPane.classList.remove('hidden');

  yummiePane = document.getElementById('yummiePane');
  if (!yummiePane.classList.contains('hidden')) {
    yummiePane.classList.add('hidden');
  }
  edmPane = document.getElementById('edmPane');
  if (!edmPane.classList.contains('hidden')) {
    edmPane.classList.add('hidden');
  }
  switch (type) {
    case 'customers':
      loadCustomers();
      break;
    case 'employees':
      loadEmployees();
      break;
    case 'admins':
      loadAdmins();
      break;
    default:
      loadAll();
      break;
  }
}

async function loadAll() {
  var objects = await getData('/users');
  createUserList(objects);
  addUserSearch(objects);
}

async function loadCustomers() {
  customers = await getUsersByRole(0);
  createUserList(customers);
  addUserSearch(customers);
}

async function loadTicketManagement() {
  //  tickets = await getDataFromTicketAPI();
  console.log('loading ticket management');
  contentWrapper = document.getElementById('UserPane');
  contentWrapper.innerHTML = '';
  createTicketsForm();
  events = getEvents();
}

async function createTicketList(tickets) {
  parentElement = document.getElementById('contentItemsWrapper');
  parentElement.innerHTML = 'Tickets';
  for (let i = 0; i < tickets.length; i++) {
    createTicketContainer(
      parentElement,
      tickets[i].id,
      tickets[i].status,
      tickets[i].email,
      tickets[i].password
    );
  }
}

async function createTicketDropdown() {
  parentElement = document.getElementById('ticketDropdown');
  parentElement.innerHTML = '';
  events = await getEvents();
  for (let i = 0; i < events.length; i++) {
    parent;
  }
}
async function getEvents() {
  const response = await fetch('http://localhost/api/events2');
  return await response.json();
}

async function createTicketsForm() {
  parentElement = document.getElementById('UserPane');
  console.log('creating form');
  fetch('/js/userPanel/formGenerateTickets.html')
    .then((response) => {
      return response.text();
    })
    .then((html) => {
      parentElement.innerHTML = html;
      console.log(html);
    });
  console.log('fetched log');
}

async function loadEmployees() {
  employees = await getUsersByRole(1);
  createUserList(employees, 'employees');
  addUserSearch(employees);
}

async function loadAdmins() {
  admins = await getUsersByRole(9);
  createUserList(admins, 'admins');
  addUserSearch(admins);
}

async function getUsersByRole(role) {
  let res = await getData('/users');
  let customers = [];
  for (let i = 0; i < res.length; i++) {
    if (role == 'all') {
      customers = res;
      break;
    }

    if (res[i].role == role) {
      customers.push(res[i]);
    }
  }
  return customers;
}

function createUserList(objects, type) {
  if (!document.body.contains(document.getElementById('UserListType'))) {
    UserListType = document.createElement('span');
    UserListType.setAttribute('id', 'UserListType');
    UserListType.classList.add('hidden');
    document.body.appendChild(UserListType);
  }
  UserListType.innerHTML = type;
  parentElement = document.getElementById('contentUsersWrapper');
  parentElement.innerHTML = '';
  for (let i = 0; i < objects.length; i++) {
    createUserContainer(
      parentElement,
      objects[i].id,
      objects[i].username,
      objects[i].email,
      objects[i].role,
      objects[i].registered_at
    );
  }
}

function createUserContainer(element, id, username, email, role, registeredAt) {
  container = document.createElement('span');
  container.classList.add(
    'bg-white',
    'p-2',
    'rounded-md',
    'grid',
    'lg:grid-cols-6',
    'md:grid-cols-1',
    'text-left',
    'relative',
    'gap-4',
    'text-center'
  );
  //id
  idSpan = document.createElement('span');
  idSpan.innerHTML = id;
  idSpan.classList.add(
    'p-2',
    'col-span-1',
    'h-full',
    'items-center',
    'justify-center',
    'flex'
  );

  //username
  unameSpan = document.createElement('span');
  unameSpan.innerHTML = username;
  unameSpan.classList.add(
    'col-span-1',
    'p-2',
    'h-full',
    'items-center',
    'justify-center',
    'flex'
  );
  unameSpan.contentEditable = 'false';
  unameSpan.setAttribute('id', 'uSpan' + id);

  //email
  mailSpan = document.createElement('span');
  mailSpan.innerHTML = email;
  mailSpan.classList.add(
    'p-1',
    'w-fit',
    'h-full',
    'items-center',
    'justify-center',
    'flex'
  );
  mailSpan.contentEditable = 'false';
  mailSpan.setAttribute('id', 'mSpan' + id);

  //role dropdown
  roleSelect = document.createElement('select');
  roleSelect.classList.add('items-center', 'justify-center', 'flex');
  roleSelect.innerHTML =
    '<option value="0">Customer</option><option value="1">Employee</option><option value="9">Admin</option>';
  roleSelect.value = role;
  roleSelect.setAttribute('id', 'rSelect' + id);
  roleSelect.disabled = true;

  //remove user
  buttonRemove = document.createElement('button');
  buttonRemove.innerHTML = 'REMOVE';
  buttonRemove.classList.add(
    'm-2',
    'py-2',
    'px-4',
    'rounded-md',
    'text-[#F7F7FB]',
    'bg-red-500',
    'w-fit'
  );
  buttonRemove.addEventListener('click', () => {
    removeUser(id);
  });

  //edit user
  buttonEdit = document.createElement('button');
  buttonEdit.innerHTML = 'EDIT';
  buttonEdit.classList.add(
    'm-2',
    'py-2',
    'px-8',
    'rounded-md',
    'text-[#F7F7FB]',
    'bg-slate-800',
    'w-fit',
    'float-right',
    'justify-center'
  );
  buttonEdit.setAttribute('id', 'b' + id);
  buttonEdit.addEventListener('click', () => {
    editUser(id);
  });

  buttonWrapper = document.createElement('div');
  buttonWrapper.classList.add(
    'flex',
    'flex-cols',
    'col-start-3',
    'justify-end'
  );
  buttonWrapper.appendChild(buttonEdit);
  buttonWrapper.appendChild(buttonRemove);
  register = document.createElement('span');
  register.innerHTML = 'registration date:' + '\n' + registeredAt;
  register.classList.add('text-left');

  //append
  container.appendChild(idSpan);
  container.appendChild(unameSpan);
  container.appendChild(mailSpan);
  container.appendChild(roleSelect);
  container.appendChild(buttonEdit);
  container.appendChild(buttonRemove);
  container.appendChild(register);

  element.appendChild(container);
}

function editUser(id) {
  uSpan = document.getElementById('uSpan' + id);
  mSpan = document.getElementById('mSpan' + id);
  roleSelect = document.getElementById('rSelect' + id);
  b = document.getElementById('b' + id);

  if (b.innerHTML == 'EDIT') {
    setEditableType(uSpan);
    setEditableType(mSpan);
    roleSelect.disabled = false;
    b.innerHTML = 'Save';
    b.classList.add('bg-green-400', 'text-[#121212]');
    return;
  }
  roleSelect.disabled = true;
  b.innerHTML = 'EDIT';
  b.classList.remove('bg-green-400', 'text-[#121212]');
  setEditableType(uSpan);
  setEditableType(mSpan);

  data = {
    post_type: 'edit',
    id: id,
    username: uSpan.innerHTML,
    email: mSpan.innerHTML,
    role: roleSelect.value,
  };

  postData('http://localhost/api/users', data);

  userListType = document.getElementById('UserListType').innerHTML;
  delay(1000).then(() => loadUserData(userListType));
}

function removeUser(id) {
  data = {
    post_type: 'delete',
    id: id,
  };

  if (confirm('are you sure you want to delete this user?')) {
    postData('http://localhost/api/users', data);
    userListType = document.getElementById('UserListType').innerHTML;
    delay(1000).then(() => loadUserData(userListType));
  }
}



async function addUserSearch(objects) {
  const searchInput = document.getElementById('searchInput');
  searchInput.addEventListener('keyup', (event) => {
    const { value } = event.target;
    searchUsers(value, objects);
  });
}

async function searchUsers(value, objects) {
  var newArr = [];
  for (element of objects) {
    if (
      element.username.includes(value) ||
      element.id.toString().includes(value) ||
      element.email.includes(value)
    )
      newArr.push(element);
  }
  createUserList(newArr);
}

function limit(string = '', limit = 0) {
  return string.substring(0, limit);
}

function addNewUser() {
  uName = document.getElementById('inputUserName');
  uPasswd = document.getElementById('inputUserPassword');
  uEmail = document.getElementById('inputUserMail');
  role = document.getElementById('userRoles').value;

  data = {
    post_type: 'insert',
    username: uName.value,
    email: uEmail.value,
    password: uPasswd.value,
    role: this.role,
  };

  uName.value = '';
  uPasswd.value = '';
  uEmail.value = '';
  console.log(data);

  postData('http://localhost/api/users', data);
  userListType = document.getElementById('UserListType').innerHTML;
  delay(1000).then(() => loadUserData(userListType));
}

async function getCurrentPageUsers() {
  userListType = document.getElementById('UserListType').innerHTML;
  users = [];
  switch (userListType) {
    case 'customers':
      users = getUsersByRole(0);
      break;
    case 'employees':
      users = getUsersByRole(1);
      break;
    case 'admins':
      users = getUsersByRole(9);
      break;
    default:
      users = getUsersByRole('all');
      break;
  }

  return users;
}

function sortByID() {
  users = getCurrentPageUsers()
    .then((users) => {
      users.sort((a, b) => (a.id > b.id ? 1 : -1));
      createUserList(users, document.getElementById('UserListType').innerHTML);
      addUserSearch(users);
    })
    .catch((error) => {
      console.error('Error fetching users:', error);
    });
}

function sortByUsername() {
  users = getCurrentPageUsers()
    .then((users) => {
      users.sort((a, b) =>
        a.username.toLowerCase() > b.username.toLowerCase() ? 1 : -1
      );
      createUserList(users, document.getElementById('UserListType').innerHTML);
      addUserSearch(users);
    })
    .catch((error) => {
      console.error('Error fetching users:', error);
    });
}

function sortByEmail() {
  users = getCurrentPageUsers()
    .then((users) => {
      users.sort((a, b) =>
        a.email.toLowerCase() > b.email.toLowerCase() ? 1 : -1
      );
      createUserList(users, document.getElementById('UserListType').innerHTML);
      addUserSearch(users);
    })
    .catch((error) => {
      console.error('Error fetching users:', error);
    });
}

// USER FUNCTIONALITY --END
