let nav = 0;
let clicked = null;
let events = localStorage.getItem('events') ? JSON.parse(localStorage.getItem('events')) : [];

//---------- Modal
const newEvent = document.getElementById('newEventModal');
const deleteEventModal = document.getElementById('deleteEventModal');
const backDrop = document.getElementById('modalBackDrop');
const eventTitleInput = document.getElementById('eventTitleInput');
const eventStartTimeInput = document.getElementById('eventStartTimeInput');
const eventEndTimeInput = document.getElementById('eventEndTimeInput');

//---------- Calendar
const calendar = document.getElementById('calendar');
const weekdays = ['domingo', 'segunda-feira', 'terça-feira', 'quarta-feira', 'quinta-feira', 'sexta-feira', 'sábado'];

//---------- Functions
function openModal(date){
  clicked = date;
  const eventDay = events.find((event) => event.date === clicked);

  if (eventDay){
    document.getElementById('eventText').innerText = `${eventDay.title}\nInício: ${eventDay.startTime}\nFim: ${eventDay.endTime}`;
    deleteEventModal.style.display = 'block';
  } else {
    newEvent.style.display = 'block';
    eventTitleInput.value = '';
    eventStartTimeInput.value = '';
    eventEndTimeInput.value = '';
  }

  backDrop.style.display = 'block';
}

function load(){
  const date = new Date();

  // Mudar mês
  if(nav !== 0){
    date.setMonth(new Date().getMonth() + nav);
  }
  
  const day = date.getDate();
  const month = date.getMonth();
  const year = date.getFullYear();
  
  const daysMonth = new Date(year, month + 1, 0).getDate();
  const firstDayMonth = new Date(year, month, 1);
  
  const dateString = firstDayMonth.toLocaleDateString('pt-br', {
    weekday: 'long',
    year: 'numeric',
    month: 'numeric',
    day: 'numeric',
  });

  const paddinDays = weekdays.indexOf(dateString.split(', ')[0]);

  // Mostrar mês e ano
  document.getElementById('monthDisplay').innerText = `${date.toLocaleDateString('pt-br', { month: 'long' })}, ${year}`;
  
  calendar.innerHTML = '';

  // Criar divs dos dias
  for (let i = 1; i <= paddinDays + daysMonth; i++) {
    const dayS = document.createElement('div');
    dayS.classList.add('day');

    const dayString = `${month + 1}/${i - paddinDays}/${year}`;

    if (i > paddinDays) {
      dayS.innerText = i - paddinDays;

      const eventDay = events.find(event => event.date === dayString);

      if (i - paddinDays === day && nav === 0) {
        dayS.id = 'currentDay';
      }

      if(eventDay){
        const eventDiv = document.createElement('div');
        eventDiv.classList.add('event');
        eventDiv.innerText = `${eventDay.title} (${eventDay.startTime} - ${eventDay.endTime})`;
        dayS.appendChild(eventDiv);
      }

      dayS.addEventListener('click', () => openModal(dayString));
    } else {
      dayS.classList.add('padding');
    }

    calendar.appendChild(dayS);
  }
}

function closeModal(){
  eventTitleInput.classList.remove('error');
  newEvent.style.display = 'none';
  backDrop.style.display = 'none';
  deleteEventModal.style.display = 'none';

  eventTitleInput.value = '';
  eventStartTimeInput.value = '';
  eventEndTimeInput.value = '';
  clicked = null;
  load();
}

function saveEvent(){
  const startTime = eventStartTimeInput.value;
  const endTime = eventEndTimeInput.value;

  if(eventTitleInput.value && startTime && endTime){
    eventTitleInput.classList.remove('error');

    const existingEvent = events.find(event => event.date === clicked && (event.startTime === startTime && event.endTime === endTime));

    if (existingEvent) {
      alert('Horario indisponivel.');
      return;
    }
    //info da nova task
    events.push({
      date: clicked,
      title: eventTitleInput.value,
      startTime: startTime,
      endTime: endTime
    });

    localStorage.setItem('events', JSON.stringify(events));

    // lerta de sucesso
    alert('Evento criado com sucesso!');

    closeModal();
  } else {
    eventTitleInput.classList.add('error');
    alert('Por favor, preencha todos os campos.');
  }
}

function deleteEvent(){
  events = events.filter(event => !(event.date === clicked && event.startTime === eventStartTimeInput.value && event.endTime === eventEndTimeInput.value));
  localStorage.setItem('events', JSON.stringify(events));

  //alerta de exclusão
  alert('Evento excluído com sucesso!');

  closeModal();
}

// Botões
function buttons(){
  document.getElementById('backButton').addEventListener('click', () => {
    nav--;
    load();
  });

  document.getElementById('nextButton').addEventListener('click', () => {
    nav++;
    load();
  });

  document.getElementById('saveButton').addEventListener('click', () => saveEvent());
  document.getElementById('cancelButton').addEventListener('click', () => closeModal());
  document.getElementById('deleteButton').addEventListener('click', () => deleteEvent());
  document.getElementById('closeButton').addEventListener('click', () => closeModal());
}

buttons();
load();
