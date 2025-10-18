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

    // Map weather keywords to local images
    const weatherImages = {
      thunderstorm: "../Images/thunderstorm.jpg",
      drizzle: "../Images/drizzle.jpg",
      rain: "../Images/rain.jpg",
      snow: "../Images/snow.jpg",
      fog: "../Images/fog.jpg",
      clouds: "../Images/cloud.jpg",
      clear: "../Images/clear.jpg"
    };

    const keyword = (weatherKeywords[0] || "").toLowerCase();
    let chosenWeather = "clear";

    if (keyword.includes("thunder")) chosenWeather = "thunderstorm";
    else if (keyword.includes("drizzle")) chosenWeather = "drizzle";
    else if (keyword.includes("rain")) chosenWeather = "rain";
    else if (keyword.includes("snow")) chosenWeather = "snow";
    else if (keyword.includes("mist") || keyword.includes("fog")) chosenWeather = "fog";
    else if (keyword.includes("cloud")) chosenWeather = "clouds";
    else if (keyword.includes("clear") || keyword.includes("sun")) chosenWeather = "clear";

    const localImage = weatherImages[chosenWeather] || weatherImages.clear;

    artLoading.classList.remove("hidden");
    artResult.classList.add("hidden");
    artLoading.textContent = `Showing painting for "${chosenWeather}" weather...`;

    try {
      // Use local image
      artImg.src = localImage;
      artImg.alt = `Painting representing ${chosenWeather}`;
      artTitle.textContent = `Painting: ${chosenWeather}`;
      artArtist.textContent = "Local Artwork";
      artDate.textContent = "";
      artDepartment.textContent = "";
      artLink.href = "#";

      artLoading.classList.add("hidden");
      artResult.classList.remove("hidden");
    } catch (err) {
      console.error(err);
      artLoading.textContent = "Failed to load local image.";
    }
  }
};
