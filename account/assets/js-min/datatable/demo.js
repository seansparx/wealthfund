SyntaxHighlighter.config.tagName="code",window.$&&$(document).ready(function(){if($.fn.dataTable){var a=!!$.fn.dataTable.Api,b=$("div.info");b.height()<115&&b.css("min-height","8em");var c=function(a){return a.replace(/&/g,"&amp;").replace(/</g,"&lt;").replace(/>/g,"&gt;")},d=$("div.tabs div.css");""===$.trim(d.find("code").text())&&d.find("code, p:eq(0), div").css("display","none");var e=$("<p/>").append($("table").clone()).html();if($("div.tabs div.table").append('<code class="multiline language-html">			'+c(e)+"</code>"),a){var f=$("ul.tabs li").eq(3).css("display","none");$(document).on("init.dt",function(a,b){if("dt"===a.namespace){var c=new $.fn.dataTable.Api(b),d=function(a){f.css("display","block"),$("div.tabs div.ajax code").remove(),$("div.tabs div.ajax div.syntaxhighlighter").remove();try{a=JSON.stringify(a,null,2)}catch(b){}$("div.tabs div.ajax").append($('<code class="multiline language-js"/>').text(a)),setTimeout(function(){SyntaxHighlighter.highlight({},$("div.tabs div.ajax code")[0])},500)},e=c.ajax.json();e&&d(e),c.on("xhr.dt",function(a,b,c){d(c)})}});var g=$("ul.tabs li").eq(4).css("display","none");$(document).on("init.dt.demoSSP",function(a,b){if("dt"===a.namespace&&b.oFeatures.bServerSide){if($.isFunction(b.ajax))return;$.ajax({url:"../resources/examples.php",data:{src:b.sAjaxSource||b.ajax.url||b.ajax},dataType:"text",type:"post",success:function(a){g.css("display","block"),$("div.tabs div.php").append('<code class="multiline language-php">'+a+"</code>"),SyntaxHighlighter.highlight({},$("div.tabs div.php code")[0])}})}})}else $("ul.tabs li").eq(3).css("display","none"),$("ul.tabs li").eq(4).css("display","none");$("ul.tabs").on("click","li",function(){$("ul.tabs li.active").removeClass("active"),$(this).addClass("active"),$("div.tabs>div").css("display","none").eq($(this).index()).css("display","block")}),$("ul.tabs li.active").click()}});