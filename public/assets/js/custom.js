function dropdown(submenuId, arrowId, dropdownId ,dropdownText) {
  document.querySelector("#" + submenuId).classList.toggle("hidden");
  document.querySelector("#" + dropdownId).classList.toggle("bg-white");
  document.querySelector("#" + dropdownText).classList.toggle("text-[#930027]");
  document.querySelector("#" + arrowId).classList.toggle("rotate-180");
  document.querySelector("#" + arrowId).classList.toggle("text-[#930027]");
}
function openSidebar() {
  document.querySelector(".sidebar").classList.toggle("w-[0]");
  document.querySelector(".main-container").classList.toggle("ml-[0px]");
  document.querySelector(".main-container").classList.toggle("rounded-l-none");
}     