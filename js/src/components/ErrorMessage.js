import React from 'react';
import PropTypes from 'prop-types';

const ErrorMessage = props => {
  return <div className="messages messages--error">{props.message}</div>;
};

ErrorMessage.propTypes = {
  message: PropTypes.string,
};

export default ErrorMessage;
