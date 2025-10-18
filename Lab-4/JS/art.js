window.art = {
  async matchPaintingForWeather(weatherKeywords) {
    const artLoading = document.getElementById("art-loading");
    const artResult = document.getElementById("art-result");
    const artImg = document.getElementById("art-img");
    const artTitle = document.getElementById("art-title");
    const artArtist = document.getElementById("art-artist");
    const artDate = document.getElementById("art-date");
    const artDepartment = document.getElementById("art-department");
    const artLink = document.getElementById("art-link");

    const weatherToObjectID = {
      Thunderstorm: 384535,
      Drizzle: 437853,
      Rain: 51087,
      Snow: 437869,
      Atmosphere: 458972,
      Clear: 459095,
      Clouds: 21693
    };

    const keyword = (weatherKeywords[0] || "").toLowerCase();
    let chosenWeather = "Clear";

    if (keyword.includes("thunder")) chosenWeather = "Thunderstorm";
    else if (keyword.includes("drizzle")) chosenWeather = "Drizzle";
    else if (keyword.includes("rain")) chosenWeather = "Rain";
    else if (keyword.includes("snow")) chosenWeather = "Snow";
    else if (keyword.includes("mist") || keyword.includes("fog")) chosenWeather = "Atmosphere";
    else if (keyword.includes("cloud")) chosenWeather = "Clouds";
    else if (keyword.includes("clear") || keyword.includes("sun")) chosenWeather = "Clear";

    const objectID = weatherToObjectID[chosenWeather];
    artLoading.classList.remove("hidden");
    artResult.classList.add("hidden");
    artLoading.textContent = `Searching for a painting that captures ${chosenWeather.toLowerCase()}...`;

    try {
      const response = await fetch(`https://collectionapi.metmuseum.org/public/collection/v1/objects/${objectID}`);
      if (!response.ok) throw new Error(`Met API returned ${response.status}`);
      const data = await response.json();

      if (!data.primaryImageSmall || data.primaryImageSmall.trim() === "") {
        throw new Error("No image available for this artwork.");
      }

      artImg.src = data.primaryImageSmall;
      artImg.alt = data.title;
      artLink.href = data.objectURL;
      artTitle.textContent = data.title;
      artArtist.textContent = data.artistDisplayName || "Unknown artist";
      artDate.textContent = data.objectDate || "";
      artDepartment.textContent = data.department || "";

      artLoading.classList.add("hidden");
      artResult.classList.remove("hidden");
    } catch (error) {
      console.error("Error fetching artwork:", error);
      artImg.src = "https://images.metmuseum.org/CRDImages/ep/original/DP-13061-001.jpg";
      artImg.alt = "Fallback Landscape";
      artTitle.textContent = "Landscape with Trees";
      artArtist.textContent = "Jean-Baptiste-Camille Corot";
      artDate.textContent = "19th century";
      artDepartment.textContent = "European Paintings";
      artLink.href = "https://www.metmuseum.org/art/collection/search/436029";

      artLoading.textContent = "Showing fallback painting.";
      artLoading.classList.add("hidden");
      artResult.classList.remove("hidden");
    }
  }
};
