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
 * Custom fields handler
 *
 * @package    mod_surveybuilder
 * @copyright  2018 Marina Glancy
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_surveybuilder\customfield;

use core_customfield\field_controller;

defined('MOODLE_INTERNAL') || die();

/**
 * Customfields handler
 *
 * @package    mod_surveybuilder
 * @copyright  2018 Marina Glancy
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class fields_handler extends \core_customfield\handler {

    public function can_configure(): bool {
        return true; // TODO
    }

    /**
     * The current user can edit custom fields on the given record on this component.
     *
     * @param field_controller $field
     * @param int $instanceid
     * @return bool
     */
    public function can_edit(field_controller $field, $instanceid = null): bool {
        return true; // TODO
    }

    public function get_configuration_url(): \moodle_url {
        return new \moodle_url('/mod/surveybuilder/customfield.php', ['s' => $this->get_itemid()]);
    }

    public function can_view(field_controller $field, $instanceid = null): bool {
        return true; // TODO
    }

    public function get_instance_context(int $instanceid): \context {
        return $this->get_configuration_context();
    }

    public function get_configuration_context(): \context {
        // TODO caching.
        list($course, $cm) = get_course_and_cm_from_instance($this->get_itemid(), 'surveybuilder');
        return $cm->context;
    }

    public function display_instance_custom_fields(int $instanceid) {
        // TODO: Implement display_instance_custom_fields() method.
    }

    public function setup_edit_page(field_controller $field): string {
        global $PAGE;
        list($course, $cm) = get_course_and_cm_from_instance($this->get_itemid(), 'surveybuilder');
        require_login($course, false, $cm);
        $PAGE->navigation->override_active_url(new \moodle_url('/mod/surveybuilder/customfield.php', ['s' => $this->get_itemid()]));
        $title = parent::setup_edit_page($field);
        $PAGE->navbar->add($title);
        return $title;
    }
}