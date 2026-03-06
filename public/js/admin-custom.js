/**
 * Custom admin script: Move export button next to search box
 * Repositions the export button from the table header area
 * to be inline with the search box (to its left).
 */
function moveExportButtons() {
    const containers = document.querySelectorAll(".fi-ta-header-ctn");
    containers.forEach((container) => {
        // Find the destination area (next to the search textbox)
        const searchArea = container.querySelector(
            ".fi-ta-header-toolbar > .ms-auto",
        );
        if (!searchArea) return;

        // Check the original header row
        const originalHeader = container.querySelector(
            ":scope > .fi-ta-header",
        );
        if (originalHeader) {
            // Find actions inside the header
            const actions = originalHeader.querySelector(".fi-ta-actions");
            if (actions) {
                // Move the actions to be the first element in the search area
                searchArea.insertBefore(actions, searchArea.firstChild);
            }
            // Hide the original header row completely since it's empty now
            originalHeader.style.display = "none";
        }
    });

    // Handle duplicate header elements that Livewire might leave behind
    const orphanedHeaders = document.querySelectorAll(".fi-ta-header:empty");
    orphanedHeaders.forEach((header) => {
        header.style.display = "none";
    });
}

// Function to schedule the move safely (prevents infinite loops & layout thrashing)
let scheduled = false;
function scheduleMove() {
    if (!scheduled) {
        scheduled = true;
        requestAnimationFrame(() => {
            moveExportButtons();
            scheduled = false;
        });
    }
}

// Initialize on page load
document.addEventListener("DOMContentLoaded", scheduleMove);

// A highly robust observer to instantly catch any Livewire DOM replacements
const observer = new MutationObserver((mutations) => {
    let shouldRun = false;
    for (let i = 0; i < mutations.length; i++) {
        if (mutations[i].addedNodes.length > 0) {
            shouldRun = true;
            break;
        }
    }
    if (shouldRun) {
        scheduleMove();
    }
});

// Start observing as soon as possible
if (document.body) {
    observer.observe(document.body, { childList: true, subtree: true });
} else {
    document.addEventListener("DOMContentLoaded", () => {
        observer.observe(document.body, { childList: true, subtree: true });
    });
}

// Also hook into Livewire directly just to be 100% safe
document.addEventListener("livewire:initialized", () => {
    Livewire.hook("morph.updated", scheduleMove);
    Livewire.hook("commit", ({ succeed }) => {
        succeed(() => {
            // After any livewire roundtrip completes
            setTimeout(scheduleMove, 10);
        });
    });
});
