import { useContext, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import axios from 'axios';
import { AuthContext } from '../app';

export default function Login() {
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [message, setMessage] = useState('');
    const { setAuth } = useContext(AuthContext);
    const navigate = useNavigate();

    const login = (e) => {
        e.preventDefault();

        axios.get('/sanctum/csrf-cookie');
        axios.post('/api/login', { email, password })
            .then(() => {
                setAuth(true);
                navigate('/');
            })
            .catch(() => {
                setMessage('Something went wrong. Please try again.');
            });
    }

    return (
        <div>
            <h2>Login</h2>

            <form onSubmit={login}>
                <label>Email: </label>
                <input
                    value={email}
                    type="email"
                    onChange={e => setEmail(e.target.value)}
                />

                <br />

                <label>Password: </label>
                <input
                    value={password}
                    type="password"
                    onChange={e => setPassword(e.target.value)}
                />

                <br />
                <br />

                <button type="submit">Log in</button>
            </form>

            <div>{message ? <p>{message}</p> : null}</div>
        </div>
    );
}
