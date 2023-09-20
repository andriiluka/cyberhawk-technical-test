import { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import axios from 'axios';

export default function Turbines() {
    const [turbines, setTurbines] = useState([]);

    const fetchTurbines = () => {
        axios.get('/api/turbines')
            .then(response => {
                setTurbines(response.data.data);
            });
    }

    useEffect(() => {
        fetchTurbines();
    }, []);

    return (
        <div>
            <h2>Turbines</h2>

            <button><Link to="/turbines/new">Add New</Link></button>

            {turbines.length > 0 && (
                <ul>
                    {turbines.map(turbine => (
                        <li key={turbine.id}>
                            <Link to={`turbines/${turbine.id}`}>Turbine #{turbine.id}</Link>
                        </li>
                    ))}
                </ul>
            )}
        </div>
    );
}
