{extends file="parent:frontend/account/sidebar.tpl"}
{namespace name="frontend/aven_faxorder/main"}

{* Link to the user orders *}
{block name="frontend_account_menu_link_orders" append}
        <li class="navigation--entry">
            <a href="{url controller='account' action='offers'}" title="Fax order" class="navigation--link{if $sAction == 'offers'} is--active{/if}">
                Fax order
            </a>
        </li>
{/block}
