var app = angular.module("pagPoli",[]);
app.controller("ocultar",function ($scope) {
	$scope.eva0 = true;
	$scope.eva1 = true;
	$scope.eva2 = true;
	$scope.mostrar = function () {
		if ($scope.t ==1) {
			$scope.eva0 = true;
			$scope.eva1 = false;
			$scope.eva2 = false;
		}else if($scope.t ==2){
			$scope.eva0 = false;
			$scope.eva1 = true;
			$scope.eva2 = false;
		}else if($scope.t == 3){
			$scope.eva0 = false;
			$scope.eva1 = false;
			$scope.eva2 = true;
		}else{
			$scope.eva0 = true;
			$scope.eva1 = true;
			$scope.eva2 = true;
		};
	}
});


/**----------------------------------------------------------------------------------------
----------------------------- Codigo de Google analytics. -----------------------
----------------------------------------------------------------------------------------  
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-37376197-4', 'udg.mx');
  ga('send', 'pageview');
//-----------------*/
function nav_old(a) {
	alert(a);
}