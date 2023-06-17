import{a as f}from"./axios-4a70c6fc.js";let v=document.getElementById("newThreadComments"),l=1,i=10,a=[];s();document.querySelector("#nextPage").addEventListener("click",u,!1);document.querySelector("#prevPage").addEventListener("click",x,!1);setInterval(()=>{s()},6e4);function m(e){let t="";return t+=`<div class="my-4 flex pt-2">
  <div class="flex flex-col md:mb-0 mb-2.5">
    <div class="avatar mx-2">
      <div class="w-9 rounded-full">
        <img src="`+e.user.avatar+`" />
      </div>
    </div>
  </div>
  <div class="grow flex flex-col">
    <div class="flex flex-col mb-2.5">
      <!-- users -->
      <div class="flex sm:flex-row flex-col text-sm sm:text-base font-semibold my-2">
        <a href="#" class="link link-hover mx-1">`+e.user.name+`</a>
        <div class="flex sm:flex-row flex-col">
          <div class="mx-1 font-light">replied to</div>
          <a href="/threads/`+e.threadNameId+'" class="mx-1 link link-hover">'+e.threadNameId.split("-")[0]+`</a>
        </div>
      </div>
      <div class="text-sm sm:text-base">`+e.content+`</div>
    </div>
    <div class="flex justify-start ">
      <a href="#" class="link link-hover text-xs">`+e.updated_at.substring(0,10)+`</a>
    </div>

  </div>
</div>`,t}function s(){f.get("/api/threadComment/recent").then(t=>{console.log(t.data.data[0]),a=t.data.data;let d="";console.log(a[0].updated_at.substring(0,10)),a.filter((r,n)=>{let c=(l-1)*i,o=c+i;if(n>=c&&n<o)return!0}).forEach(r=>{d+=m(r)}),v.innerHTML=d})}function x(){l>1&&(l--,s())}function u(){l*i<a.length&&(l++,s())}
