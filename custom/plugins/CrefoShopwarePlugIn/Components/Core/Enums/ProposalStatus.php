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

namespace CrefoShopwarePlugIn\Components\Core\Enums;

/**
 * Class ProposalStatus
 * @package CrefoShopwarePlugIn\Components\Core\Enums
 */
abstract class ProposalStatus
{
    const ReadyToSend = 1;
    const NeedsEditing = 2;
    const Sent = 3;
    const Error = 0;
}