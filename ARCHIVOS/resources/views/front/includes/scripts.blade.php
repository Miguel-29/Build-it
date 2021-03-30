<!-- Dashboard js -->
<script src="{{URL::to('assets/front/js/vendors/jquery-3.2.1.min.js')}}"></script>
<script src="{{URL::to('assets/front/js/vendors/bootstrap.bundle.min.js')}}"></script>
<script src="{{URL::to('assets/front/js/vendors/jquery.sparkline.min.js')}}"></script>
<script src="{{URL::to('assets/front/js/vendors/selectize.min.js')}}"></script>
<script src="{{URL::to('assets/front/js/vendors/jquery.tablesorter.min.js')}}"></script>
<script src="{{URL::to('assets/front/js/vendors/circle-progress.min.js')}}"></script>
<script src="{{URL::to('assets/front/plugins/rating/jquery.rating-stars.js')}}"></script>
<!-- Custom scroll bar Js-->
<script src="{{URL::to('assets/front/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js')}}"></script>

<script src="{{URL::to('assets/front/plugins/forn-wizard/js/material-bootstrap-wizard.js')}}"></script>
<script src="{{URL::to('assets/front/plugins/forn-wizard/js/jquery.validate.min.js')}}"></script>
<script src="{{URL::to('assets/front/plugins/forn-wizard/js/jquery.bootstrap.js')}}"></script>

<!-- Charts Plugin -->
<script src="{{URL::to('assets/front/plugins/chart/utils.js')}}"></script>

<!-- Google Maps Plugin -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDg3BFN_UpY_lDsGBQ1E-Z7SQgegImycdk&libraries=places" type="text/javascript"></script>
<!--<script src="{{URL::to('assets/front/plugins/maps-google/jquery.googlemap.js')}}"></script>
<script src="{{URL::to('assets/front/plugins/maps-google/map.js')}}"></script>-->


<!-- Custom Js-->
<script src="{{URL::to('assets/front/js/custom.js')}}"></script>
<script src="{{URL::to('assets/front/js/jquery.geocomplete.js')}}"></script>

<script src="{{URL::to('assets/front/plugins/date-picker/spectrum.js')}}"></script>  
<script src="{{URL::to('assets/front/plugins/date-picker/jquery-ui.js')}}"></script>
<script src="{{URL::to('assets/front/plugins/input-mask/jquery.maskedinput.js')}}"></script> 
<!-- Charts Plugin -->
<script src="{{URL::to('assets/front/plugins/chart/Chart.bundle.js')}}"></script>
<script src="{{URL::to('assets/front/plugins/chart/utils.js')}}"></script>

<!-- file uploads js -->
<script src="{{URL::to('assets/front/plugins/fileuploads/js/dropify.min.js')}}"></script>

<!-- Input Mask Plugin -->
<script src="{{URL::to('assets/front/plugins/input-mask/jquery.mask.min.js')}}"></script>

<script src="{{URL::to('assets/front/js/index1.js')}}"></script>

<script src="{{ URL::to('assets/front/plugins/sweet-alert/sweetalert.min.js') }}"></script>

<!--Select2 js -->
<script src="{{ URL::to('assets/front/plugins/select2/select2.full.min.js')}}"></script> 
<!-- Inline js -->
<script src="{{ URL::to('assets/front/js/select2.js')}}"></script>

<script src="{{ URL::to('assets/front/js/MultiStep.min.js')}}"></script>
<!---Tabs JS-->
<script src="{{URL::to('assets/front/plugins/tabs/jquery.multipurpose_tabcontent.js')}}"></script>
<!-- Data tables -->
<script src="{{ URL::asset('assets/front/plugins/datatable/jquery.dataTables.min.js') }}">
<script
    src="{{ URL::asset('assets/front/plugins/datatable/dataTables.bootstrap4.min.js') }}">
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript"
    src="https://cdn.datatables.net/v/dt/jszip-2.5.0/b-1.6.2/b-html5-1.6.2/b-print-1.6.2/datatables.min.js"></script>

</script>
<!---Accordion Js-->
<script src="{{ URL::asset('./assets/front/plugins/accordion/accordion.min.js') }}"></script>
<script src="{{ URL::asset('assets/front/js/carousel.js') }}"></script>
<script src="{{ URL::asset('assets/front/js/bootstrap.modalpop.js') }}"></script>
<script src="{{ URL::asset('assets/front/js/jquery.fancybox.min.js') }}"></script>
<!-- WYSIWYG Editor js -->
<script src="{{ URL::asset('./assets/front/plugins/wysiwyag/jquery.richtext.js' )}}"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


<script>
$(function(e) {
    $('.coment').richText();
});

$('.dropify').dropify();
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
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>