<script>
    function check(event, idproyecto, idfase) {
        event.preventDefault();
        //alert();
        rutadel = "";
        rutadel = $('#phase_'+idproyecto+'_'+idfase).attr('href');
        console.log(rutadel);
        swal({
            title: "¿Estás seguro de esta acción?",
            text: "Se eliminarán todos los registros asociados a esta fase y tipo de proyecto!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si deseo borrarlo!",
            cancelButtonText: "Cancelar",
            //closeOnConfirm: true
        }, function () {
            eliminarF(idproyecto, idfase, rutadel),
            swal.close()
        });
        return false;

    }
    function eliminarF(idproyecto, idfase, url){
        $.get(url, (response) => {
			if(response == 'Eliminado'){
                $("#container_"+idfase).remove();
                swal({
	                title: "Fase eliminada correctamente",
	                text: "",
	                type: "success",
					
	            });
            }else{
                swal({
	                title: "Ha ocurrido un error",
	                text: "",
	                type: "error",
					
	            });
            }
		});
    }
</script>