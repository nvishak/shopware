/*
 * Copyright (c) 2016-2017 Verband der Vereine Creditreform.
 * Hellersbergstrasse 12, 41460 Neuss, Germany.
 *
 * This file is part of the CrefoShopwarePlugIn.
 * For licensing information, refer to the “license” file.
 *
 * Diese Datei ist Teil des CrefoShopwarePlugIn.
 * Informationen zur Lizenzierung sind in der Datei “license” verfügbar.
 */
//{namespace name=backend/creditreform/translation}
//{block name="backend/crefo_configuration/view/tabs/report_private_person/basket_area_container"}
Ext.define('Shopware.apps.CrefoConfiguration.view.tabs.reportprivateperson.BasketAreaContainer',
    {
        extend: 'Ext.container.Container',
        name: 'reportPrivatePersonBasketAreaContainer',
        id: 'reportPrivatePersonBasketAreaContainer',
        itemId: 'reportPrivatePersonBasketAreaContainer',
        alias: 'widget.crefo-config-tabs-report-private-person-basket-area-container',
        width: '100%',
        snippets: {
            text: {
                identified: '{s name="crefoconfig/view/tabs/report_private_person/products/col/values/identified"}Indetifiziert{/s}',
                notIdentified: '{s name="crefoconfig/view/tabs/report_private_person/products/col/values/notIdentified"}Nicht Indetifiziert{/s}'
            },
            particle: {
                and: '{s name="crefo/part/uppercase/and"}UND{/s}',
                from: '{s name="crefo/part/lowercase/from"}ab{/s}',
                to: '{s name="crefo/part/lowercase/to"}bis{/s}'
            },
            validation: {
                invalidValue: '{s name="crefo/validation/invalidValue"}Ungültiger Wert{/s}'
            },
            labels: {
                basket: {
                    currency: '{s name="crefoconfig/view/tabs/report_private_person/products/currency"}EUR{/s}'
                }
            }
        },
        minBasketAreas: 1,
        maxBasketAreas: 5,
        /**
         * @param position
         * @param focus
         * @param productRecord
         * @return boolean
         * @throws error
       */
        addNewBasketAreaRow: function (position, focus, productRecord) {
            var me = this,
                success = true;
            if (Ext.isEmpty(position) || !Ext.isNumber(position)) {
                throw new Error('Failed to add new basket area! - position isn\'t a valid number');
            }
            var basketArea = Ext.create('Shopware.apps.CrefoConfiguration.view.tabs.reportprivateperson.BasketAreaRow', {
                parentPanel: me.parentPanel,
                productRecord: productRecord,
                rowIndex: position,
                focusThreshold: focus,
                useDefaults: me.useDefaults
            });
            if (me.items.length === 0) {
                basketArea.hideDelete();
                me.add(basketArea);
            } else if (me.items.length === me.maxBasketAreas || position >= me.maxBasketAreas) {
                success = false;
            } else {
                if (me.items.length === me.minBasketAreas) {
                    me.items.get(0).showDelete();
                }
                me.insert(position, basketArea);
                var i = me.items.length - 1;
                while (i > position) {
                    me.items.get(i).increaseRowIndex();
                    i--;
                }
                if (me.items.length === me.maxBasketAreas) {
                    for (i = 0; i < me.maxBasketAreas; i++) {
                        me.items.get(i).removePlusSigns();
                    }
                }
            }
            return success;
        },
        /**
       *
       * @param position
       * @returns boolean
       * @throws error
       */
        removeBasketAreaRow: function (position) {
            var me = this,
                success = true;
            if (Ext.isEmpty(position) || !Ext.isNumber(position)) {
                throw new Error('Failed to remove basket area! - position is not a valid number');
            }
            if (me.items.length <= me.minBasketAreas) {
                success = false;
            } else {
                var toRemoveCmp,
                    foundPosition = false,
                    foundPreviousFocus = false,
                    cmp;
                for (var i = 0; i < me.items.length; i++) {
                    if (i + 1 === position && !foundPreviousFocus) {
                        foundPreviousFocus = true;
                        cmp = me.items.get(i);
                        cmp.items.get(0).items.get(2).focus(true);
                    }
                    if (i === position) {
                        toRemoveCmp = me.items.get(i);
                        foundPosition = true;
                    }
                    if (i === position + 1 && !foundPreviousFocus) {
                        cmp = me.items.get(i);
                        cmp.items.get(0).items.get(2).focus(true);
                    }
                    if (me.items.length === me.minBasketAreas + 1) {
                        me.items.get(i).hideDelete();
                    }
                    if (me.items.length === me.maxBasketAreas) {
                        me.items.get(i).showPlusSigns(position);
                    }
                    if (foundPosition) {
                        me.items.get(i).decreaseRowIndex();
                    }
                }
                me.remove(toRemoveCmp, true);
                me.items.get(0).showFirstPlus();
            }
            return success;
        }
    });
//{/block}
