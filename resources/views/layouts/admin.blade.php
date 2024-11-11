<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Dashboard 2</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('public/backend') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('public/backend') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('public/backend') }}/dist/css/adminlte.min.css">

    {{-- login link --}}
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('public/backend') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('public/backend') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('public/backend') }}/dist/css/adminlte.min.css">
    {{-- login link --}}

    {{-- toster link --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">
    {{-- toster link --}}

     <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('public/backend') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('public/backend') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('public/backend') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- DataTables -->

  {{-- ajax request form edit --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

  {{-- dropify ccs link --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">

<!-- summernote -->
<link rel="stylesheet" href="{{ asset('public/backend') }}/plugins/summernote/summernote-bs4.min.css">


</head>

<body>
{{-- <body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed"> --}}
    <div class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    @guest
    @else

        <div class="wrapper">

            <!-- Navbar -->
            @include('layouts.admin_partial.navbar')
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            @include('layouts.admin_partial.sidebar')
            <!-- end Main Sidebar Container -->

        @endguest

        <!-- Content Wrapper. Contains page content -->
        @yield('admin_content')
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        @include('layouts.admin_partial.footer')
        <!-- Een Main Footer -->

    </div>
    <!-- ./wrapper -->
    </div>

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{ asset('public/backend') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('public/backend') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('public/backend') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('public/backend') }}/dist/js/adminlte.js"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="{{ asset('public/backend') }}/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
    <script src="{{ asset('public/backend') }}/plugins/raphael/raphael.min.js"></script>
    <script src="{{ asset('public/backend') }}/plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="{{ asset('public/backend') }}/plugins/jquery-mapael/maps/usa_states.min.js"></script>
    <!-- ChartJS -->
    <script src="{{ asset('public/backend') }}/plugins/chart.js/Chart.min.js"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('public/backend') }}/dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('public/backend') }}/dist/js/pages/dashboard2.js"></script>

    {{-- login script --}}
    <!-- jQuery -->
    <script src="{{ asset('public/backend') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('public/backend') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('public/backend') }}/dist/js/adminlte.min.js"></script>
    {{-- login script --}}

    {{-- toster cdn link --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    {{-- toster cdn link --}}

    <!-- DataTables  & Plugins -->
<script src="{{ asset('public/backend') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('public/backend') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('public/backend') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('public/backend') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ asset('public/backend') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('public/backend') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{ asset('public/backend') }}/plugins/jszip/jszip.min.js"></script>
<script src="{{ asset('public/backend') }}/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{ asset('public/backend') }}/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{ asset('public/backend') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{ asset('public/backend') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{ asset('public/backend') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

 {{-- dropify --}}
 <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script>

 <!-- Summernote -->
<script src="{{ asset('public/backend') }}/plugins/summernote/summernote-bs4.min.js"></script>


<script>
    $(function () {
      // Summernote
      $('.summernote').summernote()

      // CodeMirror
    //   CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
    //     mode: "htmlmixed",
    //     theme: "monokai"
    //   });
    })
  </script>

 <script>
    $('.dropify').dropify({
messages: {
    'default': 'Click Here',
    'replace': 'Drag and drop or click to replace',
    'remove':  'Remove',
    'error':   'Ooops, something wrong happended.'
}
});
</script>


<script>
    $(document).on('click', '#delete', function(e) {
        e.preventDefault(); // Prevent default action (i.e., navigating to the href)

        var link = $(this).attr("href"); // Store the link to redirect if confirmed

        // Display the SweetAlert confirmation dialog
        swal({
            title: "Are you sure you want to delete?",
            text: "This action cannot be undone.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                // Redirect to the link if confirmed
                window.location.href = link;
            } else {
                // Show a message if the action was cancelled
                swal("Action canceled!");
            }
        });
    });
</script>

        <script>
        $(document).on('click', '#logout', function(e) {
            e.preventDefault();
            var link = $(this).attr("href");
            if (confirm("Are you sure you want to logout?")) {
                window.location.href = link;
            }
            // swal({
            //     title: "Are you sure you want to logout?",
            //     text: "",
            //     icon: "warning",
            //     buttons: true,
            //     dangerMode: true,
            // }).then((willDelete)=> {
            //     if (willDelete) {
            //         window.location.href = link;
            //         }else{
            //             swal("Not Logout!");
            //         }
            // });
        });
    </script>

    {{-- toastr message --}}
    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':

                    toastr.options.timeOut = 10000;
                    toastr.info("{{ Session::get('message') }}");
                    var audio = new Audio('audio.mp3');
                    audio.play();
                    break;
                case 'success':

                    toastr.options.timeOut = 10000;
                    toastr.success("{{ Session::get('message') }}");
                    var audio = new Audio('audio.mp3');
                    audio.play();

                    break;
                case 'warning':

                    toastr.options.timeOut = 10000;
                    toastr.warning("{{ Session::get('message') }}");
                    var audio = new Audio('audio.mp3');
                    audio.play();

                    break;
                case 'error':

                    toastr.options.timeOut = 10000;
                    toastr.error("{{ Session::get('message') }}");
                    var audio = new Audio('audio.mp3');
                    audio.play();

                    break;
            }
        @endif
    </script>
    {{-- toastr message --}}

    <!-- Page specific script -->
<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>

</body>

</html>
