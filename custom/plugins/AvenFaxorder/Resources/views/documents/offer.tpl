{extends file="documents/index.tpl"}
{namespace name="documents/viison_offer_management/offer"}

{*
    Das Template erweitert das Shopware Standard Rechnungstemplate index.tpl.
    Hierdurch erbt das Tempalte die Grundstruktur und das Styling des
    Rechnungstemplates.

    Jede Spalte der Tabelle (Header-Zeile und Inhalt) kann durch Blöcke
    erweitert oder ersetzt werden.

    Innerhalb der Tabelle (block name="document_index_table_each") haben Sie
    über {$position.articleDetail} (Instanz des Shopware Models
    Shopware\Models\Article\Detail) Zugriff auf die Artikelinformationen der
    jeweiligen Angebotsposition. Bitte beachten Sie, dass nicht zu jeder
    Angebotsposition zwingend Artikelinformationen zur Verfügung stehen. Beim
    Zugriff auf die Artikelinformationen einer Angebotsposition sollten Sie
    daher zunächst immer prüfen, ob diese auch zur Verfügung stehen:

        {if $position.articleDetail}
            {$position.articleDetail->getNumber()}
        {/if}

    In jedem Block haben Sie Zugriff auf Informationen des Kunden. Über
    {$User}, {$User.billing} usw. können Sie auf diese Informationen zugreifen.
    Zu den zur Verfügung stehenden Variablen gehören:
    'shipping',  'billing', 'salutation', 'title',  'email', 'additional'
*}

{block name="document_index_head_bottom"}
   <h1 class="subject">{s name="offerNumber"}{/s} {$Document.id}</h1>
{/block}

{* Replace block to remove order number *}
{block name="document_index_head_right"}
    {$Containers.Header_Box_Right.value}
    {s namespace="documents/index" name="DocumentIndexCustomerID"}{/s} {$User.billing.customernumber}<br />
    {if $User.billing.ustid}
    {s namespace="documents/index" name="DocumentIndexUstID"}{/s} {$User.billing.ustid|replace:" ":""|replace:"-":""}<br />
    {/if}
    {s namespace="documents/index" name="DocumentIndexDate"}{/s} {$Document.date}<br />
    {if $Document.deliveryDate}{s namespace="documents/index" name="DocumentIndexDeliveryDate"}{/s} {$Document.deliveryDate}<br />{/if}
{/block}

{block name="document_index_info"}
    <style type="text/css">
        .viison-offer-management--content-info,
        .viison-offer-management--comment,
        .viison-offer-management--shipping-info,
        .viison-offer-management--expiration-date {
            margin-top: 2mm;
        }
    </style>
    <div id="info">
        {if $Containers.Content_Info.value}
            <div class="viison-offer-management--content-info">
                {$Containers.Content_Info.value}
            </div>
        {/if}
        {if $viisonOfferManagementComment}
            <div class="viison-offer-management--comment">
                {$viisonOfferManagementComment}
            </div>
        {/if}
        <div class="viison-offer-management--shipping-info">
            {if $viisonOfferManagementIsFreeShipping}
                {s name="FreeShippingInfo"}{/s}
            {else}
                {s name="NonFreeShippingInfo"}{/s}
            {/if}
        </div>
        {if $viisonOfferManagementCanExpire}
            <div class="viison-offer-management--expiration-date">
                {s name="ExpirationDateInfoPrefix"}{/s}{$viisonOfferManagementExpirationDate}{s name="ExpirationDateInfoPostfix"}{/s}
            </div>
        {/if}
    </div>
{/block}

{block name="document_index_table_head_price" append}
    {if $viisonOfferManagementShowDiscount}
        </tr>
        <tr>
            <td colspan="{if $Document.netto != true}5{else}4{/if}" align="right" class="head">{s name="DiscountRateHeader"}{/s}</td>
            <td align="right" class="head">{s name="DiscountHeader"}{/s}</td>
            <td align="right" class="head">{s name="DiscountTotalHeader"}{/s}</td>
    {/if}
{/block}

