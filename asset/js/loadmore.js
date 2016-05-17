(function(window) {
    var document = window.document,
        navigator = window.navigator,
        msPointerEnabled = navigator.msPointerEnabled,
        TOUCH_EVENTS = {
            start: msPointerEnabled ? 'MSPointerDown' : 'touchstart',
            move: msPointerEnabled ? 'MSPointerMove' : 'touchmove',
            end: msPointerEnabled ? 'MSPointerUp' : 'touchend'
        },
        dummyStyle = document.createElement('div').style,
        vendor = (function () {
            var vendors = 't,webkitT,MozT,msT,OT'.split(','),
                t,
                i = 0,
                l = vendors.length;

            for (; i < l; i++) {
                t = vendors[i] + 'ransform';
                if (t in dummyStyle) {
                    return vendors[i].substr(0, vendors[i].length - 1);
                }
            }

            return false;
        }()),
        prefixStyle = function(style) {
            if (vendor === '') return style;
            style = style.charAt(0).toUpperCase() + style.substr(1);
            return vendor + style;
        },
        transition = prefixStyle('transition'),
        transitionEndEvent = (function() {
            if (vendor == 'webkit' || vendor === 'O') {
                return vendor.toLowerCase() + 'TransitionEnd';
            }
            return 'transitionend';
        }()),
        listenTransition = function(target, duration, callbackFn) {
            var me = this,
                clear = function() {
                    if (target.transitionTimer) clearTimeout(target.transitionTimer);
                    target.transitionTimer = null;
                    target.removeEventListener(transitionEndEvent, handler, false);
                },
                handler = function() {
                    clear();
                    if (callbackFn) callbackFn.call(me);
                };
            clear();
            target.addEventListener(transitionEndEvent, handler, false);
            target.transitionTimer = setTimeout(handler, duration + 100);
        };

    var DragLoader = function(el, options) {
        this.ct = el ? (typeof el === 'string' ? document.querySelector(el) : el) : document.body;
        options = options || {};
        this.options = options;
        if (typeof options.threshold === 'undefined') options.threshold = 80;
        if (typeof options.dragDownThreshold === 'undefined') options.dragDownThreshold = options.threshold;
        if (typeof options.dragUpThreshold === 'undefined') options.dragUpThreshold = options.threshold;

        this._events = {};
        this._draggable = true;

        this.ct.addEventListener(TOUCH_EVENTS.start, this, false);
    };

    DragLoader.prototype = {
        STATUS: {
            default: 'default',
            prepare: 'prepare',
            load: 'load'
        },

        _createDragDownRegion: function() {
            this._removeDragDownRegion();
            this.header = document.createElement('div');
            this.header.style.cssText = 'position:relative;top:0;left:0;margin:0;padding:0;overflow:hidden;width:100%;height:0px;';
            this.header.className = this.options.dragDownRegionCls || '';
            this._touchCoords.status = this._processStatus('down', 0, null, true);
            this.ct.insertBefore(this.header, this.ct.children[0]);
            return this.header;
        },

        _removeDragDownRegion: function() {
            if (this.header) {
                this.ct.removeChild(this.header);
                this.header = null;
            }
        },

        _createDragUpRegion: function() {
            this._removeDragUpRegion();
            this.footer = document.createElement('div');
            this.footer.style.cssText = 'position:relative;bottom:0;left:0;margin:0;padding:0;overflow:hidden;width:100%;height:0px;';
            this.footer.className = this.options.dragUpRegionCls || '';
            this._touchCoords.status = this._processStatus('up', 0, null, true);
            this.ct.appendChild(this.footer);
            return this.footer;
        },

        _removeDragUpRegion: function() {
            if (this.footer) {
                this.ct.removeChild(this.footer);
                this.footer = null;
            }
        },

        _processDragDownHelper: function(status) {
            var options = this.options,
                helper = options.dragDownHelper;
            if (!options.preventDragHelper && helper) {
                this.header.innerHTML = helper.call(this, status);
            }
        },

        _processDragUpHelper: function(status) {
            var options = this.options,
                helper = options.dragUpHelper;
            if (!options.preventDragHelper && helper) {
                this.footer.innerHTML = helper.call(this, status);
            }
        },

        /*
         * status:
         *   default 默认状态
         *   prepare 释放加载
         *   load 加载
         */
        _processStatus: function(orient, offsetY, currentStatus, moved) {
            var options = this.options,
                STATUS = this.STATUS,
                overflow, nextStatus = currentStatus,
                upperStr;
            if (orient) {
                upperStr = orient.charAt(0).toUpperCase() + orient.substr(1);
                overflow = offsetY > options['drag' + upperStr + 'Threshold'];
                if (!overflow && currentStatus != STATUS.default) {
                    this['_processDrag' + upperStr + 'Helper'].call(this, STATUS.default);
                    this._fireEvent('drag' + upperStr + 'Default');
                    nextStatus = STATUS.default;
                } else if (moved && overflow && currentStatus != STATUS.prepare) {
                    this['_processDrag' + upperStr + 'Helper'].call(this, STATUS.prepare);
                    this._fireEvent('drag' + upperStr + 'Prepare');
                    nextStatus = STATUS.prepare;
                } else if (!moved && overflow && currentStatus != STATUS.load) {
                    this['_processDrag' + upperStr + 'Helper'].call(this, STATUS.load);
                    this._fireEvent('drag' + upperStr + 'Load');
                    nextStatus = STATUS.load;
                }
            }
            return nextStatus;
        },

        _onTouchStrat: function(e) {
            this.ct.removeEventListener(TOUCH_EVENTS.move, this, false);
            this.ct.removeEventListener(TOUCH_EVENTS.end, this, false);
            var body = document.body,
                startScrollY = this.ct === body ? (window.pageYOffset || window.scrollY || document.documentElement.scrollTop) : this.ct.scrollTop;
            if (this._draggable && (this.options.disableDragDown !== true || this.options.disableDragUp !== true) && this._fireEvent('beforeDrag') !== false) {
                this._draggable = false;
                this.ct.addEventListener(TOUCH_EVENTS.move, this, false);
                this.ct.addEventListener(TOUCH_EVENTS.end, this, false);
                this._touchCoords = {};
                this._touchCoords.startY = msPointerEnabled ? e.screenY : e.touches[0].screenY;
                this._touchCoords.startScrollY = startScrollY;
            }
        },

        _onTouchMove: function(e) {
            var ct = this.ct, header = this.header, footer = this.footer,
                options = this.options,
                innerHeight = window.innerHeight,
                ctHeight = ct.scrollHeight,
                coords = this._touchCoords,
                startScrollY = coords.startScrollY,
                blockY = coords.blockY,
                startY = coords.startY,
                stopY = msPointerEnabled ? e.screenY : e.touches[0].screenY,
                offsetY, overY;

            if (typeof coords.canDragDown === 'undefined') {
                coords.canDragDown = options.disableDragDown !== true && startY < stopY && startScrollY <= 0;
            }
            if (typeof coords.canDragUp === 'undefined') {
                coords.canDragUp = options.disableDragUp !== true && startY > stopY && startScrollY + innerHeight >= ctHeight;
            }

            if (coords.canDragDown && coords.dragUp !== true && (coords.dragDown || startY - stopY + startScrollY < 0)) {
                e.preventDefault();
                coords.dragDown = true;
                if (!header) {
                    header = this._createDragDownRegion();
                }
                if (typeof blockY === 'undefined') {
                    coords.blockY = blockY = stopY;
                }
                offsetY = stopY - blockY;
                offsetY = offsetY > 0 ? offsetY : 0;
                overY = offsetY - options.dragDownThreshold;
                if (overY > 100) {
                    offsetY = options.dragDownThreshold + 75 + (overY - 100) * 0.25;
                } else if (overY > 50) {
                    offsetY = options.dragDownThreshold + 50 + (overY - 50) * 0.5;
                }
                header.style.height = offsetY + 'px';
                coords.status = this._processStatus('down', offsetY, coords.status, true);
            } else if (coords.canDragUp && coords.dragDown !== true && (coords.dragUp || startY - stopY + startScrollY + innerHeight > ctHeight)) {
                e.preventDefault();
                coords.dragUp = true;
                if (!footer) {
                    footer = this._createDragUpRegion();
                }
                if (typeof blockY === 'undefined') {
                    coords.blockY = blockY = stopY;
                }
                offsetY = blockY - stopY;
                offsetY = offsetY > 0 ? offsetY : 0;
                overY = offsetY - options.dragUpThreshold;
                if (overY > 100) {
                    offsetY = options.dragUpThreshold + 75 + (overY - 100) * 0.2;
                } else if (overY > 50) {
                    offsetY = options.dragUpThreshold + 50 + (overY - 50) * 0.5;
                }
                ct.scrollTop = startScrollY + offsetY;
                footer.style.height = offsetY + 'px';
                coords.status = this._processStatus('up', offsetY, coords.status, true);
            } else {
                coords.blockY = stopY;
            }
        },

        _onTouchEnd: function(e) {
            this.ct.removeEventListener(TOUCH_EVENTS.move, this, false);
            this.ct.removeEventListener(TOUCH_EVENTS.end, this, false);
            this._translate();
        },

        _translate: function() {
            var me = this,
                options = me.options,
                coords = me._touchCoords, orient,
                target, targetHeight,
                adjustHeight,
                maxDuration = 200, duration,
                upperStr, threshold,
                endFn = function() {
                    coords.status = me._processStatus(orient, targetHeight, coords.status, false);
                    if (!orient || coords.status !== me.STATUS.load) {
                        me._removeDragDownRegion();
                        me._removeDragUpRegion();
                        me._touchCoords = null;
                        me._draggable = true;
                    } else if (orient == 'down') {
                        me._removeDragUpRegion();
                    } else if (orient == 'up') {
                        me._removeDragDownRegion();
                    }
                };

            if (!coords) return;

            orient = coords.dragDown ? 'down' : (coords.dragUp ? 'up' : null);
            if (orient) {
                target = orient == 'down' ? me.header : me.footer;
                targetHeight = target.offsetHeight;
                upperStr = orient.charAt(0).toUpperCase() + orient.substr(1);
                threshold = options['drag' + upperStr + 'Threshold'];
                adjustHeight = (!options.preventDragHelper && targetHeight > threshold) ? threshold : 0;
                duration = Math.ceil((targetHeight - adjustHeight) / threshold * maxDuration);
                duration = duration > maxDuration ? maxDuration : duration;
                listenTransition(target, duration, endFn);
                target.style[transition] = 'height ' + duration + 'ms';
                setTimeout(function() {
                    target.style.height = adjustHeight + 'px';
                }, 0);
            } else {
                endFn();
            }
        },

        reset: function() {
            this._translate();
        },

        on: function(type, fn) {
            if (!this._events[type]) {
                this._events[type] = [];
            }
            this._events[type].push(fn);
        },

        off: function(type, fn) {
            if (this._events[type]) {
                this._events[type].every(function(cb, i) {
                    if (cb === fn) {
                        this._events[type].splice(i, 1);
                        return false;
                    }
                });
            }
        },

        _fireEvent: function(type, args) {
            var me = this, ret;
            if (me._events[type]) {
                me._events[type].forEach(function(fn) {
                    ret = fn.apply(me, args || []);
                });
            }
            return ret;
        },

        setDragDownDisabled: function(disabled) {
            this.options.disableDragDown = disabled;
        },

        setDragUpDisabled: function(disabled) {
            this.options.disableDragUp = disabled;
        },

        handleEvent: function(e) {
            switch (e.type) {
                case TOUCH_EVENTS.start:
                    this._onTouchStrat(e);
                    break;
                case TOUCH_EVENTS.move:
                    this._onTouchMove(e);
                    break;
                case TOUCH_EVENTS.end:
                    this._onTouchEnd(e);
                    break;
            }
        },

        destroy: function() {
            if (!this.destroyed) {
                this.destroyed = true;
                this._removeDragDownRegion();
                this._removeDragUpRegion();
                this.ct.removeEventListener(TOUCH_EVENTS.start, this, false);
                this.ct.removeEventListener(TOUCH_EVENTS.move, this, false);
                this.ct.removeEventListener(TOUCH_EVENTS.end, this, false);
                this.ct = null;
            }
        }
    };

    dummyStyle = null;

    window.DragLoader = DragLoader;

})(window);