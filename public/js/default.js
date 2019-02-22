$(function(){

//doing some ajax when clicking on next or prev button
 $(document).on('click','.prevmonth, .nextmonth', function(){
  var datum = ($(this).attr('id'));
  //spliting the date (yyyy-mm) between (-)
  var myarr = datum.split("-");
  
  $.ajax({
    url: "index/almanacka",
    type: "GET",
    data: {
     //yyyy
	 'year':myarr[1],
     //mm
     'month':myarr[0],},
    dataType:'text',
    success: function(response){
    //var result = $('<div />').append(response).find('#byt').html();
     $('#almanacka').html(response);}
	});	
 });

 $(document).on('click','.sunny, .rainy', function(){
  var datum = ($(this).attr('id'));
  var weather = $(this).attr('class');
  
  $.ajax({
   url: "index/makeSun",
   type: "GET",
   data: {
    //yyyy
	'datum':datum,
	'weather':weather
   },
   dataType:'text',
   success: function(response)
   {
    $('#almanacka').html(response);
    $(".sign").css('display','flex');
    $(".input-field").trigger( "focus" );
    $(".input-field").keydown(function(){
     $(".icon-confirm").css('display','block');
     $(".icon-confirm").attr('id',datum);
     $(".icon").css('display','none');
    });
   }
  });
 });
 
 $(document).on('click', '.icon-confirm', function(){
  var datum = ($(this).attr('id'));
  var sign = $(".input-field").val();
 
  //alert(datum+' '+sign);
  $(".icon").css('display','block');
  $(".icon-confirm").css('display','none');
  $(".sign").css('display','none');
  
  $.ajax({
   url: "index/signBook",
   type: "GET",
   data: {
    //yyyy
	'datum':datum,
	'sign':sign
   },
   dataType:'text',
   success: function(response)
   {
    $('#almanacka').html(response);
   }
  });
 });
 
 $(document).on('keypress','.input-field', function(e){
  if(e.which == 13){//Enter key pressed
   $('.icon-confirm').click();//Trigger search button click event
  }
 });

 $(document).on('click', '#calview, #guestbook', function(){
  $view = $(this).attr('id');
  //alert($view);
  var datavalue;
  var path;
  var d = new Date();
  var yearValue = d.getFullYear();
  var monthValue = d.getMonth()+1;
  
  if ($view == 'guestbook'){
   path = "index/guestBook";
   datavalue = {};
  }
  else
  {
   path = "index/almanacka";	
   datavalue = {year:yearValue, month:monthValue};
  }
  $.ajax({
   url: path,
   type: "GET",
   data: datavalue,
   dataType:'text',
   success: function(response)
   {
    $('#almanacka').html(response);
    if ($view == 'guestbook'){
     var objDiv = $(".signview");
     var h = objDiv.get(0).scrollHeight;
     objDiv.animate({scrollTop: h});
    }
   }
  });
 });

});


/*! modernizr 3.6.0 (Custom Build) | MIT *
 * https://modernizr.com/download/?-webp-setclasses !*/
