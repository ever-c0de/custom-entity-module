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
  public $notValid = 'Phone %value is not valid.';
}
