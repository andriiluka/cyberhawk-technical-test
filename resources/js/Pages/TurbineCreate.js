import { useState } from 'react';
import axios from 'axios';
import { useImmer } from "use-immer";
import { Link, useNavigate } from "react-router-dom";

export default function TurbineCreate() {
    const [turbine, setTurbine] = useImmer({
        blades: [
            {
                grade: '',
            },
            {
                grade: '',
            },
            {
                grade: '',
            },
        ],
        rotor: {
            grade: '',
        },
        hub: {
            grade: '',
        },
        generator: {
            grade: '',
        },
    });
    const [message, setMessage] = useState('');
    const navigate = useNavigate();

    const createTurbine = (e) => {
        e.preventDefault();

        axios.post('/api/turbines', turbine)
            .then(response => {
                setMessage('Added successfully.');
                navigate(`/turbines/${response.data.data.id}`);
            })
            .catch(() => {
                setMessage('Something went wrong. Please try again.');
            });
    };

    function handleBladesChange(id, value) {
        setTurbine(draft => {
            const blade = draft.blades[id];
            blade.grade = value;
        });
    }

    return (
        <div>
            <h2>Add New Turbine</h2>

            <form onSubmit={createTurbine}>
                {turbine.blades.map((blade, index) => (
                    <div key={index}>
                        <label>Blade #{index + 1} Grade </label>
                        <input
                            value={blade.grade}
                            type="number"
                            min="1"
                            max="5"
                            onChange={e => handleBladesChange(index, e.target.value)}
                        />
                    </div>
                ))}

                <label>Rotor Grade </label>
                <input
                    value={turbine.rotor.grade}
                    type="number"
                    min="1"
                    max="5"
                    onChange={e => setTurbine(draft => {
                        draft.rotor.grade = e.target.value
                    })}
                />

                <br />

                <label>Hub Grade </label>
                <input
                    value={turbine.hub.grade}
                    type="number"
                    min="1"
                    max="5"
                    onChange={e => setTurbine(draft => {
                        draft.hub.grade = e.target.value
                    })}
                />

                <br />

                <label>Generator Grade </label>
                <input
                    value={turbine.generator.grade}
                    type="number"
                    min="1"
                    max="5"
                    onChange={e => setTurbine(draft => {
                        draft.generator.grade = e.target.value
                    })}
                />

                <br />
                <br />

                <button type="submit">Add</button>
                <button><Link to="/">Back to List</Link></button>

                <div>{message ? <p>{message}</p> : null}</div>
            </form>
        </div>
    );
}
