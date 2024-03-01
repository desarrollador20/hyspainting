<?php
// created: 2024-02-29 21:19:40
$dictionary["Note"]["fields"]["hs_facturador_notes"] = array (
  'name' => 'hs_facturador_notes',
  'type' => 'link',
  'relationship' => 'hs_facturador_notes',
  'source' => 'non-db',
  'module' => 'HS_Facturador',
  'bean_name' => 'HS_Facturador',
  'vname' => 'LBL_HS_FACTURADOR_NOTES_FROM_HS_FACTURADOR_TITLE',
  'id_name' => 'hs_facturador_noteshs_facturador_ida',
);
$dictionary["Note"]["fields"]["hs_facturador_notes_name"] = array (
  'name' => 'hs_facturador_notes_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_HS_FACTURADOR_NOTES_FROM_HS_FACTURADOR_TITLE',
  'save' => true,
  'id_name' => 'hs_facturador_noteshs_facturador_ida',
  'link' => 'hs_facturador_notes',
  'table' => 'hs_facturador',
  'module' => 'HS_Facturador',
  'rname' => 'name',
);
$dictionary["Note"]["fields"]["hs_facturador_noteshs_facturador_ida"] = array (
  'name' => 'hs_facturador_noteshs_facturador_ida',
  'type' => 'link',
  'relationship' => 'hs_facturador_notes',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_HS_FACTURADOR_NOTES_FROM_NOTES_TITLE',
);
