import{t as h}from"./uploadImage-414df52d.js";import"./bootstrap-359a5dbc.js";import"./axios-4a70c6fc.js";let E=document.getElementById("prefix"),f=document.getElementById("title"),w=document.getElementById("follow"),v=document.getElementById("receive"),o=document.getElementById("thread-sent"),a=document.getElementById("thread-update"),e=window.location.href,g,p,t=document.getElementById("close-alert");t&&(t.onclick=()=>{t.parentElement.parentElement.classList.add("hidden"),t.parentElement.parentElement.classList.remove("alert-success"),t.parentElement.parentElement.classList.remove("alert-error")});let i=document.getElementById("icon-alert"),c=document.getElementById("message-alert");e=e.split("/");g=e[4].split("-")[1];p=e[e.length-1].split("-")[1];o?o.onclick=d:a&&(a.onclick=d);function d(){let u=document.getElementsByTagName("iframe")[0].contentWindow.document.getElementsByTagName("img"),r=[];for(const n of u){let m=n.src.split("/");r.push(m[m.length-1])}let s={prefix:E.value,title:f.value,follow:w.checked,email:v.checked,comment:sceditor.instance(h).val(),imagePath:r,categoryId:g,threadId:p};console.log(s),a?e="/post/update-thread":o?e="/post/store-thread":e="",console.log(e),axios.post(e,s).then(function(n){console.log(n);let l=`
        <svg xmlns="http://www.w3.org/2000/svg"
        class="stroke-current flex-shrink-0 h-6 w-6"
        fill="none" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      `;i.innerHTML=l,c.innerText="Your thread has been created!",t.parentElement.parentElement.classList.add("alert-success"),t.parentElement.parentElement.classList.remove("hidden")}).catch(function(n){console.log(n);let l=`
      <svg xmlns="http://www.w3.org/2000/svg"
      class="stroke-current flex-shrink-0 h-6 w-6"
      fill="none" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
    `;i.innerHTML=l,c.innerText="Your thread has not been created!",t.parentElement.parentElement.classList.add("alert-error"),t.parentElement.parentElement.classList.remove("hidden")}),document.getElementsByTagName("iframe")[0].contentDocument.body.innerHTML="",document.getElementsByTagName("textarea")[0].value=""}
