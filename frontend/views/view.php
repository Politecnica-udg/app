<?php
	class viewTemplad{
		public static function white($html,$arr = null){
			$valores = [
				'Title' => "Escuela Politecnica Guadalajara",
				'container' => dinamic("frontend/views/indexViews/".$html, $arr)
			];
			$templad = loadPage("frontend/assets/templad/base.html");
			$mostrar = remplas($valores,$templad);
			return $mostrar;
		}
		public static function page($html,$arr = null){
			$valores = [
				'Title' => "Escuela Politecnica Guadalajara",
				'container' => dinamic("frontend/views/indexViews/".$html, $arr)
			];
			$templad = dinamic("frontend/assets/templad/page.html");
			$mostrar = remplas($valores,$templad);
			return $mostrar;
		}
		public function admon($html,$arr = null){
			$valores = [
			'Title' => "Escuela Politecnica Guadalajara",
			'container' => dinamic("frontend/views/admonViews/".$html,$arr)
			];
			$templad = dinamic("frontend/assets/templad/page.html");
			$mostrar = remplas($valores,$templad);
			return $mostrar;
		}
		public function studen($html,$arr = null){
			$valores = [
			'Title' => "Escuela Politecnica Guadalajara",
			'container' => dinamic("frontend/views/studenViews/".$html,$arr)
			];
			$templad = dinamic("frontend/assets/templad/page.html");
			$mostrar = remplas($valores,$templad);
			return $mostrar;
		}
		public function pageChosen($html,$arr = null){
			$valores = [
			'Title' => "Escuela Politecnica Guadalajara",
			'container' => dinamic("frontend/views/indexViews/".$html,$arr)
			];
			$templad = dinamic("frontend/assets/complementos/chosen/principal.html");
			$mostrar = remplas($valores,$templad);
			return $mostrar;
		}
	}
?>