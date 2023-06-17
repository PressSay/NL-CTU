import { textarea } from './post.js';
import './uploadImage.js';

let prefix = document.getElementById('prefix');
let title = document.getElementById('title');
let follow = document.getElementById("follow");
let email = document.getElementById("receive");
let post = document.getElementById('thread-sent');
let update = document.getElementById('thread-update');

let url = window.location.href;
let categoryId;
let threadId;

let btnCloseAlert = document.getElementById('close-alert');
if (btnCloseAlert) {
  btnCloseAlert.onclick = () => {
    btnCloseAlert.parentElement.parentElement.classList.add('hidden');
    btnCloseAlert.parentElement.parentElement.classList.remove('alert-success');
    btnCloseAlert.parentElement.parentElement.classList.remove('alert-error');
  }
}
let iconAlert = document.getElementById('icon-alert');
let messageAlert = document.getElementById('message-alert');

url = url.split('/');
categoryId = url[4].split('-')[1];
threadId = url[url.length - 1].split('-')[1];


if (post)
  post.onclick = send;
else if (update)
  update.onclick = send;

function send() {

  let imagesUpload = document.getElementsByTagName('iframe')[0].contentWindow.document.getElementsByTagName("img");
  let imagePath = [];

  for (const element of imagesUpload) {
    let imageSrc = element.src;
    let imagePathSrc = imageSrc.split('/');
    imagePath.push(imagePathSrc[imagePathSrc.length - 1]);
  }

  let data = {
    prefix: prefix.value,
    title: title.value,
    follow: follow.checked,
    email: email.checked,
    comment: sceditor.instance(textarea).val(),
    imagePath: imagePath,
    categoryId: categoryId,
    threadId: threadId
  };

  console.log(data);

  if (update)
    url = "/post/update-thread";
  else if (post)
    url = "/post/store-thread";
  else
    url = "";


  console.log(url);
  axios.post(url, data)
  .then(function (response) {
    console.log(response);

      let icon = `
        <svg xmlns="http://www.w3.org/2000/svg"
        class="stroke-current flex-shrink-0 h-6 w-6"
        fill="none" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      `;
      iconAlert.innerHTML = icon;
      messageAlert.innerText = 'Your thread has been created!';
      btnCloseAlert.parentElement.parentElement.classList.add('alert-success');
      btnCloseAlert.parentElement.parentElement.classList.remove('hidden');

  }).catch(function (error) {
    console.log(error);
    let icon = `
      <svg xmlns="http://www.w3.org/2000/svg"
      class="stroke-current flex-shrink-0 h-6 w-6"
      fill="none" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
    `;
    iconAlert.innerHTML = icon;
    messageAlert.innerText = 'Your thread has not been created!'
    btnCloseAlert.parentElement.parentElement.classList.add('alert-error');
    btnCloseAlert.parentElement.parentElement.classList.remove('hidden');
  });

  // clear textarea when reply
  document.getElementsByTagName('iframe')[0].contentDocument.body.innerHTML = "";
  document.getElementsByTagName('textarea')[0].value  = "";
}