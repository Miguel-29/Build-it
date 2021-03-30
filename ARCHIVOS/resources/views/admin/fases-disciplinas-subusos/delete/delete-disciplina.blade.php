<script>
    function funcionHabilitaEliminars(event,id) {
        event.preventDefault();
        //alert();
        rutadel = "";
        rutadel = $('#link_'+id).attr('href');
        console.log(rutadel);
        swal({
            title: "¿Estás seguro de esta acción?",
            text: "Se eliminará el registro que seleccionaste!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si deseo borrarlo!",
            cancelButtonText: "Cancelar",
            //closeOnConfirm: true
        }, function () {
            eliminarD(id, rutadel),
            swal.close()
        });
        return false;

    }
    function eliminarD(id, url){
        $.get(url, (response) => {
			if(response == 'Eliminado'){
                $("#row_"+id).remove();
                swal({
	                title: "Disciplina desasociada correctamente",
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