var a = false;
var app = angular.module("pagPoli",[]);
app.controller("log",['$scope','$http',function ($scope,$http) {
	$scope.err = false;
	$scope.veriLog = function (){
		$http.post("index.php/log",
			{user: $scope.user,
			  ps: $scope.ps})
		.success(function (dato) {
			if (dato.estado){
				$scope.err = false;
				a = true;
				document.forms["form1"].submit()
			}else{
				$scope.err = true;
				$scope.ps = "";
			};
		})
		.error(function (err) {
			console.log(err);
		});
	}
}]);
app.controller("ocultar",['$scope','$http', function ($scope,$http) {
	$scope.datos = "";
	$scope.datosMaestros = function(){
		$http.get("index.php/datosMaestros")
		.success(function(dato){
			$scope.datos = dato;
		})
		.error(function(err){
			console.log(err);
		});
	}
}]);
app.controller("grupAlumnos",['$scope', '$http', function ($scope, $http) {
	$scope.datos =  "";
	$scope.consulta = function (cod) {
		$http.get("index.php/datosGrupos/"+cod)
		.success(function(dato){
			$scope.datos = dato;
		})
		.error(function(err){
			console.log(err);
		});
	}
}]);

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