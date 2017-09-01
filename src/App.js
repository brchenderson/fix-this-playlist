import React, { Component } from 'react';
import logo from './logo.svg';
import './App.css';
import {Switch, Route} from 'react-router-dom';
import PlaylistPage from './components/PlaylistPage';
import SearchPage from './components/SearchPage';
import Login from './components/Login';

class App extends Component {
  render() {
    return (
      <Switch>
        <Route exact path="/" component={PlaylistPage} />
        <Route path="/search" component={SearchPage} />
        <Route path="/login" component={Login} />
      </Switch>
    );
  }
}

export default App;
