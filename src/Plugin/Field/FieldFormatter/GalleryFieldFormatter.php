<?php

namespace Drupal\react_image_gallery\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Field\Plugin\Field\FieldFormatter\EntityReferenceFormatterBase;
use Drupal\Core\Field\FieldDefinitionInterface;

/**
 * Plugin implementation of the 'gallery_field_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "gallery_field_formatter",
 *   label = @Translation("React Gallery field formatter"),
 *   field_types = {
 *     "entity_reference"
 *   }
 * )
 */
class GalleryFieldFormatter extends EntityReferenceFormatterBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
      'infinite' => TRUE,
      'lazyLoad' => FALSE,
      'showNav' => TRUE,
      'showThumbnails' => TRUE,
      'showFullscreenButton' => TRUE,
      'showPlayButton' => TRUE,
      'showBullets' => FALSE,
      'showIndex' => FALSE,
      'autoPlay' => FALSE,
    ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $props = [
      'infinite',
      'lazyLoad',
      'showNav',
      'showThumbnails',
      'showFullscreenButton',
      'showPlayButton',
      'showBullets',
      'showIndex',
      'autoPlay',
    ];

    foreach ($props as $prop) {
      $elements[$prop] = [
        '#type' => 'checkbox',
        '#title' => $this->t('Image Gallery: <strong>@prop</strong>', [
          '@prop' => $prop,
        ]),
        '#default_value' => $this->getSetting($prop) ? TRUE : FALSE,
      ];
    }

    return $elements;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];
    $settings = array_filter($this->getSettings());

    $summary[] = $this->t('Rendering gallery with props: %settings', [
      '%settings' => implode(', ', array_keys($settings)),
    ]);

    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $build = [];
    $paragraph_id = $items->getEntity()->id();
    $settings = $this->getSettings();

    // Force js array to be using true/false instead 1/0.
    foreach ($settings as $setting => $value) {
      $settings[$setting] = $value ? TRUE : FALSE;
    }

    // Markup only requires a div with an id.
    $build['#markup'] = '<div id="image-gallery-' . $paragraph_id . '"></div>';

    // Attach required libraries.
    $build['#attached']['library'] = [
      'react_image_gallery/react',
      'react_image_gallery/component',
    ];

    // Set gallery settings into drupal settings.
    $build['#attached']['drupalSettings']['gallery'][$paragraph_id] = [
      'id' => $paragraph_id,
      'element' => 'image-gallery-' . $paragraph_id,
      'settings' => $settings,
    ];

    return $build;
  }

  /**
   * {@inheritdoc}
   */
  public static function isApplicable(FieldDefinitionInterface $field_definition) {
    // Formatter is only available for fields from an image_gallery paragraph.
    if (
      $field_definition->getTargetBundle() === 'image_gallery'
      && $field_definition->getTargetEntityTypeId() === 'paragraph') {
      return TRUE;
    }

    return FALSE;
  }

}
