<?php
defined('MOODLE_INTERNAL') || die;

if ($hassiteconfig) {
    // Heading.
    $settings = new admin_settingpage('local_newplugin',
     'Отправка заявлений');
    $ADMIN->add('localplugins', $settings);

  
  $name = 'newplugin/emailfrom';
        $title = '123';
        $description = '321';
        $setting = new admin_setting_configtextarea($name, $title, $description, null);
        $settings->add($setting);
}