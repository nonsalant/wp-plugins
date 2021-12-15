import page_of from "./page_of.js"
import refreshArrows from "./_refresh_arrows.js"

const fetchPage = async (row, pagination) => {
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

const updateCurrent = async (row, pagination) => {
    if (pagination < 1) {
        pagination = 1;
    }
    let remoteElement = row.querySelector("[data-pagination]");

    const html = await fetchPage(row, pagination);

    remoteElement.innerHTML = html;
    remoteElement.dataset.pagination = pagination;
    // row.querySelector("[data-pagination]").dataset.pagination = pagination;

    //for (components as component) { component.update(row) }

    // 🚩 page_of being used here
    page_of.update(row, pagination)

    row.querySelector(".posts-row").classList.remove("loading");

    // scroll back up only on mobile
    if (window.innerWidth <= 680) {

        row.scrollIntoView();

        // pulsate heading
        const targetElement = row.querySelector(".posts-row-wrapper-header");
        targetElement?.classList.remove("pulsate");
        void targetElement?.offsetWidth; // trigger a reflow
        targetElement?.classList.add("pulsate");

        // 🚩 page_of WAS being used here

    }

    refreshArrows(row);
}

export default updateCurrent