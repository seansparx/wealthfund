!function(a){"object"==typeof exports&&"object"==typeof module?a(require("../../lib/codemirror")):"function"==typeof define&&define.amd?define(["../../lib/codemirror"],a):a(CodeMirror)}(function(a){"use strict";a.defineMode("toml",function(){return{startState:function(){return{inString:!1,stringType:"",lhs:!0,inArray:0}},token:function(a,b){if(b.inString||'"'!=a.peek()&&"'"!=a.peek()||(b.stringType=a.peek(),a.next(),b.inString=!0),a.sol()&&0===b.inArray&&(b.lhs=!0),b.inString){for(;b.inString&&!a.eol();)a.peek()===b.stringType?(a.next(),b.inString=!1):"\\"===a.peek()?(a.next(),a.next()):a.match(/^.[^\\\"\']*/);return b.lhs?"property string":"string"}return b.inArray&&"]"===a.peek()?(a.next(),b.inArray--,"bracket"):b.lhs&&"["===a.peek()&&a.skipTo("]")?(a.next(),"]"===a.peek()&&a.next(),"atom"):"#"===a.peek()?(a.skipToEnd(),"comment"):a.eatSpace()?null:b.lhs&&a.eatWhile(function(a){return"="!=a&&" "!=a})?"property":b.lhs&&"="===a.peek()?(a.next(),b.lhs=!1,null):!b.lhs&&a.match(/^\d\d\d\d[\d\-\:\.T]*Z/)?"atom":b.lhs||!a.match("true")&&!a.match("false")?b.lhs||"["!==a.peek()?!b.lhs&&a.match(/^\-?\d+(?:\.\d+)?/)?"number":(a.eatSpace()||a.next(),null):(b.inArray++,a.next(),"bracket"):"atom"}}}),a.defineMIME("text/x-toml","toml")});