import React from 'react';

const styles = {
  throbber: {
    width: '10px',
    height: '10px',
    display: 'inline-block',
  },
};

const Loading = props => {
  return (
    <div className="ajax-progress ajax-progress-throbber">
      <div style={styles.throbber} className="throbber" />Loading...
    </div>
  );
};

export default Loading;
