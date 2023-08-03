function loadYummieData(type) {
  yummiePane = document.getElementById('yummiePane');
  yummiePane.classList.remove('hidden');

  userPane = document.getElementById('UserPane');
  edmPane = document.getElementById('edmPane');
  if (!userPane.classList.contains('hidden')) {
    userPane.classList.add('hidden');
  }
  if (!edmPane.classList.contains('hidden')) {
    edmPane.classList.add('hidden');
  }

  switch (type) {
    case 'restaurants':
      loadRestaurants();
      break;
    case 'restaurantSessions':
      loadRestaurantSessions();
      break;
    case 'reservations':
      loadReservations();
    default:
      break;
  }
}

function loadRestaurants() {
  restaurantPane = document.getElementById('restaurantSubPane');
  restaurantPane.classList.remove('hidden');

  sessionsPane = document.getElementById('restaurantSessionSubPane');
  if (!sessionsPane.classList.contains('hidden')) {
    sessionsPane.classList.add('hidden');
  }

  objects = getData('/restaurants');
  createRestaurantList(objects);
}

function createRestaurantList(objects) {
  parentElement = document.getElementById('contentRestaurantWrapper');
  title = document.getElementById('YummieTitle');
  title.innerHTML = 'Restaurants';
  parentElement.innerHTML = '';

  objects.then((objects) => {
    for (let i = 0; i < objects.length; i++) {
      createRestaurantContainer(
        parentElement,
        objects[i].id,
        objects[i].name,
        objects[i].category,
        objects[i].star,
        objects[i].michelinStar,
        objects[i].description,
        objects[i].address,
        objects[i].phone_number
      );
    }
  });
}

function createRestaurantContainer(
  element,
  id,
  name,
  category,
  star,
  michelinStar,
  description,
  address,
  phoneNumber
) {
  container = document.createElement('span');
  container.classList.add(
    'bg-white',
    'p-2',
    'rounded-md',
    'grid',
    'lg:grid-cols-6',
    'lg:grid-rows-3',
    'md:grid-cols-1',
    'text-left',
    'relative',
    'gap-4',
    'text-center'
  );

  idSpan = document.createElement('span');
  idSpan.innerHTML = id;
  idSpan.classList.add('h-full', 'items-center', 'justify-center', 'flex');
  idSpan.setAttribute('id', 'rIdSpan' + id);

  nameSpan = document.createElement('span');
  nameSpan.innerHTML = name;
  nameSpan.classList.add('h-full', 'items-center', 'justify-center', 'flex');
  nameSpan.setAttribute('id', 'rNameSpan' + id);

  categorySpan = document.createElement('span');
  categorySpan.innerHTML = category;
  categorySpan.classList.add(
    'h-full',
    'items-center',
    'justify-center',
    'flex'
  );
  categorySpan.setAttribute('id', 'rCategorySpan' + id);

  starSpan = document.createElement('span');
  starSpan.innerHTML = star;
  starSpan.classList.add('h-full', 'items-center', 'justify-center', 'flex');
  starSpan.setAttribute('id', 'rStarSpan' + id);

  michelinStarSpan = document.createElement('span');
  michelinStarSpan.innerHTML = michelinStar;
  michelinStarSpan.classList.add(
    'h-full',
    'items-center',
    'justify-center',
    'flex'
  );
  michelinStarSpan.setAttribute('id', 'rMichelinStarSpan' + id);

  descriptionSpan = document.createElement('textarea');
  descriptionSpan.innerHTML = description;
  descriptionSpan.classList.add(
    'h-full',
    'items-center',
    'justify-center',
    'flex',
    'col-span-5'
  );
  descriptionSpan.setAttribute('id', 'rDescriptionSpan' + id);
  descriptionSpan.setAttribute('disabled', 'true');

  addressSpan = document.createElement('span');
  addressSpan.innerHTML = address;
  addressSpan.classList.add('h-full', 'items-center', 'justify-center', 'flex');
  addressSpan.setAttribute('id', 'rAddressSpan' + id);

  phoneNumberSpan = document.createElement('span');
  phoneNumberSpan.innerHTML = phoneNumber;
  phoneNumberSpan.classList.add(
    'h-full',
    'items-center',
    'justify-center',
    'flex'
  );
  phoneNumberSpan.setAttribute('id', 'rPhoneNumberSpan' + id);

  buttonRemove = document.createElement('button');
  buttonRemove.innerHTML = 'REMOVE';
  buttonRemove.classList.add(
    'm-2',
    'py-2',
    'px-4',
    'rounded-md',
    'text-[#F7F7FB]',
    'bg-red-500',
    'w-fit',
    'h-fit',
    'h-[50px]'
  );
  buttonRemove.addEventListener('click', () => {
    removeRestaurant(id);
  });

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
    'justify-center',
    'h-[50px]'
  );

  buttonEdit.setAttribute('id', 'restaurantB' + id);
  buttonEdit.addEventListener('click', () => {
    rDescriptionSpan = document.getElementById('rDescriptionSpan' + id);
    rDescriptionSpan.removeAttribute('disabled');
    editRestaurant(id);
  });

  container.appendChild(idSpan);
  container.appendChild(nameSpan);
  container.appendChild(categorySpan);
  container.appendChild(starSpan);
  container.appendChild(michelinStarSpan);
  container.appendChild(addressSpan);
  container.appendChild(phoneNumberSpan);
  container.appendChild(descriptionSpan);
  container.appendChild(buttonRemove);
  container.appendChild(buttonEdit);
  element.appendChild(container);
}

