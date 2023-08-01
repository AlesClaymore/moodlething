<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/moodle/config.php');
//require_once($_SERVER['DOCUMENT_ROOT'].'/moodle/local/newplugin/templates/statements.mustache');
require_once('./classes/form/form_statements.php');
global $DB;

$mform = new form_statements();

if ($mform->is_cancelled()) {

    redirect($CFG->wwwroot.'/my/', 'синяя');
}   else if ($fromform = $mform->get_data()) {
        redirect($CFG->wwwroot.'/local/newplugin/index.php', 'Красная');
}

 $that=get_config('newplugin', 'emailfrom');
 $exp = explode("\n", $that);
//$statementsDB=$DB->get_records('folder');
$statementsDB=$DB->get_records_sql('SELECT * FROM {folder} ORDER BY date DESC');
foreach ($statementsDB as $st) {
    $st->date=date("d.m.y H:i", $st->date);
    if ($st->chosenuni == 0) {     
            $st->chosenuni = $exp[0];
    }   
        else if ($st->chosenuni ==1) {
        $st->chosenuni = $exp[1];
    }
        else if ($st->chosenuni ==2) {
        $st->chosenuni = $exp[2];
    }
        else if ($st->chosenuni ==3) {
        $st->chosenuni = $exp[3];
    }
        else if ($st->chosenuni ==4) {
        $st->chosenuni = $exp[4];
    }
        $idn=$DB->get_records('user', ['id'=>$st->fullname]);
        foreach ($idn as $n) {
            $st->fullname=$n->firstname . ' ' . $n->lastname;

        }
}





echo $OUTPUT->header();
$mform->display();
$templatecontext = (object)['444'=>array_values($statementsDB)];
echo $OUTPUT->render_from_template('local_newplugin/statements', $templatecontext);
echo $OUTPUT->footer();
