import axios from "axios";

let newThreadComments = document.getElementById('newThreadComments');
let currentPage = 1;
let pageSize = 10;
let data = [];

renderRecentThread();
document.querySelector("#nextPage").addEventListener('click', nextPage, false);
document.querySelector("#prevPage").addEventListener('click', previousPage, false);

setInterval(() => {
  renderRecentThread();
}, 60000);


function addThreadComment(threadComment) {
  let html = "";
  html += `<div class="my-4 flex pt-2">
  <div class="flex flex-col md:mb-0 mb-2.5">
    <div class="avatar mx-2">
      <div class="w-9 rounded-full">
        <img src="`+ threadComment.user.avatar + `" />
      </div>
    </div>
  </div>
  <div class="grow flex flex-col">
    <div class="flex flex-col mb-2.5">
      <!-- users -->
      <div class="flex sm:flex-row flex-col text-sm sm:text-base font-semibold my-2">
        <a href="#" class="link link-hover mx-1">`+ threadComment.user.name + `</a>
        <div class="flex sm:flex-row flex-col">
          <div class="mx-1 font-light">replied to</div>
          <a href="/threads/`+ threadComment.threadNameId + `" class="mx-1 link link-hover">` + threadComment.threadNameId.split('-')[0] + `</a>
        </div>
      </div>
      <div class="text-sm sm:text-base">`+ threadComment.content + `</div>
    </div>
    <div class="flex justify-start ">
      <a href="#" class="link link-hover text-xs">`+ threadComment.updated_at.substring(0, 10) + `</a>
    </div>

  </div>
</div>`;

  return html;
}

function renderRecentThread() {
  const response = axios.get('/api/threadComment/recent');

  response.then((response) => {
    console.log(response.data.data[0]);

    data = response.data.data;
    let html = "";
    console.log(data[0].updated_at.substring(0, 10));

    data.filter((row, index) => {
      let start = (currentPage - 1) * pageSize;
      let end = start + pageSize;

      if (index >= start && index < end) return true;
    }).forEach(threadComment => {
       html += addThreadComment(threadComment);
    });

    newThreadComments.innerHTML = html;

  });
}

function previousPage() {
  if (currentPage > 1) {
    currentPage--;
    renderRecentThread();
  }
}

function nextPage() {
  if ((currentPage * pageSize) < data.length) {
    currentPage++;
    renderRecentThread();
  }
}