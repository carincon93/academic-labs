import { useEffect, useState } from 'react'
import Form from '../form/form.comp'
import Chart from '../chart/chart.comp'
import DataTable from '../datatable/datatable.comp'

import './expense.style.css';

const Expense = (props) => {

    const [category, setCategory]   = useState('')
    const [month, setMonth]         = useState('')
    const [value, setValue]         = useState(0)

    const [dataTable, setDataTable] = useState([])
	const [chartData, setChartData] = useState([['Description', 'Value']])

    useEffect(() => {
        setChartData(
            (prevState) => [
                ...prevState,
                ['Transport', 100],
                ['Other', 359],
                ['University', 500],
                ['Financial', 600],
            ]
        )

        setDataTable(
            (prevState) => [
                ...prevState,
                ['Transport', '2021-01', 100],
                ['Other', '2021-01', 359],
                ['University', '2021-02', 500],
		        ['Financial', '2021-04', 600],
            ]
        )
        // eslint-disable-next-line
    }, [])


    function handleClick(e) {
        e.preventDefault()
        if (chartData.map((item) => item[0]).indexOf(category) === -1) {
            setChartData((prevState) => [
                ...prevState,
                [category, parseInt(value)],
            ])
        } else {
            chartData.splice(
                chartData.map((item) => item[0]).indexOf(category),
                1
            )

            setChartData((prevState) => [
                ...prevState,
                [category, parseInt(value)],
            ])
        }

        setDataTable((prevState) => [
            ...prevState,
            [category, month, parseInt(value)],
        ])

        console.log([category, month, parseInt(value)])
    }

    return (
        <div className="expense-container">
            <h1>Expense</h1>
            <Chart chartData={chartData} chartTarget="expense-chart">
    			<div id="expense-chart" className="donut-chart"></div>
            </Chart>
            <div className="data-container">
                <DataTable dataTable={dataTable} firstth="Category" secondth="Date" thirdth="Value" />

                <Form handleClick={handleClick}>
                    <input
                        type="text"
                        onChange={(e) => setCategory(e.target.value)}
                        placeholder="Category"
                        required
                    />

                    <input
                        type="number"
                        min="0"
                        onChange={(e) => setValue(e.target.value)}
                        placeholder="Value"
                        required
                    />

                    <input
                        type="month"
                        onChange={(e) => setMonth(e.target.value)}
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

export default Expense;
