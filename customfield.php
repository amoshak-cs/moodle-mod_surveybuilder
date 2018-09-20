<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * @package    mod_surveybuilder
 * @copyright  2018 Marina Glancy
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(dirname(dirname(__DIR__)) . '/config.php');

$moduleid  = optional_param('s', 0, PARAM_INT);

list($course, $cm) = get_course_and_cm_from_instance($moduleid, 'surveybuilder');
require_login($course, $cm);

$PAGE->set_url(new moodle_url('/mod/surveybuilder/customfield.php', ['s' => $moduleid]));

$handler = new \mod_surveybuilder\customfield\fields_handler($moduleid);
if (!$handler->can_configure()) {
    throw new moodle_exception('You shouldn\'t be here');
}

$output = $PAGE->get_renderer('core_customfield');
$outputpage = new \core_customfield\output\management($handler);

echo $output->header(),
$output->render($outputpage),
$output->footer();
