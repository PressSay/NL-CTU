import './bootstrap'

let pageSize = 10;
let currentPage = 1;
let data = [];

let url = window.location.href;
url = url.split('/');
url = '/api/thread/user/' + url[url.length - 2] + '/' + url[url.length - 1];

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

async function renderThread() {
    await getData();

    let threads = '';

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
                "<a href=\"/threads/" + thread.title.replaceAll(' ', '_') + '-' + thread.id + "\" class=\"flex items-center\">";
            thread.prefix.forEach((prefix) => {
                threads +=
                    "<div class=\"badge badge-accent ml-2\">" +
                    prefix.content +
                    "</div>";
            });

            threads +=
                "<div class=\"ml-2 link link-hover\">" + thread.title + "</div>" +
                "</a>" +
                "<div class=\"h-full grow\">" +
                "<div class=\"w-full h-full flex justify-end\" >";

            if (thread.owner) {
                threads +=
                    "<a class=\"w-full h-full\" href=\"/threads/" + thread.title.replaceAll(' ', '_') + '-' + thread.id + "\">" +
                    "</a>" +
                    "<a href=\"/post/edit-thread/" +  thread.title.replaceAll(' ', '_') + '-' + thread.id + "\" class=\"btn btn-xs btn-circle my-2 mx-1\">" +
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
                "<a href=\"#\" class=\"ml-2 link link-hover\">" + thread.updated_at.substring(0, 10) + "</a>" +
                "</div>" +
                "<div class=\"grow h-full\">" +
                "<a class=\"grow h-full block\" href=\"/threads/" + thread.title.replaceAll(' ', '_') + '-' + thread.id + "\">" +
                "</a>" +
                "</div>" +
                "<div class=\"flex items-center\">" +
                "<!-- reply-1 -->" +
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

console.log('hello');

renderThread();

async function getData() {
    const response = await axios.get(url);
    data = response.data.data;
}


function deleteThread(parent) {
    let urlDel = parent.target.parentElement.childNodes[0].href;
    urlDel = urlDel.split('/');

    let apiDel = urlDel[urlDel.length - 1].split('-')[1];

    document.getElementById('sure').onclick = () => {
        console.log(apiDel);
        deleteData(apiDel);
        renderThread()
    }

}

function deleteData(threadId) {
    let dataThread = {
      threadId: threadId
    };
  
    axios.post('/post/delete-thread', dataThread)
      .then((response) => {
        console.log(response);
      })
      .catch((error) => {
        console.log(error);
      });
  }
  