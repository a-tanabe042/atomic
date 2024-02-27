import React from 'react';
import ReactDOM from 'react-dom/client';
import './index.css';
import App from './App';
import { RecoilRoot } from 'recoil'; // Import RecoilRoot

const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(
        <RecoilRoot> 
                <App />
        </RecoilRoot>
);

