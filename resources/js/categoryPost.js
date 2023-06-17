import './bootstrap'

const textarea = document.getElementById('bbcode-id');

function htmlDecode(input) {
  let doc = new DOMParser().parseFromString(input, "text/html");
  return doc.documentElement.textContent;
}


let prefix = document.getElementById('prefix');
let title = document.getElementById('title');
let post = document.getElementById('category-sent');
let update = document.getElementById('category-update');

let url = window.location.href;
let categoryId;

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
url = url[url.length - 1];
url = url.split('-');
categoryId = url[1];

if (!categoryId) {
  categoryId = 0;
}

if (post)
  post.onclick = send;
else if (update)
  update.onclick = send;


function send() {

  let data = {
    prefix: prefix.value,
    title: title.value,
    comment: textarea.value,
    categoryId: categoryId
  };

  console.log(data);

  if (post) {
    url = '/post/store-caterory';
    
  }
  else if (update) {
    url = '/post/update-category';
  }
  else
    url = '';

  



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
      messageAlert.innerText = 'suscessfully created!';
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
    messageAlert.innerText = 'error!';
    btnCloseAlert.parentElement.parentElement.classList.add('alert-error');
    btnCloseAlert.parentElement.parentElement.classList.remove('hidden');
  });

    document.getElementById('bbcode-id').value = "";
    document.getElementById('title').value = "";
}