<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script type="text/javascript">
var maintenancesData = [];
var incidentsData = [];
var monthsData = [];
@foreach ($mainGraphData['maintenances'] as $maintenances)
    maintenancesData.push("{{ $maintenances }}");
@endforeach
@foreach ($mainGraphData['incidents'] as $incidents)
    incidentsData.push("{{ $incidents }}");
@endforeach
@foreach ($mainGraphData['months'] as $months)
    monthsData.push("{{ $months }}");
@endforeach

const getMainChartOptions = () => {
	let mainChartColors = {}

    mainChartColors = {
        borderColor: '#F3F4F6',
        labelColor: '#6B7280',
        opacityFrom: 0.45,
        opacityTo: 0,
    }

	return {
		chart: {
			height: 420,
			type: 'area',
			fontFamily: 'Inter, sans-serif',
			foreColor: mainChartColors.labelColor,
			toolbar: {
				show: false
			}
		},
		fill: {
			type: 'gradient',
			gradient: {
				enabled: true,
				opacityFrom: mainChartColors.opacityFrom,
				opacityTo: mainChartColors.opacityTo
			}
		},
		dataLabels: {
			enabled: false
		},
		tooltip: {
			style: {
				fontSize: '14px',
				fontFamily: 'Inter, sans-serif',
			},
		},
		grid: {
			show: true,
			borderColor: mainChartColors.borderColor,
			strokeDashArray: 1,
			padding: {
				left: 35,
				bottom: 15
			}
		},
		series: [
			{
				name: 'Incidents',
				data: incidentsData,
				color: '#f87272'
			},
			{
				name: 'Maintenances',
				data: maintenancesData,
				color: '#fbbd23'
			}
		],
		markers: {
			size: 5,
			strokeColors: '#ffffff',
			hover: {
				size: undefined,
				sizeOffset: 3
			}
		},
		xaxis: {
			categories: monthsData,
			labels: {
				style: {
					colors: [mainChartColors.labelColor],
					fontSize: '14px',
					fontWeight: 500,
				},
			},
			axisBorder: {
				color: mainChartColors.borderColor,
			},
			axisTicks: {
				color: mainChartColors.borderColor,
			},
			crosshairs: {
				show: true,
				position: 'back',
				stroke: {
					color: mainChartColors.borderColor,
					width: 1,
					dashArray: 10,
				},
			},
		},
		yaxis: {
			labels: {
				style: {
					colors: [mainChartColors.labelColor],
					fontSize: '14px',
					fontWeight: 500,
				},
				formatter: function (value) {
					return value;
				}
			},
		},
		legend: {
			fontSize: '14px',
			fontWeight: 500,
			fontFamily: 'Inter, sans-serif',
			labels: {
				colors: [mainChartColors.labelColor]
			},
			itemMargin: {
				horizontal: 10
			}
		},
		responsive: [
			{
				breakpoint: 1024,
				options: {
					xaxis: {
						labels: {
							show: false
						}
					}
				}
			}
		]
	};
}
var graphMaintenanceIncident = new ApexCharts(document.getElementById("graph-maintenance-incident"), getMainChartOptions());
graphMaintenanceIncident.render();

// Lots
var crude_oil_yield = [];
var soy_hull_yield = [];
var crushed_waste = [];
var non_compliant_bagged_tvp_yield = [];
var extrusion_waste = [];
var lot_waste = [];
var lots = [];

@foreach ($lotsGraphData['crude_oil_yield'] as $crude_oil_yield)
    crude_oil_yield.push({x: "{{ $crude_oil_yield['lot'] }}", y: "{{ $crude_oil_yield['data'] }}"});
@endforeach
@foreach ($lotsGraphData['soy_hull_yield'] as $soy_hull_yield)
    soy_hull_yield.push({x: "{{ $soy_hull_yield['lot'] }}", y: "{{ $soy_hull_yield['data'] }}"});
@endforeach
@foreach ($lotsGraphData['crushed_waste'] as $crushed_waste)
    crushed_waste.push({x: "{{ $crushed_waste['lot'] }}", y: "{{ $crushed_waste['data'] }}"});
@endforeach
@foreach ($lotsGraphData['non_compliant_bagged_tvp_yield'] as $non_compliant_bagged_tvp_yield)
    non_compliant_bagged_tvp_yield.push({x: "{{ $non_compliant_bagged_tvp_yield['lot'] }}", y: "{{ $non_compliant_bagged_tvp_yield['data'] }}"});
@endforeach
@foreach ($lotsGraphData['extrusion_waste'] as $extrusion_waste)
    extrusion_waste.push({x: "{{ $extrusion_waste['lot'] }}", y: "{{ $extrusion_waste['data'] }}"});
@endforeach
@foreach ($lotsGraphData['lot_waste'] as $lot_waste)
    lot_waste.push({x: "{{ $lot_waste['lot'] }}", y: "{{ $lot_waste['data'] }}"});
@endforeach
@foreach ($lotsGraphData['lots'] as $lot)
    lots.push("{{ $lot }}");
@endforeach

const options = {
		colors: ['#1A56DB', '#FDBA8C'],
		series: [
			{
				name: 'Rendement Huile Brute',
				color: '#1A56DB',
				data: crude_oil_yield
			},
			{
				name: 'Rendement de coques',
				color: '#FDBA8C',
				data: soy_hull_yield
			},
			{
				name: 'Freinte trituration',
				color: '#17B0BD',
				data: crushed_waste
			},
			{
				name: 'Rendement PVT non-conforme',
				color: '#fbbd23',
				data: non_compliant_bagged_tvp_yield
			},
			{
				name: 'Freinte à l\'extrusion',
				color: '#f87272',
				data: extrusion_waste
			},
			{
				name: 'Freinte total du lot',
				color: '#7e3af2',
				data: lot_waste
			}
		],
		chart: {
			type: 'bar',
			height: '420px',
			fontFamily: 'Inter, sans-serif',
			foreColor: '#4B5563',
			toolbar: {
				show: false
			}
		},
		plotOptions: {
			bar: {
				columnWidth: '90%',
				borderRadius: 3
			}
		},
		tooltip: {
			shared : true,
			intersect: false,
			style: {
				fontSize: '14px',
				fontFamily: 'Inter, sans-serif'
			},
		},
		states: {
			hover: {
				filter: {
					type: 'darken',
					value: 1
				}
			}
		},
		stroke: {
			show: true,
			width: 5,
			colors: ['transparent']
		},
		grid: {
			show: false
		},
		dataLabels: {
			enabled: false
		},
		legend: {
			fontSize: '14px',
			fontWeight: 500,
			fontFamily: 'Inter, sans-serif',
			labels: {
				colors: ['#6B7280']
			},
			itemMargin: {
				horizontal: 10
			}
		},
		xaxis: {
			categories: lots,
			labels: {
				style: {
					colors: ['#6B7280'],
					fontSize: '14px',
					fontWeight: 500,
				},
			},
			axisBorder: {
				show: false
			},
			axisTicks: {
				show: false
			},
		},
		yaxis: {
			show: true,
			labels: {
				formatter: function (value) {
					return value + '%';
				}
			},
		},
		fill: {
			opacity: 1
		}
	};

const graphLots = new ApexCharts(document.getElementById("lots"), options);
graphLots.render();
</script>