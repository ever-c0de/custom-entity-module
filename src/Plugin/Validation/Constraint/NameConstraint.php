<?php

namespace Drupal\ever\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * Checks that the submitted value is a unique integer.
 *
 * @Constraint(
 *   id = "NameConstraint",
 *   label = @Translation("Name Constraint", context = "Validation"),
 *   type = "string"
 * )
 */
class NameConstraint extends Constraint {

  /**
   * Variable for failed validation.
   *
   * @var string
   *  If validation failed returns response.
   *
   * public $notValid = 'Your name %value is not valid.';
   */

}
