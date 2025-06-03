<footer class="bg-white rounded-lg shadow m-4 dark:bg-gray-800" id="footer">
    <div class="w-full mx-auto max-w-screen-xl p-4 text-center">
        <span class="text-sm text-[#930027] sm:text-center dark:text-gray-400"><a target="_blank"
                href="https://thewebconcept.com/" class="hover:underline">Powered by : The Web Concept™.</a>
        </span>
    </div>
</footer>

</div>
</div>
<!-- <script src="{{ asset('assets/js/jquery.min.js') }}"></script> -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"
    integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="{{ asset('assets/js/dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/sweetalert2.js') }}"></script>
<script src="{{ asset('assets/js/topbar.min.js') }}"></script>
<script src="{{ asset('assets/js/fancybox.min.js') }}"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>
<!-- <style>
    /* Style the title element */
    #botmanWidgetRoot div:first-child {
        color: #ffff !important; /* Change this to your desired color */
    }
</style>
<script>
    var botmanWidget = {
        aboutText: 'River City Painting',
        introMessage: "Please write 'hi' to start a conversation!",
        bubbleAvatarUrl: "{{ asset('assets/icons/chatbot.png') }}",
        mainColor: "#930027",
        bubbleBackground: "#930027",
        title: "River City Pinting (customer care)",
    };
</script>
<script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script> -->

<!-- <script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script> -->
<script>
    $(document).ready(function() {
        $('select').select2({
            width: '100%',
            matcher: function(params, data) {
                if ($.trim(params.term) === '') {
                    return data;
                }

                if (typeof data.text === 'undefined') {
                    return null;
                }

                // Convert both search term and option text to lowercase
                let searchTerm = params.term.toLowerCase();
                let optionText = data.text.toLowerCase();

                // Split search term by space and check if all words are present in the option text
                let searchWords = searchTerm.split(" ");
                let matchesAllWords = searchWords.every(word => optionText.includes(word));

                return matchesAllWords ? data : null;
            }
        });
    });
</script>
<style>
    .select2-results__option[aria-selected="true"] {
        background-color: #930027 !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #444;
        line-height: 34px;
        text-align: left;
    }

    .select2-container--default .select2-selection--single {
        background-color: #fff;
        border: 1px solid #aaa;
        height: 36px !important;
        border-radius: 0.375rem;
    }

    .select2-container--default .select2-selection--single:focus {
        border: 2px solid #0095E5;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: 6px !important;

    }
</style>




</div>
</body>
    {{-- for loader js --}}
<script>
  window.addEventListener('load', function () {
        document.getElementById('loader').style.display = 'none';
        document.getElementById('main-dashbords').style.display = 'block';

    });
</script>

<script>
const sidebar = document.querySelector(".sidebar");
const mainContainer = document.querySelector(".main-container");
const toggleBtn = document.getElementById("sidebarToggle");

const openIcon = toggleBtn.querySelector(".bi-list");
const closeIcon = toggleBtn.querySelector(".toggle-close-icon");
const navsidelogo = document.getElementById("navSideLogo");

function isSmallScreen() {
  return window.innerWidth < 1160;
}

function updateIcons(isHidden) {
  if (isHidden) {
    openIcon.classList.remove("hidden");
    closeIcon.classList.add("hidden");
    navsidelogo.style.display = "flex";
  } else {
    openIcon.classList.add("hidden");
    closeIcon.classList.remove("hidden");
    navsidelogo.style.display = "none";
  }
}

function setInitialSidebar() {
  if (isSmallScreen()) {
    sidebar.classList.add("sidebar-slide-out");
    sidebar.classList.remove("sidebar-slide-in");
    sidebar.classList.remove("sidebar-collapse");
    sidebar.classList.remove("sidebar-expand");

    mainContainer.classList.remove("ml-[250px]");
    mainContainer.classList.remove("rounded-l-3xl");

    updateIcons(true);
  } else {
    sidebar.classList.remove("sidebar-slide-out");
    sidebar.classList.add("sidebar-slide-in");
    sidebar.classList.remove("sidebar-collapse");
    sidebar.classList.add("sidebar-expand");

    mainContainer.classList.add("ml-[250px]");
    mainContainer.classList.add("rounded-l-3xl");

    updateIcons(false);
  }
}

setInitialSidebar();

window.addEventListener("resize", setInitialSidebar);

toggleBtn.addEventListener("click", () => {
  if (isSmallScreen()) {
    if (sidebar.classList.contains("sidebar-slide-out")) {
      sidebar.classList.remove("sidebar-slide-out");
      sidebar.classList.add("sidebar-slide-in");
      updateIcons(false);
    } else {
      sidebar.classList.add("sidebar-slide-out");
      sidebar.classList.remove("sidebar-slide-in");
      updateIcons(true);
    }
  } else {
    if (sidebar.classList.contains("sidebar-expand")) {
      sidebar.classList.remove("sidebar-expand");
      sidebar.classList.add("sidebar-collapse");

      mainContainer.classList.remove("ml-[250px]");
      mainContainer.classList.remove("rounded-l-3xl");

      updateIcons(true);
    } else {
      sidebar.classList.remove("sidebar-collapse");
      sidebar.classList.add("sidebar-expand");

      mainContainer.classList.add("ml-[250px]");
      mainContainer.classList.add("rounded-l-3xl");

      updateIcons(false);
    }
  }
});

// Close button on small screen
const sidebarCloseBtn = document.getElementById("sidebarClose");
if (sidebarCloseBtn) {
  sidebarCloseBtn.addEventListener("click", () => {
    sidebar.classList.add("sidebar-slide-out");
    sidebar.classList.remove("sidebar-slide-in");
    updateIcons(true);
  });
}

</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const sidebarValue = "{{ session('user_details.sidebar') }}";
    const sidebarToggleBtn = document.getElementById("sidebarToggle");

    if (sidebarValue === "0" && sidebarToggleBtn) {
        sidebarToggleBtn.click(); // Auto-close sidebar if value is 0
    }
});
</script>

</html>
