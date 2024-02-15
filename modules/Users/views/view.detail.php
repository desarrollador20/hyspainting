<?php
class UsersViewDetail extends ViewDetail
{

    public function display()
    {
       
     
        $newScript = " $('#whole_subpanel_securitygroups').hide(); ";
        echo "<script>$(document).ready(function(){" . $newScript . "})</script>";
        parent::display();
    }
}
