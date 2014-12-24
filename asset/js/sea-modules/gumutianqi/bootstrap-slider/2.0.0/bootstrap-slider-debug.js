define("gumutianqi/bootstrap-slider/2.0.0/bootstrap-slider-debug", [ "jquery-debug", "./slider-debug.css" ], function(require, exports, module) {
    var $ = require("jquery-debug");
    require("./slider-debug.css");
    /* =========================================================
     * bootstrap-slider.js v2.0.0
     * http://www.eyecon.ro/bootstrap-slider
     * =========================================================
     * Copyright 2012 Stefan Petre
     *
     * Licensed under the Apache License, Version 2.0 (the "License");
     * you may not use this file except in compliance with the License.
     * You may obtain a copy of the License at
     *
     * http://www.apache.org/licenses/LICENSE-2.0
     *
     * Unless required by applicable law or agreed to in writing, software
     * distributed under the License is distributed on an "AS IS" BASIS,
     * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
     * See the License for the specific language governing permissions and
     * limitations under the License.
     * ========================================================= */
    !function($) {
        var Slider = function(element, options) {
            this.element = $(element);
            this.picker = $('<div class="slider">' + '<div class="slider-track">' + '<div class="slider-selection"></div>' + '<div class="slider-handle"></div>' + '<div class="slider-handle"></div>' + "</div>" + '<div class="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>' + "</div>").insertBefore(this.element).append(this.element);
            this.id = this.element.data("slider-id") || options.id;
            if (this.id) {
                this.picker[0].id = this.id;
            }
            if (typeof Modernizr !== "undefined" && Modernizr.touch) {
                this.touchCapable = true;
            }
            var tooltip = this.element.data("slider-tooltip") || options.tooltip;
            this.tooltip = this.picker.find(".tooltip");
            this.tooltipInner = this.tooltip.find("div.tooltip-inner");
            this.orientation = this.element.data("slider-orientation") || options.orientation;
            switch (this.orientation) {
              case "vertical":
                this.picker.addClass("slider-vertical");
                this.stylePos = "top";
                this.mousePos = "pageY";
                this.sizePos = "offsetHeight";
                this.tooltip.addClass("right")[0].style.left = "100%";
                break;

              default:
                this.picker.addClass("slider-horizontal").css("width", this.element.outerWidth());
                this.orientation = "horizontal";
                this.stylePos = "left";
                this.mousePos = "pageX";
                this.sizePos = "offsetWidth";
                this.tooltip.addClass("top")[0].style.top = -this.tooltip.outerHeight() - 14 + "px";
                break;
            }
            this.min = this.element.data("slider-min") || options.min;
            this.max = this.element.data("slider-max") || options.max;
            this.step = this.element.data("slider-step") || options.step;
            this.value = this.element.data("slider-value") || options.value;
            if (this.value[1]) {
                this.range = true;
            }
            this.selection = this.element.data("slider-selection") || options.selection;
            this.selectionEl = this.picker.find(".slider-selection");
            if (this.selection === "none") {
                this.selectionEl.addClass("hide");
            }
            this.selectionElStyle = this.selectionEl[0].style;
            this.handle1 = this.picker.find(".slider-handle:first");
            this.handle1Stype = this.handle1[0].style;
            this.handle2 = this.picker.find(".slider-handle:last");
            this.handle2Stype = this.handle2[0].style;
            var handle = this.element.data("slider-handle") || options.handle;
            switch (handle) {
              case "round":
                this.handle1.addClass("round");
                this.handle2.addClass("round");
                break;

              case "triangle":
                this.handle1.addClass("triangle");
                this.handle2.addClass("triangle");
                break;
            }
            if (this.range) {
                this.value[0] = Math.max(this.min, Math.min(this.max, this.value[0]));
                this.value[1] = Math.max(this.min, Math.min(this.max, this.value[1]));
            } else {
                this.value = [ Math.max(this.min, Math.min(this.max, this.value)) ];
                this.handle2.addClass("hide");
                if (this.selection == "after") {
                    this.value[1] = this.max;
                } else {
                    this.value[1] = this.min;
                }
            }
            this.diff = this.max - this.min;
            this.percentage = [ (this.value[0] - this.min) * 100 / this.diff, (this.value[1] - this.min) * 100 / this.diff, this.step * 100 / this.diff ];
            this.offset = this.picker.offset();
            this.size = this.picker[0][this.sizePos];
            this.formater = options.formater;
            this.layout();
            if (this.touchCapable) {
                // Touch: Bind touch events:
                this.picker.on({
                    touchstart: $.proxy(this.mousedown, this)
                });
            } else {
                this.picker.on({
                    mousedown: $.proxy(this.mousedown, this)
                });
            }
            if (tooltip === "show") {
                this.picker.on({
                    mouseenter: $.proxy(this.showTooltip, this),
                    mouseleave: $.proxy(this.hideTooltip, this)
                });
            } else {
                this.tooltip.addClass("hide");
            }
        };
        Slider.prototype = {
            constructor: Slider,
            over: false,
            inDrag: false,
            showTooltip: function() {
                this.tooltip.addClass("in");
                //var left = Math.round(this.percent*this.width);
                //this.tooltip.css('left', left - this.tooltip.outerWidth()/2);
                this.over = true;
            },
            hideTooltip: function() {
                if (this.inDrag === false) {
                    this.tooltip.removeClass("in");
                }
                this.over = false;
            },
            layout: function() {
                this.handle1Stype[this.stylePos] = this.percentage[0] + "%";
                this.handle2Stype[this.stylePos] = this.percentage[1] + "%";
                if (this.orientation == "vertical") {
                    this.selectionElStyle.top = Math.min(this.percentage[0], this.percentage[1]) + "%";
                    this.selectionElStyle.height = Math.abs(this.percentage[0] - this.percentage[1]) + "%";
                } else {
                    this.selectionElStyle.left = Math.min(this.percentage[0], this.percentage[1]) + "%";
                    this.selectionElStyle.width = Math.abs(this.percentage[0] - this.percentage[1]) + "%";
                }
                if (this.range) {
                    this.tooltipInner.text(this.formater(this.value[0]) + " : " + this.formater(this.value[1]));
                    this.tooltip[0].style[this.stylePos] = this.size * (this.percentage[0] + (this.percentage[1] - this.percentage[0]) / 2) / 100 - (this.orientation === "vertical" ? this.tooltip.outerHeight() / 2 : this.tooltip.outerWidth() / 2) + "px";
                } else {
                    this.tooltipInner.text(this.formater(this.value[0]));
                    this.tooltip[0].style[this.stylePos] = this.size * this.percentage[0] / 100 - (this.orientation === "vertical" ? this.tooltip.outerHeight() / 2 : this.tooltip.outerWidth() / 2) + "px";
                }
            },
            mousedown: function(ev) {
                // Touch: Get the original event:
                if (this.touchCapable && ev.type === "touchstart") {
                    ev = ev.originalEvent;
                }
                this.offset = this.picker.offset();
                this.size = this.picker[0][this.sizePos];
                var percentage = this.getPercentage(ev);
                if (this.range) {
                    var diff1 = Math.abs(this.percentage[0] - percentage);
                    var diff2 = Math.abs(this.percentage[1] - percentage);
                    this.dragged = diff1 < diff2 ? 0 : 1;
                } else {
                    this.dragged = 0;
                }
                this.percentage[this.dragged] = percentage;
                this.layout();
                if (this.touchCapable) {
                    // Touch: Bind touch events:
                    $(document).on({
                        touchmove: $.proxy(this.mousemove, this),
                        touchend: $.proxy(this.mouseup, this)
                    });
                } else {
                    $(document).on({
                        mousemove: $.proxy(this.mousemove, this),
                        mouseup: $.proxy(this.mouseup, this)
                    });
                }
                this.inDrag = true;
                var val = this.calculateValue();
                this.element.trigger({
                    type: "slideStart",
                    value: val
                }).trigger({
                    type: "slide",
                    value: val
                });
                return false;
            },
            mousemove: function(ev) {
                // Touch: Get the original event:
                if (this.touchCapable && ev.type === "touchmove") {
                    ev = ev.originalEvent;
                }
                var percentage = this.getPercentage(ev);
                if (this.range) {
                    if (this.dragged === 0 && this.percentage[1] < percentage) {
                        this.percentage[0] = this.percentage[1];
                        this.dragged = 1;
                    } else if (this.dragged === 1 && this.percentage[0] > percentage) {
                        this.percentage[1] = this.percentage[0];
                        this.dragged = 0;
                    }
                }
                this.percentage[this.dragged] = percentage;
                this.layout();
                var val = this.calculateValue();
                this.element.trigger({
                    type: "slide",
                    value: val
                }).data("value", val).prop("value", val);
                return false;
            },
            mouseup: function(ev) {
                if (this.touchCapable) {
                    // Touch: Bind touch events:
                    $(document).off({
                        touchmove: this.mousemove,
                        touchend: this.mouseup
                    });
                } else {
                    $(document).off({
                        mousemove: this.mousemove,
                        mouseup: this.mouseup
                    });
                }
                this.inDrag = false;
                if (this.over == false) {
                    this.hideTooltip();
                }
                this.element;
                var val = this.calculateValue();
                this.element.trigger({
                    type: "slideStop",
                    value: val
                }).data("value", val).prop("value", val);
                return false;
            },
            calculateValue: function() {
                var val;
                if (this.range) {
                    val = [ this.min + Math.round(this.diff * this.percentage[0] / 100 / this.step) * this.step, this.min + Math.round(this.diff * this.percentage[1] / 100 / this.step) * this.step ];
                    this.value = val;
                } else {
                    val = this.min + Math.round(this.diff * this.percentage[0] / 100 / this.step) * this.step;
                    this.value = [ val, this.value[1] ];
                }
                return val;
            },
            getPercentage: function(ev) {
                if (this.touchCapable) {
                    ev = ev.touches[0];
                }
                var percentage = (ev[this.mousePos] - this.offset[this.stylePos]) * 100 / this.size;
                percentage = Math.round(percentage / this.percentage[2]) * this.percentage[2];
                return Math.max(0, Math.min(100, percentage));
            },
            getValue: function() {
                if (this.range) {
                    return this.value;
                }
                return this.value[0];
            },
            setValue: function(val) {
                this.value = val;
                if (this.range) {
                    this.value[0] = Math.max(this.min, Math.min(this.max, this.value[0]));
                    this.value[1] = Math.max(this.min, Math.min(this.max, this.value[1]));
                } else {
                    this.value = [ Math.max(this.min, Math.min(this.max, this.value)) ];
                    this.handle2.addClass("hide");
                    if (this.selection == "after") {
                        this.value[1] = this.max;
                    } else {
                        this.value[1] = this.min;
                    }
                }
                this.diff = this.max - this.min;
                this.percentage = [ (this.value[0] - this.min) * 100 / this.diff, (this.value[1] - this.min) * 100 / this.diff, this.step * 100 / this.diff ];
                this.layout();
            }
        };
        $.fn.slider = function(option, val) {
            return this.each(function() {
                var $this = $(this), data = $this.data("slider"), options = typeof option === "object" && option;
                if (!data) {
                    $this.data("slider", data = new Slider(this, $.extend({}, $.fn.slider.defaults, options)));
                }
                if (typeof option == "string") {
                    data[option](val);
                }
            });
        };
        $.fn.slider.defaults = {
            min: 0,
            max: 10,
            step: 1,
            orientation: "horizontal",
            value: 5,
            selection: "before",
            tooltip: "show",
            handle: "round",
            formater: function(value) {
                return value;
            }
        };
        $.fn.slider.Constructor = Slider;
    }(window.jQuery);
});

