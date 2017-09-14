import React from 'react';


const breakOutArtists = (artists) => {
  //Iterate and return all with commas
  return artists[0].name;
}

const Track = (props) => {
    return(
      <li>
        <p><strong>{breakOutArtists(props.props.artists)} </strong> - {props.props.name}</p>
      </li>
    )
}

export default Track;
