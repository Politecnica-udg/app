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
app.controller("alumnoEva",['$scope', '$http', function ($scope, $http) {
	$scope.datos = "";
	$scope.check = false;
	$scope.materias_Al = function(codigo){
		$http.get("index.php/materias_Al")
		.success(function (dato){
			$scope.datos = dato;
		})
		.error(function (err) {
			console.log(err);
		});
	}
	$scope.chec = function () {
		$scope.check = true;
	}
}]);
app.controller("evaluarAlum",['$scope', '$http', function ($scope, $http) {
	$scope.datos = "";
	$scope.lista = function () {
		url = window.location.search;
		$http.get("index.php/datAl/"+url)
		.success(function(dato){
			$scope.datos = dato;
			console.log($scope.datos);
		})
		.error(function(err){
			console.log(err);
		});
	}
	$scope.saveFal = function (id,fal_al) {
		$http.post("index.php/saveFal",{
			id_al: 	id,
			fal: 	fal_al,
			cTotal: $scope.datos.clas})
		.success(function (dato) {
		})
		.error(function (err) {
			console.log(err);
		});
	}
	$scope.saveCal = function (id,cal_al) {
		if(cal_al >100){
			alert("Tiene que ser un numero menor o igual a 100");
		}else{
			$http.post("index.php/saveCal",{
				id_al: 	id,
				cal: 	cal_al})
			.success(function (dato) {
			})
			.error(function (err) {
				console.log(err);
			});
		}
	}
	$scope.grabar = function(op_m){
		url = window.location.search;
		$http.post("index.php/grabarM/"+url,{
			op: op_m
		})
		.success(function(dato){
			alert("Datos Grabados");
			 location.href="index.php";
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