<?php

namespace Drupal\ever\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * Checks that the submitted value is a unique integer.
 *
 * @Constraint(
 *   id = "EmailConstraint",
 *   label = @Translation("Email Constraint", context = "Validation"),
 *   type = "string"
 * )
 */
class EmailConstraint extends Constraint {

  /**
   * @var string
   *  If validation failed returns response.
   *
   * public $invalidEmail = 'Your email %value is not valid.';
   */

}
