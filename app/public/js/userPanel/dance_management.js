function loadEDMData(type) {
  edmPane = document.getElementById('edmPane');
  edmPane.classList.remove('hidden');

  userPane = document.getElementById('UserPane');
  if (!userPane.classList.contains('hidden')) {
    userPane.classList.add('hidden');
  }

  yummiePane = document.getElementById('yummiePane');
  if (!yummiePane.classList.contains('hidden')) {
    yummiePane.classList.add('hidden');
  }

  switch (type) {
    case 'venues':
      loadVenues();
      break;
    case 'artists':
      loadArtists();
      break;
    case 'sessions':
      loadSessions();
    default:
      break;
  }
}

function loadVenues() {
  venuePane = document.getElementById('venueSubPane');
  venuePane.classList.remove('hidden');

  artistPane = document.getElementById('artistSubPane');
  if (!artistPane.classList.contains('hidden')) {
    artistPane.classList.add('hidden');
  }

  sessionPane = document.getElementById('sessionSubPane');
  if (!sessionPane.classList.contains('hidden')) {
    sessionPane.classList.add('hidden');
  }
  objects = getData('/locations');
  createVenueList(objects);
}

function createVenueList(objects) {
  parentElement = document.getElementById('contentVenueWrapper');
  title = document.getElementById('EDMTitle');
  title.innerHTML = 'Venues';
  parentElement.innerHTML = '';

  objects.then((objects) => {
    for (let i = 0; i < objects.length; i++) {
      createVenueContainer(
        parentElement,
        objects[i].id,
        objects[i].name,
        objects[i].address,
        objects[i].capacity
      );
    }
  });
}

function createVenueContainer(element, id, name, address, capacity) {
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
  idSpan.classList.add('h-full', 'items-center', 'justify-center', 'flex');
  idSpan.setAttribute('id', 'vIdSpan' + id);

  //name
  nameSpan = document.createElement('span');
  nameSpan.innerHTML = name;
  nameSpan.classList.add('h-full', 'items-center', 'justify-center', 'flex');
  nameSpan.setAttribute('id', 'vNameSpan' + id);

  //address
  addressSpan = document.createElement('span');
  addressSpan.innerHTML = address;
  addressSpan.classList.add('h-full', 'items-center', 'justify-center', 'flex');
  addressSpan.setAttribute('id', 'vAddressSpan' + id);

  //capacity
  capSpan = document.createElement('span');
  capSpan.innerHTML = capacity;
  capSpan.classList.add('h-full', 'items-center', 'justify-center', 'flex');
  capSpan.setAttribute('id', 'vCapSpan' + id);

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
    removeVenue(id);
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
  buttonEdit.setAttribute('id', 'venueB' + id);
  buttonEdit.addEventListener('click', () => {
    editVenue(id);
  });

  //append
  container.appendChild(idSpan);
  container.appendChild(nameSpan);
  container.appendChild(addressSpan);
  container.appendChild(capSpan);
  container.appendChild(buttonEdit);
  container.appendChild(buttonRemove);

  element.appendChild(container);
}

function editVenue(id) {
  vNameSpan = document.getElementById('vNameSpan' + id);
  vAddressSpan = document.getElementById('vAddressSpan' + id);
  vCapSpan = document.getElementById('vCapSpan' + id);
  b = document.getElementById('venueB' + id);

  if (b.innerHTML == 'EDIT') {
    setEditableType(vNameSpan);
    setEditableType(vAddressSpan);
    setEditableType(vCapSpan);
    b.innerHTML = 'Save';
    b.classList.add('bg-green-400', 'text-[#121212]');
    return;
  }
  b.innerHTML = 'EDIT';
  b.classList.remove('bg-green-400', 'text-[#121212]');
  setEditableType(vNameSpan);
  setEditableType(vAddressSpan);
  setEditableType(vCapSpan);

  //check for NaN
  if (isNaN(vCapSpan.innerHTML)) {
    alert('capacity is not a number');
    return;
  }

  //send form
  let form = new FormData();
  form.append('post_type', 'edit');
  form.append('id', id);
  form.append('venue_name', vNameSpan.innerHTML);
  form.append('venue_address', vAddressSpan.innerHTML);
  form.append('venue_capacity', vCapSpan.innerHTML);

  postForm('http://localhost/api/danceLocations', form).then(
    delay(1000).then(() => loadVenues())
  );
}

