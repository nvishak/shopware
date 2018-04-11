{extends file="parent:frontend/checkout/change_payment.tpl"}
{* Radio Button *}
{block name='frontend_checkout_payment_fieldset_input_radio'}
    {if $payment_mean.name == 'crefo_invoice'}
        <div class="method--input">
            <input type="radio" name="payment" class="radio auto_submit" data-crefo-payment-id="{$payment_mean.id}" value="{$payment_mean.id}" id="payment_mean{$payment_mean.id}"{if $payment_mean.id eq $sFormData.payment or (!$sFormData && !$smarty.foreach.register_payment_mean.index)} checked="checked"{/if} />
        </div>
    {else}
        {$smarty.block.parent}
    {/if}
{/block}