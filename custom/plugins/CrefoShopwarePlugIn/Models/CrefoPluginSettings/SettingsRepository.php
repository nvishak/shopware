<?php
/**
 * Copyright (c) 2016 Verband der Vereine Creditreform.
 * Hellersbergstrasse 12, 41460 Neuss, Germany.
 *
 * This file is part of the CrefoShopwarePlugIn.
 * For licensing information, refer to the “license” file.
 *
 * Diese Datei ist Teil des CrefoShopwarePlugIn.
 * Informationen zur Lizenzierung sind in der Datei “license” verfügbar.
 */

namespace CrefoShopwarePlugIn\Models\CrefoPluginSettings;

use \Shopware\Components\Model\ModelRepository;

/**
 * Class SettingsRepository
 * @package CrefoShopwarePlugIn\Models\CrefoPluginSettings
 */
class SettingsRepository extends ModelRepository
{

    /**
     * @return array
     */
    public function getGeneralSettingsArray()
    {
        $builder = $this->getEntityManager()->createQueryBuilder();
        $builder->select([
                'settings.id as id',
                'settings.communicationLanguage as communicationLanguage',
                'settings.consentDeclaration as consentDeclaration',
                'settings.logsMaxNumberOfRequest as logsMaxNumberOfRequest',
                'settings.logsMaxStorageTime as logsMaxStorageTime',
                'settings.errorNotificationStatus as errorNotificationStatus',
                'settings.emailAddress as emailAddress',
                'settings.requestCheckAtValue as requestCheckAtValue',
                'settings.errorTolerance as errorTolerance'
            ]
        );
        $builder->from('CrefoShopwarePlugIn\Models\CrefoPluginSettings\PluginSettings', 'settings');
        $builder->where('settings.id = 1');
        return $builder->getQuery()->getArrayResult();
    }

}