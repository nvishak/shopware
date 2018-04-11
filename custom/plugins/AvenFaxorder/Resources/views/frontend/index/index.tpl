{extends file="parent:frontend/index/index.tpl"}

{block name="frontend_index_content"}
    <div class="content">
        <form class="panel register--form" method="post" action="{url action=saveOrder}">
            <div>
                <fieldset>
                    <legend>Contact Person</legend>
                    <label>First Name<input name="name" value="{$firstName}"></label>
                    <label>Last Name<input name="Surnmae" value="{$lastName}"></label>
                </fieldset>
            </div>
            <div>
                <h4 class="is--bold">Billing Address</h4>
                <label>Company
                <input name="company" value="{$company}">
                </label>
                <label>Address
                <input name="Address" value="{$addressLine}">
                <input name="Address1" value="{$addressLine1}">
                </label>
                <label>City
                <input name="city" value="{$city}">
                </label>
                <label>Postcode
                <input name="postcode" value="{$postcode}">
                </label>
                <label>Country
                        <select name="register[billing][country]"
                                data-address-type="billing"
                                id="country"
                                class="select--country">

                            {*<option disabled="disabled"*}
                                    {*value=""*}
                                    {*selected="selected">*}
                                {*{s name='RegisterBillingPlaceholderCountry'}{/s}*}
                                {*{s name="RequiredField" namespace="frontend/register/index"}{/s}*}
                            {*</option>*}

                            {foreach $sCountryList as $country}
                                <option value="{$country[code]}">
                                    {$country[name]}
                                </option>
                            {/foreach}
                        </select>
                </label>
                {$countryList}
                <label>Telephone
                <input name="telephone" value="{$telephone}">
                </label>
                <label>Fax
                <input name="fax" value="{$fax}">
                </label>
                <div>{$stp}</div>
            </div>
            <div>
                <h4>Delivery Address</h4>
                <label>Country
                <input></label>
                <label>Postcode
                <input></label>
                <label>Country
                <input></label>
                <label>Telephone
                <input></label>
                <label>Fax
                <input>
                </label>
            </div>

            <div>
                <h4>Further Information</h4>
                <label>VAT ID
                <input>
                </label>
                <label>E-mail address
                <input>
                </label>
                {*<label>Internal Order Number
                        <input>
                    <label>*}
            </div>

            <button type="submit">Submit</button>
        </form>
    </div>
{/block}