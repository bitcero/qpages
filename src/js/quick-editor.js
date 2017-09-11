/*!
 * QuickPages for Common Utilities and XOOPS
 *
 * Author:  Eduardo Cortés
 * URI:     http://eduardocortes.mx
 * Parte del proyecto "Common Utilities"
 *
 * Copyright (c) 2016, Eduardo Cortés Hervis
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

(function($){

    var instance;

    this.QuickEditor = function(){

    };

    QuickEditor.prototype.init = function(){

        instance = this;

        // Capture controls clicks
        $("#qpages-editor-visual [data-control]").click(function(){

            instance.loadControl($(this));

            return false;
        });
    };

    /**
     * Execute clicked control
     * @param id
     * @param owner
     * @returns {boolean}
     */
    QuickEditor.prototype.loadControl = function(element){

        var owner = $(element).data('owner');
        var id = $(element).data('control');

        if(false === qpvProviders.hasOwnProperty('qpv' + owner)){
            return false;
        }

        var control = qpvProviders['qpv'+owner];

        if(false === control.hasOwnProperty('route')){
            return false;
        }

        // Send AJAX request for control
        $.get('qpv-providers.php', {action: 'load-control', control: id, route: control.route}, function(response){

            if(false == cuHandler.retrieveAjax(response)){
                return false;
            }

            var action = undefined != response.action ? response.action : 'insert';

            if($(element).data('target') == 'main'){
                var target = $("#qpages-editor-visual");
            } else {
                var target = $("#qpages-editor-visual [data-id='" + $(element).data('target') + "']");
            }

            switch(action){
                case 'insert':
                    instance.insertElement(response.control, target);
                    break;
            };

        }, 'json');

    };

    QuickEditor.prototype.insertElement = function(element, target){

        if($(target).data('capability') != 'container'){
            return false;
        }

        $(target).append(element);

    };


}(jQuery));

var quickEditor;

$(document).ready(function(){
    quickEditor = new QuickEditor();
    quickEditor.init();
});