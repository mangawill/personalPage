/*  
 * JCE Editor                 2.2.1.2
 * @package                 JCE
 * @url                     http://www.joomlacontenteditor.net
 * @copyright               Copyright (C) 2006 - 2012 Ryan Demmer. All rights reserved
 * @license                 GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
 * @date                    29 June 2012
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.

 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * NOTE : Javascript files have been compressed for speed and can be uncompressed using http://jsbeautifier.org/
 */
(function($){$.support.canvas=!!document.createElement('canvas').getContext;$.widget("ui.tips",{options:{speed:150,position:'top center',opacity:0.9,className:'tooltip',offsets:{'x':16,'y':18},width:200,fixed:true,sticky:false},_init:function(options){var self=this;$.extend(this.options,options);if(this.options.sticky){self._pin();}else{$(this.element).click(function(e){if(this.nodeName=='A'||$('a',this).length){return;}
if($('#jce-tooltip').hasClass('sticky')){return self._unpin();}else{return self._pin();}});}
$(this.element).hover(function(e){if($('#jce-tooltip').hasClass('sticky')){return;}
return self._start(e);},function(){if($('#jce-tooltip').hasClass('sticky')){return;}
return self._end();});},_createTips:function(){var self=this,$tips=$('#jce-tooltip');if(!$tips.get(0)){$tips=$('<div id="jce-tooltip" class="jce-tooltip ui-widget ui-widget-content ui-corner-all" role="tooltip" aria-hidden="true">'+'<span class="ui-icon ui-icon-close" title="Close"></span>'+'<div class="jce-tooltip-content"></div>'+'</div>').appendTo('body');if($.support.canvas){var canvas=document.createElement('canvas');$(canvas).attr({'width':14,'height':14}).addClass('jce-tooltip-pointer');$('#jce-tooltip').append(canvas);}else{$('#jce-tooltip').append('<div class="jce-tooltip-pointer ui-widget-content"><div class="jce-tooltip-pointer-inner"></div></div>');}
$('span.ui-icon-close',$tips).click(function(){self._end();}).hide();if($.support.cssFloat){$tips.css('opacity',0);}}},_start:function(e){var self=this;this._createTips();var $tips=$('#jce-tooltip');$tips.data('source',this.element);var text=$(this.element).attr('title')||'',title='';if(/::/.test(text)){var parts=text.split('::');title=$.trim(parts[0]);text=$.trim(parts[1]);}
$(this.element).data('title',$(this.element).attr('title')).attr('title','');$(this.element).attr('aria-describedby','jce-tooltip');var h='';if(title){h+='<h4>'+title+'</h4>';}
if(text){h+='<p>'+text+'</p>';}
$('div.jce-tooltip-content',$tips).html(h);if(this.options.fixed){this._position();}else{this._locate(e);}
$('div.jce-tooltip-pointer-down-inner',$tips).css({'border-top-color':$tips.css('background-color')});$tips.css('visibility','visible').attr('aria-hidden','false');if($.support.cssFloat){$tips.animate({'opacity':this.options.opacity},this.options.speed);}else{if(!window.XMLHttpRequest){$tips.css('width',200);}}},_end:function(){var $tips=$('#jce-tooltip'),element=$tips.data('source')||this.element;$(element).attr('title',$(element).data('title'));$(element).removeAttr('aria-describedby');$tips.css('visibility','hidden').attr('aria-hidden','true');if($.support.cssFloat){$tips.css('opacity',0);}
this._unpin();},_pin:function(){$('#jce-tooltip').addClass('sticky');$('span.ui-icon-close','#jce-tooltip').show();},_unpin:function(){$('#jce-tooltip').removeClass('sticky');$('span.ui-icon-close','#jce-tooltip').hide();},_position:function(){var $tips=$('#jce-tooltip');var p=$(this.element).offset();var o=this.options.offsets;var tip={'x':$tips.outerWidth(),'y':$tips.outerHeight()};var pos={x:p.left-tip.x/2+$(this.element).outerWidth()/2,y:p.top-(tip.y+o.y)};var position=this.options.position;var scrollTop=$(document).scrollTop();if(pos.y<0||pos.y<scrollTop){$tips.removeClass('jce-'+this.options.className+'-top');position=position.replace('top','bottom');$tips.addClass('jce-'+this.options.className+'-bottom');pos.y=p.top+o.y+10;}else{$tips.removeClass('jce-'+this.options.className+'-bottom');position=position.replace('bottom','top');$tips.addClass('jce-'+this.options.className+'-top');}
var tmp=pos.x;while(pos.x<5){pos.x+=5;}
if(tmp<0){$('.jce-tooltip-pointer',$tips).css('left',p.left-pos.x+$(this.element).outerWidth()/2);}else{$('.jce-tooltip-pointer',$tips).css('left','50%');}
if($.support.canvas){this._createPointer();}
$tips.css({top:pos.y,left:pos.x});},_createPointer:function(){var $tips=$('#jce-tooltip'),canvas=$('canvas',$tips).get(0),context=canvas.getContext('2d');var w=canvas.width,h=canvas.height;context.clearRect(0,0,canvas.width,canvas.height);context.fillStyle=$tips.css('background-color');context.strokeStyle=$tips.css('border-top-color');context.lineWidth=1.8;context.beginPath();if($tips.hasClass('jce-'+this.options.className+'-top')){context.moveTo(0,0);context.lineTo(w/2,h);context.lineTo(w,0);}else{context.moveTo(0,h);context.lineTo(w/2,0);context.lineTo(w,h);}
context.fill();context.stroke();context.closePath();},_locate:function(e){this._createTips();var $tips=$('#jce-tooltip');var o=this.options.offsets;var page={'x':e.pageX,'y':e.pageY};var tip={'x':$tips.outerWidth(),'y':$tips.outerHeight()};var offset=$(e.target).offset();var pos={'x':page.x+o.x,'y':page.y+o.y};var position=this.options.position;var scrollTop=$(document).scrollTop();if((pos.y-tip.y)<0||offset.top<(scrollTop+tip.y)){$tips.removeClass('jce-'+this.options.className+'-top');position=position.replace('top','bottom');$tips.addClass('jce-'+this.options.className+'-bottom');}else{$tips.removeClass('jce-'+this.options.className+'-bottom');position=position.replace('bottom','top');$tips.addClass('jce-'+this.options.className+'-top');}
switch(position){case'top center':pos.x=(page.x-Math.round((tip.x/2)))+o.x;pos.y=(page.y-tip.y)-o.y;break;case'bottom center':pos.x=(page.x-(tip.x/2))+o.x;pos.y=page.y+o.y;break;}
if(pos.x<0){pos.x=5;}
if(pos.x>parseFloat($(window).width())){pos.x=parseFloat($(window).width())-(tip.x/2+5);}
$tips.css({top:pos.y,left:pos.x});},destroy:function(){$.Widget.prototype.destroy.apply(this,arguments);}});$.extend($.ui.tips,{version:"2.2.1.2"});})(jQuery);