function editRestaurant(id) {
  rNameSpan = document.getElementById('rNameSpan' + id);
  rCategorySpan = document.getElementById('rCategorySpan' + id);
  rStarSpan = document.getElementById('rStarSpan' + id);
  rMichelinStarSpan = document.getElementById('rMichelinStarSpan' + id);
  rDescriptionSpan = document.getElementById('rDescriptionSpan' + id);
  rAddressSpan = document.getElementById('rAddressSpan' + id);
  rPhonenumberSpan = document.getElementById('rPhoneNumberSpan' + id);

  b = document.getElementById('restaurantB' + id);

  if (b.innerHTML == 'EDIT') {
    setEditableType(rNameSpan);
    setEditableType(rCategorySpan);
    setEditableType(rStarSpan);
    setEditableType(rMichelinStarSpan);
    setEditableType(rDescriptionSpan);
    setEditableType(rAddressSpan);
    setEditableType(rPhonenumberSpan);
    b.innerHTML = 'Save';
    b.classList.add('bg-green-400', 'text-[#121212]');
    return;
  }
  b.innerHTML = 'EDIT';
  b.classList.remove('bg-green-400', 'text-[#121212]');
  setEditableType(rNameSpan);
  setEditableType(rCategorySpan);
  setEditableType(rStarSpan);
  setEditableType(rMichelinStarSpan);
  setEditableType(rDescriptionSpan);
  setEditableType(rAddressSpan);
  setEditableType(rPhonenumberSpan);

  const data = new FormData();
  data.append('post_type', 'edit');
  data.append('id', id);
  data.append('restaurant_name', rNameSpan.innerHTML);
  data.append('restaurant_category', rCategorySpan.innerHTML);
  data.append('restaurant_star', rStarSpan.innerHTML);
  data.append(
    'restaurant_michelinStar',
    rMichelinStarSpan.innerHTML == 'true' ? '1' : '0'
  );
  data.append('restaurant_description', rDescriptionSpan.value);
  data.append('restaurant_address', rAddressSpan.innerHTML);
  data.append('restaurant_phoneNumber', rPhonenumberSpan.innerHTML);

  console.log(data);

  postForm('http://localhost/api/restaurants', data).then(
    delay(1000).then(() => loadRestaurants())
  );
}

function removeRestaurant(id) {
  data = {
    post_type: 'delete',
    id: id,
  };

  if (confirm('are you sure you want to delete this restaurant?')) {
    postData('http://localhost/api/restaurants', data);
    delay(1000).then(loadRestaurants());
  }
}

function insertRestaurant() {
  rName = document.getElementById('restaurantName');
  rCategory = document.getElementById('restaurantCategory');
  rStars = document.getElementById('restaurantStar');
  rMichelinStar = document.getElementById('restaurantMichelinStar');
  rDescription = document.getElementById('restaurantDescription');
  rAddress = document.getElementById('restaurantAddress');
  rPhonenumber = document.getElementById('restaurantPhoneNumber');
  picture = document.getElementById('restaurantFile');

  const data = new FormData();
  data.append('post_type', 'insert');
  data.append('restaurant_name', rName.value);
  data.append('restaurant_category', rCategory.value);
  data.append(
    'restaurant_michelinStar',
    rMichelinStar.value == 1 ? true : false
  );
  data.append('restaurant_description', rDescription.value);
  data.append('restaurant_address', rAddress.value);
  data.append('restaurant_phoneNumber', rPhonenumber.value);
  data.append('restaurant_star', rStars.value);

  for (let i = 0; i < picture.files.length; i++) {
    const file = picture.files[i];
    data.append(`picture${i + 1}`, file);
  }

  console.log(data);

  postForm('http://localhost/api/restaurants', data).then(
    delay(1000).then(() => loadRestaurants())
  );
}

