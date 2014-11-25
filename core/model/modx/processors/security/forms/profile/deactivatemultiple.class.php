<?php
include_once dirname(__FILE__).'/deactivate.class.php';
/**
 * Deactivate multiple FC Profiles
 *
 * @package modx
 * @subpackage processors.security.forms.profile
 */

class modFormCustomizationProfileDeactivateMultipleProcessor extends modFormCustomizationProfileDeactivateProcessor {
    public $profiles = array();

    public function initialize() {
        $profiles = $this->getProperty('profiles', '');
        if (empty($profiles)) {
            return $this->modx->lexicon('profile_err_ns');
        }
        $this->profiles = explode(',', $profiles);

        return true;
    }

    public function process() {
        foreach ($this->profiles as $profile) {
            $this->setProperty('id', $profile);
            $initialized = parent::initialize();
            if ($initialized === true) {
                $o = parent::process();
                if (!$o['success']) {
                    return $o;
                }
            } else {
                return $this->failure($initialized);
            }
        }
        return $this->success();
    }
}

return 'modFormCustomizationProfileDeactivateMultipleProcessor';
