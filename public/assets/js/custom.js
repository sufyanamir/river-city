$(document).ready(function () {

  $("#accordion-collapse").click(function () {
    $("#accordion-collapse-body").toggleClass("hidden");
  })

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

  $(".openClose-sidebar").click(function () {
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
// Get references to the necessary elements
const fileInput = document.getElementById('fileInput1');
const profileImage = document.getElementById('profileImage');
const form = document.getElementById('myForm');

// Handle file input change
fileInput.addEventListener('change', function (event) {
  const file = event.target.files[0];
  const reader = new FileReader();
  if (!$('.error-image').hasClass('d-none')) {
    $('.error-image').addClass('d-none');
  }

  // Check the file size and type of file
  if (file.type.startsWith('image/')) {
    if (file.size <= 1048576) {
      reader.readAsDataURL(file);

      reader.onload = function (e) {
        profileImage.src = e.target.result;
        form.action = "";
      };
    } else {
      $('.error-image').removeClass('d-none').text(
        'The user pic should be less than or equal to 1024KB');
      console.log("Image size exceeds the limit of 1 MB.");
      fileInput.value = "";
    }
  } else {
    $('.error-image').removeClass('d-none').text('Please select an image file.');
    console.log("Please select an image file.");
    fileInput.value = "";
  }


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