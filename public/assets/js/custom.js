$(document).ready(function () {
  // Listen for form submissions
  $(document).on('submit', 'form', function (event) {
    // Prevent the default form submission
    event.preventDefault();

    // Get the form data
    var formData = $(this).serialize();

    // Get the form action
    var formAction = $(this).attr('action');

    // Make the AJAX request
    $.ajax({
      type: 'POST',
      url: formAction,
      data: formData,
      success: function (response) {
        if (response.success == true) {
          // Handle success, if needed
          handleSuccess(response);
        } else if (response.success == false) {
          // Handle failure, if needed
          handleFailure(response);
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        // Log the error response to the console
        console.error("AJAX Error: " + textStatus, errorThrown);

        // Log the response content for further investigation
        console.log("Response:", jqXHR.responseText);

        // Handle the error here
        handleFailure(JSON.parse(jqXHR.responseText));
      }
    });
  });

  function handleSuccess(response) {
    // Redirect to the dashboard or do something else
    $('.text').removeClass('hidden');
    $('.spinner').addClass('hidden');
    Swal.fire(
      'Success!',
      response.message,
      'success'
    );
    setTimeout(
      location.reload()
      ,
      2000
    );
    // $("#universalTableBody").load(location.href + "#universalTableBody > *");
    // $(".itemDiv").load(location.href + ".itemDiv > *");
    // $(".modal-close").trigger("click");
    // $("#formData")[0].reset();
    // window.location.href = "/dashboard";
  }

  function handleFailure(response) {
    Swal.fire(
      'Warning!',
      response.message,
      'warning'
    );
    // Additional failure handling if needed
    $('.text').removeClass('hidden');
    $('.spinner').addClass('hidden');
    $('#loginBtn').attr('disabled', false);
  }

  $("#accordion-collapse").click(function () {
    $("#accordion-collapse-body").toggleClass("hidden");
  })

  $("#topbar-menubutton").click(function (e) {
    e.stopPropagation(); // Prevents the click event from reaching the document body
    $('#topbar-menu').toggleClass("topbar-menuEntring topbar-manuLeaving");
  });

  $(document).on('click', function (e) {
    if (!$("#topbar-menubutton").is(e.target) && !$('#topbar-menu').has(e.target).length) {
      // Click occurred outside the button and dropdown, hide the dropdown
      $('#topbar-menu').addClass("topbar-manuLeaving").removeClass("topbar-menuEntring");
    }
  });

  $("#profile-btn").click(function (e) {
    e.stopPropagation(); // Prevents the click event from reaching the document body
    $('#profile-menu').toggleClass("topbar-menuEntring topbar-manuLeaving");
  });

  $(document).on('click', function (e) {
    if (!$("#profile-btn").is(e.target) && !$('#profile-menu').has(e.target).length) {
      // Click occurred outside the button and dropdown, hide the dropdown
      $('#profile-menu').addClass("topbar-manuLeaving").removeClass("topbar-menuEntring");
    }
  });

  $("#action-menubutton").click(function (e) {
    // $('#topbar-menu').toggleClass("hidden");
    e.stopPropagation();
    $('#action-menu').toggleClass("topbar-menuEntring topbar-manuLeaving");
  });
  $(document).on('click', function (e) {
    if (!$("#action-menubutton").is(e.target) && !$('#action-menubutton').has(e.target).length) {
      // Click occurred outside the button and dropdown, hide the dropdown
      $('#action-menu').addClass("topbar-manuLeaving").removeClass("topbar-menuEntring");
    }
  })
  $('#emailAttachmentsCheck').click(function () {
    $("#emailAttachmentsfile").toggleClass("hidden");
  });
  // Dropdown Function
  function dropdown(submenuId, arrowId, dropdownId, dropdownText) {
    $("#" + submenuId).toggleClass("hidden");
    $("#" + dropdownId).toggleClass("bg-white");
    $("#" + dropdownText).toggleClass("text-[#930027]");
    $("#" + arrowId).toggleClass("rotate-180 text-[#930027]");
  }

  $(".open-sidebar").click(function () {
    $(".sidebar").toggleClass("w-[0px]"); // Assuming the sidebar width is initially set to 0
    $(".main-container").toggleClass("ml-[250px]");
    $(".main-container").toggleClass("rounded-l-none");
    $(".open-sidebar").addClass("hidden");

  })
  $(".openClose-sidebar").click(function () {
    $(".sidebar").toggleClass("w-[0px]"); // Assuming the sidebar width is initially set to 0
    $(".main-container").toggleClass("ml-[250px]");
    $(".main-container").toggleClass("rounded-l-none");
    $(".open-sidebar").removeClass("hidden");
  })

  // Click events for dropdowns
  $("#dropdown-card1").click(function () {
    dropdown('submenu1', 'arrow1', 'dropdown-card1', 'dropdown-text1');
  });

  $("#dropdown-card2").click(function () {
    dropdown('submenu2', 'arrow2', 'dropdown-card2', 'dropdown-text2');
  });
  $("#user-dropdown-card1").click(function () {
    dropdown('user-submenu1', 'user-arrow1', 'user-dropdown-card1', 'user-dropdown-text1');
  });
  $("#crew-dropdown-card1").click(function () {
    dropdown('crew-submenu1', 'crew-arrow1', 'crew-dropdown-card1', 'crew-dropdown-text1');
  });

  new DataTable('#universalTable');

  window.voice = function (buttonId, textareaId) {
    var recognition = new webkitSpeechRecognition();
    recognition.lang = "en-US";
    recognition.onresult = function (event) {
      console.log(event);
      var existingText = $("#" + textareaId).val();
      var newText = event.results[0][0].transcript;
      $("#" + textareaId).val(existingText + ' ' + newText);
      $('.speak-icon').removeClass('fa-beat-fade');
    };
    recognition.start();
    $('.speak-icon').addClass('fa-beat-fade');
    // Disable the button while recording
    $("#" + buttonId).prop("disabled", true);

    // Enable the button after recording ends
    recognition.onend = function () {
      $("#" + buttonId).prop("disabled", false);
    };
  }

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