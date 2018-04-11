{extends file="parent:frontend/checkout/ajax_cart_item.tpl"}

{* Prevent item deletions in order creation mode *}
{block name="frontend_checkout_ajax_cart_actions"}
        {$smarty.block.parent}
{/block}
