function k(c,l){const[o,p,m]=[...c],s=+p("pagination"),d=+p("totalpages"),{linksMap:f,$row:r}={...l};r.classList.toggle("first-page",s===1),r.classList.toggle("last-page",s===d);for(const[i,a]of f){if(!o(i))continue;const u=+a(s),w=u>d,e=u<1;w||e||u===s?g(i).forEach(h=>{h.disabled=!0}):g(i).forEach(h=>{h.disabled=!1})}function g(i){return r.querySelectorAll(i)}}function b(c,l){const[o,p,m]=[...c],s=+p("pagination");+p("totalpages");const d=n=>{m("pagination",+n)},{$row:f,postsRow:r,pageOfCurrent:g,pageOfCurrentName:i}={...l},a=o(r),u=p("remote_location"),w=new URL(u);a.classList.add("loading"),a.querySelectorAll(".prel-header, .c-card__frame").forEach(n=>{n.setAttribute("aria-busy",!0)}),d(s),o(g)&&(o(g).innerText=s),t()&&f.scrollIntoView(),w.searchParams.set("paged",s),fetch(w.toString()).then(n=>(n.ok||console.log("Response was not ok."),n.text())).then(n=>{if(n===""){console.log("No HTML was received.");return}a.innerHTML=n,a.classList.remove("loading"),t()&&e()});function e(){f.scrollIntoView(),f.querySelector("a").focus();const n=o(i);if(!n)return console.warn(i+" not found so scrollBackUp() was stopped.");h(n)}function t(){return f.offsetHeight>window.innerHeight}function h(n){n.classList.remove("pulsate"),n.offsetWidth,n.classList.add("pulsate")}}function v(c,l,o){const[p,m,s]=[...l],d=+m("pagination"),f=+m("totalpages"),r=t=>{s("pagination",Number(t))},{linksMap:g,$row:i}={...o};for(const[t,h]of g)if(w(p(t))&&e(t)){const n=h(d);a(n)}function a(t){u(t)&&(r(t),b(l,o),k(l,{linksMap:g,$row:i}))}function u(t){return!(t<1||t>f)}function w(t){return!(!t||t.disabled)}function e(t){return c.closest(t)}}function L(c){return`<div class="page-of-wrapper">
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
                    ${c}
                </button>
            </span>
        </div>
    </div>`}const P=document.querySelectorAll(".posts-row-wrapper"),x={linkNext:".next-page",linkPrevious:".previous-page",linkLast:".page-of--total",linkFirst:".go-to-page-1",pageOf:".page-of",pageOfCurrent:".page-of--current",postsRow:".posts-row",pageOfCurrentName:".page-of--current-name",pageOfWrapper:"[data-slot=page-of-wrapper]"};P.forEach(c=>{const l={$row:c,...x},o=+u("totalpages"),p=[a,u,w],{linkFirst:m,linkLast:s,linkNext:d,linkPrevious:f}={...l};if(!(o>=2))return;const r=new Map;r.set(d,e=>e+1),r.set(f,e=>e-1),r.set(s,e=>o),r.set(m,e=>1);const{pageOfWrapper:g,pageOf:i}={...l};!a(i)&&a(g)&&(a(g).outerHTML=L(o)),a(i)&&a(i).classList.remove("hidden"),a(s)&&(a(s).innerText=o),k(p,{linksMap:r,$row:c}),c.addEventListener("click",e=>{const t=e.target;v(t,p,{linksMap:r,...l})});function a(e){return c.querySelector(e)}function u(e){return a("[data-"+e+"]").dataset[e]}function w(e,t){a("[data-"+e+"]").dataset[e]=t}});
//# sourceMappingURL=script.js.map
