/**
 * @author zhixin wen <wenzhixin2010@gmail.com>
 * https://github.com/wenzhixin/bootstrap-show-password
 * version: 1.1.2
 */

!function (jQuery) {

    'use strict';

    // TOOLS DEFINITION
    // ======================

    // it only does '%s', and return '' when arguments are undefined
    var sprintf = function(str) {
        var args = arguments,
            flag = true,
            i = 1;

        str = str.replace(/%s/g, function () {
            var arg = args[i++];

            if (typeof arg === 'undefined') {
                flag = false;
                return '';
            }
            return arg;
        });
        if (flag) {
            return str;
        }
        return '';
    };

    // PASSWORD CLASS DEFINITION
    // ======================

    var Password = function(element, options) {
        this.options   = options;
        this.jQueryelement  = jQuery(element);
        this.isShown = false;

        this.init();
    };

    Password.DEFAULTS = {
        placement: 'after', // 'before' or 'after'
        white: false, // v2
        message: 'Click here to show/hide password',
        eyeClass: 'glyphicon',
        eyeOpenClass: 'glyphicon-eye-open',
        eyeCloseClass: 'glyphicon-eye-close',
        eyeClassPositionInside: false
    };

    Password.prototype.init = function() {
        var placementFuc,
            inputClass; // v2 class

        if (this.options.placement === 'before') {
            placementFuc = 'insertBefore';
            inputClass = 'input-prepend';
        } else {
            this.options.placement = 'after'; // default to after
            placementFuc = 'insertAfter';
            inputClass = 'input-append';
        }

        // Create the text, icon and assign
        this.jQueryelement.wrap(sprintf('<div class="%s input-group" />', inputClass));

        this.jQuerytext = jQuery('<input type="text" />')
            [placementFuc](this.jQueryelement)
            .attr('class', this.jQueryelement.attr('class'))
            .attr('style', this.jQueryelement.attr('style'))
            .attr('placeholder', this.jQueryelement.attr('placeholder'))
            .css('display', this.jQueryelement.css('display'))
            .val(this.jQueryelement.val()).hide();

        // Copy readonly attribute if it's set
        if (this.jQueryelement.prop('readonly'))
            this.jQuerytext.prop('readonly', true);
        this.jQueryicon = jQuery([
            '<span title="' + this.options.message + '" class="input-group-addon">',
            '<i class="icon-eye-open' + (this.options.white ? ' icon-white' : '') +
                ' ' + this.options.eyeClass + ' ' + (this.options.eyeClassPositionInside ? '' : this.options.eyeOpenClass) + '">' +
                (this.options.eyeClassPositionInside ? this.options.eyeOpenClass : '') + '</i>',
            '</span>'
        ].join(''))[placementFuc](this.jQuerytext).css('cursor', 'pointer');

        // events
        this.jQuerytext.off('keyup').on('keyup', jQuery.proxy(function() {
            if (!this.isShown) return;
            this.jQueryelement.val(this.jQuerytext.val()).trigger('change');
        }, this));

        this.jQueryicon.off('click').on('click', jQuery.proxy(function() {
            this.jQuerytext.val(this.jQueryelement.val()).trigger('change');
            this.toggle();
        }, this));
    };

    Password.prototype.toggle = function(_relatedTarget) {
        this[!this.isShown ? 'show' : 'hide'](_relatedTarget);
    };

    Password.prototype.show = function(_relatedTarget) {
        var e = jQuery.Event('show.bs.password', {relatedTarget: _relatedTarget});
        this.jQueryelement.trigger(e);

        this.isShown = true;
        this.jQueryelement.hide();
        this.jQuerytext.show();
        if (this.options.eyeClassPositionInside) {
            this.jQueryicon.find('i')
                .removeClass('icon-eye-open')
                .addClass('icon-eye-close')
                .html(this.options.eyeCloseClass);
        } else {
            this.jQueryicon.find('i')
                .removeClass('icon-eye-open ' + this.options.eyeOpenClass)
                .addClass('icon-eye-close ' + this.options.eyeCloseClass);
        }

        // v3 input-group
        this.jQuerytext[this.options.placement](this.jQueryelement);
    };

    Password.prototype.hide = function(_relatedTarget) {
        var e = jQuery.Event('hide.bs.password', {relatedTarget: _relatedTarget});
        this.jQueryelement.trigger(e);

        this.isShown = false;
        this.jQueryelement.show();
        this.jQuerytext.hide();
        if (this.options.eyeClassPositionInside) {
            this.jQueryicon.find('i')
                .removeClass('icon-eye-close')
                .addClass('icon-eye-open')
                .html(this.options.eyeOpenClass);
        } else {
            this.jQueryicon.find('i')
                .removeClass('icon-eye-close ' + this.options.eyeCloseClass)
                .addClass('icon-eye-open ' + this.options.eyeOpenClass);
        }

        // v3 input-group
        this.jQueryelement[this.options.placement](this.jQuerytext);
    };

    Password.prototype.val = function (value) {
        if (typeof value === 'undefined') {
            return this.jQueryelement.val();
        } else {
            this.jQueryelement.val(value).trigger('change');
            this.jQuerytext.val(value);
        }
    };

    Password.prototype.focus = function () {
        this.jQueryelement.focus();
    };


    // PASSWORD PLUGIN DEFINITION
    // =======================

    var old = jQuery.fn.password;

    jQuery.fn.password = function() {
        var option = arguments[0],
            args = arguments,

            value,
            allowedMethods = [
                'show', 'hide', 'toggle', 'val', 'focus'
            ]; // public function

        this.each(function() {
            var jQuerythis = jQuery(this),
                data = jQuerythis.data('bs.password'),
                options = jQuery.extend({}, Password.DEFAULTS, jQuerythis.data(), typeof option === 'object' && option);

            if (typeof option === 'string') {
                if (jQuery.inArray(option, allowedMethods) < 0) {
                    throw "Unknown method: " + option;
                }
                value = data[option](args[1]);
            } else {
                if (!data) {
                    data = new Password(jQuerythis, options);
                    jQuerythis.data('bs.password', data);
                } else {
                    data.init(options);
                }
            }
        });

        return value ? value : this;
    };

    jQuery.fn.password.Constructor = Password;


    // PASSWORD NO CONFLICT
    // =================

    jQuery.fn.password.noConflict = function() {
        jQuery.fn.password = old;
        return this;
    };

    jQuery(function () {
        jQuery('[data-toggle="password"]').password();
    });

}(window.jQuery);
