/**
 * Custom admin script: Move export button next to search box
 * Repositions the export button from the table header area
 * to be inline with the search box (to its left).
 */
function moveExportButtons() {
    document
        .querySelectorAll(".fi-ta-header-ctn")
        .forEach(function (headerCtn) {
            const header = headerCtn.querySelector(":scope > .fi-ta-header");
            const toolbar = headerCtn.querySelector(
                ":scope > .fi-ta-header-toolbar",
            );

            if (!header || !toolbar) return;

            const actions = header.querySelector(".fi-ta-actions");
            if (!actions) return;

            // Already moved? Skip
            if (actions.dataset.moved === "true") return;

            // Find the search area container in toolbar (the div with ms-auto)
            const searchArea = toolbar.querySelector(":scope > .ms-auto");
            if (searchArea) {
                // Move the actions before the first child of search area
                actions.dataset.moved = "true";
                searchArea.insertBefore(actions, searchArea.firstChild);
            }

            // Hide the now-empty header row
            header.style.display = "none";
        });
}

// Run on initial page load
document.addEventListener("DOMContentLoaded", moveExportButtons);

// Run after Livewire navigations (SPA mode)
document.addEventListener("livewire:navigated", function () {
    // Small delay to let DOM settle
    setTimeout(moveExportButtons, 100);
});

// Run after Livewire component updates (morph)
document.addEventListener("livewire:morph.updated", function () {
    setTimeout(moveExportButtons, 100);
});

// Fallback: MutationObserver to catch any DOM changes
const observer = new MutationObserver(function (mutations) {
    let shouldRun = false;
    mutations.forEach(function (mutation) {
        if (mutation.addedNodes.length > 0) {
            mutation.addedNodes.forEach(function (node) {
                if (
                    node.nodeType === 1 &&
                    (node.classList?.contains("fi-ta-header-ctn") ||
                        node.querySelector?.(".fi-ta-header-ctn"))
                ) {
                    shouldRun = true;
                }
            });
        }
    });
    if (shouldRun) {
        setTimeout(moveExportButtons, 100);
    }
});

// Start observing once DOM is ready
document.addEventListener("DOMContentLoaded", function () {
    observer.observe(document.body, { childList: true, subtree: true });
});
