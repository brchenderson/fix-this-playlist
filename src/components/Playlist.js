import React, {Component} from 'react';
import Track from './Track';

export default class Playlist extends Component{
  state = {
    tracks: []
  }

  getSongs(){
    fetch('http://localhost:8888/username/brchenderson/playlist/5ERxKv5RaWcnVm8UXJkqba').then((response) => response.json()).then((result) => {
      console.log(result.tracks.items);
      this.setState({
        tracks: result.tracks.items,
      })
    })
  }

  componentDidMount(){
    this.getSongs();
  }
  render(){

    var tracks = this.state.tracks.map((track, i)=>{
      return <Track props={track.track} />
    });

    return(
      <div>
        <h2>THis is the actual playlist.</h2>
        <ul>
          {tracks}
        </ul>
      </div>
    )
  }
}
