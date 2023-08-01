<?php
DEFINE('NAME', 'local_newplugin');

function cprint($var) {
    echo '<!--'.var_dump($var).'-->';
}

/*function local_newplugin_extend_navigation(global_navigation $navigation)
{
    $secondary_node = $navigation->add
    (
        get_string('pluginname', NAME), '/local/newplugin/');

    $secondary_node->showinflatnavigation = true;
}
*/
?>
