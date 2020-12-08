<?php

/**
 * @file
 * Contains ever_entity.page.inc.
 *
 * Page callback for Ever entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Ever entity templates.
 *
 * Default template: ever_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_ever_entity(array &$variables) {
  // Fetch EverEntity Entity Object.
  $ever_entity = $variables['elements']['#ever_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