{block name="document_index_table_each" append}
    {if $viisonOfferManagementShowDiscount}
        <tr>
            <td colspan="{if $Document.netto != true}5{else}4{/if}" align="right" class="viison-offer-management--td">
                {if $position.viisonOfferManagementDiscountRate > 0}-{/if} {$position.viisonOfferManagementDiscountRate|replace:".":","} %
            </td>
            {if $Document.netto != true && $Document.nettoPositions != true}
                <td align="right" valign="top" class="viison-offer-management--td">
                    {if $position.viisonOfferManagementDiscount > 0}-{/if} {$position.viisonOfferManagementDiscount|currency}
                </td>
                <td align="right" valign="top" class="viison-offer-management--td">
                    {if $position.viisonOfferManagementDiscountAmount > 0}-{/if} {$position.viisonOfferManagementDiscountAmount|currency}
                </td>
            {else}
                <td align="right" valign="top" class="viison-offer-management--td">
                    {if $position.viisonOfferManagementDiscountNet > 0}-{/if} {$position.viisonOfferManagementDiscountNet|currency}
                </td>
                <td align="right" valign="top" class="viison-offer-management--td">
                    {if $position.viisonOfferManagementDiscountAmountNet > 0}-{/if} {$position.viisonOfferManagementDiscountAmountNet|currency}
                </td>
            {/if}
        </tr>
    {/if}
{/block}

{block name="document_index_table_price"}
    {if $viisonOfferManagementShowDiscount}
        {if $Document.netto != true && $Document.nettoPositions != true}
            <td align="right" width="10%" valign="top">
                {$position.viisonOfferManagementReferencePrice|currency}
            </td>
            <td align="right" width="12%" valign="top">
                {$position.viisonOfferManagementReferenceAmount|currency}
            </td>
        {else}
            <td align="right" width="10%" valign="top">
                {$position.viisonOfferManagementReferencePriceNet|currency}
            </td>
            <td align="right" width="12%" valign="top">
                {$position.viisonOfferManagementReferenceAmountNet|currency}
            </td>
        {/if}
    {else}
        {$smarty.block.parent}
    {/if}
{/block}

{block name="document_index_amount"}
    {if $viisonOfferManagementShowDiscount}
        <div id="amount">
            <table width="300px" cellpadding="0" cellspacing="0">
                <tbody>
                    <tr>
                        <td align="right" width="200px" class="head">{s name="SummaryTotalAmountWithoutDiscountLabel"}{/s}</td>
                        <td align="right" width="100px" class="head">{$viisonOfferManagementReferenceTotalAmountNet|currency}</td>
                    </tr>
                    <tr>
                        <td align="right" class="head">{s name="SummaryTotalDiscountRateLabel"}{/s}{$viisonOfferManagementDiscountRateTotal|replace:".":","} %{s name="SummaryTotalDiscountRateLabelPostfix"}{/s}</td>
                        <td align="right" class="head">
                            {if $viisonOfferManagementDiscountTotalAmountNet > 0}-{/if} {$viisonOfferManagementDiscountTotalAmountNet|currency}
                        </td>
                    </tr>
                    <tr>
                        <td align="right" class="head">{s namespace="documents/index" name="DocumentIndexTotalNet"}{/s}</td>
                        <td align="right" class="head">{$Order._amountNetto|currency}</td>
                    </tr>
                    {if $Document.netto == false}
                        {foreach from=$Order._tax key=key item=tax}
                            <tr>
                                <td align="right">{s namespace="documents/index" name="DocumentIndexTax"}zzgl. {$key}{/s}</td>
                                <td align="right">{$tax|currency}</td>
                            </tr>
                        {/foreach}
                    {/if}
                    {if $Document.netto == false}
                        <tr>
                            <td align="right"><b>{s namespace="documents/index" name="DocumentIndexTotal"}{/s}</b></td>
                            <td align="right"><b>{$Order._amount|currency}</b></td>
                        </tr>
                    {else}
                        <tr>
                            <td align="right"><b>{s namespace="documents/index" name="DocumentIndexTotal"}{/s}</b></td>
                            <td align="right"><b>{$Order._amountNetto|currency}</b></td>
                        </tr>
                    {/if}
                </tbody>
            </table>
        </div>
    {else}
        {$smarty.block.parent}
    {/if}
{/block}
