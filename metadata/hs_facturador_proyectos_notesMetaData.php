<?php
// created: 2024-02-14 01:52:35
$dictionary["hs_facturador_proyectos_notes"] = array (
  'true_relationship_type' => 'one-to-many',
  'relationships' => 
  array (
    'hs_facturador_proyectos_notes' => 
    array (
      'lhs_module' => 'HS_Facturador_proyectos',
      'lhs_table' => 'hs_facturador_proyectos',
      'lhs_key' => 'id',
      'rhs_module' => 'Notes',
      'rhs_table' => 'notes',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'hs_facturador_proyectos_notes_c',
      'join_key_lhs' => 'hs_facturador_proyectos_noteshs_facturador_proyectos_ida',
      'join_key_rhs' => 'hs_facturador_proyectos_notesnotes_idb',
    ),
  ),
  'table' => 'hs_facturador_proyectos_notes_c',
  'fields' => 
  array (
    0 => 
    array (
      'name' => 'id',
      'type' => 'varchar',
      'len' => 36,
    ),
    1 => 
    array (
      'name' => 'date_modified',
      'type' => 'datetime',
    ),
    2 => 
    array (
      'name' => 'deleted',
      'type' => 'bool',
      'len' => '1',
      'default' => '0',
      'required' => true,
    ),
    3 => 
    array (
      'name' => 'hs_facturador_proyectos_noteshs_facturador_proyectos_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'hs_facturador_proyectos_notesnotes_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'hs_facturador_proyectos_notesspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'hs_facturador_proyectos_notes_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'hs_facturador_proyectos_noteshs_facturador_proyectos_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'hs_facturador_proyectos_notes_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'hs_facturador_proyectos_notesnotes_idb',
      ),
    ),
  ),
);