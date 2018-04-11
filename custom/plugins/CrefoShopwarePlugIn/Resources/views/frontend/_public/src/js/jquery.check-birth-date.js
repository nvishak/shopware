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
(function($, window) {
    'use strict';

    /**
     * event listener which will be triggered if the customer changes their shipping or payment method
     */
    $.subscribe('plugin/swShippingPayment/onInputChanged', function(event, plugin) {
        var me = plugin,
            form = me.$el.find(me.opts.formSelector),
            data = form.serializeArray(),
            crefoRadio = $('input[data-crefo-payment-id]');

        var paymentId = -1;
        $.each(data, function(i, item) {
            if (item.hasOwnProperty('name') && item.name === 'payment') {
                paymentId = window.parseInt(item.value);
                return false;
            }
        });
        if (crefoRadio.length > 0 && paymentId === window.parseInt(crefoRadio.val())) {
            $('.main--actions:button[type=submit]').crefoCheckBirthDate();
        }
    });
    $.plugin('crefoCheckBirthDate', {

        defaults: {
            errorClass: 'has--error',
            hiddenClass: 'is--hidden',
            minYearDiff: 150,
            dateRegex: /^\d{2}\.\d{2}\.\d{4}$/,
            monthLength: [ 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 ],
            errorMessageId: 'crefo_birth_date--message'
        },
        /**
         * Default plugin initialisation function.
         * Registers an event listener on the change event.
         * When it's triggered, the parent form will be submitted.
         *
         * @public
         * @method init
         */
        init: function() {
            var me = this;
            me.applyDataAttributes();
            me.$inputBirthDate = $('#sCrefoBirthDate');
            var attrReadonly = me.$inputBirthDate.attr('readonly');
            if (me.$inputBirthDate.length > 0 && (typeof attrReadonly === typeof undefined || attrReadonly === false)) {
                me._on(me.$el, 'click', $.proxy(me.onClickContinue, me));
            }
        },

        onClickContinue: function(event) {
            var me = this,
                errorMessageCmp = $('#' + me.opts.errorMessageId);
            errorMessageCmp.removeClass(me.opts.hiddenClass);
            if (me.$inputBirthDate.val() !== '' && !me.isBirthDateCorrect(me.$inputBirthDate.val())) {
                event.preventDefault();
                me.$inputBirthDate.addClass(me.opts.errorClass);
                me.$inputBirthDate.focus();
                errorMessageCmp.removeClass(me.opts.hiddenClass);
            } else {
                me.$inputBirthDate.removeClass(me.opts.errorClass);
                errorMessageCmp.addClass(me.opts.hiddenClass);
            }
            $.publish('plugin/crefoCheckBirthDate/onClickContinue', [ me ]);
        },

        isBirthDateCorrect: function(birthDate) {
            var me = this;
            //validate format
            if (!me.opts.dateRegex.test(birthDate)) {
                return false;
            }
            var today = new Date(),
                currentYear = parseInt(today.getFullYear()),
                minYear = currentYear - me.opts.minYearDiff,
                currentMonth = parseInt(today.getMonth()) + 1,
                currentDay = parseInt(today.getDate());

            var parts = birthDate.split('.'),
                day = parseInt(parts[ 0 ], 10),
                month = parseInt(parts[ 1 ], 10),
                year = parseInt(parts[ 2 ], 10),
                monthLength = me.opts.monthLength;
            //validate year
            if (year > currentYear || year < minYear) {
                return false;
            }
            //validate month
            if (month > 12 || month <= 0 || (month > currentMonth && year === currentYear)) {
                return false;
            }
            //Adjust for leap years
            if (year % 400 === 0 || (year % 100 !== 0 && year % 4 === 0)) {
                monthLength[ 1 ] = 29;
            }
            //validate day
            var futureDay = day > currentDay && month === currentMonth && year === currentYear;
            var invalidDay = day <= 0 || day > monthLength[ month - 1 ];
            return !(futureDay || invalidDay);
        },
        destroy: function() {
            this._destroy();
        }
    });
    var buttonMainAction = $('.main--actions:button[type=submit]');
    var buttonRegister = $('.register--submit:input[type=submit]');

    if (buttonMainAction.length > 0) {
        buttonMainAction.crefoCheckBirthDate();
    }
    if (buttonRegister.length > 0) {
        buttonRegister.crefoCheckBirthDate();
    }
})(jQuery, window);
