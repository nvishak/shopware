{extends file="parent:frontend/checkout/items/product.tpl"}

{* Prevent quanity changes in order creation mode *}
{block name="frontend_checkout_cart_item_quantity_selection"}
        <div class="">
            {$sBasketItem.quantity}
        </div>
{/block}

{* Prevent item deletions in order creation mode *}
{block name="frontend_checkout_cart_item_delete_article"}
        <div class="panel--td column--actions"></div>
{/block}
