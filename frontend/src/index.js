import React from 'react';
import ReactDOM from 'react-dom';
//import bootstrap 
import 'bootstrap/dist/css/bootstrap.min.css';
import { Provider } from 'react-redux'; // Redux Provider
import { configureStore } from '@reduxjs/toolkit';
import { BrowserRouter } from 'react-router-dom';
import App from './App';
import authSlice from './store/authSlice'; // Example Redux slice
import './index.css'; // Optional global CSS

// Configure Redux Store
const store = configureStore({
  reducer: {
    auth: authSlice, // Add reducers here
  },
});

ReactDOM.render(
  <Provider store={store}>
    <BrowserRouter>
      <App />
    </BrowserRouter>
  </Provider>,
  document.getElementById('root')
);
