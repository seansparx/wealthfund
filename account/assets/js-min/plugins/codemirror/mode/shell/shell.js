!function(a){"object"==typeof exports&&"object"==typeof module?a(require("../../lib/codemirror")):"function"==typeof define&&define.amd?define(["../../lib/codemirror"],a):a(CodeMirror)}(function(a){"use strict";a.defineMode("shell",function(){function a(a,b){for(var c=b.split(" "),d=0;d<c.length;d++)e[c[d]]=a}function b(a,b){if(a.eatSpace())return null;var g=a.sol(),h=a.next();if("\\"===h)return a.next(),null;if("'"===h||'"'===h||"`"===h)return b.tokens.unshift(c(h)),d(a,b);if("#"===h)return g&&a.eat("!")?(a.skipToEnd(),"meta"):(a.skipToEnd(),"comment");if("$"===h)return b.tokens.unshift(f),d(a,b);if("+"===h||"="===h)return"operator";if("-"===h)return a.eat("-"),a.eatWhile(/\w/),"attribute";if(/\d/.test(h)&&(a.eatWhile(/\d/),a.eol()||!/\w/.test(a.peek())))return"number";a.eatWhile(/[\w-]/);var i=a.current();return"="===a.peek()&&/\w+/.test(i)?"def":e.hasOwnProperty(i)?e[i]:null}function c(a){return function(b,c){for(var d,e=!1,g=!1;null!=(d=b.next());){if(d===a&&!g){e=!0;break}if("$"===d&&!g&&"'"!==a){g=!0,b.backUp(1),c.tokens.unshift(f);break}g=!g&&"\\"===d}return!e&&g||c.tokens.shift(),"`"===a||")"===a?"quote":"string"}}function d(a,c){return(c.tokens[0]||b)(a,c)}var e={};a("atom","true false"),a("keyword","if then do else elif while until for in esac fi fin fil done exit set unset export function"),a("builtin","ab awk bash beep cat cc cd chown chmod chroot clear cp curl cut diff echo find gawk gcc get git grep kill killall ln ls make mkdir openssl mv nc node npm ping ps restart rm rmdir sed service sh shopt shred source sort sleep ssh start stop su sudo tee telnet top touch vi vim wall wc wget who write yes zsh");var f=function(a,b){b.tokens.length>1&&a.eat("$");var e=a.next(),f=/\w/;return"{"===e&&(f=/[^}]/),"("===e?(b.tokens[0]=c(")"),d(a,b)):(/\d/.test(e)||(a.eatWhile(f),a.eat("}")),b.tokens.shift(),"def")};return{startState:function(){return{tokens:[]}},token:function(a,b){return d(a,b)},lineComment:"#"}}),a.defineMIME("text/x-sh","shell")});