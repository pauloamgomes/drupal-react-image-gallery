## React Image Gallery 8.x-1.x

### About this Module

This module provides a dynamic Image Gallery based on the React Image Gallery component.
(https://github.com/xiaolin/react-image-gallery).

The idea of the module came during investigating ways to develop React components under Drupal.

### Goals

* A simple way to display an Image Gallery on any Drupal 8 website
* Have few dependencies on 3rd parties
* Flexibity for the site builders

### Demo

> [Watch a demo](https://youtu.be/CY08LVXfk88) of the React Image Gallery module.

### Requirements

Module depends on Media (core) and Paragraphs module.

### Installation

* Install as you would normally install a contributed Drupal module.
  See: https://www.drupal.org/node/895232 for further information.

### Configuration

1.  Copy/upload the module to the modules directory of your Drupal installation.

2.  Enable the 'React Image Gallery' module and desired sub-modules in 'Extend'. (/admin/modules)

3.  Configure a content type (or a custom block) with an entity reference revisions (Paragraph)

4.  Create some gallery media items. (/media/add/gallery_image)

5.  Create or edit a content of the type configured on step 4 and add a 'Image Gallery' paragraph.

6.  Configure the paragraph with the media items you want.

7.  Save the content and confirm that the 'React Image Gallery' is loaded in the page.

### Development on the react App

The react app resides in the js directory (/react_image_gallery/js), to build or make changes its required to run:

```
yarn install
```

then the app can built:

```
yarn build
```

to start the app:

```
yarn start
```

When running the app locally it's required to mock in the public/index.html the settings that are passed to the gallery component,
those settings shall reflect the paragraph id where the gallery is present in Drupal. Its also required to enable CORS settings in Drupal, add the below lines inside parameters attribute to your development.services.yml:

```
  cors.config:
    enabled: true
    # Specify allowed headers, like 'x-allowed-header'.
    allowedHeaders: ['x-csrf-token', 'authorization', 'content-type', 'accept', 'origin', 'x-requested-with']
    # Specify allowed request methods, specify ['*'] to allow all possible ones.
    allowedMethods: ['POST', 'GET', 'OPTIONS']
    # Configure requests allowed from specific origins.
    allowedOrigins: ['*']
    # Sets the Access-Control-Expose-Headers header.
    exposedHeaders: true
    # Sets the Access-Control-Max-Age header.
    maxAge: false
    # Sets the Access-Control-Allow-Credentials header.
    supportsCredentials: false
  twig.config:
    debug: false
    auto_reload: true
    cache: false
```

### Author/Maintainer

* Paulo Gomes (pauloamgomes) - https://www.drupal.org/u/pauloamgomes