async function loadRestaurantSessions() {
  sessionPane = document.getElementById('restaurantSessionSubPane');
  sessionPane.classList.remove('hidden');

  restaurantPane = document.getElementById('restaurantSubPane');
  if (!restaurantPane.classList.contains('hidden')) {
    restaurantPane.classList.add('hidden');
  }

  restaurantSelect = document.getElementById('sessionRestaurant');
  restaurantObjects = await getData('/restaurants');
  restaurantSelect.innerHTML = '';
  for (let i = 0; i < restaurantObjects.length; i++) {
    restaurantSelect.innerHTML +=
      '<option value="' +
      restaurantObjects[i].id +
      '">' +
      restaurantObjects[i].name +
      '</option>';
  }

  objects = await getData('/restaurantSessions');
  createRestaurantSessionList(objects);
}

async function createRestaurantSessionList(objects) {
  parentElement = document.getElementById('contentRestaurantSessionWrapper');
  title = document.getElementById('YummieTitle');
  title.innerHTML = 'Restaurant Session';
  parentElement.innerHTML = '';

  for (let i = 0; i < objects.length; i++) {
    createRestaurantSessionContainer(
      parentElement,
      objects[i].id,
      objects[i].restaurant_id,
      objects[i].adult_Price,
      objects[i].kids_Price,
      objects[i].session_startTime,
      objects[i].session_endTime,
      objects[i].session_date,
      objects[i].seatings
    );
  }
}

async function createRestaurantSessionContainer(
  element,
  id,
  restaurant_id,
  adult_price,
  kids_price,
  start_time,
  end_time,
  date,
  seatings
) {
  container = document.createElement('div');
  container.classList.add(
    'bg-white',
    'p-2',
    'rounded-md',
    'grid',
    'lg:grid-cols-5',
    'lg:grid-rows-2',
    'md:grid-cols-1',
    'text-left',
    'relative',
    'gap-4',
    'text-center'
  );

  restaurantSelect = document.createElement('select');
  restaurantSelect.classList.add('items-center', 'justify-center', 'flex');
  restaurantSelect.setAttribute('id', 'sessionRestaurantSelect' + id);
  restaurantSelect.disabled = true;

  dataV = getData('/restaurants');
  assignOptionsToSelect(restaurantSelect, dataV, restaurant_id);

  adultPriceSpan = document.createElement('span');
  adultPriceSpan.innerHTML = adult_price;
  adultPriceSpan.classList.add(
    'h-full',
    'items-center',
    'justify-center',
    'flex'
  );
  adultPriceSpan.setAttribute('id', 'sessionRestaurantAdultPrice' + id);

  kidsPriceSpan = document.createElement('span');
  kidsPriceSpan.innerHTML = kids_price;
  kidsPriceSpan.classList.add(
    'h-full',
    'items-center',
    'justify-center',
    'flex'
  );
  kidsPriceSpan.setAttribute('id', 'sessionRestaurantKidsPrice' + id);

  startTimeSpan = document.createElement('input');
  startTimeSpan.setAttribute('type', 'time');
  startTimeSpan.setAttribute('id', 'sessionStartTime' + id);
  startTimeSpan.setAttribute('disabled', 'true');
  // startTimeSpan.classList.add('col-span-2');
  startTimeSpan.value = start_time;

  endTimeSpan = document.createElement('input');
  endTimeSpan.setAttribute('type', 'time');
  endTimeSpan.setAttribute('id', 'sessionEndTime' + id);
  endTimeSpan.setAttribute('disabled', 'true');
  // endTimeSpan.classList.add('col-span-2');
  endTimeSpan.value = end_time;

  dateSpan = document.createElement('input');
  dateSpan.setAttribute('type', 'date');
  dateSpan.setAttribute('id', 'sessionDate' + id);
  dateSpan.setAttribute('disabled', 'true');
  // dateSpan.classList.add('col-span-2');
  dateSpan.value = date;

  seatingsSpan = document.createElement('span');
  seatingsSpan.innerHTML = seatings;
  seatingsSpan.classList.add(
    'h-full',
    'items-center',
    'justify-center',
    'flex'
  );
  seatingsSpan.setAttribute('id', 'sessionRestaurantSeatings' + id);

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
    removeRestaurantSession(id);
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

  buttonEdit.setAttribute('id', 'restaurantSessionB' + id);
  buttonEdit.addEventListener('click', () => {
    editRestaurantSession(id);
  });

  container.appendChild(restaurantSelect);
  container.appendChild(adultPriceSpan);
  container.appendChild(kidsPriceSpan);
  container.appendChild(startTimeSpan);
  container.appendChild(endTimeSpan);
  container.appendChild(dateSpan);
  container.appendChild(seatingsSpan);
  container.appendChild(buttonRemove);
  container.appendChild(buttonEdit);

  element.appendChild(container);
}

