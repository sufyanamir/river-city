function dropdown() {
  document.querySelector("#submenu").classList.toggle("hidden");
  document.querySelector("#arrow").classList.toggle("rotate-0");
}
dropdown();

function openSidebar() {
  document.querySelector(".sidebar").classList.toggle("w-[0]");
  document.querySelector(".main-container").classList.toggle("ml-[0px]");
  document.querySelector(".main-container").classList.toggle("rounded-l-none");
}     