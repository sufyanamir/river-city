function dropdown(submenuId, arrowId) {
  document.querySelector("#" + submenuId).classList.toggle("hidden");
  document.querySelector("#" + arrowId).classList.toggle("rotate-180");
}
function openSidebar() {
  document.querySelector(".sidebar").classList.toggle("w-[0]");
  document.querySelector(".main-container").classList.toggle("ml-[0px]");
  document.querySelector(".main-container").classList.toggle("rounded-l-none");
}     