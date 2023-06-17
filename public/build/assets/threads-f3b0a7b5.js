import"./bootstrap-359a5dbc.js";import"./axios-4a70c6fc.js";let d=36,i=1,n=[],m=!1,r=window.location.href;r="/api/"+r.split("/")[3]+"/"+r.split("/")[4];let s=document.getElementById("close-alert");s&&(s.onclick=()=>{s.parentElement.parentElement.classList.add("hidden"),s.parentElement.parentElement.classList.remove("alert-success"),s.parentElement.parentElement.classList.remove("alert-error")});let u=document.getElementById("icon-alert"),f=document.getElementById("message-alert");function g(){i>1&&(i--,o())}function h(){i*d<n.length&&(i++,o())}document.querySelector("#nextPage").addEventListener("click",g,!1);document.querySelector("#prevPage").addEventListener("click",h,!1);document.querySelector("#search-submit").addEventListener("click",k,!1);async function o(){m?await v():await x();let t="";n.filter((e,a)=>{let c=(i-1)*d,p=c+d;if(a>=c&&a<p)return!0}).forEach(e=>{t+='<div class="w-full p-1 rounded-lg bg-base-200 hover:bg-base-300 cursor-pointer my-3"><div class="flex w-full"><div class="basis-10 "><a class="avatar" href="https://www.google.com"><div class="w-10 mask mask-hexagon"><img src="'+e.user[0].avatar+'" /></div></a></div><div class="flex flex-col basis-full"><div class="flex"><a href="/threads/'+e.title.replaceAll(" ","_")+"-"+e.id+'" class="flex flex-col sm:flex-row items-center">',e.prefix.forEach(a=>{t+='<div class="badge badge-accent ml-2">'+a.content+"</div>"}),t+='<div class="ml-2 link link-hover w-32 truncate">'+e.title+'</div></a><div class="h-full grow"><div class="w-full h-full flex justify-end" >',e.owner&&(t+='<a class="w-full h-full" href="/threads/'+e.title.replaceAll(" ","_")+"-"+e.id+'"></a><a href="/post/edit-thread/'+e.title.replaceAll(" ","_")+"-"+e.id+'" class="btn btn-xs btn-circle my-2 mx-1"><svg class="h-4 w-4 text-base" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg></a><label for="my-modal-3" class="btn btn-xs btn-circle my-2 btn-delete">x</label>'),t+='</div></div></div><div class="flex flex-row text-xs"><div class="flex items-center"><svg class="h-3.5 w-3.5 text-base ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" /></svg><a href="/profile/intro/'+e.user[0].name.replaceAll(" ","_")+"/"+e.user[0].id+'" class="ml-1 link link-hover truncate w-14 sm:w-20">'+e.user[0].name+'</a><a href="#" class="ml-2 link link-hover">'+e.updated_at.substring(0,10)+'</a></div><div class="grow h-full"><a class="grow h-full block" href="/threads/'+e.title.replaceAll(" ","_")+"-"+e.id+'"></a></div><div class="flex items-center"><svg class="h-5 w-5 text-base mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"d="M16 15v-1a4 4 0 00-4-4H8m0 0l3 3m-3-3l3-3m9 14V5a2 2 0 00-2-2H6a2 2 0 00-2 2v16l4-2 4 2 4-2 4 2z" /></svg><p class="text-xs font-light">'+e.commentCount+"</p></div></div></div></div></div>"}),document.getElementById("threads").innerHTML=t;let l=document.getElementsByClassName("btn-delete");for(const e of l)e.addEventListener("click",w,!1)}o();function w(t){let l=t.target.parentElement.children[0].href;l=l.split("/");let e=l[l.length-1].split("-")[1];document.getElementById("sure").onclick=()=>{b(e),o()}}async function x(){n=(await axios.get(r)).data.data,console.log(n[0].user[0].name)}async function v(){let t=document.getElementById("prefix").value,l=document.getElementById("last-updated").value,e=document.getElementById("writed-by").value,a={prefix:t,lastUpdated:l,writedBy:e};if(console.log(a),e==""&&l=="Any time"&&t=="All"){m=!1;return}n=(await axios.post(r+"/search",a)).data.data,m=!0,console.log(n)}async function k(){await v(),o()}function b(t){n={threadId:t},axios.post("/post/delete-thread",n).then(function(l){console.log(l);let e=`
      <svg xmlns="http://www.w3.org/2000/svg"
      class="stroke-current flex-shrink-0 h-6 w-6"
      fill="none" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
    `;u.innerHTML=e,f.innerText="Your threads has been deleted!",s.parentElement.parentElement.classList.add("alert-success"),s.parentElement.parentElement.classList.remove("hidden")}).catch(function(l){console.log(l);let e=`
    <svg xmlns="http://www.w3.org/2000/svg"
    class="stroke-current flex-shrink-0 h-6 w-6"
    fill="none" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
  `;u.innerHTML=e,f.innerText="Your threads has not been deleted!",s.parentElement.parentElement.classList.add("alert-error"),s.parentElement.parentElement.classList.remove("hidden")})}