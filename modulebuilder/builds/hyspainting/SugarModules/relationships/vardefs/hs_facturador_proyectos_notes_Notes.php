<?php
// created: 2024-02-14 01:52:35
$dictionary["Note"]["fields"]["hs_facturador_proyectos_notes"] = array (
  'name' => 'hs_facturador_proyectos_notes',
  'type' => 'link',
  'relationship' => 'hs_facturador_proyectos_notes',
  'source' => 'non-db',
  'module' => 'HS_Facturador_proyectos',
  'bean_name' => 'HS_Facturador_proyectos',
  'vname' => 'LBL_HS_FACTURADOR_PROYECTOS_NOTES_FROM_HS_FACTURADOR_PROYECTOS_TITLE',
  'id_name' => 'hs_facturador_proyectos_noteshs_facturador_proyectos_ida',
);
$dictionary["Note"]["fields"]["hs_facturador_proyectos_notes_name"] = array (
  'name' => 'hs_facturador_proyectos_notes_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_HS_FACTURADOR_PROYECTOS_NOTES_FROM_HS_FACTURADOR_PROYECTOS_TITLE',
  'save' => true,
  'id_name' => 'hs_facturador_proyectos_noteshs_facturador_proyectos_ida',
  'link' => 'hs_facturador_proyectos_notes',
  'table' => 'hs_facturador_proyectos',
  'module' => 'HS_Facturador_proyectos',
  'rname' => 'name',
);
$dictionary["Note"]["fields"]["hs_facturador_proyectos_noteshs_facturador_proyectos_ida"] = array (
  'name' => 'hs_facturador_proyectos_noteshs_facturador_proyectos_ida',
  'type' => 'link',
  'relationship' => 'hs_facturador_proyectos_notes',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_HS_FACTURADOR_PROYECTOS_NOTES_FROM_NOTES_TITLE',
);
