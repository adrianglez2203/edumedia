!function(){"use strict";var e,t={8301:function(e,t,n){var r=n(1850),o=n.n(r),i=window.wp.i18n,c=n(9196),l=n.n(c),a=function(){return l().createElement("header",{className:"eb-admin-header"},l().createElement("h4",null,(0,i.__)("Blocks Controller","essential-blocks")),l().createElement("p",null,(0,i.__)("Disable the blocks you are not using to minimize resource loading","essential-blocks")))},u=n(5191),s=n(2146),f=n.n(s),b=function(){return l().createElement("div",{id:"eb-save-admin-options"},l().createElement(f(),{raised:!0},(0,i.__)("Save","essential-blocks")))};function p(e){return p="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},p(e)}function y(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,r)}return n}function d(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?y(Object(n),!0).forEach((function(t){j(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):y(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}function m(e,t){for(var n=0;n<t.length;n++){var r=t[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}function v(e,t){return v=Object.setPrototypeOf||function(e,t){return e.__proto__=t,e},v(e,t)}function h(e,t){if(t&&("object"===p(t)||"function"==typeof t))return t;if(void 0!==t)throw new TypeError("Derived constructors may only return object or undefined");return O(e)}function O(e){if(void 0===e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return e}function k(e){return k=Object.setPrototypeOf?Object.getPrototypeOf:function(e){return e.__proto__||Object.getPrototypeOf(e)},k(e)}function j(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}var g=EssentialBlocksAdmin.all_blocks,w=function(e){!function(e,t){if("function"!=typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function");e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,writable:!0,configurable:!0}}),Object.defineProperty(e,"prototype",{writable:!1}),t&&v(e,t)}(c,e);var t,n,r,o,i=(r=c,o=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Boolean.prototype.valueOf.call(Reflect.construct(Boolean,[],(function(){}))),!0}catch(e){return!1}}(),function(){var e,t=k(r);if(o){var n=k(this).constructor;e=Reflect.construct(t,arguments,n)}else e=t.apply(this,arguments);return h(this,e)});function c(e){var t;return function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,c),j(O(t=i.call(this,e)),"onEnableAllClick",(function(){var e=d({},t.state.blocks);Object.keys(e).map((function(t){return e[t].visibility="true"})),t.setState({blocks:e})})),j(O(t),"onDisableAllClick",(function(){var e=d({},t.state.blocks);Object.keys(e).map((function(t){return e[t].visibility="false"})),t.setState({blocks:e})})),j(O(t),"onChange",(function(e,n){var r=d({},t.state.blocks);Object.keys(r).map((function(t){return r[t].value===n&&(r[t].visibility=String(e))})),t.setState({blocks:r})})),t.state={blocks:{},enabledBlocks:{}},t}return t=c,(n=[{key:"componentDidMount",value:function(){var e=g;if(Object.keys(e).length){var t=d({},this.state.enabledBlocks);Object.keys(e).map((function(n){"true"===e[n].visibility&&(t[e[n].value]=n)})),this.setState({blocks:e,enabledBlocks:t})}}},{key:"render",value:function(){var e=this,t=this.state.blocks;return l().createElement(l().Fragment,null,l().createElement("div",{className:"eb-admin-global-control"},l().createElement("div",{className:"eb-admin-button eb-admin-button-enable",onClick:function(){return e.onEnableAllClick()}},"Enable All"),l().createElement("div",{className:"eb-admin-button eb-admin-button-disable",onClick:function(){return e.onDisableAllClick()}},"Disable All")),l().createElement("div",{className:"eb-admin-checkboxes-wrapper"},Object.keys(t).map((function(n,r){return l().createElement("div",{key:r,className:"eb-admin-checkbox"},l().createElement("label",{htmlFor:t[n].value,className:"eb-admin-checkbox-label"},t[n].label,l().createElement(u.Z,{checked:"true"==t[n].visibility,onChange:function(r){return e.onChange(r,t[n].value)},defaultChecked:"true"==t[n].visibility,disabled:!1,checkedChildren:"ON",unCheckedChildren:"OFF"})))}))),l().createElement(b,null))}}])&&m(t.prototype,n),Object.defineProperty(t,"prototype",{writable:!1}),c}(c.Component),E=function(){return React.createElement("div",{className:"Helloxx"},React.createElement(a,null),React.createElement(w,null))};o().render(React.createElement(E,null),document.getElementById("admin-root"))},9196:function(e){e.exports=window.React},1850:function(e){e.exports=window.ReactDOM}},n={};function r(e){var o=n[e];if(void 0!==o)return o.exports;var i=n[e]={exports:{}};return t[e].call(i.exports,i,i.exports,r),i.exports}r.m=t,e=[],r.O=function(t,n,o,i){if(!n){var c=1/0;for(s=0;s<e.length;s++){n=e[s][0],o=e[s][1],i=e[s][2];for(var l=!0,a=0;a<n.length;a++)(!1&i||c>=i)&&Object.keys(r.O).every((function(e){return r.O[e](n[a])}))?n.splice(a--,1):(l=!1,i<c&&(c=i));if(l){e.splice(s--,1);var u=o();void 0!==u&&(t=u)}}return t}i=i||0;for(var s=e.length;s>0&&e[s-1][2]>i;s--)e[s]=e[s-1];e[s]=[n,o,i]},r.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return r.d(t,{a:t}),t},r.d=function(e,t){for(var n in t)r.o(t,n)&&!r.o(e,n)&&Object.defineProperty(e,n,{enumerable:!0,get:t[n]})},r.g=function(){if("object"==typeof globalThis)return globalThis;try{return this||new Function("return this")()}catch(e){if("object"==typeof window)return window}}(),r.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},r.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},r.j=328,function(){var e={328:0};r.O.j=function(t){return 0===e[t]};var t=function(t,n){var o,i,c=n[0],l=n[1],a=n[2],u=0;if(c.some((function(t){return 0!==e[t]}))){for(o in l)r.o(l,o)&&(r.m[o]=l[o]);if(a)var s=a(r)}for(t&&t(n);u<c.length;u++)i=c[u],r.o(e,i)&&e[i]&&e[i][0](),e[i]=0;return r.O(s)},n=self.webpackChunkessential_blocks=self.webpackChunkessential_blocks||[];n.forEach(t.bind(null,0)),n.push=t.bind(null,n.push.bind(n))}();var o=r.O(void 0,[277],(function(){return r(8301)}));o=r.O(o)}();