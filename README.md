# Team_generator #

## Describe the plugin.

Team Generator allows automation in the creation of groups, both homogeneous and heterogeneous, and taking into account characteristics that each creator can customize. It is useful to ensure that the groups are balanced, in accordance with the objective of the task and up to date. It also improves the relationship between the people in the "Team" and the collective in general, increasing confidence in the environment and promoting class cohesion.

## Provide more detailed description here.


Currently in moodle there is an Auto-create groups, which allows you to make random groupings by dividing a class into groups or number of people per group. "The default setting is Randomly.

Our model will differ in the following:
Creation of groups by features
Creation of groups taking into account past groupings
Creation of groups taking into account incompatibilities among members

This module aims at creating groups automatically, randomly and avoids the creation of repetitive groups. It is also possible to add variables to the selection such as: type of student, grades, course completed, etc.

Currently you can select course and groups within the course and the following characteristics:

If the selection of groups you want to make according to the number of groups you want to form or according to the number of people you want to the group.

If you want to take into account the history of other groups made by the program.

If you want to take into account the incompatibility of certain students.

If you want to take into account if you want to create homogeneous "teams" (groups contain people with the same characteristics) or heterogeneous (groups with different characteristics).

You have the possibility to display the creation on a full screen.

## Installing via uploaded ZIP file ##
** This plugin does NOT depend on an additional plugin.

1. Log in to your Moodle site as an admin and go to _Site administration >
   Plugins > Install plugins_.
2. Upload the ZIP file with the plugin code. You should only be prompted to add
   extra details if your plugin type is not automatically detected.
3. Check the plugin validation report and finish the installation.

## Installing manually ##

The plugin can be also installed by putting the contents of this directory to

    {your/moodle/dirroot}/local/group_generator

Afterwards, log in to your Moodle site as an admin and go to _Site administration >
Notifications_ to complete the installation.

Alternatively, you can run

    $ php admin/cli/upgrade.php

to complete the installation from the command line.

## License ##

2022 JuanCa  <juancarlo.castillo20@gmail.com>

This program is free software: you can redistribute it and/or modify it under
the terms of the GNU General Public License as published by the Free Software
Foundation, either version 3 of the License, or (at your option) any later
version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY
WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with
this program.  If not, see <https://www.gnu.org/licenses/>.
