$(document).ready(function() {
    const artDiv = $("#art");
    const weatherElement = document.getElementById("mainData");

    function displayArt(objectUrl, loadingText) {
        artDiv.html(`<p>${loadingText}</p>`);

        $.getJSON(objectUrl)
            .done(function(obj) {
                if (!obj.primaryImageSmall) {
                    artDiv.html("No image available for this artwork.");
                    return;
                }
                artDiv.html(`
                    <img src="${obj.primaryImageSmall}" alt="${obj.title}">
                    <h2>${obj.title}</h2>
                    <p><em>${obj.artistDisplayName || "Unknown artist"}</em> (${obj.objectDate || "date unknown"})</p>
                `);
            })
            .fail(() => artDiv.html("Error loading artwork details."));
    }

    const observer = new MutationObserver(() => {
        const weatherText = weatherElement.innerText;

        if (weatherText.includes("Thunderstorm")) {
            observer.disconnect();
            displayArt("https://collectionapi.metmuseum.org/public/collection/v1/objects/384535", "Searching for painting of thunderstorm...");
        }
        else if (weatherText.includes("Drizzle")) {
            observer.disconnect();
            displayArt("https://collectionapi.metmuseum.org/public/collection/v1/objects/755791", "Searching for painting of drizzle...");
        }
        else if (weatherText.includes("Rain")) {
            observer.disconnect();
            displayArt("https://collectionapi.metmuseum.org/public/collection/v1/objects/51087", "Searching for painting of rain...");
        }
        else if (weatherText.includes("Snow")) {
            observer.disconnect();
            displayArt("https://collectionapi.metmuseum.org/public/collection/v1/objects/849540", "Searching for painting of snow...");
        }
        else if (weatherText.includes("Atmosphere")) {
            observer.disconnect();
            displayArt("https://collectionapi.metmuseum.org/public/collection/v1/objects/755791", "Searching for painting of atmosphere...");
        }
        else if (weatherText.includes("Clear")) {
            observer.disconnect();
            displayArt("https://collectionapi.metmuseum.org/public/collection/v1/objects/459095", "Searching for painting of clear...");
        }
        else if (weatherText.includes("Clouds")) {
            observer.disconnect();
            displayArt("https://collectionapi.metmuseum.org/public/collection/v1/objects/21693", "Searching for painting of clouds...");
        }
    });

    observer.observe(weatherElement, { childList: true, subtree: true, characterData: true });
});
