import { useEffect } from 'react'

const Chart = (props) => {

    useEffect(() => {
		setTimeout(() => {
			window.google.charts.load('current', {
				packages: ['corechart'],
			})
			window.google.charts.setOnLoadCallback(drawChart)
		}, 1000)
	})

    function drawChart() {
		var data = window.google.visualization.arrayToDataTable(props.chartData)

		var options = {
			pieHole: 0.4,
		}

		var chart = new window.google.visualization.PieChart(
			document.getElementById(props.chartTarget)
		)
		chart.draw(data, options)
	}

    return (
        <div className="chart-container">
            {props.children}
        </div>
    );    
}

export default Chart;
