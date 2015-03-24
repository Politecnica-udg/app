<?php
	class vista_Al{
		public function gen_dinamic($html,$arr = null){
			$valores = [
			'Title' => "[title_ci]",
			'container' => dinamic("alumnos/static/".$html,$arr)
			];
			$templad = dinamic("general/page.html");
			$mostrar = remplas($valores,$templad);
			return $mostrar;
		}
	}
?>