<!-- Dashboard Core -->
<script src="{{ URL::asset('./assets/admin/js/vendors/jquery-3.2.1.min.js') }}">
</script>
<script src="{{ URL::asset('./assets/admin/js/vendors/bootstrap.bundle.min.js') }}">
</script>
<script src="{{ URL::asset('./assets/admin/js/vendors/jquery.sparkline.min.js') }}">
</script>
<script src="{{ URL::asset('./assets/admin/js/vendors/selectize.min.js') }}"></script>
<script src="{{ URL::asset('./assets/admin/js/vendors/jquery.tablesorter.min.js') }}">
</script>
<script src="{{ URL::asset('./assets/admin/js/vendors/circle-progress.min.js') }}">
</script>
<script src="{{ URL::asset('./assets/admin/plugins/rating/jquery.rating-stars.js') }}">
</script>
<!-- Fullside-menu Js-->
<script src="{{ URL::asset('assets/admin/plugins/toggle-sidebar/js/sidemenu.js') }}">
</script>

<!-- Charts Plugin -->
<script src="{{ URL::asset('./assets/admin/plugins/chart/Chart.bundle.js') }}"></script>
<script src="{{ URL::asset('./assets/admin/plugins/chart/utils.js') }}"></script>

<!-- Input Mask Plugin -->
<script src="{{ URL::asset('assets/admin/plugins/input-mask/jquery.mask.min.js') }}">
</script>

<script src="{{ URL::asset('assets/admin/js/index1.js') }}"></script>

<!-- Custom scroll bar Js-->
<script
    src="{{ URL::asset('assets/admin/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js') }}">
</script>
<!-- Data tables -->
<script src="{{ URL::asset('assets/admin/plugins/datatable/jquery.dataTables.min.js') }}">
</script>

<script
    src="{{ URL::asset('assets/admin/plugins/datatable/dataTables.bootstrap4.min.js') }}">
</script>
<!-- Datepicker js -->
<script src="{{ URL::asset('assets/admin/plugins/date-picker/spectrum.js') }}"></script>
<script src="{{ URL::asset('assets/admin/plugins/date-picker/jquery-ui.js') }}"></script>
<script src="{{ URL::asset('assets/admin/plugins/input-mask/jquery.maskedinput.js') }}">
</script>
<script src="{{ URL::asset('assets/admin/plugins/fileuploads/js/dropify.min.js') }}">
</script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js">
</script>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript"
    src="https://cdn.datatables.net/v/dt/jszip-2.5.0/b-1.6.2/b-html5-1.6.2/b-print-1.6.2/datatables.min.js"></script>
<!-- Sweet alert Plugin -->
<script src="{{ URL::asset('assets/admin/plugins/sweet-alert/sweetalert.min.js') }}">
</script>
<script src="{{ URL::asset('assets/admin/js/sweet-alert.js') }}"></script>

<!-- Custom Js-->
<script src="{{ URL::asset('assets/admin/js/custom.js') }}"></script>

<!-- WYSIWYG Editor js -->
<script src="{{ URL::asset('./assets/admin/plugins/wysiwyag/jquery.richtext.js' )}}"></script>

<!-- WYSIWYG Editor js -->
<script src="{{ URL::asset('./assets/admin/js/ckeditor.js' )}}"></script>
<script>
    $(function(e) {
        $('.description').richText();
    });


    var rutadel = "";
    $('.dropify').dropify();


    function eliminar(eliminar){ 
            url = eliminar.url;
            id = eliminar.id;
            console.log(url);
        swal({
            title: '¿Está seguro de eliminar este valor?',
            text: "No podrá revertir esta acción",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'Volver',
        }, function() {
            window.location.href = url +"/" + id + "/eliminar"    
            });
    }

    $('.dataFase').DataTable({
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    });

    $('#example').DataTable({
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    });

</script>


@stack('scripts')