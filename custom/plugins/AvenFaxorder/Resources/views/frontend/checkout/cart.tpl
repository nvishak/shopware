{extends file="parent:frontend/checkout/cart.tpl"}
{namespace name="frontend/aven_faxorder/main"}

{block name='frontend_checkout_cart_error_messages'}
        {$smarty.block.parent}
{/block}

{* Replace default offer button  *}
{block name="frontend_checkout_actions_inquiry"}{/block}
{block name="frontend_checkout_actions_confirm_bottom" append}
        <a href="{url controller=AvenOfferManagement action=index}"
           title="{"Fax Order"|escape}"
           class="btn btn--inquiry is--large is--full is--center"
        >
            Fax order
        </a>
{/block}
