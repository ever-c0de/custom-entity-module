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

  // The message that will be shown if the value is not unique.
  public $notValid = 'Your name %value is not valid';

}
