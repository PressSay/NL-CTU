import { textarea } from './post';
import './uploadImage'
import './echo'
import axios from 'axios';

const reply = document.getElementById('reply');
const channelThreadComment = Echo.join('threadComment-general');

let url = window.location.href;
url = url.split('/');


let threadId = url[4].split('-')[1];
let api = '/api/' + 'threads/' + url[4];
let pageSize = 10;
let data = [];
let currentPage = 1;
let usersJoinChannel = [];

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

channelThreadComment
  .here((users) => {
    users.forEach(user => {
      usersJoinChannel.push(user.id);
    });
  })
  .joining((user) => {
    usersJoinChannel.push(user.id);
  })
  .leaving((user) => {
    usersJoinChannel = usersJoinChannel.filter(u => u !== user);
  })
  .listen('.ThreadCommentEvent', (event) => {
    lastPage();
  });

function nextPage() {
  if (currentPage > 1) {
    currentPage--;
    renderThreadComment();
  }
}

function previousPage() {
  if ((currentPage * pageSize) < data.length) {
    currentPage++;
    renderThreadComment();
  }
}

function lastPage() {
  currentPage = Math.ceil(data.length / pageSize);
  renderThreadComment();
}

document.querySelector("#lastPage").addEventListener('click', lastPage, false);
document.querySelector("#nextPage").addEventListener('click', previousPage, false);
document.querySelector("#prevPage").addEventListener('click', nextPage, false);

let follow = document.getElementById('follow');

if (follow) {
  follow.addEventListener('click', submitFollow, false);
}

