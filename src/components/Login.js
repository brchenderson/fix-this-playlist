import React, { Component } from 'react';


/**
 * Our login page
 * Has a login button that hit's the login url
 */
export default class Login extends Component {
  render() {
    return (
      <div className="login">
        <h2>Here's our login page!</h2>
        <a href="/login">LOGIN HERE!</a>
      </div>
    );
  }
}
