const OPENWEATHER_API_KEY = "17d8e57ed26bd406e6cdde57dddbbfc0";
const CITY_QUERY = "Troy,NY,US";
const UNITS = "imperial";

const weatherLoading = document.getElementById("weather-loading");
const weatherInfo = document.getElementById("weather-info");
const wDesc = document.getElementById("w-desc");
const wTemp = document.getElementById("w-temp");
const wFeels = document.getElementById("w-feels");
const wWind = document.getElementById("w-wind");
const wIcon = document.getElementById("w-icon");
const artLoading = document.getElementById("art-loading");

document.getElementById("refresh-weather").addEventListener("click", fetchWeather);

async function fetchWeather() {
  weatherLoading.classList.remove("hidden");
  weatherInfo.classList.add("hidden");
  artLoading.textContent = "Finding a painting that matches the weather…";
  artLoading.classList.remove("hidden");

  try {
    const url = `https://api.openweathermap.org/data/2.5/weather?q=${encodeURIComponent(CITY_QUERY)}&units=${UNITS}&appid=${OPENWEATHER_API_KEY}`;
    const res = await fetch(url);
    if (!res.ok) throw new Error(`Weather API error: ${res.status} ${res.statusText}`);
    const data = await res.json();

    const primary = data.weather?.[0];
    const description = primary?.description || "Unknown";
    const main = primary?.main || "Unknown";

    wDesc.textContent = `${main} — ${description}`;
    wTemp.textContent = `Temp: ${Math.round(data.main.temp)} °${UNITS === "imperial" ? "F" : "C"}`;
    wFeels.textContent = `Feels like: ${Math.round(data.main.feels_like)} °${UNITS === "imperial" ? "F" : "C"}`;
    wWind.textContent = `Wind: ${Math.round(data.wind.speed)} ${UNITS === "imperial" ? "mph" : "m/s"}`;

    wIcon.innerHTML = primary?.icon
      ? `<img src="https://openweathermap.org/img/wn/${primary.icon}@2x.png" alt="${description}">`
      : "";

    weatherLoading.classList.add("hidden");
    weatherInfo.classList.remove("hidden");

    const keywords = chooseKeywordsFromWeather(main, description);
    await window.art.matchPaintingForWeather(keywords);
  } catch (err) {
    console.error(err);
    weatherLoading.textContent = "Failed to load weather: " + err.message;
    artLoading.textContent = "Cannot search for art until weather loads.";
  }
}

function chooseKeywordsFromWeather(main, description) {
  const desc = description.toLowerCase();
  main = (main || "").toLowerCase();

  if (desc.includes("rain") || main === "rain" || desc.includes("drizzle")) return ["rain", "storm", "umbrella"];
  if (desc.includes("snow") || main === "snow") return ["snow", "winter", "snowstorm"];
  if (desc.includes("thunder") || desc.includes("storm") || main === "thunderstorm") return ["storm", "tempest"];
  if (desc.includes("clear") || main === "clear") return ["sunny", "sunset", "blue sky", "landscape"];
  if (desc.includes("cloud") || main === "clouds") return ["clouds", "sky", "landscape"];
  if (desc.includes("mist") || desc.includes("fog")) return ["fog", "mist", "haze"];

  return [main || "landscape"];
}

fetchWeather();
