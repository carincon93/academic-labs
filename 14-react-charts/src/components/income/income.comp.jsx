import { useEffect, useState } from 'react'
import Form from '../form/form.comp'
import Chart from '../chart/chart.comp'
import DataTable from '../datatable/datatable.comp'

import './income.style.css'

const Income = (props) => {

    const [project, setProject]   = useState('')
    const [deadline, setDeadline]       = useState('')
    const [cost, setCost]       = useState(0)

    const [dataTable, setDataTable] = useState([])
	const [chartData, setChartData] = useState([['Description', 'Value']])

    useEffect(() => {
        setChartData(
            (prevState) => [
                ...prevState,
                ['Web design', 50],
                ['Laravel', 679],
                ['React native', 500],
                ['Svelte', 600],
            ]
        )

        setDataTable(
            (prevState) => [
                ...prevState,
                ['Web design', '2021-04-12', 50],
                ['Laravel', '2021-02-01', 679],
                ['React native', '2020-09-09', 500],
		        ['Svelte', '2019-10-15', 600],
            ]
        )
        // eslint-disable-next-line
    }, [])


    function handleClick(e) {
        e.preventDefault()
        if (chartData.map((item) => item[0]).indexOf(project) === -1) {
            setChartData((prevState) => [
                ...prevState,
                [project, parseInt(cost)],
            ])
        } else {
            chartData.splice(
                chartData.map((item) => item[0]).indexOf(project),
                1
            )

            setChartData((prevState) => [
                ...prevState,
                [project, parseInt(cost)],
            ])
        }
        
        setDataTable((prevState) => [
            ...prevState,
            [project, deadline, parseInt(cost)],
        ])
        
        console.log([project, deadline, parseInt(cost)])
    }

    return (
        <div className="income-container">
            <h1>Income</h1>
            <Chart chartData={chartData} chartTarget="income-chart">
    			<div id="income-chart" className="donut-chart"></div>
            </Chart>
            <div className="data-container">
                <DataTable dataTable={dataTable} firstth="Project" secondth="Deadline" thirdth="Cost" />

                <Form handleClick={handleClick}>
                    <input
                        type="text"
                        onChange={(e) => setProject(e.target.value)}
                        placeholder="Project"
                        required
                    />

                    <input
                        type="number"
                        min="0"
                        onChange={(e) => setCost(e.target.value)}
                        placeholder="Cost"
                        required
                    />

                    <input
                        type="date"
                        onChange={(e) => setDeadline(e.target.value)}
                        required
                    />

                    <button type="submit">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            className="button-icon"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                strokeLinecap="round"
                                strokeLinejoin="round"
                                strokeWidth="2"
                                d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                            />
                        </svg>
                    </button>
                </Form>
            </div>
        </div>
    );    
}

export default Income;
