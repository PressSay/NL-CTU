import axios from "axios";
let notification = document.getElementById('notification');


let btnTheme = document.getElementById('themes-btn');

if (btnTheme) {
  btnTheme.addEventListener('click', () => {
    let html = document.querySelector('html');
    let theme = html.getAttribute('data-theme');
    if (theme == 'night') {
      html.setAttribute('data-theme', 'garden');
      localStorage.setItem("nightMode", "false");
    } else {
      html.setAttribute('data-theme', 'night');
      localStorage.setItem("nightMode", "true");
    }
  });
}

if (localStorage.getItem("nightMode") == "true") {
  let html = document.querySelector('html');
  html.setAttribute('data-theme', 'night');
} else {
  let html = document.querySelector('html');
  html.setAttribute('data-theme', 'garden');
}

function renderNotification() {
  let data = getData();
  data.then((response) => {
    let data = response.data;

    let html = "";

    data.forEach(element => {
      console.log(element);
      let userName = element.data.user.name;
      let thread = element.data.thread;
      let titleThread = thread.title;

      html += `<button class="text-xs truncate" style="width: 11rem;" >` + userName + ' comment in ' + titleThread + `</button>`;

    });

    notification.innerHTML = html;
    let i = 0;

    data.forEach(element => {
      let idThread = element.data.thread.id;
      notification.children[i].addEventListener('click', () => {
        readNotification(idThread);
      } , false);
    });
  });

}


function readNotification($threadId) {
  let sendData = {
    threadId: $threadId,
  };
  let urlResponse = axios.post('/api/notifications/read', sendData);
  urlResponse.then((response) => {
    console.log(response.data.url);

    // window.location.href = response.data.url;
  });
}


if (notification) {
  setInterval(() => {

    renderNotification();

  }, 60000);

  renderNotification();
}

async function getData() {
  let response = await axios.get('/api/notifications');
  return response;
}