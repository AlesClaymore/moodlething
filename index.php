<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/moodle/config.php');
require_once('./classes/form/form_123.php');
global $DB, $USER;
$PAGE->set_title('Сервис: Подача заявлений');
$PAGE->set_url(new moodle_url('/local/newplugin/index.php'));
$mform = new form_123();

if ($mform->is_cancelled()) {
    
    redirect($CFG->wwwroot.'/local/newplugin/statements.php/', 'Вы отменили подачу заявления'); //редирект если нажать отмену в форме
}  else if ($fromform = $mform->get_data()) {
    $dbtable=new stdClass();
    $dbtable->fullname=$USER->id;
    $dbtable->date=time();
    $dbtable->age=$fromform->age;
    $dbtable->email=$fromform->email;
    $dbtable->chosenuni=$fromform->uni;
    $dbtable->bio=$fromform->additionalinfo;
    $DB->insert_record('folder', $dbtable);
    redirect($CFG->wwwroot.'/local/newplugin/statements.php/', 'Успех! Можете посмотреть список ваших заявлений'); //успех, редирект
}
    $i32 = 'SELECT * FROM {folder} WHERE fullname = :zoom ORDER BY date DESC LIMIT 1'; 
    $timer = $DB->get_records_sql($i32, ['zoom'=>$USER->id]);
    $time = '';
    foreach ($timer as $r) {
        $time = $r->date;
    }
    $ct=time();
    $nt=($ct - $time);
    $cd=(3600 - $nt);
    $timerupdate=gmdate("H:i:s", $cd);

    echo $OUTPUT->header();

    if ($ct - $time < 3600) {
        \core\notification::error('У вас осталось: ' .  $timerupdate);
    }
    else {
        $mform->display();
    }
    echo $OUTPUT->footer();
    ?>