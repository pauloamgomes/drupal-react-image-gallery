import React, { Component } from 'react';
import PropTypes from 'prop-types';

import Gallery from './components/Gallery';

class App extends Component {
  render() {
    return (
      <div>
        <Gallery id={this.props.id} settings={this.props.settings} />
      </div>
    );
  }
}

App.propTypes = {
  id: PropTypes.string,
  settings: PropTypes.object,
};

export default App;
