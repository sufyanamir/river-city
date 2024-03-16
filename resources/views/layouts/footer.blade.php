</div>
</div>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/sweetalert2.js') }}"></script>
<script src="{{ asset('assets/js/topbar.min.js') }}"></script>
<script src="{{ asset('assets/js/fancybox.min.js') }}"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('select').select2({
            width: '100%'
        });
        $('#Items_dropdown').select2({
            minimumResultsForSearch: Infinity
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
        border:2px solid #0095E5;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: 6px !important;

    }
</style>
</body>

</html>
