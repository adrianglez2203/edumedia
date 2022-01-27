!function(){"use strict";var e=window.wp.data,t=window.lodash,n=window.wp.blocks;function o(e,t){var n="undefined"!=typeof Symbol&&e[Symbol.iterator]||e["@@iterator"];if(!n){if(Array.isArray(e)||(n=function(e,t){if(e){if("string"==typeof e)return r(e,t);var n=Object.prototype.toString.call(e).slice(8,-1);return"Object"===n&&e.constructor&&(n=e.constructor.name),"Map"===n||"Set"===n?Array.from(e):"Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)?r(e,t):void 0}}(e))||t&&e&&"number"==typeof e.length){n&&(e=n);var o=0,i=function(){};return{s:i,n:function(){return o>=e.length?{done:!0}:{done:!1,value:e[o++]}},e:function(e){throw e},f:i}}throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}var a,c=!0,l=!1;return{s:function(){n=n.call(e)},n:function(){var e=n.next();return c=e.done,e},e:function(e){l=!0,a=e},f:function(){try{c||null==n.return||n.return()}finally{if(l)throw a}}}}function r(e,t){(null==t||t>e.length)&&(t=e.length);for(var n=0,o=new Array(t);n<t;n++)o[n]=e[n];return o}!function(){var r=eb_style_handler.editor_type,i=function(e,t){return e&&t?e+"//"+t:null},a=function(){},c=!1;"edit-site"===r?c=(0,e.select)("core/edit-site").__experimentalGetPreviewDeviceType:"edit-post"===r&&(c=(0,e.select)("core/edit-post").__experimentalGetPreviewDeviceType),window.ebEditCurrentPreviewOption=c();var l=(0,e.select)("core/editor"),s=l.isSavingPost,u=void 0===s?a:s,d=l.isAutosavingPost,v=void 0===d?a:d,f=l.isSavingNonPostEntityChanges,b=void 0===f?a:f,p=/^essential\-blocks\//g,y=function(){var c=(0,e.select)("core").getEditedEntityRecord,l=void 0===c?a:c,s=(0,e.select)("core/block-editor").getBlocks,u=void 0===s?a:s,d=(0,e.select)("core/editor").getCurrentPostId,v=(void 0===d?a:d)(),f=u(),b={};!function e(r){var a,c,s=o(r);try{for(s.s();!(a=s.n()).done;){var u=a.value,d=u.attributes,v=d.blockMeta,f=d.blockRoot,p=d.blockId,y=u.innerBlocks;if((0,t.isFunction)(n.isReusableBlock)&&(0,n.isReusableBlock)(u)){var k=l("postType","wp_block",u.attributes.ref),w=(c=k,0!==Object.keys(c).length&&(0,n.parse)((0,t.isFunction)(k.content)?k.content(k):k.content));if(w){var g,h=o(w);try{for(h.s();!(g=h.n()).done;){var m=g.value,_=m.attributes,P=_.blockMeta,B=_.blockRoot,T=_.blockId,O=m.innerBlocks;P&&"essential_block"===B&&(b[T]=P),O.length>0&&e(O)}}catch(e){h.e(e)}finally{h.f()}}}else if((0,t.isFunction)(n.isTemplatePart)&&(0,n.isTemplatePart)(u)){var E=u.attributes,S=E.theme,A=E.slug,I=l("postType","wp_template_part",i(S,A)),j=I.blocks,R=void 0===j?[]:j,C=I.innerBlocks,x=void 0===C?[]:C;e(R),e(x)}else v&&"essential_block"===f&&(b[p]=v);y.length>0&&e(y)}}catch(e){s.e(e)}finally{s.f()}}(f);var p=JSON.stringify(b);jQuery.ajax({type:"POST",url:ajaxurl,data:{data:p,id:v,editorType:r,action:"eb_write_block_css",nonce:eb_style_handler.sth_nonce},error:function(e){console.log(e)}})},k=function(){if(window.ebEditCurrentPreviewOption!==c()){var t=c();window.ebEditCurrentPreviewOption=t;var n=lodash.isFunction,r=wp.blocks,l=r.parse,s=void 0===l?a:l,u=r.isReusableBlock,d=void 0===u?a:u,v=r.isTemplatePart,f=void 0===v?a:v,b=(0,e.select)("core").getEditedEntityRecord,y=void 0===b?a:b,k=(0,e.select)("core/block-editor"),w=k.getBlocks,g=void 0===w?a:w,h=k.updateBlockAttributes,m=void 0===h?a:h;!function e(r){var a,c=o(r);try{for(c.s();!(a=c.n()).done;){var l=a.value,u=l.name,v=l.clientId,b=l.innerBlocks;if(n(d)&&d(l)){var k,w=y("postType","wp_block",l.attributes.ref),g=o(s(n(w.content)?w.content(w):w.content));try{for(g.s();!(k=g.n()).done;){var h=k.value,_=h.innerBlocks,P=h.clientId,B=h.name;p.test(B)&&m(P,{resOption:t}),_.length>0&&e(_)}}catch(e){g.e(e)}finally{g.f()}}else if(n(f)&&f(l)){var T=l.attributes,O=T.theme,E=T.slug,S=y("postType","wp_template_part",i(O,E)),A=S.blocks,I=void 0===A?[]:A,j=S.innerBlocks,R=void 0===j?[]:j;e(I),e(R)}else p.test(u)&&m(v,{resOption:t});b.length>0&&e(b)}}catch(e){c.e(e)}finally{c.f()}}(g())}};"edit-site"===r?(0,e.subscribe)((function(){b()&&y(),k()})):"edit-post"===r&&(0,e.subscribe)((function(){u()&&!v()&&y(),k()}))}()}();