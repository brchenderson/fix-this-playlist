import React from 'react';
import Playlist from './Playlist';
import {Link} from 'react-router-dom';

const PlaylistPage = () => (
  <div>
    <h1>This is the playlist / Main page.</h1>
    <Playlist />
    <Link to="/search">I want to add my own songs.</Link>
  </div>
);

export default PlaylistPage;
