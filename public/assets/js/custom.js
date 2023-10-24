$(document).ready(function () {

  $("#topbar-menubutton").click(function () {
    // $('#topbar-menu').toggleClass("hidden");
    $('#topbar-menu').toggleClass("topbar-menuEntring topbar-manuLeaving");
  });
  $("#profile-btn").click(function () {
    // $('#topbar-menu').toggleClass("hidden");
    $('#profile-menu').toggleClass("topbar-menuEntring topbar-manuLeaving");
  });
  $("#action-menubutton").click(function () {
    // $('#topbar-menu').toggleClass("hidden");
    $('#action-menu').toggleClass("topbar-menuEntring topbar-manuLeaving");
  });

  // Dropdown Function
  function dropdown(submenuId, arrowId, dropdownId, dropdownText) {
    $("#" + submenuId).toggleClass("hidden");
    $("#" + dropdownId).toggleClass("bg-white");
    $("#" + dropdownText).toggleClass("text-[#930027]");
    $("#" + arrowId).toggleClass("rotate-180 text-[#930027]");
  }

  $(".openClose-sidebar").click(function(){
    $(".sidebar").toggleClass("w-[0px]"); // Assuming the sidebar width is initially set to 0
    $(".main-container").toggleClass("ml-[250px]");
    $(".main-container").toggleClass("rounded-l-none");

  })

  // Click events for dropdowns
  $("#dropdown-card1").click(function () {
    dropdown('submenu1', 'arrow1', 'dropdown-card1', 'dropdown-text1');
  });

  $("#dropdown-card2").click(function () {
    dropdown('submenu2', 'arrow2', 'dropdown-card2', 'dropdown-text2');
  });

  new DataTable('#example');

});
// function dropdown(submenuId, arrowId, dropdownId ,dropdownText) {
//   document.querySelector("#" + submenuId).classList.toggle("hidden");
//   document.querySelector("#" + dropdownId).classList.toggle("bg-white");
//   document.querySelector("#" + dropdownText).classList.toggle("text-[#930027]");
//   document.querySelector("#" + arrowId).classList.toggle("rotate-180");
//   document.querySelector("#" + arrowId).classList.toggle("text-[#930027]");
// }
// function openSidebar() {
//   document.querySelector(".sidebar").classList.toggle("w-[0]");
//   document.querySelector(".main-container").classList.toggle("ml-[0px]");
//   document.querySelector(".main-container").classList.toggle("rounded-l-none");
// }     