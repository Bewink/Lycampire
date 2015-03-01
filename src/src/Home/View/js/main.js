"use strict";

(function() {
    function addListener(obj, eventName, listener) {
        if(obj.addEventListener) {
            obj.addEventListener(eventName, listener, false);
        } else {
            obj.attachEvent("on" + eventName, listener);
        }
    }

    addListener(document, 'DOMContentLoaded', function(event) {

    });
})();