{* Own Template: Crefo invoice panel *}
{block name='frontend_crefo_invoice_panel'}
    <div id="crefo--panel">
        {if $sHasCrefoConsentDeclaration}
            {*Consent Declaration*}
            {block name='frontend_crefo_invoice_consent'}
                <div class="panel--body" id="crefo--consent-div">
                    {*Checkbox*}
                    {block name='frontend_crefo_invoice_consent_checkbox'}
                        <span>
                            <input type="checkbox"
                                    {if $payment_mean.id == $form_data.payment}
                                       required="required"
                                       aria-required="true"
                                   {/if}
                                   data-crefoConsentErrorMessage="{s name="frontend/payment/dateErrorMessage" namespace="frontend/creditreform/translation"}Bearbeitung erforderlich{/s}"
                                   id="sCrefoConfirmation"
                                   name="sCrefoConfirmation"
                                    {if $sCrefoConfirmation} checked="checked"{/if}
                                   class="register-field  is--required{if $sCrefoConfirmationError || $sNoCrefoConfirmation} has--error{/if}"
                            />
                        </span>
                    {/block}
                    {*Label*}
                    {block name='frontend_crefo_invoice_consent_label'}
                        <span>
                            <label for="sCrefoConfirmation">
                                {s name="frontend/gateway/checkboxText" namespace="frontend/creditreform/translation"}Ich stimme der Überprüfung meiner Bonität und der Speicherung des Ergebnisses zu. Hierzu werden die zu einer Bonitätsprüfung benötigten firmenbezogenen Daten an Creditreform übermittelt. Die von Creditreform enthaltenen Informationen werden für eine Entscheidung über das Zustandekommen eines Vertragsverhältnisses verwendet.{/s}
                            </label>
                        </span>
                    {/block}
                </div>
            {/block}
        {/if}
        {if !$sIsCompany}
            {*Birthdate Textfield*}
            {block name='frontend_crefo_invoice_birthdate_field'}
                <div id="crefo--birthdate-div">
                    {*Label*}
                    <label for="sCrefoBirthDate" {if $sCrefoBirthdateError}class="has--error"{/if}>
                        {s name="frontend/payment/birthdateLabel" namespace="frontend/creditreform/translation"}Bitte tragen Sie hier Ihr Geburtsdatum ein:{/s}
                    </label>
                    <input type="text"
                            {if $payment_mean.id == $form_data.payment}
                                required="required"
                                aria-required="true"
                            {/if}
                           id="sCrefoBirthDate"
                           data-crefoDateErrorMessage="{s name="frontend/payment/dateErrorMessage" namespace="frontend/creditreform/translation"}Bearbeitung erforderlich{/s}"
                           placeholder="{s name="frontend/payment/datePlaceholder" namespace="frontend/creditreform/translation"}TT.MM.JJJJ{/s}"
                           name="sCrefoBirthDate"
                           value="{$sCrefoBirthDate|escape}"
                           class="register-field is--required {if $sCrefoBirthdateError || $sNoCrefoBirthDate} has--error{/if}"
                    />
                    <div id="crefo_birth_date--message" class="register--error-msg is--hidden">
                        <p>{s namespace='backend/creditreform/translation' name='crefoorders/view/list/col/collection/answers/doc/edit'}Bearbeitung erforderlich{/s}</p>
                    </div>
                </div>
            {/block}
        {/if}
    </div>
{/block}