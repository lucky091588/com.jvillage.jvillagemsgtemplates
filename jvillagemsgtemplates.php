<?php

require_once 'jvillagemsgtemplates.civix.php';

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function jvillagemsgtemplates_civicrm_config(&$config) {
  _jvillagemsgtemplates_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function jvillagemsgtemplates_civicrm_xmlMenu(&$files) {
  _jvillagemsgtemplates_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function jvillagemsgtemplates_civicrm_install() {
  _jvillagemsgtemplates_civix_civicrm_install();
  _jvillagemsgtemplates_modifyDefaultTemplates('custom');
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
 */
function jvillagemsgtemplates_civicrm_postInstall() {
  _jvillagemsgtemplates_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function jvillagemsgtemplates_civicrm_uninstall() {
  _jvillagemsgtemplates_civix_civicrm_uninstall();
  _jvillagemsgtemplates_modifyDefaultTemplates('civicrm');
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function jvillagemsgtemplates_civicrm_enable() {
  _jvillagemsgtemplates_civix_civicrm_enable();
  _jvillagemsgtemplates_modifyDefaultTemplates('custom');
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function jvillagemsgtemplates_civicrm_disable() {
  _jvillagemsgtemplates_civix_civicrm_disable();
  _jvillagemsgtemplates_modifyDefaultTemplates('civicrm');
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function jvillagemsgtemplates_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _jvillagemsgtemplates_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function jvillagemsgtemplates_civicrm_managed(&$entities) {
  _jvillagemsgtemplates_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function jvillagemsgtemplates_civicrm_caseTypes(&$caseTypes) {
  _jvillagemsgtemplates_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function jvillagemsgtemplates_civicrm_angularModules(&$angularModules) {
  _jvillagemsgtemplates_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function jvillagemsgtemplates_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _jvillagemsgtemplates_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *
function jvillagemsgtemplates_civicrm_preProcess($formName, &$form) {

} // */

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_navigationMenu
 *
function jvillagemsgtemplates_civicrm_navigationMenu(&$menu) {
  _jvillagemsgtemplates_civix_insert_navigation_menu($menu, NULL, array(
    'label' => ts('The Page', array('domain' => 'com.jvillage.jvillagemsgtemplates')),
    'name' => 'the_page',
    'url' => 'civicrm/the-page',
    'permission' => 'access CiviReport,access CiviContribute',
    'operator' => 'OR',
    'separator' => 0,
  ));
  _jvillagemsgtemplates_civix_navigationMenu($menu);
} // */


function _jvillagemsgtemplates_modifyDefaultTemplates($to) {
  if ($to != 'custom' && $to != 'civicrm') {
    throw new Excetption('Invalid value for $to in call to '. __FUNCTION__);
  }
  
  $workflow_templates = array(
    'contribution_offline_receipt' => array(
      'html' =>  'offline_html.tpl',
      'txt' => 'offline_txt.tpl',
    ),
    'contribution_online_receipt' => array(
      'html' =>  'online_html.tpl',
      'txt' => 'online_txt.tpl',
    ),
  );

  $option_values = civicrm_api3('OptionValue', 'get', array(
    'sequential' => 1,
    'name' => array('IN' => array_keys($workflow_templates)),
    'option_group_id' => "msg_tpl_workflow_contribution",
  ));
  foreach ($option_values['values'] as $option_value) {
    try {
      $message_template = civicrm_api3('MessageTemplate', 'getsingle', array(
        'sequential' => 1,
        'workflow_id' => $option_value['id'],
        'is_reserved' => 1,
      ));
    }
    catch (Exception $e) {       
      throw new Exception("Could not find exactly one default template matching workflow '{$option_value['name']}");
    }
    
    $ext_path = CRM_Core_Resources::singleton()->getPath('com.jvillage.jvillagemsgtemplates') . '/msg_template/' . $to;
    
    $html = file_get_contents("{$ext_path}/{$workflow_templates[$option_value['name']]['html']}");
    $txt = file_get_contents("{$ext_path}/{$workflow_templates[$option_value['name']]['txt']}");
    
    
    
    $api_params = $message_template;
    $api_params['msg_text'] = $txt;
    $api_params['msg_html'] = $html;
    $result = civicrm_api3('MessageTemplate', 'create', $api_params);
  }
}
