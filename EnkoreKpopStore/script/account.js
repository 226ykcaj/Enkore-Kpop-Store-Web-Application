//For account.php login change to register
// This event listener ensures that the script runs after the HTML content has fully loaded
document.addEventListener("DOMContentLoaded", () => {
    // Get references to the login and register tabs and forms
    const loginTab = document.getElementById("loginTab");
    const registerTab = document.getElementById("registerTab");
    const loginForm = document.getElementById("login-con");
    const registerForm = document.getElementById("register-con");

    // Add event listener to the login tab
    loginTab.addEventListener("click", () => {
        // Add 'active' class to login tab and remove it from register tab
        loginTab.classList.add("active");
        registerTab.classList.remove("active");
        // Display login form and hide register form
        loginForm.style.display = "block";
        registerForm.style.display = "none";
    });

    // Add event listener to the register tab
    registerTab.addEventListener("click", () => {
        // Add 'active' class to register tab and remove it from login tab
        registerTab.classList.add("active");
        loginTab.classList.remove("active");
        // Display register form and hide login form
        registerForm.style.display = "block";
        loginForm.style.display = "none";
    });
});