function insertRestaurantSession() {
  restaurantSelect = document.getElementById('sessionRestaurant');
  adultPrice = document.getElementById('sessionRestaurantAdultPrice');
  kidsPrice = document.getElementById('sessionRestaurantKidsPrice');
  startTime = document.getElementById('sessionRestaurantStartTime');
  endTime = document.getElementById('sessionRestaurantEndTime');
  date = document.getElementById('sessionRestaurantDate');
  seatings = document.getElementById('sessionRestaurantSeatings');

  formattedDate = new Date(date.value).toISOString().split('T')[0];
  const data = {
    post_type: 'insert',
    restaurant_id: parseInt(restaurantSelect.value),
    adult_Price: parseFloat(adultPrice.value),
    kids_Price: parseFloat(kidsPrice.value),
    session_startTime: startTime.value,
    session_endTime: endTime.value,
    session_date: formattedDate,
    seatings: parseInt(seatings.value),
  };

  console.log(data);

  postData('http://localhost/api/restaurantSessions', data).then(
    delay(1000).then(() => loadRestaurantSessions())
  );
}

function editRestaurantSession(id) {
  sRestaurantName = document.getElementById('sessionRestaurantSelect' + id);
  sAdultPrice = document.getElementById('sessionRestaurantAdultPrice' + id);
  sKidsPrice = document.getElementById('sessionRestaurantKidsPrice' + id);
  sStartTime = document.getElementById('sessionStartTime' + id);
  sEndTime = document.getElementById('sessionEndTime' + id);
  sDate = document.getElementById('sessionDate' + id);
  sSeatings = document.getElementById('sessionRestaurantSeatings' + id);
  b = document.getElementById('restaurantSessionB' + id);

  if (b.innerHTML == 'EDIT') {
    setEditableType(sAdultPrice);
    setEditableType(sKidsPrice);
    setEditableType(sRestaurantName);
    setEditableType(sStartTime);
    setEditableType(sEndTime);
    setEditableType(sDate);
    setEditableType(sSeatings);
    b.innerHTML = 'Save';
    b.classList.add('bg-green-400', 'text-[#121212]');
    return;
  }
  b.innerHTML = 'EDIT';
  b.classList.remove('bg-green-400', 'text-[#121212]');
  setEditableType(sAdultPrice);
  setEditableType(sKidsPrice);
  setEditableType(sRestaurantName);
  setEditableType(sStartTime);
  setEditableType(sEndTime);
  setEditableType(sDate);
  setEditableType(sSeatings);

  formattedDate = new Date(sDate.value).toISOString().split('T')[0];
  const data = {
    post_type: 'edit',
    id: id,
    restaurant_id: parseInt(sRestaurantName.value),
    adult_Price: parseFloat(sAdultPrice.innerHTML),
    kids_Price: parseFloat(sKidsPrice.innerHTML),
    session_startTime: sStartTime.value,
    session_endTime: sEndTime.value,
    session_date: formattedDate,
    seatings: parseInt(sSeatings.innerHTML),
  };

  console.log(data);

  postData('http://localhost/api/restaurantSessions', data).then(
    delay(1000).then(() => loadRestaurantSessions())
  );
}

function removeRestaurantSession(id) {
  data = {
    post_type: 'delete',
    id: id,
  };

  if (confirm('are you sure you want to delete this restaurant session?')) {
    postData('http://localhost/api/restaurantSessions', data);
    delay(1000).then(loadRestaurantSessions());
  }
}

async function loadReservations() {
  reservationsPane = document.getElementById('restaurantReservationSubPane');
  reservationsPane.classList.remove('hidden');

  sessionsPane = document.getElementById('restaurantSessionSubPane');
  restaurantPane = document.getElementById('restaurantSubPane');
  if (
    !sessionsPane.classList.contains('hidden') ||
    !restaurantPane.classList.contains('hidden')
  ) {
    sessionsPane.classList.add('hidden');
    restaurantPane.classList.add('hidden');
  }

  objects = await getData('/reservations');
  createRestaurantReservationList(objects);
}

