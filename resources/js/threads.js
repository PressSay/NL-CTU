import './bootstrap'

let pageSize = 36;
let currentPage = 1;
let data = [];
let isSearch = false;

let url = window.location.href;
url = "/api/" + url.split('/')[3] + '/' + url.split('/')[4];

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

function previousPage() {
  if (currentPage > 1) {
    currentPage--;
    renderThread();
  }
}

function nextPage() {
  if ((currentPage * pageSize) < data.length) {
    currentPage++;
    renderThread();
  }
}

document.querySelector("#nextPage").addEventListener('click', previousPage, false);
document.querySelector("#prevPage").addEventListener('click', nextPage, false);
document.querySelector("#search-submit").addEventListener('click', searchSubmit, false);

async function renderThread() {
  if (!isSearch) {
    await getData();
  } else {
    await getDataSearch();
  }

  let threads = "";


  data.filter((row, index) => {
    let start = (currentPage - 1) * pageSize;
    let end = start + pageSize;

    if (index >= start && index < end) return true
  })
    .forEach((thread) => {

      threads +=
        "<div class=\"w-full p-1 rounded-lg bg-base-200 hover:bg-base-300 cursor-pointer my-3\">" +
        "<div class=\"flex w-full\">" +
        "<div class=\"basis-10 \">" +
        "<a class=\"avatar\" href=\"https://www.google.com\">" +
        "<div class=\"w-10 mask mask-hexagon\">" +
        "<img src=\"" + thread.user[0].avatar + "\" />" +
        "</div>" +
        "</a>" +
        "</div>" +
        "<div class=\"flex flex-col basis-full\">" +
        "<div class=\"flex\">" +
        "<a href=\"/threads/" + thread.title.replaceAll(' ', '_') + '-' + thread.id + "\" class=\"flex flex-col sm:flex-row items-center\">";

      thread.prefix.forEach((prefix) => {
        threads +=
          "<div class=\"badge badge-accent ml-2\">" +
          prefix.content +
          "</div>";
      });

      threads +=
        "<div class=\"ml-2 link link-hover w-32 truncate\">" + thread.title + "</div>" +
        "</a>" +
        "<div class=\"h-full grow\">" +
        "<div class=\"w-full h-full flex justify-end\" >";

      if (thread.owner) {
        threads +=
          "<a class=\"w-full h-full\" href=\"/threads/" + thread.title.replaceAll(' ', '_') + '-' + thread.id + "\">" +
          "</a>" +
          "<a href=\"/post/edit-thread/" + thread.title.replaceAll(' ', '_') + '-' + thread.id + "\" class=\"btn btn-xs btn-circle my-2 mx-1\">" +
          "<svg class=\"h-4 w-4 text-base\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\">" +
          "<path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\"" +
          "d=\"M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z\" />" +
          "</svg>" +
          "</a>" +
          "<label for=\"my-modal-3\" class=\"btn btn-xs btn-circle my-2 btn-delete\">" +
          "x" +
          "</label>";
      }

      threads +=
        "</div>" +
        "</div>" +
        "</div>" +
        "<div class=\"flex flex-row text-xs\">" +
        "<div class=\"flex items-center\">" +
        "<svg class=\"h-3.5 w-3.5 text-base ml-2\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\">" +
        "<path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\"" +
        "d=\"M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6\" />" +
        "</svg>" +
        // "<a href=\"/profile/intro/{{ str_replace(' ','_',$thread->user->name).'/'.$thread->user->id }}\" class=\"ml-1 link link-hover truncate w-14 sm:w-20\">{{ $thread->user->name }}</a>" +
        "<a href=\"/profile/intro/" + thread.user[0].name.replaceAll(' ', '_') + "/" + thread.user[0].id + "\" class=\"ml-1 link link-hover truncate w-14 sm:w-20\">" + thread.user[0].name + "</a>" +
        "<a href=\"#\" class=\"ml-2 link link-hover\">" + thread.updated_at.substring(0, 10) + "</a>" +
        "</div>" +
        "<div class=\"grow h-full\">" +
        "<a class=\"grow h-full block\" href=\"/threads/" + thread.title.replaceAll(' ', '_') + '-' + thread.id + "\">" +
        "</a>" +
        "</div>" +
        "<div class=\"flex items-center\">" +
        "<svg class=\"h-5 w-5 text-base mr-1\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\">" +
        "<path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\"" +
        "d=\"M16 15v-1a4 4 0 00-4-4H8m0 0l3 3m-3-3l3-3m9 14V5a2 2 0 00-2-2H6a2 2 0 00-2 2v16l4-2 4 2 4-2 4 2z\" />" +
        "</svg>" +
        "<p class=\"text-xs font-light\">" + thread.commentCount + "</p>" +
        "</div>" +
        "</div>" +
        "</div>" +
        "</div>" +
        "</div>";

    });

  document.getElementById('threads').innerHTML = threads;

  let btnDelete = document.getElementsByClassName('btn-delete');

  for (const element of btnDelete) {
    element.addEventListener('click', deleteThread, false);
  }

}

renderThread();


function deleteThread(parent) {
  let urlDel = parent.target.parentElement.children[0].href;
  urlDel = urlDel.split('/');

  let apiDel = urlDel[urlDel.length - 1].split('-')[1];

  document.getElementById('sure').onclick = () => {
    deleteData(apiDel);
    renderThread();
  }

}


async function getData() {
  const response = await axios.get(url);
  data = response.data.data;
  console.log(data[0].user[0].name);
}

async function getDataSearch() {
  let prefix = document.getElementById('prefix').value;
  let lastUpdated = document.getElementById('last-updated').value;
  let writedBy = document.getElementById('writed-by').value;

  let dataSearch = {
    prefix: prefix,
    lastUpdated: lastUpdated,
    writedBy: writedBy,
  };

  console.log(dataSearch);

  if (writedBy == '' && lastUpdated == 'Any time' && prefix == 'All') {
    isSearch = false;
    return;
  }

  const response = await axios.post(url + '/search', dataSearch);
  data = response.data.data;
  isSearch = true;

  console.log(data);
}

async function searchSubmit() {
  await getDataSearch();
  renderThread();
}


function deleteData(threadId) {
  data = {
    threadId: threadId
  };

  axios.post('/post/delete-thread', data)
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
      messageAlert.innerText = 'Your threads has been deleted!';
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
      messageAlert.innerText = 'Your threads has not been deleted!';
      btnCloseAlert.parentElement.parentElement.classList.add('alert-error');
      btnCloseAlert.parentElement.parentElement.classList.remove('hidden');
    });
}


