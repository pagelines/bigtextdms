;(function($)
{
    // Purposeful Global
    BigTextDMS = {
        STARTING_PX_FONT_SIZE: 11,
        DEFAULT_MAX_FONT_SIZE_EM: 48,
        GLOBAL_STYLE_ID: 'bigtextdms-style',
        STYLE_ID: 'bigtextdms-id',
        LINE_CLASS_PREFIX: 'bigtextdms-line',
        LINE_FOCUS_CLASS: 'bigtextdms-focus',
        EXEMPT_CLASS: 'bigtextdms-exempt',
        DEFAULT_CHILD_SELECTOR: '> div',
        childSelectors: {
            div: '> div',
            ol: '> li',
            ul: '> li'
        },
        DATA_KEY: 'bigtextdmsOptions',
        counter: 0,
        init: function($head)
        {
            if(!$('#'+BigTextDMS.GLOBAL_STYLE_ID).length) {
                $head.append(BigTextDMS.generateStyleTag(BigTextDMS.GLOBAL_STYLE_ID, ['.bigtextdms, .bigtextdms .' + BigTextDMS.EXEMPT_CLASS + ' { font-size: ' + BigTextDMS.STARTING_PX_FONT_SIZE + 'px; }']));
            }
        },
        getStyleId: function(elementId)
        {
            return BigTextDMS.STYLE_ID + '-' + elementId;
        },
        generateStyleTag: function(id, css)
        {
            return $('<style>' + css.join('\n') + '</style>').attr('id', id);
        },
        generateFontSizeCss: function(elementId, linesFontSizes, lineWordSpacings)
        {
            var css = [],
                styleId = BigTextDMS.getStyleId(elementId);

            for(var j=0, k=linesFontSizes.length; j<k; j++) {
                css.push('#' + elementId + ' .' + BigTextDMS.LINE_CLASS_PREFIX + j + ' {' +
                    (linesFontSizes[j] ? ' font-size: ' + linesFontSizes[j] + 'em;' : '') +
                    (lineWordSpacings[j] ? ' word-spacing: ' + lineWordSpacings[j] + 'px;' : '') + ' }');
            }

            $('#' + styleId).remove();
            return BigTextDMS.generateStyleTag(styleId, css);
        },
        testLineDimensions: function($line, maxwidth, property, size, interval, units)
        {
            $line.css(property, size + units);

            if($line.width() >= maxwidth) {
                $line.css(property, '');

                return parseFloat((parseFloat(size) - interval).toFixed(2));
            }

            return false;
        }
    };

    $.fn.bigtextdms = function(options)
    {
        var $headCache = $('head');
        BigTextDMS.init($headCache);

        options = $.extend({
                    maxfontsize: BigTextDMS.DEFAULT_MAX_FONT_SIZE_EM,
                    childSelector: '',
                    bindResize: null,
                    resize: true
                }, options || {});

        return this.each(function()
        {
            var $t = $(this).addClass('bigtextdms'),
                id = $t.attr('id'),
                childSelector = options.childSelector ||
                            BigTextDMS.childSelectors[this.tagName.toLowerCase()] ||
                            BigTextDMS.DEFAULT_CHILD_SELECTOR,
                maxwidth = $t.width(),
                $c = $t.clone(true)
                            .addClass('bigtextdms-cloned')
                            .css({
                                'min-width': parseInt(maxwidth, 10),
                                width: 'auto',
                                position: 'absolute',
                                left: -9999,
                                top: -9999
                            }).appendTo(document.body),
                eventNamespace,
                eventName;

            if(!id) {
                id = 'bigtextdms-id' + (BigTextDMS.counter++);
                eventNamespace = id;
                $t.attr('id', id);
            } else {
                eventNamespace = 'bigtextdms-' + id;
            }

            if(options.resize) {
                function resizeFunction()
                {
                    $('#'+id).bigtextdms(options);
                }

                eventName = 'resize.' + eventNamespace;

                if($.isFunction(options.bindResize)) {
                    options.bindResize(resizeFunction);
                } else if($.throttle) {
                    // https://github.com/cowboy/jquery-throttle-debounce
                    $(window).unbind(eventName).bind(eventName, $.throttle(100, resizeFunction));
                } else if($.fn.smartresize) {
                    // https://github.com/lrbabe/jquery-smartresize/
                    eventName = 'smartresize.' + eventNamespace;
                    $(window).unbind(eventName).bind(eventName, resizeFunction);
                } else {
                    $(window).unbind(eventName).bind(eventName, resizeFunction);
                }
            }

            var styleId = BigTextDMS.getStyleId(id);
            $('#' + styleId).remove();

            // font-size isn't the only thing we can modify, we can also mess with:
            // word-spacing and letter-spacing.
            // Note: webkit does not respect subpixel letter-spacing or word-spacing,
            // nor does it respect hundredths of a font-size em.
            var fontSizes = [],
                wordSpacings = [];

            $c.find(childSelector).css({
                float: 'left',
                clear: 'left'
            }).each(function(lineNumber) {
                var $line = $(this),
                    intervals = [16,8,4,2,1,.1,.01],
                    fontMatch = 1,
                    lineMax;

                if($line.hasClass(BigTextDMS.EXEMPT_CLASS)) {
                    fontSizes.push(null);
                    return;
                }

                for(var m=0, n=intervals.length; m<n; m++) {
                    inner: for(var j=1, k=10; j<=k; j++) {
                        lineMax = BigTextDMS.testLineDimensions($line, maxwidth, 'font-size', fontMatch + j*intervals[m], intervals[m], 'em');

                        if(lineMax !== false) {
                            fontMatch = lineMax;
                            break inner;
                        }
                    }

                    if(fontMatch > options.maxfontsize) {
                        break;
                    }
                }

                if(fontMatch > options.maxfontsize) {
                    fontSizes.push(options.maxfontsize);
                } else {
                    fontSizes.push(fontMatch);
                }
            }).each(function(lineNumber) {
                var $line = $(this),
                    wordSpacing = 0,
                    interval = 1,
                    maxWordSpacing;

                if($line.hasClass(BigTextDMS.EXEMPT_CLASS)) {
                    wordSpacings.push(null);
                    return;
                }

                // must re-use font-size, even though it was removed above.
                $line.css('font-size', fontSizes[lineNumber] + 'em');

                for(var m=0, n=10; m<n; m+=interval) {
                    maxWordSpacing = BigTextDMS.testLineDimensions($line, maxwidth, 'word-spacing', m, interval, 'px');
                    if(maxWordSpacing !== false) {
                        wordSpacing = maxWordSpacing;
                        break;
                    }
                }

                $line.css('font-size', '');
                wordSpacings.push(wordSpacing);
            }).removeAttr('style');

            $headCache.append(BigTextDMS.generateFontSizeCss(id, fontSizes, wordSpacings));

            $c.remove();

            $t.find(childSelector).each(function(lineNumber)
            {
                $(this).each(function()
                    {
                        // remove existing line classes.
                        this.className = this.className.replace(new RegExp('\\s*' + BigTextDMS.LINE_CLASS_PREFIX + '\\d+'), '');
                    })
                    .addClass(BigTextDMS.LINE_CLASS_PREFIX + lineNumber)
                    [maxwidth / fontSizes[lineNumber] < 80 ? 'addClass' : 'removeClass'](BigTextDMS.LINE_FOCUS_CLASS);
            });
        });
    };
})(jQuery);