import React from 'react';
import ReactDOM from 'react-dom';

import App from './App';

const galleries = window.drupalSettings.gallery || {};

Object.keys(galleries).forEach(key => {
  ReactDOM.render(
    <App id={galleries[key].id} settings={galleries[key].settings} />,
    document.getElementById(galleries[key].element)
  );
});
