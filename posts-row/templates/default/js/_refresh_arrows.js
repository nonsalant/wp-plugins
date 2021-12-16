// use for each if using 2 pairs of arrows (ie: in heading_details)
const refreshArrows = (row) => {
    const totalpages = row.querySelector("[data-totalpages]").dataset.totalpages
    const pagination = row.querySelector("[data-pagination]").dataset.pagination

    // use for each if using 2 pairs of arrows (ie: in heading_details)
    const linkNext = row.querySelector(".next-page");
    const linkPrevious = row.querySelector(".previous-page");

    console.log(pagination + " of " + totalpages)

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

export default refreshArrows