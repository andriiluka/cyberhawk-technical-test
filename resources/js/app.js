import { createRoot } from 'react-dom/client';
import { BrowserRouter, Routes, Route, Link, useNavigate } from 'react-router-dom';
import axios from 'axios';
import { createContext, useEffect, useState } from 'react';

import Turbines from './Pages/Turbines';
import TurbineCreate from './Pages/TurbineCreate';
import TurbineEdit from './Pages/TurbineEdit';
import Login from './Pages/Login';

export const AuthContext = createContext(null);

function App() {
    const navigate = useNavigate();
    const [auth, setAuth] = useState(null);

    axios.interceptors.response.use(function (response) {
        return response;
    }, function (error) {
        if (error.response?.status === 401) {
            navigate('/login');
        }

        return Promise.reject(error);
    });

    useEffect(() => {
        axios.get('/api/me')
            .then(() => {
                setAuth(true);
            });
    }, []);

    function logout() {
        axios.post('/api/logout')
            .then(() => {
                setAuth(false);
                navigate('/login');
            });
    }

    return (
        <AuthContext.Provider value={{ auth, setAuth }}>
            <h1><Link to="/">Wind Farm</Link></h1>

            {!auth ?
                <button><Link to="/login">Log in</Link></button> :
                <button onClick={logout}>Log out</button>
            }

            <Routes>
                <Route path="/login" element={<Login /> } />
                <Route path="/" element={<Turbines /> } />
                <Route path="/turbines/new" element={<TurbineCreate /> } />
                <Route path="/turbines/:id" element={<TurbineEdit /> } />
            </Routes>
        </AuthContext.Provider>
    );
}

const container = document.getElementById('app');

if (container) {
    const root = createRoot(container);

    root.render(<BrowserRouter><App /></BrowserRouter>);
}
