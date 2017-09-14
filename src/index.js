import React from 'react';
import ReactDOM from 'react-dom';
import './index.css';
import App from './App';
import {BrowserRouter as Router} from 'react-router-dom';
import registerServiceWorker from './registerServiceWorker';
//import { createStore, combineReducers, applyMiddleware } from 'redux';
//import thunk        from 'redux-thunk';
//import { Provider } from 'react-redux';
//import { syncHistory, routeReducer }     from 'react-router-redux';
//import { createHistory } from 'history';
//import Login   from './components/Login';
//import Error   from './components/Error';

//const store = createStore(reducer, initialState);

ReactDOM.render(

    <Router>
      <App />
    </Router>, document.getElementById('root'));
registerServiceWorker();
