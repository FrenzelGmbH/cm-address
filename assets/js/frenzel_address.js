(function ($) {
    // address plugin
    $.address = function (method) {
        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on jQuery.address');
            return false;
        }
    };

    // Default settings
    var defaults = {
        listSelector: '[data-address="list"]',
        parentSelector: '[data-address="parent"]',
        appendSelector: '[data-address="append"]',
        formSelector: '[data-address="form"]',
        contentSelector: '[data-address="content"]',
        toolsSelector: '[data-address="tools"]',
        formGroupSelector: '[data-address="form-group"]',
        errorSummarySelector: '[data-address="form-summary"]',
        errorSummaryToggleClass: 'hidden',
        errorClass: 'has-error',
        offset: 0
    };

    // Edit the address
    $(document).on('click', '[data-address="update"]', function (evt) {
        evt.preventDefault();

        $.address('createForm');        

        var data = $.data(document, 'address'),
            $this = $(this),
            $append = $this.parents(data.appendSelector);

        $.ajax({
            url: $this.data('address-fetch-url'),
            type: 'PUT',
            data: {"id" : $this.data('address-id')},
            error: function (xhr, status, error) {
                alert(error);
            },
            success: function (response, status, xhr) {
                $append.append(response);
            }
        });
    });

    // Delete address
    $(document).on('click', '[data-address="delete"]', function (evt) {
        evt.preventDefault();

        var data = $.data(document, 'address'),
            $this = $(this);

        if (confirm($this.data('address-confirm'))) {
            $.ajax({
                url: $this.data('address-url'),
                type: 'DELETE',
                error: function (xhr, status, error) {
                    alert('error');
                },
                success: function (result, status, xhr) {
                    console.log(result);
                    console.log($this.parents('[data-address="parent"][data-address-id="' + $this.data('address-id') + '"]'));
                    $this.parents('[data-address="parent"][data-address-id="' + $this.data('address-id') + '"]').find(data.contentSelector).text(result);
                    $this.parents(data.toolsSelector).remove();
                }
            });
        }
    });

    // AJAX updating form submit
    $(document).on('submit', '[data-address-action="update"]', function (evt) {
        evt.preventDefault();

        var data = $.data(document, 'address'),
            $this = $(this);

        $.ajax({
            url: $(this).attr('action'),
            type: 'PUT',
            data: $(this).serialize(),
            beforeSend: function (xhr, settings) {
                $this.find('[type="submit"]').attr('disabled', true);
            },
            complete: function (xhr, status) {
                $this.find('[type="submit"]').attr('disabled', false);
            },
            error: function (xhr, status, error) {
                if (xhr.status === 400) {
                    $.address('updateErrors', $this, xhr.responseJSON);
                } else {
                    alert(error);
                }
            },
            success: function (response, status, xhr) {
                $this.parents('[data-address="parent"][data-address-id="' + $this.data('address-id') + '"]').html(response);
                $.address('removeForm');
            }
        });
    });

    // AJAX create form submit
    $(document).on('submit', '[data-address-action="create"]', function (evt) {
        evt.preventDefault();

        var data = $.data(document, 'address'),
            $this = $(this);

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            beforeSend: function (xhr, settings) {
                $this.find('[type="submit"]').attr('disabled', true);
            },
            complete: function (xhr, status) {
                $this.find('[type="submit"]').attr('disabled', false);
            },
            error: function (xhr, status, error) {
                if (xhr.status === 400) {
                    $.address('updateErrors', $this, xhr.responseJSON);
                } else {
                    alert(error);
                }
            },
            success: function (response, status, xhr) {
                $(data.listSelector).html(response);
                $.address('clearErrors', $this);
                $this.trigger('reset');
                $('#container_net_frenzel_address_form').hide( 2000 );
            }
        });
    });

    // Methods
    var methods = {
        init: function (options) {
            if ($.data(document, 'address') !== undefined) {
                return;
            }

            // Set plugin data
            $.data(document, 'address', $.extend({}, defaults, options || {}));

            return this;
        },
        destroy: function () {
            $(document).unbind('.address');
            $(document).removeData('address');
        },
        data: function () {
            return $.data(document, 'address');
        },
        createForm: function () {
            var data = $.data(document, 'address'),
                $form = $(data.formSelector),
                $clone = $form.clone();

            methods.removeForm();

            $clone.removeAttr('id');
            $clone.attr('data-address', 'js-form');

            data.clone = $clone;
        },
        removeForm: function () {
            var data = $.data(document, 'address');

            if (data.clone !== undefined) {
                $('[data-address="js-form"]').remove();
                data.clone = undefined;
            }
        },
        scrollTo: function (id) {
            var data = $.data(document, 'address'),
                topScroll = $('[data-address="parent"][data-address-id="' + id + '"]').offset().top;
            $('body, html').animate({
                scrollTop: topScroll - data.offset
            }, 500);
        },
        updateErrors: function ($form, response) {
            var data = $.data(document, 'address'),
                message = '';

            $.each(response, function (id, msg) {
                $('#' + id).closest(data.formGroupSelector).addClass(data.errorClass);
                message += msg;
            });

            $form.find(data.errorSummarySelector).toggleClass(data.errorSummaryToggleClass).text(message);
        },
        clearErrors: function ($form) {
            var data = $.data(document, 'address');

            $form.find('.' + data.errorClass).removeClass(data.errorClass);
            $form.find(data.errorSummarySelector).toggleClass(data.errorSummaryToggleClass).text('');
        }
    };
})(window.jQuery);