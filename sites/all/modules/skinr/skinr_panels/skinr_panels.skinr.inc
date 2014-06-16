<?php
/**
 * @file
 * Provide skinr handling for panels.module.
 */

/**
 * @defgroup skinr_panels_module panels.module handlers.
 *
 * @{
 */

/**
 * Implements hook_skinr_config_info().
 */
function skinr_panels_skinr_config_info() {
  $data['panels']['form']['skinr_ui_form'] = array(
    'preprocess_hook_callback' => 'skinr_panels_skinr_preprocess_hook_callback',
    'title' => t('panel pane settings'),
    'collapsed' => FALSE,
  );
  $data['panels']['preprocess']['panels_pane'] = array(
    'index_handler' => 'skinr_panels_skinr_preprocess_index_handler',
  );
  $data['panels']['contextual_links']['panels_pane'] = array(
    'contextual_links_handler' => 'skinr_panels_skinr_contextual_links',
  );

  return $data;
}

/**
 * Skinr preprocess hook callback.
 *
 * @param &$form
 *   Passes in the $form parameter from hook_form_alter().
 * @param $form_state
 *   Passes in the $form_state parameter from hook_form_alter().
 *
 * @return
 *   An array of preprocess hooks we wish to use.
 */
function skinr_panels_skinr_preprocess_hook_callback(&$form, $form_state) {
  if (strpos($form['skinr']['element']['#value'], 'region') === 0) {
    return 'panels_region';
  }
  elseif (strpos($form['skinr']['element']['#value'], 'pane') === 0) {
    return 'panels_pane';
  }
  else {
    return 'panels_display';
  }
}

/**
 * Skinr preprocess index handler.
 *
 * @param &$variables
 *   Passes in the $variables parameter from module_preprocess().
 *
 * @return
 *   The index where we can find our values in Skinr's data structure. If an
 *   array is returned, it will loop through each index in Skinr's data
 *   structure and merge the returned classes.
 */
function skinr_panels_skinr_preprocess_index_handler(&$variables) {
  $index = array();
  $index[] = 'pane__' . $variables['pane']->did . '__' . $variables['pane']->pid;
  return $index;
}

/**
 * Skinr contextual links handler.
 *
 * @param &$variables
 *   Passes in the $variables parameter from skinr_preprocess().
 *
 * @return
 *   An array. Each value is an array that forms the function arguments for
 *   menu_contextual_links(). For example:
 *   @code
 *     array(
 *       'admin/appearance/skinr/edit', array('system', 'navigation')),
 *     )
 *   @endcode
 */
function skinr_panels_skinr_contextual_links(&$variables) {
  $links = array();
  $links['skinr-panels'] = array(
    'admin/appearance/skinr/edit/nojs', array('panels', 'pane__' . $variables['pane']->did . '__' . $variables['pane']->pid),
  );
  return $links;
}

/**
 * @}
 */
