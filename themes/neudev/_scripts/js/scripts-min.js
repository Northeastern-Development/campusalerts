!function(t,$,e){"use strict";$(function(){var t=1e3,e=1500,n=500;$(window).scroll(function(){$(this).scrollTop()<1e3?$(".topbutton").fadeOut(500):$(".topbutton").fadeIn(500)}),$(".topbutton").on("touchend click",function(){return $("html, body").animate({scrollTop:0},1500),!1});var i=$(window).width();$("p.testp").text("Initial screen width is currently: "+i+"px."),$(window).resize(function(){var t=$(window).width();$("p.testp").text("Initial screen width is currently: "+t+"px."),t<=576?$("p.testp").text("Screen width is less than or equal to 576px. Width is currently: "+t+"px."):t<=680?$("p.testp").text("Screen width is between 577px and 680px. Width is currently: "+t+"px."):t<=1024?$("p.testp").text("Screen width is between 681px and 1024px. Width is currently: "+t+"px."):t<=1500?$("p.testp").text("Screen width is between 1025px and 1499px. Width is currently: "+t+"px."):$("p.testp").text("Screen width is greater than 1500px. Width is currently: "+t+"px.")})})}(this,jQuery);