define("gumutianqi/bootstrap-slider/2.0.0/slider-debug.css", [], function() {
    seajs.importStyle(".slider{display:inline-block;vertical-align:middle;position:relative}.slider.slider-horizontal{width:210px;height:20px}.slider.slider-horizontal .slider-track{height:10px;width:100%;margin-top:-5px;top:50%;left:0}.slider.slider-horizontal .slider-selection{height:100%;top:0;bottom:0}.slider.slider-horizontal .slider-handle{margin-left:-10px;margin-top:-5px}.slider.slider-horizontal .slider-handle.triangle{border-width:0 10px 10px;width:0;height:0;border-bottom-color:#0480be;margin-top:0}.slider.slider-vertical{height:210px;width:20px}.slider.slider-vertical .slider-track{width:10px;height:100%;margin-left:-5px;left:50%;top:0}.slider.slider-vertical .slider-selection{width:100%;left:0;top:0;bottom:0}.slider.slider-vertical .slider-handle{margin-left:-5px;margin-top:-10px}.slider.slider-vertical .slider-handle.triangle{border-width:10px 0 10px 10px;width:1px;height:1px;border-left-color:#0480be;margin-left:0}.slider input{display:none}.slider .tooltip-inner{white-space:nowrap}.slider-track{position:absolute;cursor:pointer;background-color:#f7f7f7;background-image:-moz-linear-gradient(top,#f5f5f5,#f9f9f9);background-image:-webkit-gradient(linear,0 0,0 100%,from(#f5f5f5),to(#f9f9f9));background-image:-webkit-linear-gradient(top,#f5f5f5,#f9f9f9);background-image:-o-linear-gradient(top,#f5f5f5,#f9f9f9);background-image:linear-gradient(to bottom,#f5f5f5,#f9f9f9);background-repeat:repeat-x;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#fff5f5f5', endColorstr='#fff9f9f9', GradientType=0);-webkit-box-shadow:inset 0 1px 2px rgba(0,0,0,.1);-moz-box-shadow:inset 0 1px 2px rgba(0,0,0,.1);box-shadow:inset 0 1px 2px rgba(0,0,0,.1);-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px}.slider-selection{position:absolute;background-color:#f7f7f7;background-image:-moz-linear-gradient(top,#f9f9f9,#f5f5f5);background-image:-webkit-gradient(linear,0 0,0 100%,from(#f9f9f9),to(#f5f5f5));background-image:-webkit-linear-gradient(top,#f9f9f9,#f5f5f5);background-image:-o-linear-gradient(top,#f9f9f9,#f5f5f5);background-image:linear-gradient(to bottom,#f9f9f9,#f5f5f5);background-repeat:repeat-x;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#fff9f9f9', endColorstr='#fff5f5f5', GradientType=0);-webkit-box-shadow:inset 0 -1px 0 rgba(0,0,0,.15);-moz-box-shadow:inset 0 -1px 0 rgba(0,0,0,.15);box-shadow:inset 0 -1px 0 rgba(0,0,0,.15);-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px}.slider-handle{position:absolute;width:20px;height:20px;background-color:#0e90d2;background-image:-moz-linear-gradient(top,#149bdf,#0480be);background-image:-webkit-gradient(linear,0 0,0 100%,from(#149bdf),to(#0480be));background-image:-webkit-linear-gradient(top,#149bdf,#0480be);background-image:-o-linear-gradient(top,#149bdf,#0480be);background-image:linear-gradient(to bottom,#149bdf,#0480be);background-repeat:repeat-x;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff149bdf', endColorstr='#ff0480be', GradientType=0);-webkit-box-shadow:inset 0 1px 0 rgba(255,255,255,.2),0 1px 2px rgba(0,0,0,.05);-moz-box-shadow:inset 0 1px 0 rgba(255,255,255,.2),0 1px 2px rgba(0,0,0,.05);box-shadow:inset 0 1px 0 rgba(255,255,255,.2),0 1px 2px rgba(0,0,0,.05);opacity:.8;border:0 solid transparent}.slider-handle.round{-webkit-border-radius:20px;-moz-border-radius:20px;border-radius:20px}.slider-handle.triangle{background:transparent none}");
});
