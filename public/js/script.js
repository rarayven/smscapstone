+function(o){"use strict";o(".example:not(.skip)").each(function(){var t=o("<div>").text(o(this).html()).html(),e=t.match(/^(\s+)/)[0].length-1,n=new RegExp("\\n\\s{"+e+"}","g"),g=t.replace(n,"\n").replace(/\t/g,"  ").trim();g=g.replace(/=""/g,""),o(this).after(o('<code class="highlight html">').html(g))}),o("code.highlight").each(function(){hljs.highlightBlock(this)})}(jQuery);var Demo=function(){};Demo.prototype.init=function(o){$(o).bootstrapToggle(o)},Demo.prototype.destroy=function(o){$(o).bootstrapToggle("destroy")},Demo.prototype.on=function(o){$(o).bootstrapToggle("on")},Demo.prototype.off=function(o){$(o).bootstrapToggle("off")},Demo.prototype.toggle=function(o){$(o).bootstrapToggle("toggle")},Demo.prototype.enable=function(o){$(o).bootstrapToggle("enable")},Demo.prototype.disable=function(o){$(o).bootstrapToggle("disable")},demo=new Demo;