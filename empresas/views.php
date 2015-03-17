<?php
	class vista_E
	{

		public function gen_static($html)
		{
			$valores = [
			'Title' => "[udg]",
			'container' => load_page("empresas/static/".$html)
			];
			$templad = load_page("main/templates/principal.html");
			$mostrar = remplas($valores,$templad);
			return $mostrar;
		}
		public function gen_s($html,$arr)
		{
			$valores = [
			'Title' => "[udg]",
			'container' => dinamic("empresas/static/".$html,$arr)
			];
			$templad = dinamic("general/page.html");
			$mostrar = remplas($valores,$templad);
			return $mostrar;
		}
	}
?>