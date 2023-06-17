import"./bootstrap-359a5dbc.js";import"./axios-4a70c6fc.js";const m=document.getElementById("bbcode-id");let p=document.getElementById("prefix"),u=document.getElementById("title"),r=document.getElementById("category-sent"),s=document.getElementById("category-update"),e=window.location.href,n,t=document.getElementById("close-alert");t&&(t.onclick=()=>{t.parentElement.parentElement.classList.add("hidden"),t.parentElement.parentElement.classList.remove("alert-success"),t.parentElement.parentElement.classList.remove("alert-error")});let i=document.getElementById("icon-alert"),c=document.getElementById("message-alert");e=e.split("/");e=e[e.length-1];e=e.split("-");n=e[1];n||(n=0);r?r.onclick=d:s&&(s.onclick=d);function d(){let a={prefix:p.value,title:u.value,comment:m.value,categoryId:n};console.log(a),r?e="/post/store-caterory":s?e="/post/update-category":e="",axios.post(e,a).then(function(l){console.log(l);let o=`
        <svg xmlns="http://www.w3.org/2000/svg"
        class="stroke-current flex-shrink-0 h-6 w-6"
        fill="none" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      `;i.innerHTML=o,c.innerText="suscessfully created!",t.parentElement.parentElement.classList.add("alert-success"),t.parentElement.parentElement.classList.remove("hidden")}).catch(function(l){console.log(l);let o=`
      <svg xmlns="http://www.w3.org/2000/svg"
      class="stroke-current flex-shrink-0 h-6 w-6"
      fill="none" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
    `;i.innerHTML=o,c.innerText="error!",t.parentElement.parentElement.classList.add("alert-error"),t.parentElement.parentElement.classList.remove("hidden")}),document.getElementById("bbcode-id").value="",document.getElementById("title").value=""}
