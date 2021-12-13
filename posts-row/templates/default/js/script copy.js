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
    updateCurrent(pagination);
    e.preventDefault();
  });

  //
  row.querySelector(".go-to-page-1").addEventListener("click", (e) => {
    pagination = 1;
    updateCurrent(pagination);
    e.preventDefault();
  });

  const updateCurrent = async (pagination) => {

    const html = await fetchPage(pagination);

    remoteElement.innerHTML = html;
    remoteElement.dataset.pagination = pagination;

    //
    row.querySelector(".page-of--current").innerHTML = row.querySelector("[data-pagination]").dataset.pagination;

    row.querySelector(".posts-row").classList.remove("loading");
    
    // scroll back up only on mobile
    if (window.innerWidth <= 680) {
      
      row.scrollIntoView();

      // pulsate heading
      let targetElement = row.querySelector(".posts-row-wrapper-header");
      targetElement.classList.remove("pulsate");
      void targetElement.offsetWidth; // trigger a reflow
      targetElement.classList.add("pulsate");

      // show .go-to-page-1 on following pages
      if (pagination < 3) { // ℹ️ 2 or 3
        // un-hide .go-to-page-1
        row.querySelector(".go-to-page-1").classList.add("hidden");
      } else {
        // hide .go-to-page-1
        row.querySelector(".go-to-page-1").classList.remove("hidden");
      }
      
    }

    refreshArrows();
  }

  const fetchPage = async (pagination) => {

    const remote_location = row.querySelector("[data-remote_location]").dataset.remote_location;
    //"/api/?heading=$heading&ids=$ids&cat=$cat&link=$link&button=$button";

    row.querySelector(".posts-row").classList.add("loading");

    try {
      const response = await fetch(remote_location + "&paged=" + pagination, {
        headers: {
          Accept: "text/plain", //Accept: "application/json"
        }
      })

      let data = await response.text(); //const data = await response.json();
      return data;
      
    } catch (err) {
      console.warn("⚠ Something went wrong.", err);
      row.querySelector(".posts-row").classList.remove("loading");
    }
      
    
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
    updateCurrent(pagination);
  });

  linkPrevious.addEventListener("click", () => {
    pagination--;
    updateCurrent(pagination);
  });

}); // end of posts_rows.forEach