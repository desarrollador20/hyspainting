<?php

class HS_PrestamosController extends SugarController
{


    public function action_save()
    {
        if (!isset($this->bean->date_modified)) {
            $time = new DateTime($this->bean->fetched_row['date_entered']);
            $this->bean->name  = sprintf('PR-%s', $time->format('Ymd-His'));
        }
        parent::action_save();
    }




protected function post_save()
{

    //  $this->view='edit';
    SugarApplication::redirect('index.php?module=HS_Prestamos&action=index&parentTab=Todo');
}
}