async function createRestaurantReservationList(objects) {
  parentElement = document.getElementById(
    'contentRestaurantReservationWrapper'
  );
  title = document.getElementById('YummieTitle');
  title.innerHTML = 'Restaurant Reservations';
  parentElement.innerHTML = '';

  for (let i = 0; i < objects.length; i++) {
    const session = await getRestaurantSessionById(objects[i].session_id);

    const restaurantName = await getRestaurantNameById(session.restaurant_id);
    createRestaurantReservationContainer(
      parentElement,
      objects[i].uuid,
      objects[i].session_id,
      objects[i].status,
      objects[i].adults,
      objects[i].kids,
      objects[i].comment,
      session,
      restaurantName
    );
  }
}

function createRestaurantReservationContainer(
  element,
  uuid,
  session_id,
  status,
  adults,
  kids,
  comment,
  session,
  restaurantName
) {
  container = document.createElement('div');
  container.classList.add(
    'bg-white',
    'p-2',
    'rounded-md',
    'grid',
    'lg:grid-cols-5',
    'lg:grid-rows-2',
    'md:grid-cols-1',
    'text-left',
    'relative',
    'gap-4',
    'text-center'
  );

  var statusText = status ? 'Active' : 'Deactivated';

  restaurantLabel = document.createElement('label');
  restaurantLabel.classList.add(
    'h-full',
    'items-center',
    'justify-center',
    'flex',
    'text-xl'
  );
  restaurantLabel.innerHTML = 'Restaurant Name';

  sessionDateLabel = document.createElement('label');
  sessionDateLabel.classList.add(
    'h-full',
    'items-center',
    'justify-center',
    'flex',
    'text-xl'
  );
  sessionDateLabel.innerHTML = 'Session Date';

  sessionStartTimeLabel = document.createElement('label');
  sessionStartTimeLabel.classList.add(
    'h-full',
    'items-center',
    'justify-center',
    'flex',
    'text-xl'
  );
  sessionStartTimeLabel.innerHTML = 'Session Start Time';

  sessionEndTimeLabel = document.createElement('label');
  sessionEndTimeLabel.classList.add(
    'h-full',
    'items-center',
    'justify-center',
    'flex',
    'text-xl'
  );
  sessionEndTimeLabel.innerHTML = 'Session End Time';

  statusLabel = document.createElement('label');
  statusLabel.classList.add(
    'h-full',
    'items-center',
    'justify-center',
    'flex',
    'text-xl'
  );
  statusLabel.innerHTML = 'Status';

  adultsLabel = document.createElement('label');
  adultsLabel.classList.add(
    'h-full',
    'items-center',
    'justify-center',
    'flex',
    'text-xl'
  );
  adultsLabel.innerHTML = 'Adults';

  kidsLabel = document.createElement('label');
  kidsLabel.classList.add(
    'h-full',
    'items-center',
    'justify-center',
    'flex',
    'text-xl'
  );
  kidsLabel.innerHTML = 'Kids';

  commentLabel = document.createElement('label');
  commentLabel.classList.add(
    'h-full',
    'items-center',
    'justify-center',
    'flex',
    'col-span-3',
    'text-xl'
  );
  commentLabel.innerHTML = 'Comment';

  restaurantNameSpan = document.createElement('span');
  restaurantNameSpan.classList.add(
    'h-full',
    'items-center',
    'justify-center',
    'flex'
  );
  restaurantNameSpan.innerHTML = restaurantName;
  restaurantNameSpan.setAttribute('id', 'reservationRestaurantName' + uuid);

  sessionDate = document.createElement('span');
  sessionDate.classList.add('h-full', 'items-center', 'justify-center', 'flex');
  sessionDate.innerHTML = session.session_date;
  sessionDate.setAttribute('id', 'reservationSessionDate' + uuid);

  sessionStartTime = document.createElement('span');
  sessionStartTime.classList.add(
    'h-full',
    'items-center',
    'justify-center',
    'flex'
  );
  sessionStartTime.innerHTML = session.session_startTime;
  sessionStartTime.setAttribute('id', 'reservationSessionStartTime' + uuid);

  sessionEndTime = document.createElement('span');
  sessionEndTime.classList.add(
    'h-full',
    'items-center',
    'justify-center',
    'flex'
  );
  sessionEndTime.innerHTML = session.session_endTime;
  sessionEndTime.setAttribute('id', 'reservationSessionEndTime' + uuid);

  statusSpan = document.createElement('span');
  statusSpan.classList.add('h-full', 'items-center', 'justify-center', 'flex');
  statusSpan.innerHTML = statusText;
  statusSpan.setAttribute('id', 'reservationStatus' + uuid);

  adultsSpan = document.createElement('span');
  adultsSpan.classList.add('h-full', 'items-center', 'justify-center', 'flex');
  adultsSpan.innerHTML = adults;
  adultsSpan.setAttribute('id', 'reservationAdults' + uuid);

  kidsSpan = document.createElement('span');
  kidsSpan.classList.add('h-full', 'items-center', 'justify-center', 'flex');
  kidsSpan.innerHTML = kids;
  kidsSpan.setAttribute('id', 'reservationKids' + uuid);

  commentSpan = document.createElement('textarea');
  commentSpan.classList.add(
    'h-full',
    'items-center',
    'justify-center',
    'flex',
    'col-span-3'
  );
  commentSpan.innerHTML = comment;
  commentSpan.disabled = true;
  commentSpan.setAttribute('id', 'reservationComment' + uuid);

  button = document.createElement('button');
  button.innerHTML = status ? 'DEACTIVATE' : 'ACTIVATE';
  if (status) {
    button.classList.add('bg-red-500');
  } else {
    button.classList.add('bg-green-500');
  }
  button.classList.add(
    'm-2',
    'py-2',
    'px-4',
    'rounded-md',
    'text-[#F7F7FB]',
    'w-fit',
    'h-fit',
    'h-[50px]'
  );
  button.addEventListener('click', () => {
    if (status) {
      button.innerHTML = 'ACTIVATE';
      button.classList.remove('active');
      button.classList.remove('bg-red-500');
      button.classList.add('bg-green-500');
      deactivateRestaurantReservation(
        uuid,
        session_id,
        status,
        adults,
        kids,
        comment
      );
    } else {
      button.innerHTML = 'DEACTIVATE';
      button.classList.add('active');
      button.classList.remove('bg-green-500');
      button.classList.add('bg-red-500');
      activateRestaurantReservation(
        uuid,
        session_id,
        status,
        adults,
        kids,
        comment
      );
    }
  });

  container.appendChild(restaurantLabel);
  container.appendChild(sessionDateLabel);
  container.appendChild(sessionStartTimeLabel);
  container.appendChild(sessionEndTimeLabel);
  container.appendChild(statusLabel);
  container.appendChild(restaurantNameSpan);
  container.appendChild(sessionDate);
  container.appendChild(sessionStartTime);
  container.appendChild(sessionEndTime);
  container.appendChild(statusSpan);
  container.appendChild(adultsLabel);
  container.appendChild(kidsLabel);
  container.appendChild(commentLabel);
  container.appendChild(adultsSpan);
  container.appendChild(kidsSpan);
  container.appendChild(commentSpan);
  container.appendChild(button);

  element.appendChild(container);
}

