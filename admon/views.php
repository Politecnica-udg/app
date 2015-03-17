<?php
	class vista_A
	{
		public function gen_dinamic($html,$arr = null)
		{
			$valores = [
			'Title' => "[title_ci]",
			'container' => dinamic("admon/static/".$html,$arr)
			];
			$templad = dinamic("general/page.html");
			$mostrar = remplas($valores,$templad);
			return $mostrar;
		}
	}
?>