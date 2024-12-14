document.getElementById("submit").addEventListener("click", function() {
    const region = document.getElementById("region").value;
    const description = document.getElementById("description").value;

    if (description.trim() === "") {
        alert("Please provide a brief description of your project.");
        return;
    }

    alert(`Your project proposal has been submitted!\nRegion: ${region}\nDescription: ${description}`);
});

// Optional: Add functionality to load recent projects dynamically
const projects = [
    "Community Park Improvement",
    "Public Library Renovation",
    "Waste Management System Upgrade",
    "New Pedestrian Walkways"
];

const slider = document.querySelector(".slider");
projects.forEach(project => {
    const projectItem = document.createElement("div");
    projectItem.classList.add("project-item");
    projectItem.textContent = project;
    slider.appendChild(projectItem);
});