function deactivateRestaurantReservation(
  uuid,
  session_id,
  status,
  adults,
  kids,
  comment
) {
  const data = {
    post_type: 'edit',
    uuid: uuid,
    session_id: session_id,
    status: 0,
    adults: adults,
    kids: kids,
    comment: comment,
  };
  if (confirm('are you sure you want to deactivate this reservation?')) {
    postData('http://localhost/api/reservations', data);
    delay(1000).then(loadReservations());
  }
}

function activateRestaurantReservation(
  uuid,
  session_id,
  status,
  adults,
  kids,
  comment
) {
  const data = {
    post_type: 'edit',
    uuid: uuid,
    session_id: session_id,
    status: 1,
    adults: adults,
    kids: kids,
    comment: comment,
  };

  postData('http://localhost/api/reservations', data);
  delay(1000).then(loadReservations());
}

async function getRestaurantSessionById(id) {
  const restaurantSessions = await getData('/restaurantSessions');
  for (let i = 0; i < restaurantSessions.length; i++) {
    if (restaurantSessions[i].id == id) {
      return restaurantSessions[i];
    }
  }
}

async function getRestaurantNameById(id) {
  restaurants = await getData('/restaurants');
  for (let i = 0; i < restaurants.length; i++) {
    if (restaurants[i].id == id) {
      return restaurants[i].name;
    }
  }
}
