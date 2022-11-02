//eyesys dhtml  (c)eyecon 2002 [ eyecon@webteam.ro ]
//visit www.webteam.ro for great scripts and tutorials

var ie5=window.createPopup

if (ie5)
document.oncontextmenu=init;
var eyesys="";
var preitem="";
function init(){
mx=event.clientX;
my=event.clientY;
menx=window.screenLeft+mx;
meny=window.screenTop+my;
sysmen=window.createPopup();
sysmen.document.write(eyesys);
sysmen.show(menx,meny,eyesys_width,document.getElementById('men').offsetHeight);
return false
};
function eyesys_init(){
if (ie5){
eyesys+=("<style type='text/css'>.textul{position:absolute;top:0px;color:"+eyesys_titletext+";writing-mode:	tb-rl;padding-top:10px;filter: flipH() flipV() dropShadow( Color=000000,offX=-2,offY=-2,positive=true);z-Index:10;width:100%;height:100%;font: bold 12px sans-serif}.gradientul{position:relative;top:0px;left:0px;width:100%;background-color:"+eyesys_titlecol2+";height:100%;z-Index:9;FILTER: alpha( style=1,opacity=0,finishOpacity=100,startX=100,finishX=100,startY=0,finishY=100)}.contra{background-color:"+eyesys_titlecol1+";border:1px inset "+eyesys_bg+";height:98%;width:18px;z-Index:8;top:0px;left:0px;margin:2px;position:absolute;}.men{position:absolute;top:0px;left:0px;padding-left:18px;background-color:"+eyesys_bg+";border:2px outset "+eyesys_bg+";z-Index:1;}.men a{margin:1px;cursor:default;padding-bottom:4px;padding-left:1px;padding-right:1px;padding-top:3px;text-decoration:none;height:100%;width:100%;color:"+eyesys_cl+";font:normal 8pt tahoma;}.men a:hover{background:"+eyesys_bgov+";color:"+eyesys_clov+";} BODY{overflow:hidden;border:0px;padding:0px;margin:0px;}.ico{border:none;float:left;}</style><div class='men'>")
}
};

function eyesys_item(txt,ico,lnk){
if (ie5){
if(!ico)ico='s.gif';
preitem+=("<a href='#' onmousedown='parent.window.location.href=\""+lnk+"\"'><img src='"+ico+"' width='16' height='16' class='ico'> "+txt+"</a>")
}
};

function eyesys_close(){
if (ie5){
eyesys+=preitem;
eyesys+=("</div><div class='contra'><div class='gradientul'></div><div class='textul' id='titlu'>"+eyesys_title+"</div></div>");
document.write("<div id='men' style='width:"+eyesys_width+"'></div>");
document.getElementById('men').innerHTML=preitem
}
}