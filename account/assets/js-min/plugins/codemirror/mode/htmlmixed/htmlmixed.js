!function(a){"object"==typeof exports&&"object"==typeof module?a(require("../../lib/codemirror"),require("../xml/xml"),require("../javascript/javascript"),require("../css/css")):"function"==typeof define&&define.amd?define(["../../lib/codemirror","../xml/xml","../javascript/javascript","../css/css"],a):a(CodeMirror)}(function(a){"use strict";a.defineMode("htmlmixed",function(b,c){function d(a,b){var c=b.htmlState.tagName;c&&(c=c.toLowerCase());var d=h.token(a,b.htmlState);if("script"==c&&/\btag\b/.test(d)&&">"==a.current()){var e=a.string.slice(Math.max(0,a.pos-100),a.pos).match(/\btype\s*=\s*("[^"]+"|'[^']+'|\S+)[^<]*$/i);e=e?e[1]:"",e&&/[\"\']/.test(e.charAt(0))&&(e=e.slice(1,e.length-1));for(var k=0;k<j.length;++k){var l=j[k];if("string"==typeof l.matches?e==l.matches:l.matches.test(e)){l.mode&&(b.token=f,b.localMode=l.mode,b.localState=l.mode.startState&&l.mode.startState(h.indent(b.htmlState,"")));break}}}else"style"==c&&/\btag\b/.test(d)&&">"==a.current()&&(b.token=g,b.localMode=i,b.localState=i.startState(h.indent(b.htmlState,"")));return d}function e(a,b,c){var d,e=a.current(),f=e.search(b);return f>-1?a.backUp(e.length-f):(d=e.match(/<\/?$/))&&(a.backUp(e.length),a.match(b,!1)||a.match(e)),c}function f(a,b){return a.match(/^<\/\s*script\s*>/i,!1)?(b.token=d,b.localState=b.localMode=null,d(a,b)):e(a,/<\/\s*script\s*>/,b.localMode.token(a,b.localState))}function g(a,b){return a.match(/^<\/\s*style\s*>/i,!1)?(b.token=d,b.localState=b.localMode=null,d(a,b)):e(a,/<\/\s*style\s*>/,i.token(a,b.localState))}var h=a.getMode(b,{name:"xml",htmlMode:!0,multilineTagIndentFactor:c.multilineTagIndentFactor,multilineTagIndentPastTag:c.multilineTagIndentPastTag}),i=a.getMode(b,"css"),j=[],k=c&&c.scriptTypes;if(j.push({matches:/^(?:text|application)\/(?:x-)?(?:java|ecma)script$|^$/i,mode:a.getMode(b,"javascript")}),k)for(var l=0;l<k.length;++l){var m=k[l];j.push({matches:m.matches,mode:m.mode&&a.getMode(b,m.mode)})}return j.push({matches:/./,mode:a.getMode(b,"text/plain")}),{startState:function(){var a=h.startState();return{token:d,localMode:null,localState:null,htmlState:a}},copyState:function(b){if(b.localState)var c=a.copyState(b.localMode,b.localState);return{token:b.token,localMode:b.localMode,localState:c,htmlState:a.copyState(h,b.htmlState)}},token:function(a,b){return b.token(a,b)},indent:function(b,c){return!b.localMode||/^\s*<\//.test(c)?h.indent(b.htmlState,c):b.localMode.indent?b.localMode.indent(b.localState,c):a.Pass},innerMode:function(a){return{state:a.localState||a.htmlState,mode:a.localMode||h}}}},"xml","javascript","css"),a.defineMIME("text/html","htmlmixed")});