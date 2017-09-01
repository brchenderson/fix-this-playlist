import React, {Component} from 'react';
import Track from './Track';
import SpotifyWebApi from 'spotify-web-api-node';

/*const spotifyApi = new SpotifyWebApi({
  clientId : '76fb6284f8984d5fa793a6c6ee802caf',
  clientSecret : 'beb5b5e47c414ec2b0807e7e66b81446',
  redirectUri : 'http://localhost:3000/callback'
});

spotifyApi.getArtistAlbums('43ZHCT0cAZBISjO8DG9PnE')
.then(function(data) {
console.log('Artist albums', data.body);
}, function(err) {
console.error(err);
}); */

export default class Playlist extends Component{
  componentDidMount(){
    //Will use Redux action later!!!!
    /*fetch('https://api.spotify.com/v1/users/brchenderson/playlists/5ERxKv5RaWcnVm8UXJkqba').then(function(response){
      if(response.ok) {
        return response.json();
      }
      //throw new Error('Network response was not ok.');
    }).then(function(result){
      console.log(result)
    });*/
  }
  render(){
    return(
      <div>
        <h2>THis is the actual playlist.</h2>
        <ul>
          <Track />
          <Track />
          <Track />
        </ul>
      </div>
    )
  }
}
