<?php

/* This file is part of Jeedom.
 *
 * Jeedom is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Jeedom is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Jeedom. If not, see <http://www.gnu.org/licenses/>.
 */

try {
    require_once dirname(__FILE__) . '/../../../../core/php/core.inc.php';
    include_file('core', 'authentification', 'php');

    if (!isConnect('admin')) {
        throw new Exception(__('401 - {{Accès non autorisé}}', __FILE__));
    }

    if (init('action') == 'flashRF') {
        ajax::success(rflink::flashRF());
    }

    if (init('action') == 'check') {
        ajax::success(rflink::check());
    }

    if (init('action') == 'saveInclude') {
        ajax::success(rflink::saveInclude(init('value')));
    }

    if (init('action') == 'netgate') {
        ajax::success(rflink::saveNetGate(init('value')));
    }

    if (init('action') == 'debug') {
        ajax::success(rflink::controlController( 'RFUDEBUG=ON' ));
    }

    if (init('action') == 'restart') {
        ajax::success(rflink::controlController( 'REBOOT' ));
    }

    if (init('action') == 'milightActive') {
        ajax::success(rflink::controlController( 'milightnrf=on' ));
    }

    if (init('action') == 'send') {
        ajax::success(rflink::echoController( init('value') ));
    }

    throw new Exception(__('{{Aucune methode correspondante à}} : ', __FILE__) . init('action'));
    /*     * *********Catch exeption*************** */
} catch (Exception $e) {
    ajax::error(displayExeption($e), $e->getCode());
}
?>