function insertVenue() {
  vName = document.getElementById('venueName');
  vAddress = document.getElementById('venueAddress');
  vCap = document.getElementById('venueCap');
  picture = document.getElementById('venueFile');
  data = {
    post_type: 'insert',
    venue_name: vName.innerHTML,
    venue_address: vAddress.value,
    venue_capacity: vCap.value,
    picture: this.file,
  };

  let form = new FormData();
  form.append('post_type', 'insert');
  form.append('venue_name', vName.value);
  form.append('venue_address', vAddress.value);
  form.append('venue_capacity', vCap.value);
  form.append('picture', picture.files[0]);

  postForm('http://localhost/api/danceLocations', form).then(
    delay(1000).then(() => loadVenues())
  );
}

function removeVenue(id) {
  data = {
    post_type: 'delete',
    id: id,
  };

  if (confirm('are you sure you want to delete this venue?')) {
    postData('http://localhost/api/danceLocations', data);
    delay(1000).then(loadVenues());
  }
}

function loadArtists() {
  artistPane = document.getElementById('artistSubPane');
  artistPane.classList.remove('hidden');
  venuePane = document.getElementById('venueSubPane');

  if (!venuePane.classList.contains('hidden')) {
    venuePane.classList.add('hidden');
  }

  sessionPane = document.getElementById('sessionSubPane');
  if (!sessionPane.classList.contains('hidden')) {
    sessionPane.classList.add('hidden');
  }
  objects = getData('/artists');
  createArtistList(objects);
}

function createArtistList(objects) {
  parentElement = document.getElementById('contentArtistWrapper');
  title = document.getElementById('EDMTitle');
  title.innerHTML = 'Artists';
  parentElement.innerHTML = '';

  objects.then((objects) => {
    for (let i = 0; i < objects.length; i++) {
      createArtistContainer(
        parentElement,
        objects[i].id,
        objects[i].name,
        objects[i].genre,
        objects[i].description
      );
    }
  });
}

async function createArtistContainer(element, id, name, genres, description) {
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
  idSpan.classList.add('h-full', 'items-center', 'justify-center', 'flex');
  idSpan.setAttribute('id', 'aIdSpan' + id);

  //name
  nameSpan = document.createElement('span');
  nameSpan.innerHTML = name;
  nameSpan.classList.add('h-full', 'items-center', 'justify-center', 'flex');
  nameSpan.setAttribute('id', 'aNameSpan' + id);

  //genres
  genresSpan = document.createElement('span');
  genresSpan.innerHTML = genres;
  genresSpan.classList.add(
    'h-full',
    'items-center',
    'justify-center',
    'flex',
    'col-span-2'
  );
  genresSpan.setAttribute('id', 'aGenresSpan' + id);

  //remove venue
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
    removeArtist(id);
  });

  //edit venue
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
  buttonEdit.setAttribute('id', 'artistButton' + id);
  buttonEdit.addEventListener('click', () => {
    editArtist(id);
  });

  //description

  descriptionS = document.createElement('TEXTAREA');
  descriptionS.innerHTML = description;
  descriptionS.classList.add(
    'h-full',
    'col-span-4',
    'text-ellipsis',
    'items-center',
    'justify-center',
    'flex',
    'text-ellipsis'
  );
  descriptionS.setAttribute('id', 'aDesSpan' + id);
  descriptionS.setAttribute('disabled', 'true');

  //append
  container.appendChild(idSpan);
  container.appendChild(nameSpan);
  container.appendChild(genresSpan);
  container.appendChild(buttonEdit);
  container.appendChild(buttonRemove);
  container.appendChild(descriptionS);

  element.appendChild(container);
}

