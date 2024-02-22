<?php
$listViewDefs ['ProjectTask'] = 
array (
  'NAME' => 
  array (
    'width' => '40%',
    'label' => 'LBL_LIST_NAME',
    'link' => true,
    'default' => true,
    'sortable' => true,
  ),
  'PROJECT_NAME' => 
  array (
    'width' => '25%',
    'label' => 'LBL_PROJECT_NAME',
    'id' => 'PROJECT_ID',
    'link' => true,
    'default' => true,
    'sortable' => true,
    'module' => 'Project',
    'ACLTag' => 'PROJECT',
    'related_fields' => 
    array (
      0 => 'project_id',
    ),
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '10%',
    'label' => 'LBL_LIST_ASSIGNED_USER_ID',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => false,
  ),
  'PERCENT_COMPLETE' => 
  array (
    'width' => '10%',
    'label' => 'LBL_LIST_PERCENT_COMPLETE',
    'default' => false,
    'sortable' => true,
  ),
  'PRIORITY' => 
  array (
    'width' => '10%',
    'label' => 'LBL_LIST_PRIORITY',
    'default' => false,
    'sortable' => true,
  ),
  'DATE_FINISH' => 
  array (
    'width' => '10%',
    'label' => 'LBL_DATE_FINISH',
    'default' => false,
    'sortable' => true,
  ),
  'DATE_START' => 
  array (
    'width' => '10%',
    'label' => 'LBL_DATE_START',
    'default' => false,
    'sortable' => true,
  ),
);
;
?>
