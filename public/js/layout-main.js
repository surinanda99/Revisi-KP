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

// scroller
const scrollers = document.querySelectorAll(".scroller");
if (!window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
  addAnimation();
}

function addAnimation() {
  scrollers.forEach((scroller) => {
    scroller.setAttribute("data-animated", true);
    const scrollerInner = scroller.querySelector(".scroller__inner");
    const scrollerContent = Array.from(scrollerInner.children);
    scrollerContent.forEach((item) => {
      const duplicatedItem = item.cloneNode(true);
      duplicatedItem.setAttribute("aria-hidden", true);
      scrollerInner.appendChild(duplicatedItem);
    });
  });
}