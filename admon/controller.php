<?php
	class admon {
		var $data;
		function __construct(){$this->data = new general_A();}
		public function lisMaestros(){
			global $url_array;
			if ($url_array[2]) {
				$mat = $this->data->materias($url_array[2]);
				return render_to_response (vista_A::gen_dinamic('materias.html',$mat));
			} else {
				$mat = $this->data->maestros();
				return render_to_response (vista_A::gen_dinamic('listaMaestros.html',$mat));
			}
		}
	}
?>