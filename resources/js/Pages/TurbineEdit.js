import { useState, useEffect } from 'react';
import axios from 'axios';
import { Link, useParams } from 'react-router-dom';
import { useImmer } from "use-immer";

export default function TurbineEdit() {
    const [turbine, setTurbine] = useImmer(null);
    const [message, setMessage] = useState('');
    let { id } = useParams();

    const fetchTurbine = () => {
        axios.get(`/api/turbines/${id}`)
            .then(response => {
                setTurbine(response.data.data);
            });
    }

    useEffect(() => {
        fetchTurbine();
    }, []);

    const updateTurbine = (e) => {
        e.preventDefault();

        axios.put(`/api/turbines/${id}`, turbine)
            .then(() => {
                setMessage('Updated successfully.');
            })
            .catch(() => {
                setMessage('Something went wrong. Please try again.');
            });
    };

    function handleBladesChange(id, value) {
        setTurbine(draft => {
            const blade = draft.blades.find(blade =>
                blade.id === id
            );
            blade.grade = value;
        });
    }

    return (
        <div>
            <h2>Turbine #{id}</h2>

            {turbine && (
                <form onSubmit={updateTurbine}>
                    {turbine.blades.map(blade => (
                        <div key={blade.id}>
                            <label>Blade #{blade.id} Grade </label>
                            <input
                                value={blade.grade ?? ''}
                                type="number"
                                min="1"
                                max="5"
                                onChange={e => handleBladesChange(blade.id, e.target.value)}
                            />
                        </div>
                    ))}

                    <label>Rotor Grade </label>
                    <input
                        value={turbine.rotor.grade ?? ''}
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
                        value={turbine.hub.grade ?? ''}
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
                        value={turbine.generator.grade ?? ''}
                        type="number"
                        min="1"
                        max="5"
                        onChange={e => setTurbine(draft => {
                            draft.generator.grade = e.target.value
                        })}
                    />

                    <br />
                    <br />

                    <button type="submit">Update</button>
                    <button><Link to="/">Back to List</Link></button>

                    <div>{message ? <p>{message}</p> : null}</div>
                </form>
            )}
        </div>
    );
}
