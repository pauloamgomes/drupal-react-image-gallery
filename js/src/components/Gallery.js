import React, { Component } from 'react';
import PropTypes from 'prop-types';
import { connect, PromiseState } from 'react-refetch';
import ImageGallery from 'react-image-gallery';

import Loading from './Loading';
import ErrorMessage from './ErrorMessage';

import 'react-image-gallery/styles/css/image-gallery.css';

class Gallery extends Component {
  render() {
    const { imageFetch } = this.props;

    if (imageFetch.pending) {
      return <Loading />;
    } else if (imageFetch.rejected) {
      console.error(imageFetch.reason);
      return <ErrorMessage message="An unexpected error has occurred." />;
    } else if (imageFetch.fulfilled) {
      const images = imageFetch.value.map((value, idx) => {
        return {
          original: `${process.env.REACT_APP_DRUPAL_HOST}${value.image}`,
          thumbnail: `${process.env.REACT_APP_DRUPAL_HOST}${value.thumbnail}`,
          originalAlt: value.name,
          originalTitle: value.name,
          description: value.description,
        };
      });

      return <ImageGallery items={images} {...this.props.settings} />;
    }
  }
}

Gallery.propTypes = {
  id: PropTypes.string,
  settings: PropTypes.object,
  imageFetch: PropTypes.instanceOf(PromiseState).isRequired,
};

export default connect(props => {
  return {
    imageFetch: `${process.env.REACT_APP_DRUPAL_HOST}/api/image-gallery/${
      props.id
    }?_format=json`,
  };
})(Gallery);
