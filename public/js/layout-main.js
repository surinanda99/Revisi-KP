const menuDashboard = document.querySelector(".toggle-btn");
const sidebar = document.querySelector("#sidebar");

menuDashboard.addEventListener("click", function () {
  if (is_touch_device()) {
    sidebar.classList.toggle("expand");
  }
});

menuDashboard.addEventListener("mouseover", function () {
  if (!is_touch_device()) {
    sidebar.classList.add("expand");
  }
});

menuDashboard.addEventListener("mouseout", function () {
  if (!is_touch_device()) {
    sidebar.classList.remove("expand");
  }
});

const logoMenu = document.querySelector(".sidebar-logo");

logoMenu.addEventListener("mouseover", function () {
  if (!is_touch_device()) {
    sidebar.classList.add("expand");
  }
});

logoMenu.addEventListener("mouseout", function () {
  if (!is_touch_device()) {
    sidebar.classList.remove("expand");
  }
});

const sidebarLinks = document.querySelectorAll(".sidebar-link");

sidebarLinks.forEach(link => {
  link.addEventListener("mouseover", function () {
    if (!is_touch_device()) {
      sidebar.classList.add("expand");
    }
  });

  link.addEventListener("mouseout", function () {
    if (!is_touch_device()) {
      sidebar.classList.remove("expand");
    }
  });
});

function is_touch_device() {
  return window.matchMedia('(hover: none)').matches;
}

