!function(a){"object"==typeof exports&&"object"==typeof module?a(require("../../lib/codemirror")):"function"==typeof define&&define.amd?define(["../../lib/codemirror"],a):a(CodeMirror)}(function(a){"use strict";a.defineMode("puppet",function(){function a(a,b){for(var c=b.split(" "),e=0;e<c.length;e++)d[c[e]]=a}function b(a,b){for(var c,d,e=!1;!a.eol()&&(c=a.next())!=b.pending;){if("$"===c&&"\\"!=d&&'"'==b.pending){e=!0;break}d=c}return e&&a.backUp(1),c==b.pending?b.continueString=!1:b.continueString=!0,"string"}function c(a,c){var f=a.match(/[\w]+/,!1),g=a.match(/(\s+)?\w+\s+=>.*/,!1),h=a.match(/(\s+)?[\w:_]+(\s+)?{/,!1),i=a.match(/(\s+)?[@]{1,2}[\w:_]+(\s+)?{/,!1),j=a.next();if("$"===j)return a.match(e)?c.continueString?"variable-2":"variable":"error";if(c.continueString)return a.backUp(1),b(a,c);if(c.inDefinition){if(a.match(/(\s+)?[\w:_]+(\s+)?/))return"def";a.match(/\s+{/),c.inDefinition=!1}return c.inInclude?(a.match(/(\s+)?\S+(\s+)?/),c.inInclude=!1,"def"):a.match(/(\s+)?\w+\(/)?(a.backUp(1),"def"):g?(a.match(/(\s+)?\w+/),"tag"):f&&d.hasOwnProperty(f)?(a.backUp(1),a.match(/[\w]+/),a.match(/\s+\S+\s+{/,!1)&&(c.inDefinition=!0),"include"==f&&(c.inInclude=!0),d[f]):/(\s+)?[A-Z]/.test(f)?(a.backUp(1),a.match(/(\s+)?[A-Z][\w:_]+/),"def"):h?(a.match(/(\s+)?[\w:_]+/),"def"):i?(a.match(/(\s+)?[@]{1,2}/),"special"):"#"==j?(a.skipToEnd(),"comment"):"'"==j||'"'==j?(c.pending=j,b(a,c)):"{"==j||"}"==j?"bracket":"/"==j?(a.match(/.*?\//),"variable-3"):j.match(/[0-9]/)?(a.eatWhile(/[0-9]+/),"number"):"="==j?(">"==a.peek()&&a.next(),"operator"):(a.eatWhile(/[\w-]/),null)}var d={},e=/({)?([a-z][a-z0-9_]*)?((::[a-z][a-z0-9_]*)*::)?[a-zA-Z0-9_]+(})?/;return a("keyword","class define site node include import inherits"),a("keyword","case if else in and elsif default or"),a("atom","false true running present absent file directory undef"),a("builtin","action augeas burst chain computer cron destination dport exec file filebucket group host icmp iniface interface jump k5login limit log_level log_prefix macauthorization mailalias maillist mcx mount nagios_command nagios_contact nagios_contactgroup nagios_host nagios_hostdependency nagios_hostescalation nagios_hostextinfo nagios_hostgroup nagios_service nagios_servicedependency nagios_serviceescalation nagios_serviceextinfo nagios_servicegroup nagios_timeperiod name notify outiface package proto reject resources router schedule scheduled_task selboolean selmodule service source sport ssh_authorized_key sshkey stage state table tidy todest toports tosource user vlan yumrepo zfs zone zpool"),{startState:function(){var a={};return a.inDefinition=!1,a.inInclude=!1,a.continueString=!1,a.pending=!1,a},token:function(a,b){return a.eatSpace()?null:c(a,b)}}}),a.defineMIME("text/x-puppet","puppet")});