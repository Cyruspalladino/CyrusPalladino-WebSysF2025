const navList = document.getElementById('nav-items');
const previewTitle = document.getElementById('preview-title');
const previewDesc = document.getElementById('preview-description');

function buildNav() {
    navList.innerHTML = '';

    const lectures = courseData.Websys_course.Lectures;
    const labs = courseData.Websys_course.Labs;

    // Add lectures
    for (const key in lectures) {
        const li = document.createElement('li');
        li.textContent = key;
        li.onclick = () => showPreview(lectures[key]);
        navList.appendChild(li);
    }

    // Add labs
    for (const key in labs) {
        const li = document.createElement('li');
        li.textContent = key;
        li.onclick = () => showPreview(labs[key]);
        navList.appendChild(li);
    }
}

function showPreview(item) {
    previewTitle.textContent = item.Title;
    previewDesc.textContent = item.Description;
}

function refreshContent() {
    location.reload();
}

buildNav();