function insertArtist() {
  aName = document.getElementById('artistName');
  aGenres = document.getElementById('artistGenre');
  aDescription = document.getElementById('artistDescription');
  aSongs = document.getElementById('artistSongs');
  picture = document.getElementById('artistPicture');

  if (aName.value == '' || aGenres.value == '' || aDescription.value == '') {
    alert('not all fields have been filled in');
    return;
  }

  songs = getAllSongsFromList();
  let form = new FormData();
  form.append('post_type', 'insert');
  form.append('artist_name', aName.value);
  form.append('artist_genre', aGenres.value);
  form.append('artist_description', aDescription.value);
  form.append('artist_songs', songs);
  form.append('picture', picture.files[0]);
  console.log(songs);
  postForm('http://localhost/api/artists', form);
  delay(1000).then(loadArtists());
}

function getAllSongsFromList() {
  let list = document.getElementById('songList').children;
  let songs = '';
  for (let i = 0; i < list.length; i++) {
    songs += list[i].innerText + ':';
  }
  return songs;
}

function updateSongList() {
  song = document.getElementById('songInput');
  if (song.value == '') {
    return;
  }
  list = document.getElementById('songList');

  if (list.children.length >= 3) {
    alert('cant have more than 3 songs');
    return;
  }
  songWrapper = document.createElement('span');
  songText = document.createElement('span');
  songText.innerHTML = song.value;
  songWrapper.appendChild(songText);
  list.appendChild(songWrapper);
}
document.getElementById('addSongToList').onclick = updateSongList;

function editArtist(id) {
  aNameSpan = document.getElementById('aNameSpan' + id);
  aGenresSpan = document.getElementById('aGenresSpan' + id);
  aDescription = document.getElementById('aDesSpan' + id);
  b = document.getElementById('artistButton' + id);

  if (b.innerHTML == 'EDIT') {
    setEditableType(aNameSpan);
    setEditableType(aGenresSpan);
    aDescription.removeAttribute('disabled');
    b.innerHTML = 'Save';
    b.classList.add('bg-green-400', 'text-[#121212]');
    return;
  }
  b.innerHTML = 'EDIT';
  b.classList.remove('bg-green-400', 'text-[#121212]');
  setEditableType(aNameSpan);
  setEditableType(aGenresSpan);
  aDescription.setAttribute('disabled', 'true');

  let form = new FormData();
  form.append('post_type', 'edit');
  form.append('id', id);
  form.append('artist_name', aNameSpan.innerHTML);
  form.append('artist_description', aDescription.value);
  form.append('artist_genre', aGenresSpan.innerHTML);

  console.log(form);
  postForm('http://localhost/api/artists', form).then(
    delay(1000).then(() => loadArtists())
  );
}


async function getData(url = '') {
  const response = await fetch(url);
  return response.json();
}

function removeArtist(id) {
  data = {
    post_type: 'delete',
    id: id,
  };

  if (confirm('are you sure you want to delete this artist?')) {
    postData('http://localhost/api/artists', data);
    delay(1000).then(loadArtists());
  }
}

async function loadSessions() {
  sessionPane = document.getElementById('sessionSubPane');
  sessionPane.classList.remove('hidden');

  artistPane = document.getElementById('artistSubPane');
  if (!artistPane.classList.contains('hidden')) {
    artistPane.classList.add('hidden');
  }

  venuePane = document.getElementById('venueSubPane');
  if (!venuePane.classList.contains('hidden')) {
    venuePane.classList.add('hidden');
  }

  //conf artistselect
  artistSelect = document.getElementById('sessionArtist');
  artistObjects = await getData('/artists');
  artistSelect.innerHTML = '';
  for (let i = 0; i < artistObjects.length; i++) {
    artistSelect.innerHTML +=
      '<option value="' +
      artistObjects[i].id +
      '">' +
      artistObjects[i].name +
      '</option>';
  }
  console.log(artistObjects);

  //conf venueSelect
  venueSelect = document.getElementById('sessionVenue');
  venueSelect.innerHTML = '';
  venueObjects = await getData('/danceLocations');
  for (let i = 0; i < venueObjects.length; i++) {
    venueSelect.innerHTML +=
      '<option value="' +
      venueObjects[i].id +
      '">' +
      venueObjects[i].name +
      '</option>';
  }

  sessionObjects = await getData('/danceSessions');
  createSessionList(sessionObjects);
}

