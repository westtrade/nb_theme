<?php
/**
 * @file
 * button.vars.php
 */

/**
 * Implements hook_preprocess_button().
 */
function nanobarrier_preprocess_button(&$vars) {

    dpm($vars);


  $vars['element']['#attributes']['class'][] = 'btn';
  if (isset($vars['element']['#value'])) {
    if ($class = _bootstrap_colorize_button($vars['element']['#value'])) {
      $vars['element']['#attributes']['class'][] = $class;
    }
  }
}
