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

    this.QuickEditor = function(){

        this.init = function(){

            var $this = this;

            $("#qpages-editor-options a[data-editor='normal']").click(function(){
                $this.switchEditor('normal');
                return false;
            });

            $("#qpages-editor-options a[data-editor='visual']").click(function(){
                $this.switchEditor('visual');
                return false;
            });

        }

        this.switchEditor = function(which){
            if('visual' == which){
                $("#qpages-editor-standard").fadeOut(300, function(){
                    $("#qpages-editor-visual").fadeIn(300);
                });
            } else {
                $("#qpages-editor-visual").fadeOut(300, function(){
                    $("#qpages-editor-standard").fadeIn(300);
                });
            }
        }

    }

}(jQuery));

var quickEditor;

$(document).ready(function(){
    quickEditor = new QuickEditor();
    quickEditor.init();
});