<?php

namespace Drupal\ever\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * Checks that the submitted value is a unique integer.
 *
 * @Constraint(
 *   id = "PhoneConstraint",
 *   label = @Translation("Phone Constraint", context = "Validation"),
 *   type = "string"
 * )
 */
class PhoneConstraint extends Constraint {

  /**
   * Variable for failed validation.
   *
   * @var string
   *  If validation failed returns response.
   *
   * public $notValid = 'Phone %value is not valid.';
   */

}