async function createSessionContainer(
  parentElement,
  id,
  venue,
  artist_id,
  date,
  session_type,
  duration,
  ticketsAmount,
  price
) {
  wrapper = document.createElement('div');
  wrapper.classList.add(
    'bg-white',
    'p-2',
    'rounded-md',
    'grid',
    'lg:grid-cols-8',
    'md:grid-cols-1',
    'text-left',
    'relative',
    'gap-4',
    'text-center'
  );

  dateSpan = document.createElement('input');
  dateSpan.setAttribute('type', 'datetime-local');
  dateSpan.setAttribute('id', 'sessionDate' + id);
  dateSpan.setAttribute('disabled', 'true');
  dateSpan.classList.add('col-span-2');
  dateSpan.value = date;

  //role dropdown
  venueSelect = document.createElement('select');
  venueSelect.classList.add('items-center', 'justify-center', 'flex');
  venueSelect.setAttribute('id', 'sessionVenueSelect' + id);
  venueSelect.disabled = true;

  dataV = getData('/danceLocations');
  assignOptionsToSelect(venueSelect, dataV, venue);

  artistSelect = document.createElement('select');
  artistSelect.classList.add('items-center', 'justify-center', 'flex');
  artistSelect.value = artist_id;
  artistSelect.setAttribute('id', 'sessionArtistSelect' + id);
  artistSelect.disabled = true;
  dataV = getData('/artists');
  assignOptionsToSelect(artistSelect, dataV, artist_id);

  sessionSpan = document.createElement('span');
  sessionSpan.classList.add('h-full', 'items-center', 'justify-center', 'flex');
  sessionSpan.setAttribute('id', 'sessionType' + id);
  sessionSpan.innerHTML = session_type;

  durationSpan = document.createElement('span');
  durationSpan.classList.add(
    'h-full',
    'items-center',
    'justify-center',
    'flex'
  );
  durationSpan.innerHTML = duration;
  durationSpan.setAttribute('id', 'sessionDuration' + id);
  ticketAmountSpan = document.createElement('span');
  ticketAmountSpan.classList.add(
    'h-full',
    'items-center',
    'justify-center',
    'flex'
  );
  ticketAmountSpan.innerHTML = ticketsAmount;
  ticketAmountSpan.setAttribute('id', 'sessionTicketA' + id);
  priceSpan = document.createElement('span');
  priceSpan.classList.add('h-full', 'items-center', 'justify-center', 'flex');
  priceSpan.innerHTML = price;
  priceSpan.setAttribute('id', 'sessionPrice' + id);

  //remove session
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
    removeSession(id);
  });

  //edit session
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
  buttonEdit.setAttribute('id', 'sessionButton' + id);
  buttonEdit.addEventListener('click', () => {
    editSession(id);
  });

  wrapper.appendChild(dateSpan);
  wrapper.appendChild(venueSelect);
  wrapper.appendChild(artistSelect);

  wrapper.appendChild(sessionSpan);
  wrapper.appendChild(durationSpan);
  wrapper.appendChild(ticketAmountSpan);
  wrapper.appendChild(priceSpan);
  wrapper.appendChild(buttonEdit);
  wrapper.appendChild(buttonRemove);

  parentElement.appendChild(wrapper);
}

