<script>
window.onload = function() {

var chart = new CanvasJS.Chart("chartContainer", {
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	exportEnabled: true,
	animationEnabled: true,
	title: {
		text: "Desktop Browser Market Share in 2016"
	},
	data: [{
		type: "pie",
		startAngle: 25,
		toolTipContent: "<b>{label}</b>: {y}%",
		showInLegend: "true",
		legendText: "{label}",
		indexLabelFontSize: 16,
		indexLabel: "{label} - {y}%",
		dataPoints: [
			{ y: 51.08, label: "Chrome" },
			{ y: 27.34, label: "Internet Explorer" },
			{ y: 10.62, label: "Firefox" },
			{ y: 5.02, label: "Microsoft Edge" },
			{ y: 4.07, label: "Safari" },
			{ y: 1.22, label: "Opera" },
			{ y: 0.44, label: "Others" }
		]
	}]
});
chart.render();

}
</script>


<main role="main">

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container p-5">
      <h1 class="display-3">Hello, world!</h1>
      <p>Bienvenu sur le TP4 de Victoria Carré! Ce site est dédier à l'administration d'une bibliothèque.</p>
    </div>
  </div>


  <div class="container">
    <div class="row">
     <div class="col-md-8" style="height: 600px">
        <div class="card border-success mb-8" style="height: 600px">
          <div class="card-header">statistiques livres</div>
          <div class="card-body">
            <div class="card-text" id="chartContainer"></div>
          </div>
        </div>
      </div>
     <div class="col-md-4" style="height: 600px">
        <div class="card border-success mb-3" style="height: 600px">
          <div class="card-header">statistiques générales</div>
          <div class="card-body">
            <p class="card-text"></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>