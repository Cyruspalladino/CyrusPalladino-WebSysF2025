const apiKey = "17d8e57ed26bd406e6cdde57dddbbfc0";
const lat = 42.7284;
const lon = -73.6918;
const url = `https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&appid=${apiKey}&units=metric`;

function capital(str) {
  return str
    .split(" ")
    .map(word => word.charAt(0).toUpperCase() + word.slice(1))
    .join(" ");
}

fetch(url)
  .then(response => response.json())
  .then(data => {
    const temp = data.main.temp;
    const desc = capital(data.weather[0].description);
    const main = data.weather[0].main;
    const icon = data.weather[0].icon;
    const iconUrl = `https://openweathermap.org/img/wn/${icon}@2x.png`;
    const wind = data.wind.speed;
    const humidity = data.main.humidity;

    document.getElementById("location").textContent = "Troy, NY";
    document.getElementById("temperature").textContent = `${temp}°C`;
    document.getElementById("condition").textContent = desc;
    document.getElementById("icon").src = iconUrl;
    document.getElementById("icon").alt = desc;
    document.getElementById("mainData").textContent = main;
    document.getElementById("wind").textContent = `Wind: ${wind} m/s`;
    document.getElementById("humidity").textContent = `Humidity: ${humidity}%`;
  })
  .catch(error => console.error("Error:", error));