async function createSessionList(objects) {
  parentElement = document.getElementById('contentSessionWrapper');
  title = document.getElementById('EDMTitle');
  title.innerHTML = 'Session';
  parentElement.innerHTML = '';

  for (let i = 0; i < objects.length; i++) {
    //list
    createSessionContainer(
      parentElement,
      objects[i].id,
      objects[i].venue,
      objects[i].artist_id,
      objects[i].date,
      objects[i].session,
      objects[i].duration,
      objects[i].ticketsAmount,
      objects[i].price
    );
  }
}

function insertSession() {
  sessionDate = document.getElementById('sessionDate');
  sessionVenue = document.getElementById('sessionVenue');
  sessionArtist = document.getElementById('sessionArtist');
  sessionTickets = document.getElementById('sessionTickets');
  sessionPrice = document.getElementById('sessionPrice');
  sessionType = document.getElementById('sessionType');
  sessionDuration = document.getElementById('sessionDuration');

  if (
    sessionPrice.value == '' ||
    sessionType.value == '' ||
    sessionDuration.value == '' ||
    sessionDate.value == ''
  ) {
    alert('one or multiple fields are empty');
    return;
  }
  date = new Date(sessionDate.value)
    .toISOString()
    .slice(0, 19)
    .replace('T', ' ');
  data = {
    post_type: 'insert',
    session_date: date,
    session_venue_id: parseInt(sessionVenue.value),
    session_artist_id: parseInt(sessionArtist.value),
    session_type: sessionType.value,
    session_ticket_amount: parseInt(sessionTickets.value),
    session_price: parseFloat(sessionPrice.value),
    session_duration: parseInt(sessionDuration.value),
  };

  console.log(data);

  postData('http://localhost/api/danceSessions', data);

  loadSessions();
}

function editSession(id) {
  sDate = document.getElementById('sessionDate' + id);
  sVenue = document.getElementById('sessionVenueSelect' + id);
  sArtist = document.getElementById('sessionArtistSelect' + id);
  sType = document.getElementById('sessionType' + id);
  sDuration = document.getElementById('sessionDuration' + id);
  sTicketA = document.getElementById('sessionTicketA' + id);
  sPrice = document.getElementById('sessionPrice' + id);
  b = document.getElementById('sessionButton' + id);

  if (b.innerHTML == 'EDIT') {
    setEditableType(sType);
    setEditableType(sDuration);
    setEditableType(sTicketA);
    setEditableType(sPrice);
    sVenue.disabled = false;
    sArtist.disabled = false;
    sDate.disabled = false;
    b.innerHTML = 'Save';
    b.classList.add('bg-green-400', 'text-[#121212]');
    return;
  }
  b.innerHTML = 'EDIT';
  b.classList.remove('bg-green-400', 'text-[#121212]');
  setEditableType(sType);
  setEditableType(sDuration);
  setEditableType(sTicketA);
  setEditableType(sPrice);
  sVenue.disabled = true;
  sArtist.disabled = true;
  sDate.disabled = true;

  date = new Date(sDate.value).toISOString().slice(0, 19).replace('T', ' ');

  data = {
    post_type: 'edit',
    id: id,
    session_venue_id: parseInt(sVenue.value),
    session_artist_id: parseInt(sArtist.value),
    session_date: date,
    session_price: parseFloat(sPrice.innerHTML),
    session_duration: parseInt(sDuration.innerHTML),
    session_ticket_amount: parseInt(sTicketA.innerHTML),
    session_type: sType.innerHTML,
  };

  console.log(data);

  postData('http://localhost/api/danceSessions', data);
}
function removeSession(id) {
  data = {
    post_type: 'delete',
    id: id,
  };

  if (confirm('are you sure you want to delete this artist?')) {
    postData('http://localhost/api/danceSessions', data);
    delay(1000).then(loadSessions());
  }
}

async function assignOptionsToSelect(element, data, selected) {
  objects = await data;
  for (let i = 0; i < objects.length; i++) {
    element.innerHTML +=
      '<option value="' + objects[i].id + '">' + objects[i].name + '</option>';
  }
  element.value = selected;
}
