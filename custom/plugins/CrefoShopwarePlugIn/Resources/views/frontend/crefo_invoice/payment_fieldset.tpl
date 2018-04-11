{extends file="parent:frontend/register/payment_fieldset.tpl"}
{* Radio Button *}
{block name='frontend_register_payment_fieldset_input_radio'}
    {if $payment_mean.name == 'crefo_invoice'}
        <input type="radio" name="register[payment]" data-crefo-payment-id="{$payment_mean.id}"
               value="{$payment_mean.id}"
               id="payment_mean{$payment_mean.id}"{if $payment_mean.id eq $form_data.payment or (!$form_data && !$payment_mean@index)} checked="checked"{/if} />
    {else}
        {$smarty.block.parent}
    {/if}
{/block}
{* Method Name *}
{block name='frontend_register_payment_fieldset_input_label'}
    {if $payment_mean.name == 'crefo_invoice'}
        <label for="payment_mean{$payment_mean.id}" class="is--strong">
            {$payment_mean.description}
        </label>
    {else}
        {$smarty.block.parent}
    {/if}
{/block}