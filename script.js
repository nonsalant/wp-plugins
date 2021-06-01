const posts_rows = document.querySelectorAll("[id^='posts-row-wrapper']");
let i = 0;

posts_rows.forEach((row) => {
  i++;
  const totalpages = row.querySelector("[data-totalpages]").dataset.totalpages;
  let pagination = 1;
  const linkNext = row.querySelector(".next-page");
  const linkPrevious = row.querySelector(".previous-page");
  let remoteElement = row.querySelector("[data-pagination]");

  //
  let pageOfTotal = row.querySelector(".page-of .page-of--total");
  pageOfTotal.innerHTML = row.querySelector("[data-totalpages]").dataset.totalpages;
  pageOfTotal.addEventListener("click", (e) => {
    pagination = totalpages;
    fetchPage(pagination);
    e.preventDefault();
  });

  //
  row.querySelector(".go-to-page-1").addEventListener("click", (e) => {
    pagination = 1;
    fetchPage(pagination);
    e.preventDefault();
  });

  const fetchPage = (pagination) => {

    const ssr_location = row.querySelector("[data-ssr_location]").dataset.ssr_location;
    //"/ssr/?heading=$heading&ids=$ids&cat=$cat&link=$link&button=$button";
    row.querySelector(".featured-posts-grid").classList.add("loading");

    fetch(ssr_location + "&pagination=" + pagination)
      .then(function (response) {
        return response.text();
      })
      .then(function (html) {
        remoteElement.innerHTML = html;
        remoteElement.dataset.pagination = pagination;

        //
        row.querySelector(".page-of--current").innerHTML = row.querySelector("[data-pagination]").dataset.pagination;
        //refreshArrows();

        row.querySelector(".featured-posts-grid").classList.remove("loading");
        
        // scroll back up only on mobile
        if (window.innerWidth <= 680) { 
          row.scrollIntoView();

          // pulsate heading
          targetElement = row.querySelector("h2.widget__title")
          targetElement.classList.remove("pulsate")
          void targetElement.offsetWidth // trigger a reflow
          targetElement.classList.add("pulsate")

          // show .go-to-page-1 on following pages
          if (pagination < 2) { // ℹ️ 2 or 3
            // un-hide .go-to-page-1
            row.querySelector(".go-to-page-1").classList.add("hidden");
          } else {
            // hide .go-to-page-1
            row.querySelector(".go-to-page-1").classList.remove("hidden");
          }
          
        }
  
      })
      .catch(function (err) {
        console.warn("Something went wrong.", err);
        row
          .querySelector(".featured-posts-grid")
          .classList.remove("loading");
      });
    
    refreshArrows();
  };

  const refreshArrows = () => {
    if (pagination < 2) {
      linkPrevious.disabled = true;
    } else {
      linkPrevious.disabled = false;
    }
    if (pagination >= totalpages) {
      linkNext.disabled = true;
    } else {
      linkNext.disabled = false;
    }
  };

  if (totalpages > 1) {
    linkPrevious.classList.remove("hidden");
    linkNext.classList.remove("hidden");
    row.querySelector(".page-of").classList.remove("hidden");
    refreshArrows();
  }

  linkNext.addEventListener("click", () => {
    pagination++;
    fetchPage(pagination);
  });

  linkPrevious.addEventListener("click", () => {
    pagination--;
    fetchPage(pagination);
  });
});
