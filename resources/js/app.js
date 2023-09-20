import { createRoot } from 'react-dom/client';
import { BrowserRouter, Routes, Route, Link } from 'react-router-dom';

import Turbines from './Pages/Turbines';
import TurbineCreate from './Pages/TurbineCreate';
import TurbineEdit from './Pages/TurbineEdit';

function App() {
    return (
        <BrowserRouter>
            <h1><Link to="/">Wind Farm</Link></h1>

            <Routes>
                <Route path="/" element={<Turbines /> } />
                <Route path="/turbines/new" element={<TurbineCreate /> } />
                <Route path="/turbines/:id" element={<TurbineEdit /> } />
            </Routes>
        </BrowserRouter>
    );
}

const container = document.getElementById('app');

if (container) {
    const root = createRoot(container);

    root.render(<App />);
}
