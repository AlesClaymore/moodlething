<?php
require_once("$CFG->libdir/formslib.php");

class form_123 extends moodleform {
    public function definition() {
    global $CFG;
    $mform = $this->_form;
    $mform->addElement('checkbox', 'openup', 'Готов',);

    $mform->addElement('text', 'email', 'Почта студента');
    $mform->settype('email', PARAM_EMAIL);
    $mform->addRule('email',  get_string('Введите корректные данные'), 'required');
    $mform->setDefault('email',  'ivanivanov@mail.ru');
    $mform->hideIF('email', 'openup');
    $mform->hideIF('uni', 'openup');
    $mform->hideIF('age', 'openup');
    $mform->hideIF('additionalinfo', 'openup');
    $mform->hideIF('', 'openup');
    
    $qwe = get_config('newplugin', 'emailfrom');
    $ewq = explode("\n", $qwe);

    
    $mform->addElement('select', 'uni', 'Университет', $ewq);
    
    $mform->setDefault('university', array('МУИВ'));
    $mform->addRule('university', get_string('Выберите университет'), 'required');

    $mform->addElement('text', 'age',  'Возраст');
    $mform->setType('age', PARAM_INT);
    $mform->addRule('age', get_string('Введите корректный возраст'), 'numeric');
    $mform->addRule('age',  get_string('bio','local_newplugin'), 'required');

    $mform->addElement('textarea', 'additionalinfo', 'О себе');
    $mform->addRule('additionalinfo', get_string('Поле не заполнено'), 'required');
   // $mform->addRule('additionalinfo', get_string('bio','local_newplugin'), 'rangelength', array(5, 200));

    $this->add_action_buttons(true, 'Подать заявление');
    }
function validation($data, $files) {
    $errors=parent::validation($data, $files);
    if($data['age']<18) { 
        $errors['age']='Возраст слишком мал';
    }
    if($data['age'] > 60) {
        $errors['age'] = 'Слишком старый';
    }
    if(strlen($data['additionalinfo']) < 5){
        $errors['additionalinfo']='Слишком кратко';
    }
    if(strlen($data['additionalinfo']) >200){
        $errors['additionalinfo']='Слишком длинно';
    }
    return $errors;
}
    }

?>