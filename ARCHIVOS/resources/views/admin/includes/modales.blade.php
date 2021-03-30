@if(Session::has('error'))
        <script type="text/javascript">
	        $(document).ready(function() {
				swal({
	                title: "Ingreso fallido!",
	                //text: "{{Session::get('error')}}",
	                html: "{{Session::get('error')}}",
	                type: "error"
	            });
	        });
		</script>
	    @endif
        @if(Session::has('errordataform'))
        <script type="text/javascript">
			<?php
			$ppp = Session::get('errordataform');
			?>
			$(document).ready(function() {
				swal({
                    title: "<?php echo $ppp;?>",
                    text: "",
	                type: "error",
					
	            });
            });
		</script>
	    @endif
	    @if(Session::has('mensaje'))
        <script type="text/javascript">
			<?php
			$mensaje = Session::get('mensaje');
			?>
			$(document).ready(function() {
				swal({
	                title: "<?php echo $mensaje;?>",
					//html: true,
	                text: "",
	                type: "success",
					
	            });
            });
		</script>
        @endif
        @if(Session::has('warning'))
        <script type="text/javascript">
			<?php
			$warning = Session::get('warning');
			?>
			$(document).ready(function() {
				swal({
	                title: "<?php echo $warning;?>",
					//html: true,
	                text: "",
	                type: "warning",
					
	            });
            });
		</script>
	    @endif
    

    