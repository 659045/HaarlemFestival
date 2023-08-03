function generateDancePage() {
  wrapper = document.getElementById('content-wrapper');
  wrapper.classList.add('flex', 'justify-center', 'w-[100%]', 'flex-col');

  generateArtistSection();
  generatePlanningSection();
  generateLocationSection();
}

//generate the artist section of the page

function generateArtistSection() {
  container = document.getElementById('content-wrapper');
  sectionTitleContainer = document.createElement('div');
  sectionTitleContainer.classList.add('flex', 'justify-center', 'mt-[100px]');
  sectionTitle = document.createElement('h1');
  sectionTitle.classList.add('text-[64px]', 'text-[#F7F7FB]', "font-['Lato']");
  sectionTitle.innerHTML = 'The Artists';

  artistGrid = document.createElement('div');
  artistGrid.classList.add('grid', 'grid-cols-3', 'grid-rows-2');

  generateArtists(artistGrid);

  sectionTitleContainer.appendChild(sectionTitle);

  container.appendChild(sectionTitleContainer);
  container.appendChild(artistGrid);
}

//generate the artist cards
function generateArtist(artist, mt, artistGrid) {
  artistContainer = document.createElement('div');
  artistContainer.classList.add(
    'flex',
    'flex-col',
    'justify-center',
    'items-center',
    'mt-[' + mt + 'px]'
  );

  image = new Image();
  image.src = artist.imagePath;
  image.classList.add('w-[300px]');

  artistName = document.createElement('h2');
  artistName.classList.add(
    'text-[24px]',
    'text-[#F7F7FB]',
    "font-['Lato']",
    'font-bold',
    'mb-[20px]'
  );
  artistName.innerHTML = artist.name;

  link = document.createElement('a');
  link.href = '/dance/detailPage?id=' + artist.id;

  link.appendChild(image);

  artistContainer.appendChild(artistName);
  artistContainer.appendChild(link);
  artistGrid.appendChild(artistContainer);
}

//get the data from the api and generate the artist cards
async function generateArtists(artistGrid) {
  artists = await getDataFromArtistAPI();

  for (let i = 1; i <= artists.length; i++) {
    if (i <= artists.length / 2) {
      margin = i * 100;
    } else {
      margin = i * 100 - (artists.length / 2) * 120;
    }
    generateArtist(artists[i - 1], margin, artistGrid);
  }
}

//get the data from the api
async function getDataFromArtistAPI() {
  const response = await fetch('http://localhost/api/artists');
  return await response.json();
}

//generate the planning section of the page
function generatePlanningSection() {
  planning = document.createElement('div');
  container.appendChild(planning);
  sectionTitleContainer = document.createElement('div');
  sectionTitleContainer.classList.add('flex', 'justify-center', 'mt-[100px]');
  sectionTitle = document.createElement('h1');
  sectionTitle.classList.add('text-[64px]', 'text-[#F7F7FB]', "font-['Lato']");
  sectionTitle.innerHTML = 'The Planning';

  container = document.getElementById('content-wrapper');

  planningGrid = document.createElement('div');
  planningGrid.classList.add(
    'flex',
    'flex-col',
    'mt-[50px]',
    'text-[24px]',
    'text-[#F7F7FB]',
    "font-['Lato']"
  );

  planningGrid.setAttribute('id', 'planningGrid');

  planningParagraph = document.createElement('p');
  planningParagraph.classList.add('text-[#656262]', 'mt-[10px]');
  planningParagraph.innerHTML =
    '* The capacity of the Club sessions is very limited. Availability for All-Access pas holders can not be garanteed due to safety regulations. Tickets available represents total capacity. (90% is sold as single tickets. 10% of total capacity is left for Walk ins/All-Acces passholders.)';

  buttonContainer = document.createElement('div');
  buttonContainer.classList.add('flex', 'justify-center');
  button = document.createElement('button');
  button.classList.add(
    'mt-[100px]',
    'w-[200px]',
    'h-[50px]',
    'text-white',
    'outline',
    'outline-3',
    'white'
  );
  button.innerHTML = 'Buy Tickets';
 button.addEventListener('click', GotoTicket);

  sectionTitleContainer.appendChild(sectionTitle);

  planning.appendChild(sectionTitleContainer);
  planning.appendChild(planningGrid);
  planning.appendChild(planningParagraph);
  planning.appendChild(buttonContainer);

  buttonContainer.appendChild(button);

  container.appendChild(planning);

  generatePlanningItem('Date', 'Location', 'Artist', 'Tickets', 'Price');
  generatePlanningItems();
}

