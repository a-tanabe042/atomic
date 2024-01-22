import React from 'react';
import ReactDOM from 'react-dom/client'; // Updated import
import App from './App';
import './styles.css';

const rootElement = document.getElementById('root');
const root = ReactDOM.createRoot(rootElement); // Use the imported createRoot
root.render(
  <React.StrictMode>
    <App />
  </React.StrictMode>
);
