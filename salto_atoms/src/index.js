import React, { Suspense } from 'react';
import ReactDOM from 'react-dom/client';
import './index.css';
import App from './App';
import store from './app/store';
import { Provider } from 'react-redux';
import SuspenseContent from './containers/SuspenseContent';
import { RecoilRoot } from 'recoil'; // Import RecoilRoot

const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(
    <Suspense fallback={<SuspenseContent />}>
        <RecoilRoot> 
            <Provider store={store}>
                <App />
            </Provider>
        </RecoilRoot>
    </Suspense>
  // </React.StrictMode>
);

