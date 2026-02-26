import React, { useState } from 'react';
import Form from './components/form/form.comp';
import Task from './components/task/task.comp';
import Timer from './components/timer/timer.comp';

import './index.style.css';

const TaskManager = () => {

    const [todos, setTodo] = useState([
        {
            id: 1,
            category: 'Job',
            tasks : [
                {
                    id: 1,
                    description: 'Build a web wireframe',
                    checklist: {
                        id: 1,
                        description: 'The web wireframe must be simple'
                    }
                },
            ]
        },
        {
            id: 2,
            category: 'Job',
            tasks : [
                {
                    id: 2,
                    description: 'Build a web prototype',
                    checklist: {
                        id: 2,
                        description: 'The web prototype must be functional'
                    }
                },
            ]
        },
        {
            id: 3,
            category: 'Job',
            tasks : [
                {
                    id: 3,
                    description: 'Build an interactive web',
                    checklist: {
                        id: 3,
                        description: 'The interactive web must be responsive'
                    }
                },
            ]
        },
        {
            id: 4,
            category: 'Homework',
            tasks : [
                {
                    id: 4,
                    description: 'Create new React application "react-forms"',
                    checklist: {
                        id: 4,
                        description: 'Must create 3 different classes and 15 different objects'
                    }
                },
            ]
        },
        {
            id: 5,
            category: 'Homework',
            tasks : [
                {
                    id: 5,
                    description: 'Create one form to add new objects, must create variables (setState)',
                    checklist: {
                        id: 5,
                        description: 'The tab should not be refreshed'
                    }
                },
            ]
        },
        {
            id: 6,
            category: 'Homework',
            tasks : [
                {
                    id: 6,
                    description: 'Create fake data',
                    checklist: {
                        id: 6,
                        description: 'The data must be stored in json'
                    }
                },
            ]
        },
        {
            id: 7,
            category: 'Homework',
            tasks : [
                {
                    id: 7,
                    description: 'Print variables names and values with console.log().',
                    checklist: {
                        id: 7,
                        description: 'Take a screenshot'
                    }
                },
            ]
        },
        {
            id: 8,
            category: 'Homework',
            tasks : [
                {
                    id: 8,
                    description: 'Attach screenshots to the github repository',
                    checklist: {
                        id: 8,
                        description: 'The screenshots must be png or jpg'
                    }
                },
            ]
        },
        {
            id: 9,
            category: 'Job',
            tasks : [
                {
                    id: 9,
                    description: 'Check for date errors in the web application',
                    checklist: {
                        id: 9,
                        description: 'Verify data return'
                    }
                },
            ]
        },
        {
            id: 10,
            category: 'Homework',
            tasks : [
                {
                    id: 10,
                    description: 'Create at least 3 components with props',
                    checklist: {
                        id: 10,
                        description: 'Students, Course, Grades'
                    }
                },
            ]
        },
        {
            id:11,
            category: 'Homework',
            tasks : [
                {
                    id:11,
                    description: 'Create git-hub repository "react-coditional-rendering"',
                    checklist: {
                        id:11,
                        description: 'The react application must be different'
                    }
                },
            ]
        },
        {
            id: 12,
            category: 'Homework',
            tasks : [
                {
                    id: 12,
                    description: 'Complete the componente structure started in class',
                    checklist: {
                        id: 12,
                        description: 'Must be the same. (https://reactjs.org/docs/thinking-in-react.html)'
                    }
                },
            ]
        },
        {
            id: 13,
            category: 'Homework',
            tasks : [
                {
                    id: 13,
                    description: 'Create two pages with reports',
                    checklist: {
                        id: 13,
                        description: 'A user should be able filter out results (with different filter criteria)'
                    }
                },
            ]
        },
        {
            id: 14,
            category: 'Homework',
            tasks : [
                {
                    id: 14,
                    description: 'Create two different pages to allow the end user create new objets/records. At least one form, should include a relationship with another table.',
                    checklist: {
                        id: 14,
                        description: 'Once the record has been created, the form data should not lost.'
                    }
                },
            ]
        },
        {
            id: 15,
            category: 'Homework',
            tasks : [
                {
                    id: 15,
                    description: 'To create a new database, as per an idea that might have',
                    checklist: {
                        id: 15,
                        description: 'The database must have at least 4 different tables with relations among them'
                    }
                },
            ]
        }
    ]);

    function removeElement() {
        let newTodos = [...todos]; 
        newTodos.shift();
        setTodo(newTodos);
    }

    return (
        <div className="todos-container">
            <Timer />

            <h4 className="mb-10 text-center">Tasks</h4>
            {todos.length > 0 ? <button type="button" className="complete-button" onClick={() => removeElement()}>Complete</button> : null}
            {todos.map((todo, index) => {
                return (
                    <React.Fragment key={todo.id}>
                        <Task todo={todo} setTodo={setTodo} todos={todos} classes={index === 0 ? 'first-task' : ''} />
                    </React.Fragment>
                )
            })}
            <Form setTodo={setTodo} todos={todos} />
        </div>
    );    
}

export default TaskManager;