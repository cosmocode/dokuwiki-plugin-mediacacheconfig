<?php
/**
 * DokuWiki Plugin mediacacheconfig (Action Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Michael Große <grosse@cosmocode.de>
 */

// must be run within Dokuwiki
if(!defined('DOKU_INC')) die();

class action_plugin_mediacacheconfig extends DokuWiki_Action_Plugin {

    /**
     * Registers a callback function for a given event
     *
     * @param Doku_Event_Handler $controller DokuWiki's event controller object
     * @return void
     */
    public function register(Doku_Event_Handler $controller) {

       $controller->register_hook('FETCH_MEDIA_STATUS', 'AFTER', $this, 'handle_fetch_media_status');

    }

    /**
     * [Custom event handler which performs action]
     *
     * @param Doku_Event $event  event object by reference
     * @param mixed      $param  [the parameters passed as fifth argument to register_hook() when this
     *                           handler was registered]
     * @return void
     */

    public function handle_fetch_media_status(Doku_Event $event, $param) {
        global $INPUT;

        if ($INPUT->has('cache')) {
            // do nothing if cache behavior has been explicitly defined
            return;
        }

        if ($this->getConf('always-validate') === '1') {
            $event->data['cache'] = 0;
        }
    }

}

// vim:ts=4:sw=4:et:
