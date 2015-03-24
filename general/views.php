<?php
	class vista{
		static function index_log(){
			$valores = [
				'Title' => "Escuela Politecnica Guadalajara",
				'container' => dinamic("general/static/login.html")
			];
			$templad = load_page("main/templates/principal.html");
			$mostrar = remplas($valores,$templad);
			return $mostrar;
		}
		static function page($html, $arr = null){
			$valores = [
				'Title' => "Escuela Politecnica Guadalajara",
				'container' => dinamic("general/static/".$html,$arr)
			];
			$templad = dinamic("general/page.html");
			$mostrar = remplas($valores,$templad);
			return $mostrar;
		}
	}
?>