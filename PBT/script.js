// Function to set cookie
function setCookie(name, value, days) {
    let d = new Date();
    d.setTime(d.getTime() + days*24*60*60*1000);
    const expires = "expires=" + d.toUTCString();
    document.cookie = `${name}=${value}; ${expires}; path=/`;
}

// Function to get cookie
function getCookie(name) {
    const cookies = document.cookie.split(";");

    for(let c of cookies) {
        const [key, value] = c.trim().split("=");
        if (key === name) return value;
    }
    return null;
}


// Theme selector functionality
document.addEventListener("DOMContentLoaded", function() {
    const body = document.body;
    const themeSelector = document.getElementById("themeSelector");

    if (themeSelector) {
        themeSelector.value = body.className || "light-mode"; // default

        themeSelector.addEventListener("change", function() {
            const selectedTheme = themeSelector.value;
            body.className = selectedTheme;
            
            fetch("../config/update_theme.php", {
                method: "POST",
                headers: {"Content-Type": "application/x-www-form-urlencoded"},
                body: "theme=" + encodeURIComponent(selectedTheme)
            });
        });
    }
});

//Force reload on back/forward navigation to prevent caching issues
window.addEventListener("pageshow", function(event) {
    if (event.persisted || window.performance && window.performance.navigation.type === 2) {
        window.location.reload();
    }
});