function addThreadComment(avatar, userName, birthday, threadCount, reaction,
  age, location, updated_at, owner, content, id) {

  let threadComments = "";
  threadComments +=
    "<div class=\"my-4 flex flex-col md:flex-row pt-2\">" +
    "<div class=\"flex flex-col md:mb-0 mb-6\">" +
    "<div class=\"flex md:flex-col md:justify-center md:items-center\">" +
    "<div class=\"avatar md:mr-0 mr-2\">" +
    "<div class=\"w-9 rounded-full\">" +
    "<img src=\"" + avatar + "\" />" +
    "</div>" +
    "</div>" +
    "<a href=\"#\" class=\"text-xs sm:text-sm md:mr-0 mr-2 truncate w-32 text-center\">" +
    userName +
    "</a>" +
    "<div class=\"badge badge-accent text-xs font-light mb-1\">" +
    "Members" +
    "</div>" +
    "</div>" +

    "<div class=\"block md:w-32 w-full\">" +
    "<div class=\"collapse collapse-arrow\">" +
    "<input type=\"checkbox\" class=\"h-5 min-h-0\" />" +
    "<div class=\"collapse-title p-0 h-5 flex justify-center items-center min-h-0 text-xs font-light \">" +
    "<p>Detail</p>" +
    "</div>" +
    "<div class=\"collapse-content\">" +
    "<div class=\"flex items-center justify-between my-1\">" +

    "<svg class=\"h-3.5 w-3.5 text-base\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\"" +
    "stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\">" +
    "<path d=\"M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2\" />" +
    "<circle cx=\"12\" cy=\"7\" r=\"4\" />" +
    "</svg>" +
    "<div class=\"text-xs\">" + birthday.substring(0, 10) + "</div>" +
    "</div>" +
    "<div class=\"flex items-center justify-between my-1\">" +

    "<svg class=\"h-3.5 w-3.5 text-base\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" stroke-width=\"2\"" +
    "stroke=\"currentColor\" fill=\"none\" stroke-linecap=\"round\" stroke-linejoin=\"round\">" +
    "<path stroke=\"none\" d=\"M0 0h24v24H0z\" />" +
    "<path d=\"M21 14l-3 -3h-7a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1h9a1 1 0 0 1 1 1v10\" />" +
    "<path d=\"M14 15v2a1 1 0 0 1 -1 1h-7l-3 3v-10a1 1 0 0 1 1 -1h2\" />" +
    "</svg>" +
    "<div class=\"text-xs\">" + threadCount + "</div>" +
    "</div>" +
    "<div class=\"flex items-center justify-between my-1\">" +

    "<svg class=\"h-3.5 w-3.5 text-base\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" stroke-width=\"2\"" +
    "stroke=\"currentColor\" fill=\"none\" stroke-linecap=\"round\" stroke-linejoin=\"round\">" +
    "<path stroke=\"none\" d=\"M0 0h24v24H0z\" />" +
    "<path" +
    " d=\"M7 11v 8a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1v-7a1 1 0 0 1 1 -1h3a4 4 0 0 0 4 -4v-1a2 2 0 0 1 4 0v5h3a2 2 0 0 1 2 2l-1 5a2 3 0 0 1 -2 2h-7a3 3 0 0 1 -3 -3\" />" +
    "</svg>" +
    "<div class=\"text-xs\">" + reaction + "</div>" +
    "</div>" +

    "<div class=\"flex items-center justify-between my-1\">" +

    "<svg class=\"h-3.5 w-3.5 text-base\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" stroke-width=\"2\"" +
    "stroke=\"currentColor\" fill=\"none\" stroke-linecap=\"round\" stroke-linejoin=\"round\">" +
    "<path stroke=\"none\" d=\"M0 0h24v24H0z\" />" +
    "<path d=\"M6 14a6 6 0 0 0 12 0a12 12 0 0 0 -3 -8.5a3.7 3.7 0 0 0 -6 0a12 12 0 0 0 -3 8.5\" />" +
    "</svg>" +
    "<div class=\"text-xs\">" + age + "</div>" +
    "</div>" +
    "<div class=\"flex items-center justify-between my-1\">" +

    "<svg class=\"h-3.5 w-3.5 text-base\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" stroke-width=\"2\"" +
    "stroke=\"currentColor\" fill=\"none\" stroke-linecap=\"round\" stroke-linejoin=\"round\">" +
    "<path stroke=\"none\" d=\"M0 0h24v24H0z\" />" +
    "<circle cx=\"12\" cy=\"11\" r=\"3\" />" +
    "<path" +
    " d=\"M17.657 16.657L13.414 20.9a1.998 1.998 0 0 1 -2.827 0l-4.244-4.243a8 8 0 1 1 11.314 0z\" />" +
    "</svg>" +
    "<div class=\"text-xs\">" + location + "</div>" +
    "</div>" +
    "</div>" +
    "</div>" +
    "</div>" +
    "</div>" +


    "<div class=\"grow flex flex-col \">" +
    "<div class=\"flex justify-between mb-4\">" +
    "<a href=\"#\" class=\"link link-hover text-xs\">" + updated_at.substring(0, 10) + "</a>" +
    "<div class=\"flex items-center\" id=\"" + id + "\">" +
    "<a href=\"\">" +
    "<svg class=\"h-3.5 w-3.5 text-base\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" stroke-width=\"2\"" +
    "stroke=\"currentColor\" fill=\"none\" stroke-linecap=\"round\" stroke-linejoin=\"round\">" +
    "<path stroke=\"none\" d=\"M0 0h24v24H0z\" />" +
    "<circle cx=\"12\" cy=\"18\" r=\"2\" />" +
    "<circle cx=\"7\" cy=\"6\" r=\"2\" />" +
    "<circle cx=\"17\" cy=\"6\" r=\"2\" />" +
    "<path d=\"M7 8v2a2 2 0 0 0 2 2h6a2 2 0 0 0 2 -2v-2\" />" +
    "<line x1=\"12\" y1=\"12\" x2=\"12\" y2=\"16\" />" +
    "</svg>" +
    "</a>" +
    "<p class=\"font-light text-xs mx-2\">#4</p>";

  if (owner) {

    threadComments +=
      "<label for=\"my-modal-3\" class=\"btn btn-xs btn-circle mx-1 btn-delete\">" +
      "x" +
      "</label>";
  }


  threadComments +=
    "</div>" +
    "</div>" +
    "<div class=\"block\">" +
    "<div class=\"text-sm sm:text-base\">" +
    content +
    "</div>" +
    "</div>" +
    "</div>" +
    "</div>";

  return threadComments;
}

