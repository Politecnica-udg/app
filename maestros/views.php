<?php
	class vista_M {
		static function page($html, $arr = null){
			$valores = [
				'Title' => "Escuela Politecnica Guadalajara",
				'container' => dinamic("maestros/static/".$html,$arr)
			];
			$templad = dinamic("general/page.html");
			$mostrar = remplas($valores,$templad);
			return $mostrar;
		}
	}
?>