// use await instead and add it at the end?
// import page_of from 'https://codepen.io/nonsalant/pen/aa624500ad336a82b27dcc0677571897.js';
import page_of from "./page_of.js"
import updateCurrent from "./_update_current.js"
// import refreshArrows from "./_refresh_arrows.js"

/////
document.addEventListener("DOMContentLoaded", () => {
  const posts_rows = document.querySelectorAll("[id^='posts-row-wrapper']");

  posts_rows.forEach((row) => {
    processRow(row)
  }) // end of posts_rows.forEach
}); // end of addEventListener
/////

/// move this to a module w/ exports default
/// and use {processRow} = import from process-row.js
/// ?should this be ...= async (row) => ...
const processRow = (row) => {
  const totalpages = row.querySelector("[data-totalpages]").dataset.totalpages;
  // let pagination = 1;
  const linkNext = row.querySelector(".next-page");
  const linkPrevious = row.querySelector(".previous-page");
  let remoteElement = row.querySelector("[data-pagination]");

  // 🚩 page_of being used here
  page_of(row);

  // ✂️ updateCurrent def. was taken from here

  // fetchPage def. was taken from here


  // use for each if using 2 pairs of arrows (ie: in heading_details)

  if (totalpages > 1) {
    // still needed in case show-arrows was used but it didn't paginate
    linkPrevious.classList.remove("hidden");
    linkNext.classList.remove("hidden");
  }

  linkNext.addEventListener("click", () => {
    const pagination = +remoteElement.dataset.pagination;
    updateCurrent(row, pagination + 1);
  });

  linkPrevious.addEventListener("click", () => {
    const pagination = +remoteElement.dataset.pagination;
    updateCurrent(row, pagination - 1);
  });

}