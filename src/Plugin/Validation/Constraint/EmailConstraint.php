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

  // The message that will be shown if the value is not an integer.
  public $invalidEmail = 'Your email %value is not valid.';

}
