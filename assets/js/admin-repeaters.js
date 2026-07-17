/* Редактор повторяющихся блоков (ACF Free) — только админка. */
(function ($) {
    'use strict';

    function reindex($repeater) {
        var $rows = $repeater.find('.tr-rows > .tr-row');
        $rows.each(function (i) {
            var $row = $(this);
            $row.attr('data-index', i);
            $row.find('.tr-row-num').first().text(i + 1);
            $row.find('[name]').each(function () {
                this.name = this.name.replace(/\]\[-?\w+\]\[/, '][' + i + '][');
            });
        });
        var max = parseInt($repeater.attr('data-max'), 10) || 0;
        $repeater.find('.tr-add').prop('disabled', max > 0 && $rows.length >= max);
    }

    function reindexAll() {
        $('.tr-repeater').each(function () {
            reindex($(this));
        });
    }

    $(function () {
        reindexAll();
    });

    $(document).on('click', '.tr-add', function (e) {
        e.preventDefault();
        var $repeater = $(this).closest('.tr-repeater');
        var tpl = $repeater.find('template.tr-template')[0];
        if (!tpl) {
            return;
        }
        var max = parseInt($repeater.attr('data-max'), 10) || 0;
        var count = $repeater.find('.tr-rows > .tr-row').length;
        if (max > 0 && count >= max) {
            return;
        }
        var $row = $(tpl.content.cloneNode(true)).children('.tr-row').first();
        $row.find('.tr-row-num').text(count + 1);
        $repeater.find('.tr-rows').append($row);
        reindex($repeater);
    });

    $(document).on('click', '.tr-remove', function (e) {
        e.preventDefault();
        if (!window.confirm('Удалить эту запись?')) {
            return;
        }
        var $repeater = $(this).closest('.tr-repeater');
        $(this).closest('.tr-row').remove();
        reindex($repeater);
    });

    $(document).on('click', '.tr-up, .tr-down', function (e) {
        e.preventDefault();
        var $row = $(this).closest('.tr-row');
        var $repeater = $(this).closest('.tr-repeater');
        if ($(this).hasClass('tr-up')) {
            var $prev = $row.prev('.tr-row');
            if ($prev.length) {
                $row.insertBefore($prev);
            }
        } else {
            var $next = $row.next('.tr-row');
            if ($next.length) {
                $row.insertAfter($next);
            }
        }
        reindex($repeater);
    });

    $(document).on('click', '.tr-image-select', function (e) {
        e.preventDefault();
        var $box = $(this).closest('.tr-image');
        var frame = wp.media({
            title: 'Выберите изображение',
            button: { text: 'Использовать изображение' },
            library: { type: 'image' },
            multiple: false
        });
        frame.on('select', function () {
            var attachment = frame.state().get('selection').first().toJSON();
            $box.find('.tr-image-id').val(attachment.id);
            var url = (attachment.sizes && attachment.sizes.thumbnail) ? attachment.sizes.thumbnail.url : attachment.url;
            $box.find('.tr-image-preview').html($('<img>', { src: url, alt: '' }));
            $box.addClass('has-image');
        });
        frame.open();
    });

    $(document).on('click', '.tr-image-clear', function (e) {
        e.preventDefault();
        var $box = $(this).closest('.tr-image');
        $box.find('.tr-image-id').val('');
        $box.find('.tr-image-preview').empty();
        $box.removeClass('has-image');
    });
})(jQuery);
