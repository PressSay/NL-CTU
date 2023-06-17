import{a as v}from"./axios-4a70c6fc.js";let f=document.getElementById("threads"),s=1,r=10,a=[];i();document.querySelector("#nextPage").addEventListener("click",g,!1);document.querySelector("#prevPage").addEventListener("click",m,!1);setInterval(()=>{i()},6e4);function u(e){let l="";return l+=`<div class="w-full p-1 rounded-lg bg-base-200 hover:bg-base-300 cursor-pointer my-3">
  <div class="flex w-full">
    <div class="basis-10 ">
      <a class="avatar" href="">
        <div class="w-10 mask mask-hexagon">
          <img src="`+e.user[0].avatar+`" />
        </div>
      </a>
    </div>
    <div class="flex flex-col basis-full">
      <div class="flex">
        <a href="/threads/`+e.title.replace(" ","_")+"-"+e.id+'" class="flex items-center">',e.prefix.forEach(t=>{l+='<div class="badge badge-accent ml-2">'+t.content+"</div>"}),l+='<div class="ml-2 link link-hover">'+e.title+`</div>
        </a>
        <div class="h-full grow">
          <a class="w-full h-full block" href="/threads/`+e.title.replace(" ","_")+"-"+e.id+`"></a>
        </div>
      </div>
      <div class="flex flex-row text-xs">
        <div class="flex items-center">
          <!-- reply -->
          <svg class="h-3.5 w-3.5 text-base ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
          </svg>
          <a href="#" class="ml-1 link link-hover w-14 sm:w-20 truncate">`+e.user[0].name+`</a>
          <a href="#" class="ml-2 link link-hover">`+e.updated_at.substring(0,10)+`</a>
        </div>
        <div class="grow h-full">
          <a class="grow h-full block" href="/threads/`+e.title.replace(" ","_")+"-"+e.id+`">
          </a>
        </div>
        <div class="flex items-center">
          <svg class="h-5 w-5 text-base mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M16 15v-1a4 4 0 00-4-4H8m0 0l3 3m-3-3l3-3m9 14V5a2 2 0 00-2-2H6a2 2 0 00-2 2v16l4-2 4 2 4-2 4 2z" />
          </svg>
          <p class="text-xs font-light">`+e.commentCount+`</p>
        </div>
      </div>
    </div>
  </div>
</div>`,l}function m(){s>1&&(s--,i())}function g(){s*r<a.length&&(s++,i())}function i(){v.get("/api/thread/new").then(l=>{a=l.data.data;let t="";console.log(a[0].updated_at.substring(0,10)),a.filter((n,o)=>{let c=(s-1)*r,d=c+r;if(o>=c&&o<d)return!0}).forEach(n=>{t+=u(n)}),f.innerHTML=t})}
