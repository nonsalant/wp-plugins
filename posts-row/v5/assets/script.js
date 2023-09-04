const b="modulepreload",L=function(l){return"/"+l},k={},y=function(c,r,f){if(!r||r.length===0)return c();const d=document.getElementsByTagName("link");return Promise.all(r.map(t=>{if(t=L(t),t in k)return;k[t]=!0;const g=t.endsWith(".css"),p=g?'[rel="stylesheet"]':"";if(!!f)for(let a=d.length-1;a>=0;a--){const n=d[a];if(n.href===t&&(!g||n.rel==="stylesheet"))return}else if(document.querySelector(`link[href="${t}"]${p}`))return;const s=document.createElement("link");if(s.rel=g?"stylesheet":b,g||(s.as="script",s.crossOrigin=""),s.href=t,document.head.appendChild(s),g)return new Promise((a,n)=>{s.addEventListener("load",a),s.addEventListener("error",()=>n(new Error(`Unable to preload CSS for ${t}`)))})})).then(()=>c())};function v(l,c){const[r,f,d]=[...l],t=+f("pagination"),g=+f("totalpages"),{linksMap:p,$row:u}={...c};u.classList.toggle("first-page",t===1),u.classList.toggle("last-page",t===g);for(const[a,n]of p){if(!r(a))continue;const h=+n(t),m=h>g,e=h<1;m||e||h===t?s(a).forEach(w=>{w.disabled=!0}):s(a).forEach(w=>{w.disabled=!1})}function s(a){return u.querySelectorAll(a)}}function P(l,c){const[r,f,d]=[...l],t=+f("pagination");+f("totalpages");const g=i=>{d("pagination",+i)},{$row:p,postsRow:u,pageOfCurrent:s,pageOfCurrentName:a}={...c},n=r(u),h=f("remote_location"),m=new URL(h);n.classList.add("loading"),n.querySelectorAll(".prel-header, .c-card__frame").forEach(i=>{i.setAttribute("aria-busy",!0)}),g(t),r(s)&&(r(s).innerText=t),o()&&p.scrollIntoView(),m.searchParams.set("paged",t),fetch(m.toString()).then(i=>(i.ok||console.log("Response was not ok."),i.text())).then(i=>{if(i===""){console.log("No HTML was received.");return}n.innerHTML=i,n.classList.remove("loading"),o()&&e()});function e(){p.scrollIntoView(),p.querySelector("a").focus();const i=r(a);if(!i)return console.warn(a+" not found so scrollBackUp() was stopped.");w(i)}function o(){return p.offsetHeight>window.innerHeight}function w(i){i.classList.remove("pulsate"),i.offsetWidth,i.classList.add("pulsate")}}const _=Object.freeze(Object.defineProperty({__proto__:null,default:P},Symbol.toStringTag,{value:"Module"}));function E(l,c,r){const[f,d,t]=[...c],g=+d("pagination"),p=+d("totalpages"),u=o=>{t("pagination",Number(o))},{linksMap:s,$row:a}={...r};for(const[o,w]of s)if(m(f(o))&&e(o)){const i=w(g);n(i)}function n(o){h(o)&&(u(o),P(c,r),v(c,{linksMap:s,$row:a}))}function h(o){return!(o<1||o>p)}function m(o){return!(!o||o.disabled)}function e(o){return l.closest(o)}}function O(l){return`<div class="page-of-wrapper">
        <div class="page-of">
            <button class="go-to-page-1" type="button">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <use href="#arrow-left-thin"></use>
                </svg>
                <span style="white-space: nowrap;">
                    Back to: <b>Page 1</b>
                </span>
            </button>
            <span class="page-of--you-are-here">
                <span class="callout page-of--current-name">
                    <span>Page</span>
                    <span class="page-of--current">1</span>
                </span>
                <em>of</em>
                <button type="button" class="page-of--total">
                    ${l}
                </button>
            </span>
        </div>
    </div>`}const $=document.querySelectorAll(".posts-row-wrapper"),S={linkNext:".next-page",linkPrevious:".previous-page",linkLast:".page-of--total",linkFirst:".go-to-page-1",pageOf:".page-of",pageOfCurrent:".page-of--current",postsRow:".posts-row",pageOfCurrentName:".page-of--current-name",pageOfWrapper:"[data-slot=page-of-wrapper]"};$.forEach(l=>{const c={$row:l,...S},r=+h("totalpages"),f=[n,h,m],{linkFirst:d,linkLast:t,linkNext:g,linkPrevious:p}={...c};if(!(r>=2))return;const u=new Map;u.set(g,e=>e+1),u.set(p,e=>e-1),u.set(t,e=>r),u.set(d,e=>1);const{pageOfWrapper:s,pageOf:a}={...c};!n(a)&&n(s)&&(n(s).outerHTML=O(r)),n(a)&&n(a).classList.remove("hidden"),n(t)&&(n(t).innerText=r),document.body.classList.contains("development")&&y(()=>Promise.resolve().then(()=>_),void 0).then(e=>{e.default(f,c)}).catch(e=>console.error(e)),v(f,{linksMap:u,$row:l}),l.addEventListener("click",e=>{const o=e.target;E(o,f,{linksMap:u,...c})});function n(e){return l.querySelector(e)}function h(e){return n("[data-"+e+"]").dataset[e]}function m(e,o){n("[data-"+e+"]").dataset[e]=o}});
//# sourceMappingURL=script.js.map
