import './form.style.css'

const Form = (props) => {
    return (
        <div className="form-container card">
            <form onSubmit={(e) => props.handleClick(e)}>
                {props.children}
            </form>
        </div>
    );    
}

export default Form;
