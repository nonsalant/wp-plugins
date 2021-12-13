import updateCurrent from "./_update_current.js"
import refreshArrows from "./_refresh_arrows.js"

// 🚩 page_of is defined here
const page_of = (row) => {
    const pageOfTotal = row.querySelector(".page-of .page-of--total");
    // let totalpages
    const totalpages = row.querySelector("[data-totalpages]").dataset.totalpages
    pageOfTotal.innerText = totalpages
    pageOfTotal.addEventListener("click", (e) => {
        updateCurrent(row, totalpages);
        e.preventDefault();
    });
    //
    row.querySelector(".go-to-page-1").addEventListener("click", (e) => {
        updateCurrent(row, 1);
        e.preventDefault();
    });

    if (totalpages > 1) {
        // 🚩 page_of being used here to show page_of on multi-page rows
        row.querySelector(".page-of").classList.remove("hidden");
        refreshArrows(row);
    } // ? still needed if 0 js by default? yes, in case show-arrows but it didn't paginate

}

page_of.update = (row, pagination) => {
    row.querySelector(".page-of--current").innerHTML = row.querySelector("[data-pagination]").dataset.pagination;

    // mobile only: hide "back to 1st page" link on 1st page
    if (window.innerWidth <= 680) {
        // show .go-to-page-1 on following pages
        if (pagination < 3) { // ℹ️ 2 or 3
            // un-hide .go-to-page-1
            row.querySelector(".go-to-page-1").classList.add("hidden");
        } else {
            // hide .go-to-page-1
            row.querySelector(".go-to-page-1").classList.remove("hidden");
        }
    }
}

export default page_of