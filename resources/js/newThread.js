import axios from "axios";

let newThreads = document.getElementById('threads');
let currentPage = 1;
let pageSize = 10;
let data = [];

renderThreadNew();
document.querySelector("#nextPage").addEventListener('click', nextPage, false);
document.querySelector("#prevPage").addEventListener('click', previousPage, false);

setInterval(() => {
  renderThreadNew();
}, 60000);

function addThread(thread) {
  let html = "";

  html += `<div class="w-full p-1 rounded-lg bg-base-200 hover:bg-base-300 cursor-pointer my-3">
  <div class="flex w-full">
    <div class="basis-10 ">
      <a class="avatar" href="">
        <div class="w-10 mask mask-hexagon">
          <img src="` + thread.user[0].avatar + `" />
        </div>
      </a>
    </div>
    <div class="flex flex-col basis-full">
      <div class="flex">
        <a href="/threads/`+ thread.title.replace(' ', '_') + "-" + thread.id + `" class="flex items-center">`;
        
  thread.prefix.forEach((prefix) => {
    html +=
      "<div class=\"badge badge-accent ml-2\">" +
      prefix.content +
      "</div>";
  });
  
  html += `<div class="ml-2 link link-hover">` + thread.title + `</div>
        </a>
        <div class="h-full grow">
          <a class="w-full h-full block" href="/threads/`+ thread.title.replace(' ', '_') + "-" + thread.id + `"></a>
        </div>
      </div>
      <div class="flex flex-row text-xs">
        <div class="flex items-center">
          <!-- reply -->
          <svg class="h-3.5 w-3.5 text-base ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
          </svg>
          <a href="#" class="ml-1 link link-hover w-14 sm:w-20 truncate">`+ thread.user[0].name + `</a>
          <a href="#" class="ml-2 link link-hover">` + thread.updated_at.substring(0, 10) + `</a>
        </div>
        <div class="grow h-full">
          <a class="grow h-full block" href="/threads/`+ thread.title.replace(' ', '_') + "-" + thread.id + `">
          </a>
        </div>
        <div class="flex items-center">
          <svg class="h-5 w-5 text-base mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M16 15v-1a4 4 0 00-4-4H8m0 0l3 3m-3-3l3-3m9 14V5a2 2 0 00-2-2H6a2 2 0 00-2 2v16l4-2 4 2 4-2 4 2z" />
          </svg>
          <p class="text-xs font-light">`+ thread.commentCount + `</p>
        </div>
      </div>
    </div>
  </div>
</div>`;

  return html;
}

function previousPage() {
  if (currentPage > 1) {
    currentPage--;
    renderThreadNew();
  }
}

function nextPage() {
  if ((currentPage * pageSize) < data.length) {
    currentPage++;
    renderThreadNew();
  }
}



function renderThreadNew() {
  const response = axios.get('/api/thread/new');

  response.then((response) => {
    // console.log(response);
    data = response.data.data;
    let html = "";
    console.log(data[0].updated_at.substring(0, 10));

    data.filter((row, index) => {
      let start = (currentPage - 1) * pageSize;
      let end = start + pageSize;

      if (index >= start && index < end) return true;
    }).forEach(thread => {
      html += addThread(thread);
    });

    newThreads.innerHTML = html;
  });
}
