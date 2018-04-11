{extends file="parent:frontend/checkout/shipping_payment.tpl"}

{* Content Top *}
{block name="frontend_index_content_top" append}
    {if $sCrefoShowBadResponse}
        {* Crefo No Agreement Accepted Message *}
        {block name='frontend_crefo_invoice_bad_message'}
            <div class="alert is--error is--rounded">
                <div class="alert--icon">
                    <i class="icon--element icon--cross"></i>
                </div>
                <div class="alert--content">
                    {s name="frontend/shippingPayment/message" namespace="frontend/creditreform/translation"}*Die gewählte Zahlungsart kann nicht verwendet werden.{/s}
                </div>
            </div>
        {/block}
    {/if}
    {if $sNoCrefoBirthDate || $sNoCrefoConfirmation}
        {*Crefo No Complete Data Message *}
        {block name='frontend_crefo_invoice_no_data_message'}
            <div class="alert is--warning is--rounded">
                <div class="alert--icon">
                    <i class="icon--element icon--warning"></i>
                </div>
                <div class="alert--content">
                    {s name="frontend/payment/dateErrorMessage" namespace="frontend/creditreform/translation"}Bearbeitung erforderlich{/s}
                </div>
            </div>
        {/block}
    {/if}
{/block}