//generate the planning items
function generatePlanningItem(date, location, artist, tickets, price) {
  grid = document.getElementById('planningGrid');

  wrapper = document.createElement('div');
  wrapper.classList.add(
    'grid',
    'grid-cols-5',
    'flex-row',
    'text-center',
    'border',
    'border-[1px]'
  );

  dateSpan = document.createElement('span');
  dateSpan.classList.add('border', 'br-[1px]');
  dateSpan.innerHTML = date;

  locationSpan = document.createElement('span');
  locationSpan.classList.add('border', 'br-[1px]');
  locationSpan.innerHTML = location;

  artistSpan = document.createElement('span');
  artistSpan.classList.add('border', 'br-[1px]');
  artistSpan.innerHTML = artist;

  ticketsSpan = document.createElement('span');
  ticketsSpan.classList.add('border', 'br-[1px]');
  ticketsSpan.innerHTML = tickets;

  priceSpan = document.createElement('span');
  priceSpan.classList.add('border', 'br-[1px]');
  priceSpan.innerHTML = '€' + price;

  wrapper.appendChild(dateSpan);
  wrapper.appendChild(locationSpan);
  wrapper.appendChild(artistSpan);
  wrapper.appendChild(ticketsSpan);
  wrapper.appendChild(priceSpan);

  grid.appendChild(wrapper);
}

//get the data from the api and generate the planning items
async function generatePlanningItems() {
  sessions = await getDataFromSessionAPI();
  artists = await getDataFromArtistAPI();
  locations = await getDataFromLocationAPI();

  const formatter = new Intl.DateTimeFormat('en-US', {
    weekday: 'short',
    month: 'short',
    day: 'numeric',
    hour: 'numeric',
    minute: 'numeric',
  });

  console.log(sessions);
  for (let i = 0; i < sessions.length; i++) {
    const formattedDateTime = formatter.format(new Date(sessions[i].date));
    locationID = sessions[i].venue - 1;
    artistID = sessions[i].artist_id - 1;

      
      console.log(artists[artistID].name);
      generatePlanningItem(
      formattedDateTime,
      locations[locationID].name,
      artists[artistID].name,
      sessions[i].ticketsAmount,
      sessions[i].price
    );
  }
}

//get the data from the api
async function getDataFromSessionAPI() {
  const response = await fetch('http://localhost/api/danceSessions');
  return await response.json();
}

//generate the location section of the page
function generateLocationSection() {
  container = document.getElementById('content-wrapper');
  sectionTitleContainer = document.createElement('div');
  sectionTitleContainer.classList.add(
    'flex',
    'justify-center',
    'mt-[100px]',
    'mb-[50px]'
  );
  sectionTitle = document.createElement('h1');
  sectionTitle.classList.add('text-[64px]', 'text-[#F7F7FB]', "font-['Lato']");
  sectionTitle.innerHTML = 'Locations';

  locationGrid = document.createElement('div');
  locationGrid.classList.add(
    'grid',
    'grid-cols-2',
    'gap-x-[20px]',
    'gap-y-[20px]'
  );

  generateLocations(locationGrid);

  sectionTitleContainer.appendChild(sectionTitle);

  container.appendChild(sectionTitleContainer);
  container.appendChild(locationGrid);
}

//generate a location
function generateLocation(locationGrid, location) {
  locationContainer = document.createElement('div');
  locationContainer.classList.add(
    'grid',
    'grid-cols-2',
    'grid-rows-2',
    'outline',
    'outline-1',
    'outline-white'
  );

  locationName = document.createElement('h2');
  locationName.classList.add(
    'text-[24px]',
    'text-[#F7F7FB]',
    "font-['Lato']",
    'mt-[20px]',
    'ml-[10px]'
  );
  locationName.innerHTML = location.name;

  image = new Image();
  image.src = location.imagePath;
  image.classList.add(
    'grid',
    'justify-self-end',
    'row-span-2',
    'w-[253px]',
    'h-[161px]'
  );

  locationAddress = document.createElement('h2');
  locationAddress.classList.add(
    'text-[20px]',
    'text-[#F7F7FB]',
    "font-['Lato']",
    'ml-[10px]'
  );
  locationAddress.innerHTML = location.address;

  locationContainer.appendChild(locationName);
  locationContainer.appendChild(image);
  locationContainer.appendChild(locationAddress);

  locationGrid.appendChild(locationContainer);
}

//get the data from the api and generate the locations
async function generateLocations(locationGrid) {
  locations = await getDataFromLocationAPI();

  for (let i = 0; i < locations.length; i++) {
    generateLocation(locationGrid, locations[i]);
  }
}

//get the data from the api
async function getDataFromLocationAPI() {
  const response = await fetch('http://localhost/api/danceLocations');
  return await response.json();
}

generateDancePage();




function GotoTicket() {
  location.href = "/danceTicket";
}