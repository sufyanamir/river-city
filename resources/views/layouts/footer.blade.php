</div>
</div>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="{{ asset('assets/js/dataTables.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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