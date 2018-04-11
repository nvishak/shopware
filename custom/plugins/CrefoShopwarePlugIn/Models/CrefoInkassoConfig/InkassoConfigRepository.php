<?php
/**
 * Copyright (c) 2016-2017 Verband der Vereine Creditreform.
 * Hellersbergstrasse 12, 41460 Neuss, Germany.
 *
 * This file is part of the CrefoShopwarePlugIn.
 * For licensing information, refer to the “license” file.
 *
 * Diese Datei ist Teil des CrefoShopwarePlugIn.
 * Informationen zur Lizenzierung sind in der Datei “license” verfügbar.
 */

namespace CrefoShopwarePlugIn\Models\CrefoInkassoConfig;

use \Shopware\Components\Model\ModelRepository;

/**
 * Class InkassoConfigRepository
 * @package CrefoShopwarePlugIn\Models\CrefoInkassoConfig
 */
class InkassoConfigRepository extends ModelRepository
{

    /**
     * @return mixed
     */
    public function getInkassoValuesQueryBuilder()
    {
        $builder = $this->getEntityManager()->createQueryBuilder();
        $builder->select([
                'inkws.id as id',
                'inkws.keyWS as keyWS',
                'inkws.textWS as textWS',
                'inkws.typeValue as typeValue'
            ]
        )
            ->from('CrefoShopwarePlugIn\Models\CrefoInkassoConfig\InkassoWSValues', 'inkws');
        return $builder;
    }

    /**
     * @return mixed
     */
    public function getInkassoCreditorsQueryBuilder()
    {
        $builder = $this->getEntityManager()->createQueryBuilder();
        $builder->select([
                'creditor.id as id',
                'creditor.useraccount as useraccount',
                'creditor.name as name',
                'creditor.address as address'
            ]
        )
            ->from('CrefoShopwarePlugIn\Models\CrefoInkassoConfig\InkassoCreditors', 'creditor');
        return $builder;
    }
}