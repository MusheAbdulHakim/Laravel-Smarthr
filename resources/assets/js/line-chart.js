
	// Line Chart
	
	var ctx = document.getElementById("lineChart").getContext('2d');
	var lineChart = new Chart(ctx, {
		type: 'line',
		data: {
			labels: ["Jan",	"Feb",	"Mar",	"Apr",	"May"],
			datasets: [{
				label: 'UI Developer',
				data: [20,	10,	5,	5,	20],
				fill: false,
				borderColor: '#373651',
				backgroundColor: '#373651',
				borderWidth: 1
			},
					  {
				label: 'Android',
				data: [2,	2,	3,	4,	1],
				fill: false,
				borderColor: '#E65A26',
				backgroundColor: '#E65A26',
				borderWidth: 1
			},
					  {
				label: 'Web Designing',
				data: [1,	3,	6,	8,	10],
				fill: false,
				borderColor: '#a1a1a1',
				backgroundColor: '#a1a1a1',
				borderWidth: 1
			}]
		},
		options: {
		  responsive: true,
			legend: {
				display: false
			}
		}
	});
