import './echo'
import { textarea } from './post.js'
import './uploadImage'

const sendPost = document.getElementById('forum-post-send');
const sendForum = document.getElementById('forum-send');
const list_messages = document.getElementById('list-messages');
const list_posts = document.getElementById('list-posts');

const parser = new DOMParser();
const channelChat = Echo.channel('chat-general');
const channelPost = Echo.channel('post-general');

let pageSize = 10;
let currentPage = 1;
let data = [];

function previousPage() {
  if (currentPage > 1) {
    currentPage--;
    renderCategory();
  }
}

function nextPage() {
  if ((currentPage * pageSize) < data.length) {
    currentPage++;
    renderCategory();
  }
}

document.querySelector("#nextPage").addEventListener('click', nextPage, false);
document.querySelector("#prevPage").addEventListener('click', previousPage, false);

renderCategory();

async function renderCategory() {
  await getData();

  let categories = "";

  data.filter((row, index) => {
    let start = (currentPage - 1) * pageSize;
    let end = start + pageSize;

    if (index >= start && index < end) return true
  })
    .forEach((category) => {

      categories +=
        "<div class=\"collapse rounded-box collapse-arrow my-3 w-full\">" +
        "<input type=\"checkbox\" checked />" +
        "<div class=\"collapse-title bg-base-300\">" +
        category.title +
        "</div>" +
        "<div class=\"collapse-content p-0\">" +
        "<div class=\"rounded-b-lg bg-base-200 p-2\">";

      category.subcategories.forEach((subCategory) => {

        categories +=
          "<div class=\"flex flex-col pt-3 rounded-lg bg-base-200 hover:bg-base-300 \">" +
          "<div class=\"flex flex-row\">" +
          "<div class=\"basis-10 ml-1\">" +
          "<div class=\"w-8 rounded-xl\">" +
          "<svg class=\"h-8 w-8 text-base\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" stroke-width=\"2\"" +
          "stroke=\"currentColor\" fill=\"none\" stroke-linecap=\"round\" stroke-linejoin=\"round\">" +
          "<path stroke=\"none\" d=\"M0 0h24v24H0z\" />" +
          "<path d=\"M4 21v-13a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-9l-4 4\" />" +
          "<line x1=\"8\" y1=\"9\" x2=\"16\" y2=\"9\" />" +
          "<line x1=\"8\" y1=\"13\" x2=\"14\" y2=\"13\" />" +
          "</svg>" +
          "</div>" +
          "</div>" +
          "<div class=\"basis-full flex flex-col xl:flex-row\">" +
          "<div class=\"basis-1/2 xl:basis-full flex flex-col lg:flex-row\">" +
          "<div class=\"flex flex-col items-start justify-center\">" +
          "<a href=\"/categories/" + subCategory.title.replaceAll(' ', '_') + '-' + subCategory.id + "\" class=\"flex sm:flex-row flex-col sm:items-center w-full cursor-pointer\">" +
          "<div class=\"text-base font-bold mx-2 link link-hover truncate sm:w-56 w-44\">" + subCategory.title + "</div>";

        subCategory.prefix.forEach((prefixes) => {
          categories += "<div class=\"flex flex-col\">";
          prefixes.forEach((prefix) => {
            categories += "<div class=\"badge badge-accent mb-1  text-xs\">" + prefix.content + "</div>";
          });
          categories += "</div>";
        });

        categories += "</a>" +
          "<p class=\"hidden md:block font-light text-left ml-2\">" +
          subCategory.description +
          "</p>" +
          "</div>" +
          "</div>" +
          "<div class=\"flex flex-col sm:flex-row basis-1/2 xl:basis-80 justify-center mt-4 xl:mt-0 \">" +
          "<div class=\" flex lg:mt-0 my-2.5 mr-2 sm:mr-0\">" +
          "<div class=\"lg:basis-1/2 flex flex-row lg:flex-col items-center justify-start lg:mx-2.5 mx-2\">" +
          "<p class=\"font-medium mr-2 lg:mr-1\">" + subCategory.threadCount + "</p>" +
          "<p class=\"font-light text-xs\">Thread</p>" +
          "</div>" +
          "<div class=\"lg:basis-1/2 flex flex-row lg:flex-col items-center justify-start lg:mr-3\">" +
          "<p class=\"font-medium mr-2 lg:mr-1\">" +
          subCategory.commentCount +
          "</p>" +
          "<p class=\"text-xs font-light\">Comment</p>" +
          "</div>" +
          "</div>";

        if (subCategory.thread) {
          categories +=
            "<div class=\"basis-full flex\">" +
            "<div class=\"hidden md:block  mr-2\">" +
            "<a href=\"https://www.google.com\" class=\"avatar\">" +
            "<div class=\"w-8 rounded-full\">" +
            "<img src=\"" + subCategory.thread.avatar + "\" />" +
            "</div>" +
            "</a>" +
            "</div>" +
            "<div class=\"flex flex-col\">" +
            "<a href=\"/threads/" + subCategory.thread.title.replaceAll(' ', '_') + '-' + subCategory.thread.id + "\">" +
            "<div class=\"flex items-center\">";

          if (!subCategory.thread.prefix) {
            categories +=
              "<div class=\"badge badge-primary mr-1\">" + subCategory.thread.prefix + "</div>";
          }

          categories +=
            "<p class=\"font-light link link-hover truncate w-24\">" +
            subCategory.thread.title +
            "</p>" +
            "</div>" +
            "</a>" +
            "<div class=\"text-start\">" +
            "<a href=\"#\" class=\"link link-hover\">" + subCategory.thread.updated_at.substring(0, 10) + "</a>" +
            "</div>" +
            "</div>" +
            "</div>";

        }

        categories +=
          "</div>" +
          "</div>" +
          "</div>" +
          "</div>";

      });

      categories +=
        "</div>" +
        "</div>" +
        "</div>";

    });

  document.getElementById('categories').innerHTML = categories;
}

