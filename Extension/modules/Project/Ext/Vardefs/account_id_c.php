<?php
$dictionary['Project']['fields']['account_id_c'] = array (
  'inline_edit' => 1,
  'required' => true,
  'source' => 'custom_fields',
  'name' => 'account_id_c',
  'vname' => 'LBL_COMPANIA_ACCOUNT_ID',
  'type' => 'id',
  'massupdate' => '0',
  'default' => NULL,
  'no_default' => false,
  'comments' => '',
  'help' => '',
  'importable' => 'true',
  'duplicate_merge' => 'disabled',
  'duplicate_merge_dom_value' => '0',
  'audited' => false,
  'reportable' => false,
  'unified_search' => false,
  'merge_filter' => 'disabled',
  'len' => '36',
  'size' => '20',
  'id' => 'Projectaccount_id_c',
);
$dictionary['Project']['fields']['compania_c'] = array (
  'inline_edit' => '',
  'labelValue' => 'Compania',
  'required' => true,
  'source' => 'non-db',
  'name' => 'compania_c',
  'vname' => 'LBL_COMPANIA',
  'type' => 'relate',
  'massupdate' => '0',
  'default' => NULL,
  'no_default' => false,
  'comments' => '',
  'help' => '',
  'importable' => 'true',
  'duplicate_merge' => 'disabled',
  'duplicate_merge_dom_value' => '0',
  'audited' => true,
  'reportable' => true,
  'unified_search' => false,
  'merge_filter' => 'disabled',
  'len' => '255',
  'size' => '20',
  'id_name' => 'account_id_c',
  'ext2' => 'Accounts',
  'module' => 'Accounts',
  'rname' => 'name',
  'quicksearch' => 'enabled',
  'studio' => 'visible',
  'id' => 'Projectcompania_c',
);