!function(e,n,A){function o(e,n){return typeof e===n}function t(){var e,n,A,t,a,i,l;for(var f in r)if(r.hasOwnProperty(f)){if(e=[],n=r[f],n.name&&(e.push(n.name.toLowerCase()),n.options&&n.options.aliases&&n.options.aliases.length))for(A=0;A<n.options.aliases.length;A++)e.push(n.options.aliases[A].toLowerCase());for(t=o(n.fn,"function")?n.fn():n.fn,a=0;a<e.length;a++)i=e[a],l=i.split("."),1===l.length?Modernizr[l[0]]=t:(!Modernizr[l[0]]||Modernizr[l[0]]instanceof Boolean||(Modernizr[l[0]]=new Boolean(Modernizr[l[0]])),Modernizr[l[0]][l[1]]=t),s.push((t?"":"no-")+l.join("-"))}}function a(e){var n=u.className,A=Modernizr._config.classPrefix||"";if(c&&(n=n.baseVal),Modernizr._config.enableJSClass){var o=new RegExp("(^|\\s)"+A+"no-js(\\s|$)");n=n.replace(o,"$1"+A+"js$2")}Modernizr._config.enableClasses&&(n+=" "+A+e.join(" "+A),c?u.className.baseVal=n:u.className=n)}function i(e,n){if("object"==typeof e)for(var A in e)f(e,A)&&i(A,e[A]);else{e=e.toLowerCase();var o=e.split("."),t=Modernizr[o[0]];if(2==o.length&&(t=t[o[1]]),"undefined"!=typeof t)return Modernizr;n="function"==typeof n?n():n,1==o.length?Modernizr[o[0]]=n:(!Modernizr[o[0]]||Modernizr[o[0]]instanceof Boolean||(Modernizr[o[0]]=new Boolean(Modernizr[o[0]])),Modernizr[o[0]][o[1]]=n),a([(n&&0!=n?"":"no-")+o.join("-")]),Modernizr._trigger(e,n)}return Modernizr}var s=[],r=[],l={_version:"3.6.0",_config:{classPrefix:"",enableClasses:!0,enableJSClass:!0,usePrefixes:!0},_q:[],on:function(e,n){var A=this;setTimeout(function(){n(A[e])},0)},addTest:function(e,n,A){r.push({name:e,fn:n,options:A})},addAsyncTest:function(e){r.push({name:null,fn:e})}},Modernizr=function(){};Modernizr.prototype=l,Modernizr=new Modernizr;var f,u=n.documentElement,c="svg"===u.nodeName.toLowerCase();!function(){var e={}.hasOwnProperty;f=o(e,"undefined")||o(e.call,"undefined")?function(e,n){return n in e&&o(e.constructor.prototype[n],"undefined")}:function(n,A){return e.call(n,A)}}(),l._l={},l.on=function(e,n){this._l[e]||(this._l[e]=[]),this._l[e].push(n),Modernizr.hasOwnProperty(e)&&setTimeout(function(){Modernizr._trigger(e,Modernizr[e])},0)},l._trigger=function(e,n){if(this._l[e]){var A=this._l[e];setTimeout(function(){var e,o;for(e=0;e<A.length;e++)(o=A[e])(n)},0),delete this._l[e]}},Modernizr._q.push(function(){l.addTest=i}),Modernizr.addAsyncTest(function(){function e(e,n,A){function o(n){var o=n&&"load"===n.type?1==t.width:!1,a="webp"===e;i(e,a&&o?new Boolean(o):o),A&&A(n)}var t=new Image;t.onerror=o,t.onload=o,t.src=n}var n=[{uri:"data:image/webp;base64,UklGRiQAAABXRUJQVlA4IBgAAAAwAQCdASoBAAEAAwA0JaQAA3AA/vuUAAA=",name:"webp"},{uri:"data:image/webp;base64,UklGRkoAAABXRUJQVlA4WAoAAAAQAAAAAAAAAAAAQUxQSAwAAAABBxAR/Q9ERP8DAABWUDggGAAAADABAJ0BKgEAAQADADQlpAADcAD++/1QAA==",name:"webp.alpha"},{uri:"data:image/webp;base64,UklGRlIAAABXRUJQVlA4WAoAAAASAAAAAAAAAAAAQU5JTQYAAAD/////AABBTk1GJgAAAAAAAAAAAAAAAAAAAGQAAABWUDhMDQAAAC8AAAAQBxAREYiI/gcA",name:"webp.animation"},{uri:"data:image/webp;base64,UklGRh4AAABXRUJQVlA4TBEAAAAvAAAAAAfQ//73v/+BiOh/AAA=",name:"webp.lossless"}],A=n.shift();e(A.name,A.uri,function(A){if(A&&"load"===A.type)for(var o=0;o<n.length;o++)e(n[o].name,n[o].uri)})}),t(),a(s),delete l.addTest,delete l.addAsyncTest;for(var p=0;p<Modernizr._q.length;p++)Modernizr._q[p]();e.Modernizr=Modernizr}(window,document);