async function renderThreadComment() {
  await getData();

  let threadComments = "";

  data.filter((row, index) => {
    let start = (currentPage - 1) * pageSize;
    let end = start + pageSize;


    if (index >= start && index < end) return true
  })
    .forEach((threadComment) => {

      threadComments += addThreadComment(threadComment.avatar, threadComment.user.name, threadComment.birthday,
        threadComment.threadCount, threadComment.reaction, threadComment.age, threadComment.location,
        threadComment.updated_at, threadComment.owner, threadComment.content, threadComment.id);
    });

  document.getElementById('threadComments').innerHTML = threadComments;

  let btnDelete = document.getElementsByClassName('btn-delete');


  for (const element of btnDelete) {
    element.addEventListener('click', deleteThreadComment, false);
  }
}

renderThreadComment();


function deleteThreadComment(parent) {
  let apiDel = parent.target.parentElement.id;

  document.getElementById('sure').onclick = () => {
    deleteData(apiDel);
    renderThreadComment()
  }
}

function deleteData(threadCommentId) {
  data = {
    threadCommentId: threadCommentId
  };

  console.log(data)

  axios.post('/post/delete-comment', data)
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
      messageAlert.innerText = 'Your threadcomment has been deleted!';
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
      messageAlert.innerText = 'Your threadcomment has not been deleted!';
      btnCloseAlert.parentElement.parentElement.classList.add('alert-error');
      btnCloseAlert.parentElement.parentElement.classList.remove('hidden');
    });
}


async function getData() {
  const response = await axios.get(api);
  data = response.data.data;
}

if (reply != null) {
  reply.onclick = async () => {

    let imagesUpload = document.getElementsByTagName('iframe')[0].contentWindow.document.getElementsByTagName("img");
    let imagePath = [];

    for (const element of imagesUpload) {
      let imageSrc = element.src;
      let imagePathSrc = imageSrc.split('/');
      imagePath.push(imagePathSrc[imagePathSrc.length - 1]);
    }

    const data = {
      comment: sceditor.instance(textarea).val().trim(),
      threadId: threadId,
      imagePath: imagePath,
      userIds: usersJoinChannel,
    }

    let dataChannel = {};

   await axios.post('/post/store-comment', data)
      .then(function (response) {
        console.log(response);
        dataChannel = {
          'threadCommentId': response.data.threadCommentId,
        };

          let icon = `
          <svg xmlns="http://www.w3.org/2000/svg"
          class="stroke-current flex-shrink-0 h-6 w-6"
          fill="none" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
        `;
          iconAlert.innerHTML = icon;
          messageAlert.innerText = 'Your threadcomment has been created!';
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
        messageAlert.innerText = 'Your threadcomment has not been created!';
        btnCloseAlert.parentElement.parentElement.classList.add('alert-error');
        btnCloseAlert.parentElement.parentElement.classList.remove('hidden');
      });

   

     axios.post('/api/channel', dataChannel);

    // clear textarea when reply
    document.getElementsByTagName('iframe')[0].contentDocument.body.innerHTML = "";
    document.getElementsByTagName('textarea')[0].value = ""
    renderThreadComment();

  }
}

async function submitFollow() {
  console.log(api + '/follow');
  const response = await axios.get(api + '/follow');
  let follow = response.data.message;

  console.log(follow);

  if (follow == "follow successfully") {
    document.getElementById('follow').innerHTML = "Unfollow";
  } else if (follow == "unfollow successfully") {
    document.getElementById('follow').innerHTML = "Follow";
  }
}