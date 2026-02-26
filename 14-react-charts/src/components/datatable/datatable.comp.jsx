import './datatable.style.css'

const DataTable = (props) => {

    return (
        <div className="datatable-container">
            <div className="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>{props.firstth}</th>
                            <th>{props.secondth}</th>
                            <th>{props.thirdth}</th>
                        </tr>
                    </thead>
                    <tbody>
                        {props.dataTable.map((item, index) => {
                            return (
                                <tr key={index}>
                                    <td>{item[0]}</td>
                                    <td>{item[1]}</td>
                                    <td>{item[2]} USD</td>
                                </tr>
                            )
                        })}
                    </tbody>
                </table>
            </div>
        </div>
    );    
}

export default DataTable;
