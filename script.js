document.addEventListener("DOMContentLoaded", function() {
    checkLoginStatus();

    document.addEventListener("click", function(event) {
        let menu = document.getElementById("profileMenu");
        if (!event.target.closest(".profile-dropdown")) {
            menu.style.display = "none";
        }
    });
});

function checkLoginStatus() {
    let user = JSON.parse(localStorage.getItem("currentUser"));

    if (user) {
        document.getElementById("username").textContent = user.name || "User";
        document.getElementById("userProfilePic").src = user.profilePic || "default-profile.png";

        document.getElementById("profileSection").style.display = "flex";
        document.getElementById("loginMenu").style.display = "none"; // Hide login if user is logged in
    } else {
        document.getElementById("profileSection").style.display = "none";
        document.getElementById("loginMenu").style.display = "block";
    }
}

function toggleProfileMenu() {
    let menu = document.getElementById("profileMenu");
    menu.style.display = menu.style.display === "block" ? "none" : "block";
}

function logout() {
    localStorage.removeItem("currentUser");
    alert("Logged out successfully!");
    window.location.href = "index.html"; // Redirect to home page after logout
}
