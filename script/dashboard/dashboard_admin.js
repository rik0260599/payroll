$("document").ready(function () {
	var ctx = document.getElementById("myBarChart");
	var myBarChart = new Chart(ctx, {
		type: "bar",
		data: {
			labels: [
				"Januari",
				"Februari",
				"Maret",
				"April",
				"Mei",
				"Juni",
				"Juli",
				"Agustus",
				"September",
				"Oktober",
				"November",
				"Desember",
			],
			datasets: [
				{
					label: "Gaji",
					backgroundColor: "#4e73df",
					hoverBackgroundColor: "#2e59d9",
					borderColor: "#4e73df",
					data: [
						30000000, 35000000, 34000000, 30000000, 30000000, 30000000,
						30000000, 30000000, 30000000, 30000000, 30000000, 30000000,
						30000000,
					],
				},
			],
		},
		options: {
			maintainAspectRatio: false,
			layout: {
				padding: {
					left: 10,
					right: 25,
					top: 25,
					bottom: 0,
				},
			},
			scales: {
				xAxes: [
					{
						time: {
							unit: "Staf",
						},
						gridLines: {
							display: false,
							drawBorder: false,
						},
						ticks: {
							maxTicksLimit: 12,
						},
						maxBarThickness: 25,
					},
				],
				yAxes: [
					{
						ticks: {
							min: 0,
							max: 100000000,
							maxTicksLimit: 2500000,
							padding: 10,
							stepSize: 10000000,
							// Include a dollar sign in the ticks
							callback: function (value, index, values) {
								return number_format(value);
							},
						},
						gridLines: {
							color: "rgb(234, 236, 244)",
							zeroLineColor: "rgb(234, 236, 244)",
							drawBorder: false,
							borderDash: [2],
							zeroLineBorderDash: [2],
						},
					},
				],
			},
			legend: {
				display: false,
			},
			tooltips: {
				titleMarginBottom: 10,
				titleFontColor: "#6e707e",
				titleFontSize: 14,
				backgroundColor: "rgb(255,255,255)",
				bodyFontColor: "#858796",
				borderColor: "#dddfeb",
				borderWidth: 1,
				xPadding: 15,
				yPadding: 15,
				displayColors: true,
				caretPadding: 10,
				callbacks: {
					label: function (tooltipItem, chart) {
						var datasetLabel =
							chart.datasets[tooltipItem.datasetIndex].label || "";
						return datasetLabel + " : " + number_format(tooltipItem.yLabel);
					},
				},
			},
		},
	});
});
