/**----------------------------------------------------------------------------------------
----------------------------- Codigo de Google analytics. -----------------------
----------------------------------------------------------------------------------------  **/
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-37376197-4', 'udg.mx');
  ga('send', 'pageview');


function justNumbers(e) {
var keynum = window.event ? window.event.keyCode : e.which;

if ( keynum == 8 ) return true;
return /\d/.test(String.fromCharCode(keynum));
}
//-----------------
function nav_old(a) {
	alert(a);
}