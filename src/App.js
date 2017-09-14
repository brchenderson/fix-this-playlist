import React, { Component } from 'react';
import './App.css';
import {Switch, Route} from 'react-router-dom';
import PlaylistPage from './components/PlaylistPage';
import SearchPage from './components/SearchPage';


class App extends Component {
  render() {
    return (
      <Switch>
        <Route exact path="/" component={PlaylistPage} />
        <Route path="/search" component={SearchPage} />
      </Switch>
    );
  }
}

export default App;
