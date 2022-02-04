{{-- <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script> --}}
<script src="{{ asset('admin/js/popper.min.js') }}"></script>
<script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
<!--Data table-->
<link rel="stylesheet" type="text/css" href="{{ asset('admin/css/jquery.dataTables.css') }}">

<script type="text/javascript" charset="utf8" src="{{ asset('admin/js/jquery.dataTables.js') }}"></script>
<style>
    table.dataTable thead .sorting:after,
    table.dataTable thead .sorting_asc:after,
    table.dataTable thead .sorting_desc:after,
    table.dataTable thead .sorting:before,
    table.dataTable thead .sorting_asc:before,
    table.dataTable thead .sorting_desc:before {
        display: none;
        content: "" !important;
        background-image: none !important;
    }

    table.dataTable thead .sorting {
        background-image: none !important;
    }

</style>

<script src="{{ asset('admin/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script src="{{ asset('admin/js/main.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
</body>

</div>
</div>

</html>
