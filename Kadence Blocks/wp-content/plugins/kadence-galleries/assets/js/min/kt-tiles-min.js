/*!
 * justifiedGallery - v3.8.1
 * http://miromannino.github.io/Justified-Gallery/
 * Copyright (c) 2020 Miro Mannino
 * Licensed under the MIT license.
 */
!function(t){"function"==typeof define&&define.amd?define(["jquery"],t):"object"==typeof module&&module.exports?module.exports=function(i,e){return void 0===e&&(e="undefined"!=typeof window?require("jquery"):require("jquery")(i)),t(e),e}:t(jQuery)}((function($){var t=function(t,i){this.settings=i,this.checkSettings(),this.imgAnalyzerTimeout=null,this.entries=null,this.buildingRow={entriesBuff:[],width:0,height:0,aspectRatio:0},this.lastFetchedEntry=null,this.lastAnalyzedIndex=-1,this.yield={every:2,flushed:0},this.border=i.border>=0?i.border:i.margins,this.maxRowHeight=this.retrieveMaxRowHeight(),this.suffixRanges=this.retrieveSuffixRanges(),this.offY=this.border,this.rows=0,this.spinner={phase:0,timeSlot:150,$el:$('<div class="jg-spinner"><span></span><span></span><span></span></div>'),intervalId:null},this.scrollBarOn=!1,this.checkWidthIntervalId=null,this.galleryWidth=t.width(),this.$gallery=t};t.prototype.getSuffix=function(t,i){var e,s;for(e=t>i?t:i,s=0;s<this.suffixRanges.length;s++)if(e<=this.suffixRanges[s])return this.settings.sizeRangeSuffixes[this.suffixRanges[s]];return this.settings.sizeRangeSuffixes[this.suffixRanges[s-1]]},t.prototype.removeSuffix=function(t,i){return t.substring(0,t.length-i.length)},t.prototype.endsWith=function(t,i){return-1!==t.indexOf(i,t.length-i.length)},t.prototype.getUsedSuffix=function(t){for(var i in this.settings.sizeRangeSuffixes)if(this.settings.sizeRangeSuffixes.hasOwnProperty(i)){if(0===this.settings.sizeRangeSuffixes[i].length)continue;if(this.endsWith(t,this.settings.sizeRangeSuffixes[i]))return this.settings.sizeRangeSuffixes[i]}return""},t.prototype.newSrc=function(t,i,e,s){var n;if(this.settings.thumbnailPath)n=this.settings.thumbnailPath(t,i,e,s);else{var r=t.match(this.settings.extension),o=null!==r?r[0]:"";n=t.replace(this.settings.extension,""),n=this.removeSuffix(n,this.getUsedSuffix(n)),n+=this.getSuffix(i,e)+o}return n},t.prototype.showImg=function(t,i){this.settings.cssAnimation?(t.addClass("jg-entry-visible"),i&&i()):(t.stop().fadeTo(this.settings.imagesAnimationDuration,1,i),t.find(this.settings.imgSelector).stop().fadeTo(this.settings.imagesAnimationDuration,1,i))},t.prototype.extractImgSrcFromImage=function(t){var i=t.data("safe-src"),e="data-safe-src";return void 0===i&&(i=t.attr("src"),e="src"),t.data("jg.originalSrc",i),t.data("jg.src",i),t.data("jg.originalSrcLoc",e),i},t.prototype.imgFromEntry=function(t){var i=t.find(this.settings.imgSelector);return 0===i.length?null:i},t.prototype.captionFromEntry=function(t){var i=t.find("> .jg-caption");return 0===i.length?null:i},t.prototype.displayEntry=function(t,i,e,s,n,r){t.width(s),t.height(r),t.css("top",e),t.css("left",i);var o=this.imgFromEntry(t);if(null!==o){o.css("width",s),o.css("height",n),o.css("margin-left",-s/2),o.css("margin-top",-n/2);var a=o.data("jg.src");if(a){a=this.newSrc(a,s,n,o[0]),o.one("error",(function(){this.resetImgSrc(o)}));var h=function(){o.attr("src",a)};"skipped"===t.data("jg.loaded")&&a?this.onImageEvent(a,function(){this.showImg(t,h),t.data("jg.loaded",!0)}.bind(this)):this.showImg(t,h)}}else this.showImg(t);this.displayEntryCaption(t)},t.prototype.displayEntryCaption=function(t){var i=this.imgFromEntry(t);if(null!==i&&this.settings.captions){var e=this.captionFromEntry(t);if(null===e){var s=i.attr("alt");this.isValidCaption(s)||(s=t.attr("title")),this.isValidCaption(s)&&(e=$('<div class="jg-caption">'+s+"</div>"),t.append(e),t.data("jg.createdCaption",!0))}null!==e&&(this.settings.cssAnimation||e.stop().fadeTo(0,this.settings.captionSettings.nonVisibleOpacity),this.addCaptionEventsHandlers(t))}else this.removeCaptionEventsHandlers(t)},t.prototype.isValidCaption=function(t){return void 0!==t&&t.length>0},t.prototype.onEntryMouseEnterForCaption=function(t){var i=this.captionFromEntry($(t.currentTarget));this.settings.cssAnimation?i.addClass("jg-caption-visible").removeClass("jg-caption-hidden"):i.stop().fadeTo(this.settings.captionSettings.animationDuration,this.settings.captionSettings.visibleOpacity)},t.prototype.onEntryMouseLeaveForCaption=function(t){var i=this.captionFromEntry($(t.currentTarget));this.settings.cssAnimation?i.removeClass("jg-caption-visible").removeClass("jg-caption-hidden"):i.stop().fadeTo(this.settings.captionSettings.animationDuration,this.settings.captionSettings.nonVisibleOpacity)},t.prototype.addCaptionEventsHandlers=function(t){var i=t.data("jg.captionMouseEvents");void 0===i&&(i={mouseenter:$.proxy(this.onEntryMouseEnterForCaption,this),mouseleave:$.proxy(this.onEntryMouseLeaveForCaption,this)},t.on("mouseenter",void 0,void 0,i.mouseenter),t.on("mouseleave",void 0,void 0,i.mouseleave),t.data("jg.captionMouseEvents",i))},t.prototype.removeCaptionEventsHandlers=function(t){var i=t.data("jg.captionMouseEvents");void 0!==i&&(t.off("mouseenter",void 0,i.mouseenter),t.off("mouseleave",void 0,i.mouseleave),t.removeData("jg.captionMouseEvents"))},t.prototype.clearBuildingRow=function(){this.buildingRow.entriesBuff=[],this.buildingRow.aspectRatio=0,this.buildingRow.width=0},t.prototype.prepareBuildingRow=function(t,i){var e,s,n,r,o,a=!0,h=0,g=this.galleryWidth-2*this.border-(this.buildingRow.entriesBuff.length-1)*this.settings.margins,l=g/this.buildingRow.aspectRatio,u=this.settings.rowHeight,d=this.buildingRow.width/g>this.settings.justifyThreshold;if(i||t&&"hide"===this.settings.lastRow&&!d){for(e=0;e<this.buildingRow.entriesBuff.length;e++)s=this.buildingRow.entriesBuff[e],this.settings.cssAnimation?s.removeClass("jg-entry-visible"):(s.stop().fadeTo(0,.1),s.find("> img, > a > img").fadeTo(0,0));return-1}for(t&&!d&&"justify"!==this.settings.lastRow&&"hide"!==this.settings.lastRow&&(a=!1,this.rows>0&&(a=(u=(this.offY-this.border-this.settings.margins*this.rows)/this.rows)*this.buildingRow.aspectRatio/g>this.settings.justifyThreshold)),e=0;e<this.buildingRow.entriesBuff.length;e++)n=(s=this.buildingRow.entriesBuff[e]).data("jg.width")/s.data("jg.height"),a?(r=e===this.buildingRow.entriesBuff.length-1?g:l*n,o=l):(r=u*n,o=u),g-=Math.round(r),s.data("jg.jwidth",Math.round(r)),s.data("jg.jheight",Math.ceil(o)),(0===e||h>o)&&(h=o);return this.buildingRow.height=h,a},t.prototype.flushRow=function(t,i){var e=this.settings,s,n,r=this.border,o;if(n=this.prepareBuildingRow(t,i),i||t&&"hide"===e.lastRow&&-1===n)this.clearBuildingRow();else{if(this.maxRowHeight&&this.maxRowHeight<this.buildingRow.height&&(this.buildingRow.height=this.maxRowHeight),t&&("center"===e.lastRow||"right"===e.lastRow)){var a=this.galleryWidth-2*this.border-(this.buildingRow.entriesBuff.length-1)*e.margins;for(o=0;o<this.buildingRow.entriesBuff.length;o++)a-=(s=this.buildingRow.entriesBuff[o]).data("jg.jwidth");"center"===e.lastRow?r+=Math.round(a/2):"right"===e.lastRow&&(r+=a)}var h=this.buildingRow.entriesBuff.length-1;for(o=0;o<=h;o++)s=this.buildingRow.entriesBuff[this.settings.rtl?h-o:o],this.displayEntry(s,r,this.offY,s.data("jg.jwidth"),s.data("jg.jheight"),this.buildingRow.height),r+=s.data("jg.jwidth")+e.margins;this.galleryHeightToSet=this.offY+this.buildingRow.height+this.border,this.setGalleryTempHeight(this.galleryHeightToSet+this.getSpinnerHeight()),(!t||this.buildingRow.height<=e.rowHeight&&n)&&(this.offY+=this.buildingRow.height+e.margins,this.rows+=1,this.clearBuildingRow(),this.settings.triggerEvent.call(this,"jg.rowflush"))}};var i=0;t.prototype.rememberGalleryHeight=function(){i=this.$gallery.height(),this.$gallery.height(i)},t.prototype.setGalleryTempHeight=function(t){i=Math.max(t,i),this.$gallery.height(i)},t.prototype.setGalleryFinalHeight=function(t){i=t,this.$gallery.height(t)},t.prototype.checkWidth=function(){this.checkWidthIntervalId=setInterval($.proxy((function(){if(this.$gallery.is(":visible")){var t=parseFloat(this.$gallery.width());Math.abs(t-this.galleryWidth)>this.settings.refreshSensitivity&&(this.galleryWidth=t,this.rewind(),this.rememberGalleryHeight(),this.startImgAnalyzer(!0))}}),this),this.settings.refreshTime)},t.prototype.isSpinnerActive=function(){return null!==this.spinner.intervalId},t.prototype.getSpinnerHeight=function(){return this.spinner.$el.innerHeight()},t.prototype.stopLoadingSpinnerAnimation=function(){clearInterval(this.spinner.intervalId),this.spinner.intervalId=null,this.setGalleryTempHeight(this.$gallery.height()-this.getSpinnerHeight()),this.spinner.$el.detach()},t.prototype.startLoadingSpinnerAnimation=function(){var t=this.spinner,i=t.$el.find("span");clearInterval(t.intervalId),this.$gallery.append(t.$el),this.setGalleryTempHeight(this.offY+this.buildingRow.height+this.getSpinnerHeight()),t.intervalId=setInterval((function(){t.phase<i.length?i.eq(t.phase).fadeTo(t.timeSlot,1):i.eq(t.phase-i.length).fadeTo(t.timeSlot,0),t.phase=(t.phase+1)%(2*i.length)}),t.timeSlot)},t.prototype.rewind=function(){this.lastFetchedEntry=null,this.lastAnalyzedIndex=-1,this.offY=this.border,this.rows=0,this.clearBuildingRow()},t.prototype.getSelectorWithoutSpinner=function(){return this.settings.selector+", div:not(.jg-spinner)"},t.prototype.getAllEntries=function(){var t=this.getSelectorWithoutSpinner();return this.$gallery.children(t).toArray()},t.prototype.updateEntries=function(t){var i;if(t&&null!=this.lastFetchedEntry){var e=this.getSelectorWithoutSpinner();i=$(this.lastFetchedEntry).nextAll(e).toArray()}else this.entries=[],i=this.getAllEntries();return i.length>0&&($.isFunction(this.settings.sort)?i=this.sortArray(i):this.settings.randomize&&(i=this.shuffleArray(i)),this.lastFetchedEntry=i[i.length-1],this.settings.filter?i=this.filterArray(i):this.resetFilters(i)),this.entries=this.entries.concat(i),!0},t.prototype.insertToGallery=function(t){var i=this;$.each(t,(function(){$(this).appendTo(i.$gallery)}))},t.prototype.shuffleArray=function(t){var i,e,s;for(i=t.length-1;i>0;i--)e=Math.floor(Math.random()*(i+1)),s=t[i],t[i]=t[e],t[e]=s;return this.insertToGallery(t),t},t.prototype.sortArray=function(t){return t.sort(this.settings.sort),this.insertToGallery(t),t},t.prototype.resetFilters=function(t){for(var i=0;i<t.length;i++)$(t[i]).removeClass("jg-filtered")},t.prototype.filterArray=function(t){var i=this.settings;if("string"===$.type(i.filter))return t.filter((function(t){var e=$(t);return e.is(i.filter)?(e.removeClass("jg-filtered"),!0):(e.addClass("jg-filtered").removeClass("jg-visible"),!1)}));if($.isFunction(i.filter)){for(var e=t.filter(i.filter),s=0;s<t.length;s++)-1===e.indexOf(t[s])?$(t[s]).addClass("jg-filtered").removeClass("jg-visible"):$(t[s]).removeClass("jg-filtered");return e}},t.prototype.resetImgSrc=function(t){"src"===t.data("jg.originalSrcLoc")?t.attr("src",t.data("jg.originalSrc")):t.attr("src","")},t.prototype.destroy=function(){clearInterval(this.checkWidthIntervalId),this.stopImgAnalyzerStarter(),$.each(this.getAllEntries(),$.proxy((function(t,i){var e=$(i);e.css("width",""),e.css("height",""),e.css("top",""),e.css("left",""),e.data("jg.loaded",void 0),e.removeClass("jg-entry jg-filtered jg-entry-visible");var s=this.imgFromEntry(e);s&&(s.css("width",""),s.css("height",""),s.css("margin-left",""),s.css("margin-top",""),this.resetImgSrc(s),s.data("jg.originalSrc",void 0),s.data("jg.originalSrcLoc",void 0),s.data("jg.src",void 0)),this.removeCaptionEventsHandlers(e);var n=this.captionFromEntry(e);e.data("jg.createdCaption")?(e.data("jg.createdCaption",void 0),null!==n&&n.remove()):null!==n&&n.fadeTo(0,1)}),this)),this.$gallery.css("height",""),this.$gallery.removeClass("justified-gallery"),this.$gallery.data("jg.controller",void 0),this.settings.triggerEvent.call(this,"jg.destroy")},t.prototype.analyzeImages=function(t){for(var i=this.lastAnalyzedIndex+1;i<this.entries.length;i++){var e=$(this.entries[i]);if(!0===e.data("jg.loaded")||"skipped"===e.data("jg.loaded")){var s=this.galleryWidth-2*this.border-(this.buildingRow.entriesBuff.length-1)*this.settings.margins,n=e.data("jg.width")/e.data("jg.height");if(this.buildingRow.entriesBuff.push(e),this.buildingRow.aspectRatio+=n,this.buildingRow.width+=n*this.settings.rowHeight,this.lastAnalyzedIndex=i,s/(this.buildingRow.aspectRatio+n)<this.settings.rowHeight&&(this.flushRow(!1,this.settings.maxRowsCount>0&&this.rows===this.settings.maxRowsCount),++this.yield.flushed>=this.yield.every))return void this.startImgAnalyzer(t)}else if("error"!==e.data("jg.loaded"))return}this.buildingRow.entriesBuff.length>0&&this.flushRow(!0,this.settings.maxRowsCount>0&&this.rows===this.settings.maxRowsCount),this.isSpinnerActive()&&this.stopLoadingSpinnerAnimation(),this.stopImgAnalyzerStarter(),this.setGalleryFinalHeight(this.galleryHeightToSet),this.settings.triggerEvent.call(this,t?"jg.resize":"jg.complete")},t.prototype.stopImgAnalyzerStarter=function(){this.yield.flushed=0,null!==this.imgAnalyzerTimeout&&(clearTimeout(this.imgAnalyzerTimeout),this.imgAnalyzerTimeout=null)},t.prototype.startImgAnalyzer=function(t){var i=this;this.stopImgAnalyzerStarter(),this.imgAnalyzerTimeout=setTimeout((function(){i.analyzeImages(t)}),.001)},t.prototype.onImageEvent=function(t,i,e){if(i||e){var s=new Image,n=$(s);i&&n.one("load",(function(){n.off("load error"),i(s)})),e&&n.one("error",(function(){n.off("load error"),e(s)})),s.src=t}},t.prototype.init=function(){var t=!1,i=!1,e=this;$.each(this.entries,(function(s,n){var r=$(n),o=e.imgFromEntry(r);if(r.addClass("jg-entry"),!0!==r.data("jg.loaded")&&"skipped"!==r.data("jg.loaded"))if(null!==e.settings.rel&&r.attr("rel",e.settings.rel),null!==e.settings.target&&r.attr("target",e.settings.target),null!==o){var a=e.extractImgSrcFromImage(o);if(!1===e.settings.waitThumbnailsLoad||!a){var h=parseFloat(o.attr("width")),g=parseFloat(o.attr("height"));if("svg"===o.prop("tagName")&&(h=parseFloat(o[0].getBBox().width),g=parseFloat(o[0].getBBox().height)),!isNaN(h)&&!isNaN(g))return r.data("jg.width",h),r.data("jg.height",g),r.data("jg.loaded","skipped"),i=!0,e.startImgAnalyzer(!1),!0}r.data("jg.loaded",!1),t=!0,e.isSpinnerActive()||e.startLoadingSpinnerAnimation(),e.onImageEvent(a,(function(t){r.data("jg.width",t.width),r.data("jg.height",t.height),r.data("jg.loaded",!0),e.startImgAnalyzer(!1)}),(function(){r.data("jg.loaded","error"),e.startImgAnalyzer(!1)}))}else r.data("jg.loaded",!0),r.data("jg.width",r.width()|parseFloat(r.css("width"))|1),r.data("jg.height",r.height()|parseFloat(r.css("height"))|1)})),t||i||this.startImgAnalyzer(!1),this.checkWidth()},t.prototype.checkOrConvertNumber=function(t,i){if("string"===$.type(t[i])&&(t[i]=parseFloat(t[i])),"number"!==$.type(t[i]))throw i+" must be a number";if(isNaN(t[i]))throw"invalid number for "+i},t.prototype.checkSizeRangesSuffixes=function(){if("object"!==$.type(this.settings.sizeRangeSuffixes))throw"sizeRangeSuffixes must be defined and must be an object";var t=[];for(var i in this.settings.sizeRangeSuffixes)this.settings.sizeRangeSuffixes.hasOwnProperty(i)&&t.push(i);for(var e={0:""},s=0;s<t.length;s++)if("string"===$.type(t[s]))try{var n;e[parseInt(t[s].replace(/^[a-z]+/,""),10)]=this.settings.sizeRangeSuffixes[t[s]]}catch(t){throw"sizeRangeSuffixes keys must contains correct numbers ("+t+")"}else e[t[s]]=this.settings.sizeRangeSuffixes[t[s]];this.settings.sizeRangeSuffixes=e},t.prototype.retrieveMaxRowHeight=function(){var t=null,i=this.settings.rowHeight;if("string"===$.type(this.settings.maxRowHeight))t=this.settings.maxRowHeight.match(/^[0-9]+%$/)?i*parseFloat(this.settings.maxRowHeight.match(/^([0-9]+)%$/)[1])/100:parseFloat(this.settings.maxRowHeight);else{if("number"!==$.type(this.settings.maxRowHeight)){if(!1===this.settings.maxRowHeight||null==this.settings.maxRowHeight)return null;throw"maxRowHeight must be a number or a percentage"}t=this.settings.maxRowHeight}if(isNaN(t))throw"invalid number for maxRowHeight";return t<i&&(t=i),t},t.prototype.checkSettings=function(){this.checkSizeRangesSuffixes(),this.checkOrConvertNumber(this.settings,"rowHeight"),this.checkOrConvertNumber(this.settings,"margins"),this.checkOrConvertNumber(this.settings,"border"),this.checkOrConvertNumber(this.settings,"maxRowsCount");var t=["justify","nojustify","left","center","right","hide"];if(-1===t.indexOf(this.settings.lastRow))throw"lastRow must be one of: "+t.join(", ");if(this.checkOrConvertNumber(this.settings,"justifyThreshold"),this.settings.justifyThreshold<0||this.settings.justifyThreshold>1)throw"justifyThreshold must be in the interval [0,1]";if("boolean"!==$.type(this.settings.cssAnimation))throw"cssAnimation must be a boolean";if("boolean"!==$.type(this.settings.captions))throw"captions must be a boolean";if(this.checkOrConvertNumber(this.settings.captionSettings,"animationDuration"),this.checkOrConvertNumber(this.settings.captionSettings,"visibleOpacity"),this.settings.captionSettings.visibleOpacity<0||this.settings.captionSettings.visibleOpacity>1)throw"captionSettings.visibleOpacity must be in the interval [0, 1]";if(this.checkOrConvertNumber(this.settings.captionSettings,"nonVisibleOpacity"),this.settings.captionSettings.nonVisibleOpacity<0||this.settings.captionSettings.nonVisibleOpacity>1)throw"captionSettings.nonVisibleOpacity must be in the interval [0, 1]";if(this.checkOrConvertNumber(this.settings,"imagesAnimationDuration"),this.checkOrConvertNumber(this.settings,"refreshTime"),this.checkOrConvertNumber(this.settings,"refreshSensitivity"),"boolean"!==$.type(this.settings.randomize))throw"randomize must be a boolean";if("string"!==$.type(this.settings.selector))throw"selector must be a string";if(!1!==this.settings.sort&&!$.isFunction(this.settings.sort))throw"sort must be false or a comparison function";if(!1!==this.settings.filter&&!$.isFunction(this.settings.filter)&&"string"!==$.type(this.settings.filter))throw"filter must be false, a string or a filter function"},t.prototype.retrieveSuffixRanges=function(){var t=[];for(var i in this.settings.sizeRangeSuffixes)this.settings.sizeRangeSuffixes.hasOwnProperty(i)&&t.push(parseInt(i,10));return t.sort((function(t,i){return t>i?1:t<i?-1:0})),t},t.prototype.updateSettings=function(t){this.settings=$.extend({},this.settings,t),this.checkSettings(),this.border=this.settings.border>=0?this.settings.border:this.settings.margins,this.maxRowHeight=this.retrieveMaxRowHeight(),this.suffixRanges=this.retrieveSuffixRanges()},t.prototype.defaults={sizeRangeSuffixes:{},thumbnailPath:void 0,rowHeight:120,maxRowHeight:!1,maxRowsCount:0,margins:1,border:-1,lastRow:"nojustify",justifyThreshold:.9,waitThumbnailsLoad:!0,captions:!0,cssAnimation:!0,imagesAnimationDuration:500,captionSettings:{animationDuration:500,visibleOpacity:.7,nonVisibleOpacity:0},rel:null,target:null,extension:/\.[^.\\/]+$/,refreshTime:200,refreshSensitivity:0,randomize:!1,rtl:!1,sort:!1,filter:!1,selector:"a",imgSelector:"> img, > a > img, > svg, > a > svg",triggerEvent:function(t){this.$gallery.trigger(t)}},$.fn.justifiedGallery=function(i){return this.each((function(e,s){var n=$(s);n.addClass("justified-gallery");var r=n.data("jg.controller");if(void 0===r){if(null!=i&&"object"!==$.type(i)){if("destroy"===i)return;throw"The argument must be an object"}r=new t(n,$.extend({},t.prototype.defaults,i)),n.data("jg.controller",r)}else if("norewind"===i);else{if("destroy"===i)return void r.destroy();r.updateSettings(i),r.rewind()}r.updateEntries("norewind"===i)&&r.init()}))}}));