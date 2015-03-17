<?php
	class vista
	{	
		public function gen_dinamic($html,$arr = null)
		{
			$valores = [
			'Title' => "[title_ci]",
			'container' => dinamic("general/static/".$html,$arr)
			];
			$templad = dinamic("general/page.html");
			$mostrar = remplas($valores,$templad);
			return $mostrar;
		}
		public function index_log_in()
		{
			$valores = [
			'Title' => "Escuela Politecnica Guadalajara",
			'container' => dinamic("general/static/login.html")
			];
			$templad = load_page("main/templates/principal.html");
			$mostrar = remplas($valores,$templad);
			return $mostrar;
		}
		public function principal()
		{
			$valores = [
				'Title' => "Escuela Politecnica Guadalajara",
				'container' => dinamic("general/static/principal.html")
			];
			$templad = dinamic("general/page.html");
			$mostrar = remplas($valores,$templad);
			return $mostrar;
		}
		public function MS_404()
		{
			$valores = [
			'Title' => "[404_ruta]",
			'container' => load_page("general/static/404.html")
			];
			$templad = load_page("main/templates/principal.html");
			$mostrar = remplas($valores,$templad);
			return $mostrar;
		}
	}
?>