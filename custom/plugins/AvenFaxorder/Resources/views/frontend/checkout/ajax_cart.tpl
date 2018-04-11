{extends file="parent:frontend/checkout/ajax_cart.tpl"}

{block name="frontend_checkout_ajax_cart_open_basket" append}
    </div>
        {block name="aven_faxorder_ajax_cart_request_offer_button"}
            <a
                href="{url controller=AvenOfferManagement action=index}"
                class="btn is--full is--center is--icon-right viison-offer-management--ajax-cart-button"
                title="{"Fax Order"|escape}"
            >
                {block name="aven_faxorder_ajax_cart_request_offer_button_content"}
                    <i class="icon--arrow-right"></i>
                    Fax order
                {/block}
            </a>
        {/block}
{/block}
