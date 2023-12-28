</div>
</div>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="{{ asset('assets/js/dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/sweetalert2.js') }}"></script>
<script src="{{ asset('assets/js/topbar.min.js') }}"></script>
<script src="{{ asset('assets/js/fancybox.min.js') }}"></script>
<script src="{{ mix('node_modules/flowbite/dist/flowbite.min.js') }}"></script>
<script>
  $(".addEstimate").click(function(e) {
    e.preventDefault();
    $("#addEstimate-modal").removeClass('hidden');
  });

  $(".modal-close").click(function(e) {
    e.preventDefault();
    $("#addEstimate-modal").addClass('hidden');
    $("#addEstimate-form")[0].reset()
  });
</script>
</body>

</html>