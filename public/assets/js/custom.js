$(document).ready(function () {
  topbar.config({
    autoRun: false,
    barThickness: 3,
    barColors: {
      '0': '#930027'
    },
    shadowBlur: 5,
    shadowColor: 'rgba(0, 0, 0, .5)',
    className: 'topbar',
  })
  topbar.show();
  (function step() {
    setTimeout(function () {
      if (topbar.progress('+.01') < 1) step()
    }, 16)
  })()
  $(window).on('load', function () {
    topbar.hide();
  });
  // Listen for form submissions
  // Listen for form submissions
  $(document).on('submit', 'form', function (event) {
    event.preventDefault();

    var $form = $(this); // cache the form
    var formData = new FormData(this);
    var apiUrl = $form.attr('action');

    // Disable all buttons inside this form
    $form.find('button, input[type="submit"]').prop('disabled', true);

    $.ajax({
      type: 'POST',
      url: apiUrl,
      data: formData,
      processData: false,
      contentType: false,
      beforeSend: function () {
        if (apiUrl != '/sendChat') {
          $('.text').addClass('hidden');
          $('.spinner').removeClass('hidden');
        }
        topbar.config({
          autoRun: false,
          barThickness: 3,
          barColors: { '0': '#930027' },
          shadowBlur: 5,
          shadowColor: 'rgba(0, 0, 0, .5)',
          className: 'topbar',
        });
        topbar.show();
        (function step() {
          setTimeout(function () {
            if (topbar.progress('+.01') < 1) step()
          }, 16);
        })();
      },
      success: function (response) {
        if (response.success == true) {
          if (apiUrl != '/sendChat') {
            handleSuccess(response);
          }
          if (apiUrl == '/addEstimate' || apiUrl == '/setScheduleWork' || apiUrl == '/setScheduleEstimate' || apiUrl == '/sendProposal') {
            window.location.assign('/viewEstimate/' + response.estimate_id);
          } else if (apiUrl == '/sendChat') {
            $('#message').val('');
            $('#imageAudioPlayback').hide();
            document.getElementById('messageSound').play();
            loadLatestMessages();
            scrollToBottom();
            topbar.hide();
          } else {
            setInterval(location.reload(), 5000);
          }
        } else if (response.success == false) {
          handleFailure(response);
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error("AJAX Error: " + textStatus, errorThrown);
        console.log("Response:", jqXHR.responseText);
        handleFailure(JSON.parse(jqXHR.responseText));
      },
      complete: function () {
        // No matter success or error, re-enable buttons
        $form.find('button, input[type="submit"]').prop('disabled', false);

        // Also reset loading state
        $('.text').removeClass('hidden');
        $('.spinner').addClass('hidden');
        topbar.hide();
      }
    });
});


  function loadLatestMessages() {
    var estimateId = $('#estimate_id').val();
    $.ajax({
      url: '/getLatestMessages/' + estimateId,
      type: 'GET',
      success: function (response) {
        if (response.success) {
          let oldMessages = $('#chat-dialog').html();
          if (oldMessages != response.messages) {
            $('#chat-dialog').html(response.messages);
            // Call the scrollToBottom function after updating messages
            if (typeof scrollToBottom == 'function') {
              scrollToBottom();
            }

            // Play message received sound
            // document.getElementById('messageSound').play();
          }
        }
      }
    });
  }
  // Scroll chat to the bottom automatically
  function scrollToBottom() {
    var chatDialog = document.getElementById('chat-dialog');
    var chatContainer = chatDialog.closest('.overflow-auto');
    if (chatContainer) {
      chatContainer.scrollTop = chatContainer.scrollHeight;
    }
  }

  setInterval(function () {
    loadLatestMessages();
  }, 5000);

  function handleSuccess(response) {
    // Redirect to the dashboard or do something else
    $('.text').removeClass('hidden');
    $('.spinner').addClass('hidden');
    Swal.fire(
      'Success!',
      response.message,
      'success'
    );
    topbar.hide();
    // $('.save-btn').attr('disabled', false);
    // $('.save-btn').addClass('bg-[#930027]');
    // $('.save-btn').removeClass('bg-[#0000]');
    //   var formData = new FormData($('form')[0]); // Assuming the form is the first and only form on the page
    // var estimateId = formData.get('estimate_id');

    // Reload the chat messages after successful submission
    // if (estimateId) {
    //   $.ajax({
    //     type: 'GET',
    //     url: '/estimates/getChatMessage/' + estimateId,
    //     success: function (response) {
    //       if (response.success) {
    //         // Update the chat messages container with the retrieved messages
    //         $('.chat-messages-container').html(response.html);
    //       } else {
    //         console.error(response.message);
    //       }
    //     },
    //     error: function (jqXHR, textStatus, errorThrown) {
    //       console.error("AJAX Error: " + textStatus, errorThrown);
    //       console.log("Response:", jqXHR.responseText);
    //     }
    //   });
    // }
    // $("#universalTableBody").load(location.href + " #universalTableBody > *");
    // $("#chat-dialog").load(location.href + " #chat-dialog > *");
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
    topbar.hide();
    // Additional failure handling if needed
    $('.text').removeClass('hidden');
    $('.spinner').addClass('hidden');
    $('#loginBtn').attr('disabled', false);
    // $('.save-btn').attr('disabled', false);
    // $('.save-btn').addClass('bg-[#930027]');
    // $('.save-btn').removeClass('bg-[#0000]');
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

  $("#addItem-menubutton").click(function (e) {
    e.stopPropagation(); // Prevents the click event from reaching the document body
    $('#addItem-menu').toggleClass("topbar-menuEntring topbar-manuLeaving");
  });

  $(document).on('click', function (e) {
    if (!$("#addItem-menubutton").is(e.target) && !$('#addItem-menu').has(e.target).length) {
      // Click occurred outside the button and dropdown, hide the dropdown
      $('#addItem-menu').addClass("topbar-manuLeaving").removeClass("topbar-menuEntring");
    }
  });

  $("#addItem-menubutton1").click(function (e) {
    e.stopPropagation(); // Prevents the click event from reaching the document body
    $('#addItem-menu1').toggleClass("topbar-menuEntring topbar-manuLeaving");
  });

  $(document).on('click', function (e) {
    if (!$("#addItem-menubutton1").is(e.target) && !$('#addItem-menu1').has(e.target).length) {
      // Click occurred outside the button and dropdown, hide the dropdown
      $('#addItem-menu1').addClass("topbar-manuLeaving").removeClass("topbar-menuEntring");
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

  // new DataTable('#universalTable');
  new DataTable('.universalTable');

  $('#universalTable').DataTable({
    "order": [[0, "desc"]]
  });

  window.voice = function (buttonId, textareaId) {
    var recognition = new webkitSpeechRecognition();
    recognition.lang = "en-US";
    recognition.onresult = function (event) {
      console.log(event);
      var existingText = $("#" + textareaId).val();
      var newText = event.results[0][0].transcript;
      $("#" + textareaId).val(existingText + ' ' + newText);
      $('#' + buttonId).removeClass('fa-beat-fade');
    };
    recognition.start();
    $('#' + buttonId).addClass('fa-beat-fade');
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
