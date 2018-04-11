{extends file="parent:frontend/index/index.tpl"}
{block name="frontend_index_content_left"}{/block}
{block name="frontend_index_content"}
    <div class="content">
        <div class="page-title">
            <h1>Faxbestellung</h1>
        </div>
        <p>Hier erhalten Sie unser Fax-Bestellformular zum Ausdrucken.<br>Bitte füllen Sie dazu alle Pflichtfelder aus. Im Anschluss erhalten Sie eine PDF, die Sie dann an unsere Fax-Nummer: +49 (0)30 / 374 362 73 schicken können.</p>
        <form class="panel register--form" method="post" action="{url action=saveFaxOrder}">
            <div>
                <fieldset>
                    <legend>Contact Person</legend>
                    <label>First Name<input name="name" class="register--field" value="{$firstName}"></label>
                    <label>Last Name<input name="Surnmae" class="register--field" value="{$lastName}"></label>
                </fieldset>
            </div>
            <div>
                <fieldset>
                    <legend>Billing Address</legend>
                    <label>Company<br>
                        <input name="company" class="register--field" value="{$company}" required>
                    </label>
                    <br><br>
                    <label>Address<br>
                        <input name="Address" class="register--field" value="{$addressLine}" required>
                        <br><br>
                        <input name="Address1" class="register--field" value="{$addressLine1}" required>
                    </label>
                    <br><br>
                    <label>City<br>
                        <input name="city" class="register--field" value="{$city}" required>
                    </label>
                    <br><br>
                    <label>Postcode<br>
                        <input name="postcode" class="register--field" value="{$postcode}" required>
                    </label>
                    <br><br>
                    <label>Country<br>
                        <select name="country"
                                data-address-type="billing"
                                id="country"
                                class="select--country" required>

                            <option disabled="disabled"
                                    value=""
                                    selected="selected">
                                {s name='RegisterBillingPlaceholderCountry'}{/s}
                                {s name="RequiredField" namespace="frontend/register/index"}{/s}
                            </option>

                            {foreach $sCountryList as $country}
                                <option value="{$country.name}">
                                    {$country.name}
                                </option>
                            {/foreach}
                        </select>
                    </label>
                    <br><br>
                    <label>Telephone<br>
                        <input name="telephone" class="register--field" value="{$telephone}" required>
                    </label><br><br>
                    <label>Fax<br>
                        <input name="fax" class="register--field" value="{$fax}" required>
                    </label>
                </fieldset>
            </div>
            <div>
                <fieldset>
                    <legend>Delivery Address</legend>
                    <label>Company<br>
                        <input name="dacompany" class="register--field" value="{$dacompany}" required>
                    </label>
                    <br><br>
                    <label>Address<br>
                        <input name="daaddress" class="register--field" value="{$daaddress}" required><br><br>
                        <input name="daaddress1" value="{$daaddress1}" required>
                    </label>
                    <br><br>
                    <label>City<br>
                        <input name="daCity" class="register--field" value="{$daCity}" required></label>
                    <br><br>
                    <label>Postcode<br>
                        <input name="dapostcode" class="register--field" value="{$dapostcode}" required></label>
                    <br><br>
                    <label>Country<br>
                        <select name="daCountry"
                                id="daCountry"
                                class="select--country" required>

                            <option disabled="disabled"
                                    value=""
                                    selected="selected">
                                {s name='RegisterBillingPlaceholderCountry'}{/s}
                                {s name="RequiredField" namespace="frontend/register/index"}{/s}
                            </option>

                            {foreach $sCountryList as $country}
                                <option value="{$country.name}">
                                    {$country.name}
                                </option>
                            {/foreach}
                        </select>
                    </label>
                    <br><br>
                    <label>Telephone<br>
                        <input name="daTelephone" class="register--field" value="{$daTelephone}" required></label>
                    <br>
                    <label>Fax<br>
                        <input name="daFax" class="register--field" value="{$daFax}" required>
                    </label>
                </fieldset>
            </div>

            <div>
                <fieldset>
                    <legend>Further Information</legend>
                    <label>VAT ID<br>
                        <input name="vatId" class="register--field" value="{$vatId}" required>
                    </label>
                    <br><br>
                    <label>E-mail address<br>
                        <input name="e-mail" class="register--field" value="{$email}" required>
                    </label>
                    <br><br>
                    <label>Internal Order Number<br>
                        <input name="internalnumber" class="register--field" value="{$internalOrderNumber}" required>
                        <label>
                </fieldset>
            </div>
            <br>
            <button type="submit" class="address--form-submit btn btn-lg">Submit</button>
        </form>
    </div>
{/block}