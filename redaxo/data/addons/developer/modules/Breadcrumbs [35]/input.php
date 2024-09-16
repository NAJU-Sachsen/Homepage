<?php
$mform = MForm::factory();
$mform->addSelectField(1, ['align_left' => 'linksbündig', 'align_right' => 'rechtsbündig'], ['label' => 'Platzierung']);
echo $mform->show();
