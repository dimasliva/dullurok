const mobileMenuButton = document.getElementById("mobile-menu-button");
const mobileMenu = document.getElementById("mobile-menu");

mobileMenuButton.addEventListener("click", () => {
  mobileMenu.classList.toggle("hidden");
  mobileMenuButton.querySelector("svg:first-child").classList.toggle("hidden");
  mobileMenuButton.querySelector("svg:last-child").classList.toggle("hidden");
});
document.addEventListener("DOMContentLoaded", function () {
  const toggleButton = document.getElementById("toggle-sidebar");
  const sidebar = document.getElementById("sidebar");

  toggleButton.addEventListener("click", function () {
    sidebar.classList.toggle("-translate-x-full");
  });

  // Закрытие sidebar при клике вне его области
  document.addEventListener("click", function (event) {
    const isClickInsideSidebar = sidebar.contains(event.target);
    const isClickToggleButton = toggleButton.contains(event.target);

    // Если клик был вне sidebar и не на кнопке
    if (!isClickInsideSidebar && !isClickToggleButton) {
      sidebar.classList.add("-translate-x-full"); // Закрываем sidebar
    }
  });
});