async function getData() {
  const response = await axios.get('/api/forum');
  data = response.data.data;
}


if (textarea) {
  sendForum.onclick = () => {
    sendChatMessages();
    document.getElementsByTagName('iframe')[0].contentDocument.body.innerHTML = "";
    document.getElementsByTagName('textarea')[0].value  = "" 
  }
  sendPost.onclick = () => {
    sendPostMessages();
  }
}


channelChat.listen('.ChatGeneralEvent', (event) => {
  let userImage = document.createElement('img');
  let userName = event.userName + " ";
  let eventMessage = event.message;
  console.log(eventMessage);
  let messageString = "<div class=\"bg-base-300 rounded-md p-2\">" + eventMessage + "</div>";
  let message = parser.parseFromString(messageString, "text/html").body.firstChild;
  userImage.src = event.avatar;
  addChatMessage(userImage, userName, message, event.date)
});


channelPost.listen('.PostGeneralEvent', (event) => {
  let userId = event.userId;
  let userImage = event.avatar;
  let userName = event.userName;
  let content = event.content;
  let time = event.date;

  addPostMessage(userId, userName, userImage, content, time);
  if (list_posts.childElementCount > 5)
    list_posts.lastElementChild.remove();
})


function sendChatMessages() {
  axios.post('/chat-request', {
    message: sceditor.instance(textarea).val(),
  })
    .then((response) => {
      console.log(response);
    })
    .catch((error) => {
      console.log(error);
    });

}

function sendPostMessages() {
  axios.post('/post-request', {
    content: document.getElementById('forum-post-content').value,
  })
    .then((response) => {
      console.log(response.data.message);
    })
    .catch((error) => {
      console.log(error);
    });
}


function addChatMessage(userImage, userName, message, time) {
  let chatContainer = document.createElement('div');
  let chatAvatar = document.createElement('div');
  let chatAvatarImgContainer = document.createElement('div');
  let chatheader = document.createElement('div');
  let chatDate = document.createElement('time');

  chatContainer.classList.add('chat', 'chat-start');
  chatAvatar.classList.add('chat-image', 'avatar');
  chatAvatarImgContainer.classList.add('w-6', 'rounded-full');
  chatheader.classList.add('chat-header');
  chatDate.classList.add('text-xs', 'opacity-50');

  chatAvatarImgContainer.appendChild(userImage);
  chatAvatar.appendChild(chatAvatarImgContainer);
  chatDate.append(time);
  chatheader.append(userName);
  chatheader.appendChild(chatDate);

  chatContainer.appendChild(chatAvatar);
  chatContainer.appendChild(message);
  chatContainer.appendChild(chatheader);

  list_messages.appendChild(chatContainer);
}

function addPostMessage(userId, userName, avatar, content, time) {
  let postContainer = document.createElement('div');
  let postAvatarContainer = document.createElement('div');
  let postAvatar = document.createElement('a');
  let postAvatarImgContainer = document.createElement('div');
  let postAvatarImg = document.createElement('img');
  let postContentContainer1 = document.createElement('div');
  let postHeader = document.createElement('h2');
  let postUserName = document.createElement('a');
  let postContentContainer2 = document.createElement('div');
  let postContent = document.createElement('div');
  let postDateContainer = document.createElement('div');
  let postDate = document.createElement('div');
  let postReaction = document.createElement('a');

  postContainer.classList.add('flex', 'flex-row', 'w-full', 'my-1');
  postAvatarContainer.classList.add('basis-2/12');
  postAvatar.classList.add('avatar', 'online', 'mr');
  postAvatarImgContainer.classList.add('w-8', 'rounded-full');
  postAvatarImg.src = avatar;
  postContentContainer1.classList.add('basis-10/12');
  postUserName.classList.add('text-cyan-700', 'user-name');
  postContent.classList.add('truncate', 'w-32', 'max-h-10');
  postDateContainer.classList.add('flex', 'w-full', 'justify-between');
  postDate.classList.add('text-xs', 'font-light');

  postAvatarImgContainer.appendChild(postAvatarImg);
  postAvatar.appendChild(postAvatarImgContainer);
  postAvatarContainer.appendChild(postAvatar);
  postUserName.append(userName);
  postUserName.id = "user-" + userId;
  postHeader.appendChild(postUserName);
  postContent.append(content);
  postDate.append(time);
  postReaction.append('...');
  postDateContainer.appendChild(postDate);
  postDateContainer.appendChild(postReaction);
  postContentContainer2.appendChild(postContent);
  postContentContainer2.appendChild(postDateContainer);
  postContentContainer1.appendChild(postHeader);
  postContentContainer1.appendChild(postContentContainer2);
  postContainer.appendChild(postAvatarContainer);
  postContainer.appendChild(postContentContainer1);

  list_posts.prepend(postContainer);
}


let users = document.getElementsByClassName('user');

// update user online in 5min
setInterval(() => {
  let setIsPreventUpdateAgain = [];
  for (const element of users) {
    if (setIsPreventUpdateAgain.includes(element.id.split('-')[1])) {
      continue;
    }
    setIsPreventUpdateAgain.push(element.id.split('-')[1]);
    axios.post('/get-users', {
      userId: element.id.split('-')[1],
    })
      .then((response) => {
        if (response.data.isOnline == 'online') {
          element.classList.add('online');
        } else {
          element.classList.remove('online');
        }
      })
      .catch((error) => {
        console.log(error);
      });
  }
}, 300000);

