const $ = (elem) => document.getElementById(elem),
  sidebar = $("sidebar"),
  btn = $("nb-toggle");

btn.addEventListener("click", () => {
  sidebar.classList.toggle("active");
});
