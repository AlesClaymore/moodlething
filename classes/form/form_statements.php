<?php
require_once("$CFG->libdir/formslib.php");

class form_statements extends moodleform {
    public function definition() {
    global $CFG;
    $mform = $this->_form;
    
    $this->add_action_buttons(true, 'Подать заявление');
    
    function validation($data, $files){}
    $errors=parent::validation($data, $files);
    return $errors;
    }
}
