// Metro Banner V 2
(function ($) 
{

  var mbCounter   = 0;
  var mbIsOpen    = false;
  var isAnimating = false;
  var TextInterval;
  var ColorInterval;
  var TiemOutInterval;
  var buthovercolor = "#431764";
  var butleavecolor = "#572080";

  //green sock
  (window._gsQueue||(window._gsQueue=[])).push(function(){_gsDefine("plugins.CSSPlugin",["plugins.TweenPlugin","TweenLite"],function(a){"use strict";var d,e,f,g,c=function(){a.call(this,"css"),this._overwriteProps.length=0},h={},i=c.prototype=new a("css");i.constructor=c,c.version="1.8.0",c.API=2,c.defaultTransformPerspective=0,i="px",c.suffixMap={top:i,right:i,bottom:i,left:i,width:i,height:i,fontSize:i,padding:i,margin:i,perspective:i};var G,H,I,J,K,L,j=/(?:\d|\-\d|\.\d|\-\.\d)+/g,k=/(?:\d|\-\d|\.\d|\-\.\d|\+=\d|\-=\d|\+=.\d|\-=\.\d)+/g,l=/(?:\+=|\-=|\-|\b)[\d\-\.]+[a-zA-Z0-9]*(?:%|\b)/gi,m=/[^\d\-\.]/g,n=/(?:\d|\-|\+|=|#|\.)*/g,o=/opacity *= *([^)]*)/,p=/opacity:([^;]*)/,q=/alpha\(opacity *=.+?\)/i,r=/([A-Z])/g,s=/-([a-z])/gi,t=/(^(?:url\(\"|url\())|(?:(\"\))$|\)$)/gi,u=function(a,b){return b.toUpperCase()},v=/(?:Left|Right|Width)/i,w=/(M11|M12|M21|M22)=[\d\-\.e]+/gi,x=/progid\:DXImageTransform\.Microsoft\.Matrix\(.+?\)/i,y=Math.PI/180,z=180/Math.PI,A={},B=document,C=B.createElement("div"),D=B.createElement("img"),E=c._internals={_specialProps:h},F=navigator.userAgent,M=function(){var c,a=F.indexOf("Android"),b=B.createElement("div");return I=-1!==F.indexOf("Safari")&&-1===F.indexOf("Chrome")&&(-1===a||Number(F.substr(a+8,1))>3),K=I&&6>Number(F.substr(F.indexOf("Version/")+8,1)),J=-1!==F.indexOf("Firefox"),/MSIE ([0-9]{1,}[\.0-9]{0,})/.exec(F),L=parseFloat(RegExp.$1),b.innerHTML="<a style='top:1px;opacity:.55;'>a</a>",c=b.getElementsByTagName("a")[0],c?/^0.55/.test(c.style.opacity):!1}(),N=function(a){return o.test("string"==typeof a?a:(a.currentStyle?a.currentStyle.filter:a.style.filter)||"")?parseFloat(RegExp.$1)/100:1},O=function(a){window.console&&console.log(a)},P="",Q="",R=function(a,b){b=b||C;var d,e,c=b.style;if(void 0!==c[a])return a;for(a=a.charAt(0).toUpperCase()+a.substr(1),d=["O","Moz","ms","Ms","Webkit"],e=5;--e>-1&&void 0===c[d[e]+a];);return e>=0?(Q=3===e?"ms":d[e],P="-"+Q.toLowerCase()+"-",Q+a):null},S=B.defaultView?B.defaultView.getComputedStyle:function(){},T=c.getStyle=function(a,b,c,d,e){var f;return M||"opacity"!==b?(!d&&a.style[b]?f=a.style[b]:(c=c||S(a,null))?(a=c.getPropertyValue(b.replace(r,"-$1").toLowerCase()),f=a||c.length?a:c[b]):a.currentStyle&&(c=a.currentStyle,f=c[b]),null==e||f&&"none"!==f&&"auto"!==f&&"auto auto"!==f?f:e):N(a)},U=function(a,b,c){var f,g,d={},e=a._gsOverwrittenClassNamePT;if(e&&!c){for(;e;)e.setRatio(0),e=e._next;a._gsOverwrittenClassNamePT=null}if(b=b||S(a,null))if(f=b.length)for(;--f>-1;)d[b[f].replace(s,u)]=b.getPropertyValue(b[f]);else for(f in b)d[f]=b[f];else if(b=a.currentStyle||a.style)for(f in b)d[f.replace(s,u)]=b[f];return M||(d.opacity=N(a)),g=wb(a,b,!1),d.rotation=g.rotation*z,d.skewX=g.skewX*z,d.scaleX=g.scaleX,d.scaleY=g.scaleY,d.x=g.x,d.y=g.y,vb&&(d.z=g.z,d.rotationX=g.rotationX*z,d.rotationY=g.rotationY*z,d.scaleZ=g.scaleZ),d.filters&&delete d.filters,d},V=function(a,b,c,d){var g,h,i,e={},f=a.style;for(h in c)"cssText"!==h&&"length"!==h&&isNaN(h)&&b[h]!==(g=c[h])&&-1===h.indexOf("Origin")&&("number"==typeof g||"string"==typeof g)&&(e[h]=""!==g&&"auto"!==g&&"none"!==g||"string"!=typeof b[h]||""===b[h].replace(m,"")?g:0,void 0!==f[h]&&(i=new jb(f,h,f[h],i)));if(d)for(h in d)"className"!==h&&(e[h]=d[h]);return{difs:e,firstMPT:i}},W={width:["Left","Right"],height:["Top","Bottom"]},X=["marginLeft","marginRight","marginTop","marginBottom"],Y=function(a,b,c){var d=parseFloat("width"===b?a.offsetWidth:a.offsetHeight),e=W[b],f=e.length;for(c=c||S(a,null);--f>-1;)d-=parseFloat(T(a,"padding"+e[f],c,!0))||0,d-=parseFloat(T(a,"border"+e[f]+"Width",c,!0))||0;return d},Z=function(a,b,c,d,e){if("px"===d||!d)return c;if("auto"===d||!c)return 0;var j,f=v.test(b),g=a,h=C.style,i=0>c;return i&&(c=-c),"%"===d&&-1!==b.indexOf("border")?j=c/100*(f?a.clientWidth:a.clientHeight):(h.cssText="border-style:solid; border-width:0; position:absolute; line-height:0;","%"!==d&&"em"!==d&&g.appendChild?h[f?"borderLeftWidth":"borderTopWidth"]=c+d:(g=a.parentNode||B.body,h[f?"width":"height"]=c+d),g.appendChild(C),j=parseFloat(C[f?"offsetWidth":"offsetHeight"]),g.removeChild(C),0!==j||e||(j=Z(a,b,c,d,!0))),i?-j:j},$=function(a,b){(null==a||""===a||"auto"===a||"auto auto"===a)&&(a="0 0");var c=a.split(" "),d=-1!==a.indexOf("left")?"0%":-1!==a.indexOf("right")?"100%":c[0],e=-1!==a.indexOf("top")?"0%":-1!==a.indexOf("bottom")?"100%":c[1];return null==e?e="0":"center"===e&&(e="50%"),("center"===d||isNaN(parseFloat(d)))&&(d="50%"),b&&(b.oxp=-1!==d.indexOf("%"),b.oyp=-1!==e.indexOf("%"),b.oxr="="===d.charAt(1),b.oyr="="===e.charAt(1),b.ox=parseFloat(d.replace(m,"")),b.oy=parseFloat(e.replace(m,""))),d+" "+e+(c.length>2?" "+c[2]:"")},_=function(a,b){return"string"==typeof a&&"="===a.charAt(1)?parseInt(a.charAt(0)+"1",10)*parseFloat(a.substr(2)):parseFloat(a)-parseFloat(b)},ab=function(a,b){return null==a?b:"string"==typeof a&&"="===a.charAt(1)?parseInt(a.charAt(0)+"1",10)*Number(a.substr(2))+b:parseFloat(a)},bb=function(a,b){if(null==a)return b;var c=-1===a.indexOf("rad")?y:1,d="="===a.charAt(1);return a=Number(a.replace(m,""))*c,d?a+b:a},cb=function(a,b){var c="number"==typeof a?a*y:bb(a,b),d=(c-b)%(2*Math.PI);return d!==d%Math.PI&&(d+=Math.PI*(0>d?2:-2)),b+d},db={aqua:[0,255,255],lime:[0,255,0],silver:[192,192,192],black:[0,0,0],maroon:[128,0,0],teal:[0,128,128],blue:[0,0,255],navy:[0,0,128],white:[255,255,255],fuchsia:[255,0,255],olive:[128,128,0],yellow:[255,255,0],orange:[255,165,0],gray:[128,128,128],purple:[128,0,128],green:[0,128,0],red:[255,0,0],pink:[255,192,203],cyan:[0,255,255],transparent:[255,255,255,0]},eb=function(a){if(!a||""===a)return db.black;if(db[a])return db[a];if("number"==typeof a)return[a>>16,255&a>>8,255&a];if("#"===a.charAt(0)){if(4===a.length){var b=a.charAt(1),c=a.charAt(2),d=a.charAt(3);a="#"+b+b+c+c+d+d}return a=parseInt(a.substr(1),16),[a>>16,255&a>>8,255&a]}return a=a.match(j)||db.transparent,a[0]=Number(a[0]),a[1]=Number(a[1]),a[2]=Number(a[2]),a.length>3&&(a[3]=Number(a[3])),a},fb="(?:\\b(?:(?:rgb|rgba)\\(.+?\\))|\\B#.+?\\b";for(i in db)fb+="|"+i+"\\b";fb=RegExp(fb+")","gi");var gb=function(a,b,c){if(null==a)return function(a){return a};var d=b?(a.match(fb)||[""])[0]:"",e=a.split(d).join("").match(l)||[],f=a.substr(0,a.indexOf(e[0])),g=")"===a.charAt(a.length-1)?")":"",h=-1!==a.indexOf(" ")?" ":",",i=e.length,k=i>0?e[0].replace(j,""):"";return b?function(a){"number"==typeof a&&(a+=k);var b=(a.match(fb)||[d])[0],j=a.split(b).join("").match(l)||[],m=j.length;if(i>m--)for(;i>++m;)j[m]=c?j[(m-1)/2>>0]:e[m];return f+j.join(h)+h+b+g}:function(a){"number"==typeof a&&(a+=k);var b=a.match(l)||[],d=b.length;if(i>d--)for(;i>++d;)b[d]=c?b[(d-1)/2>>0]:e[d];return f+b.join(h)+g}},hb=function(a){return a=a.split(","),function(b,c,d,e,f,g,h){var j,i=(c+"").split(" ");for(h={},j=0;4>j;j++)h[a[j]]=i[j]=i[j]||i[(j-1)/2>>0];return e.parse(b,h,f,g)}},jb=(E._setPluginRatio=function(a){this.plugin.setRatio(a);for(var f,g,h,i,b=this.data,c=b.proxy,d=b.firstMPT,e=1e-6;d;)f=c[d.v],d.r?f=f>0?f+.5>>0:f-.5>>0:e>f&&f>-e&&(f=0),d.t[d.p]=f,d=d._next;if(b.autoRotate&&(b.autoRotate.rotation=c.rotation),1===a)for(d=b.firstMPT;d;){if(g=d.t,g.type){if(1===g.type){for(i=g.xs0+g.s+g.xs1,h=1;g.l>h;h++)i+=g["xn"+h]+g["xs"+(h+1)];g.e=i}}else g.e=g.s+g.xs0;d=d._next}},function(a,b,c,d,e){this.t=a,this.p=b,this.v=c,this.r=e,d&&(d._prev=this,this._next=d)}),lb=(E._parseToProxy=function(a,b,c,d,e,f){var l,m,n,o,p,g=d,h={},i={},j=c._transform,k=A;for(c._transform=null,A=b,d=p=c.parse(a,b,d,e),A=k,f&&(c._transform=j,g&&(g._prev=null,g._prev&&(g._prev._next=null)));d&&d!==g;){if(1>=d.type&&(m=d.p,i[m]=d.s+d.c,h[m]=d.s,f||(o=new jb(d,"s",m,o,d.r),d.c=0),1===d.type))for(l=d.l;--l>0;)n="xn"+l,m=d.p+"_"+n,i[m]=d.data[n],h[m]=d[n],f||(o=new jb(d,n,m,o,d.rxp[n]));d=d._next}return{proxy:h,end:i,firstMPT:o,pt:p}},E.CSSPropTween=function(a,b,c,e,f,h,i,j,k,l,m){this.t=a,this.p=b,this.s=c,this.c=e,this.n=i||"css_"+b,a instanceof lb||g.push(this.n),this.r=j,this.type=h||0,k&&(this.pr=k,d=!0),this.b=void 0===l?c:l,this.e=void 0===m?c+e:m,f&&(this._next=f,f._prev=this)}),mb=c.parseComplex=function(a,b,c,d,e,f,g,h,i,l){g=new lb(a,b,0,0,g,l?2:1,null,!1,h,c,d);var q,r,s,t,u,v,w,x,y,z,A,B,m=c.split(", ").join(",").split(" "),n=(d+"").split(", ").join(",").split(" "),o=m.length,p=G!==!1;for(o!==n.length&&(m=(f||"").split(" "),o=m.length),g.plugin=i,g.setRatio=l,q=0;o>q;q++)if(t=m[q],u=n[q],x=parseFloat(t),x||0===x)g.appendXtra("",x,_(u,x),u.replace(k,""),p&&-1!==u.indexOf("px"),!0);else if(e&&("#"===t.charAt(0)||0===t.indexOf("rgb")||db[t]))t=eb(t),u=eb(u),y=t.length+u.length>6,y&&!M&&0===u[3]?(g["xs"+g.l]+=g.l?" transparent":"transparent",g.e=g.e.split(n[q]).join("transparent")):(M||(y=!1),g.appendXtra(y?"rgba(":"rgb(",t[0],u[0]-t[0],",",!0,!0).appendXtra("",t[1],u[1]-t[1],",",!0).appendXtra("",t[2],u[2]-t[2],y?",":")",!0),y&&(t=4>t.length?1:t[3],g.appendXtra("",t,(4>u.length?1:u[3])-t,")",!1)));else if(v=t.match(j)){if(w=u.match(k),!w||w.length!==v.length)return g;for(s=0,r=0;v.length>r;r++)A=v[r],z=t.indexOf(A,s),g.appendXtra(t.substr(s,z-s),Number(A),_(w[r],A),"",p&&"px"===t.substr(z+A.length,2),0===r),s=z+A.length;g["xs"+g.l]+=t.substr(s)}else g["xs"+g.l]+=g.l?" "+t:t;if(-1!==d.indexOf("=")&&g.data){for(B=g.xs0+g.data.s,q=1;g.l>q;q++)B+=g["xs"+q]+g.data["xn"+q];g.e=B+g["xs"+q]}return g.l||(g.type=-1,g.xs0=g.e),g.xfirst||g},nb=9;for(i=lb.prototype,i.l=i.pr=0;--nb>0;)i["xn"+nb]=0,i["xs"+nb]="";i.xs0="",i._next=i._prev=i.xfirst=i.data=i.plugin=i.setRatio=i.rxp=null,i.appendXtra=function(a,b,c,d,e,f){var g=this,h=g.l;return g["xs"+h]+=f&&h?" "+a:a||"",c||0===h||g.plugin?(g.l++,g.type=g.setRatio?2:1,g["xs"+g.l]=d||"",h>0?(g.data["xn"+h]=b+c,g.rxp["xn"+h]=e,g["xn"+h]=b,g.plugin||(g.xfirst=new lb(g,"xn"+h,b,c,g.xfirst||g,0,g.n,e,g.pr),g.xfirst.xs0=0),g):(g.data={s:b+c},g.rxp={},g.s=b,g.c=c,g.r=e,g)):(g["xs"+h]+=b+(d||""),g)};var ob=function(a,b,c,d,e,f,g){this.p=d?R(a)||a:a,h[a]=h[this.p]=this,this.format=f||gb(b,e),c&&(this.parse=c),this.clrs=e,this.dflt=b,this.pr=g||0},pb=E._registerComplexSpecialProp=function(a,b,c,d,e,f,g){for(var k,h=a.split(","),i=b instanceof Array?b:[b],j=h.length;--j>-1;)k=new ob(h[j],i[j],c,d&&0===j,e,f,g)},qb=function(a){if(!h[a]){var b=a.charAt(0).toUpperCase()+a.substr(1)+"Plugin";pb(a,null,function(a,c,d,e,f,g,i){var j=(window.GreenSockGlobals||window).com.greensock.plugins[b];return j?(j._cssRegister(),h[d].parse(a,c,d,e,f,g,i)):(O("Error: "+b+" js file not loaded."),f)})}};i=ob.prototype,i.parseComplex=function(a,b,c,d,e,f){return mb(a,this.p,b,c,this.clrs,this.dflt,d,this.pr,e,f)},i.parse=function(a,b,c,d,e,g){return this.parseComplex(a.style,this.format(T(a,c,f,!1,this.dflt)),this.format(b),e,g)},c.registerSpecialProp=function(a,b,c){pb(a,null,function(a,d,e,f,g,h){var j=new lb(a,e,0,0,g,2,e,!1,c);return j.plugin=h,j.setRatio=b(a,d,f._tween,e),j},!1,!1,null,c)};var rb=["scaleX","scaleY","scaleZ","x","y","z","skewX","rotation","rotationX","rotationY","perspective"],sb=R("transform"),tb=P+"transform",ub=R("transformOrigin"),vb=null!==R("perspective"),wb=function(a,b,d){var l,m,n,o,p,q,r,s,t,u,v,x,e=d?a._gsTransform||{skewY:0}:{skewY:0},f=0>e.scaleX,g=2e-5,h=1e5,i=-Math.PI+1e-4,j=Math.PI-1e-4,k=vb?parseFloat(T(a,ub,b,!1,"0 0 0").split(" ")[2])||e.zOrigin||0:0;for(sb?l=T(a,tb,b,!0):a.currentStyle&&(l=a.currentStyle.filter.match(w),l=l&&4===l.length?l[0].substr(4)+","+Number(l[2].substr(4))+","+Number(l[1].substr(4))+","+l[3].substr(4)+","+(e?e.x:0)+","+(e?e.y:0):null),m=(l||"").match(/(?:\-|\b)[\d\-\.e]+\b/gi)||[],n=m.length;--n>-1;)o=Number(m[n]),m[n]=(o*h+(0>o?-.5:.5)>>0)/h;if(16===m.length){var y=m[8],z=m[9],A=m[10],B=m[12],C=m[13],D=m[14];if(e.zOrigin&&(D=-e.zOrigin,B=y*D-m[12],C=z*D-m[13],D=A*D+e.zOrigin-m[14]),!d||B!==e.x||C!==e.y||D!==e.z){var P,Q,R,S,U,V,W,X,E=m[0],F=m[1],G=m[2],H=m[3],I=m[4],J=m[5],K=m[6],L=m[7],M=m[11],N=e.rotationX=Math.atan2(K,A),O=i>N||N>j;N&&(U=Math.cos(-N),V=Math.sin(-N),P=I*U+y*V,Q=J*U+z*V,R=K*U+A*V,S=L*U+M*V,y=I*-V+y*U,z=J*-V+z*U,A=K*-V+A*U,M=L*-V+M*U,I=P,J=Q,K=R),N=e.rotationY=Math.atan2(y,E),N&&(W=i>N||N>j,U=Math.cos(-N),V=Math.sin(-N),P=E*U-y*V,Q=F*U-z*V,R=G*U-A*V,S=H*U-M*V,z=F*V+z*U,A=G*V+A*U,M=H*V+M*U,E=P,F=Q,G=R),N=e.rotation=Math.atan2(F,J),N&&(X=i>N||N>j,U=Math.cos(-N),V=Math.sin(-N),E=E*U+I*V,Q=F*U+J*V,J=F*-V+J*U,K=G*-V+K*U,F=Q),X&&O?e.rotation=e.rotationX=0:X&&W?e.rotation=e.rotationY=0:W&&O&&(e.rotationY=e.rotationX=0),e.scaleX=(Math.sqrt(E*E+F*F)*h+.5>>0)/h,e.scaleY=(Math.sqrt(J*J+z*z)*h+.5>>0)/h,e.scaleZ=(Math.sqrt(K*K+A*A)*h+.5>>0)/h,e.skewX=0,e.perspective=M?1/M:0,e.x=B,e.y=C,e.z=D}}else if(!vb||0===m.length||e.x!==m[4]||e.y!==m[5]||!e.rotationX&&!e.rotationY){var Y=m.length>=6,Z=Y?m[0]:1,$=m[1]||0,_=m[2]||0,ab=Y?m[3]:1;e.x=m[4]||0,e.y=m[5]||0,p=Math.sqrt(Z*Z+$*$),q=Math.sqrt(ab*ab+_*_),r=Z||$?Math.atan2($,Z):e.rotation||0,s=_||ab?Math.atan2(_,ab)+r:e.skewX||0,t=p-Math.abs(e.scaleX||0),u=q-Math.abs(e.scaleY||0),Math.abs(s)>Math.PI/2&&Math.abs(s)<1.5*Math.PI&&(f?(p*=-1,s+=0>=r?Math.PI:-Math.PI,r+=0>=r?Math.PI:-Math.PI):(q*=-1,s+=0>=s?Math.PI:-Math.PI)),v=(r-e.rotation)%Math.PI,x=(s-e.skewX)%Math.PI,(void 0===e.skewX||t>g||-g>t||u>g||-g>u||v>i&&j>v&&0!==v*h>>0||x>i&&j>x&&0!==x*h>>0)&&(e.scaleX=p,e.scaleY=q,e.rotation=r,e.skewX=s),vb&&(e.rotationX=e.rotationY=e.z=0,e.perspective=parseFloat(c.defaultTransformPerspective)||0,e.scaleZ=1)}e.zOrigin=k;for(n in e)g>e[n]&&e[n]>-g&&(e[n]=0);return d&&(a._gsTransform=e),e},xb=function(a){var l,m,b=this.data,c=-b.rotation,d=c+b.skewX,e=1e5,f=(Math.cos(c)*b.scaleX*e>>0)/e,g=(Math.sin(c)*b.scaleX*e>>0)/e,h=(Math.sin(d)*-b.scaleY*e>>0)/e,i=(Math.cos(d)*b.scaleY*e>>0)/e,j=this.t.style,k=this.t.currentStyle;if(k){m=g,g=-h,h=-m,l=k.filter,j.filter="";var v,w,p=this.t.offsetWidth,q=this.t.offsetHeight,r="absolute"!==k.position,s="progid:DXImageTransform.Microsoft.Matrix(M11="+f+", M12="+g+", M21="+h+", M22="+i,t=b.x,u=b.y;if(null!=b.ox&&(v=(b.oxp?.01*p*b.ox:b.ox)-p/2,w=(b.oyp?.01*q*b.oy:b.oy)-q/2,t+=v-(v*f+w*g),u+=w-(v*h+w*i)),r)v=p/2,w=q/2,s+=", Dx="+(v-(v*f+w*g)+t)+", Dy="+(w-(v*h+w*i)+u)+")";else{var z,A,B,y=8>L?1:-1;for(v=b.ieOffsetX||0,w=b.ieOffsetY||0,b.ieOffsetX=Math.round((p-((0>f?-f:f)*p+(0>g?-g:g)*q))/2+t),b.ieOffsetY=Math.round((q-((0>i?-i:i)*q+(0>h?-h:h)*p))/2+u),nb=0;4>nb;nb++)A=X[nb],z=k[A],m=-1!==z.indexOf("px")?parseFloat(z):Z(this.t,A,parseFloat(z),z.replace(n,""))||0,B=m!==b[A]?2>nb?-b.ieOffsetX:-b.ieOffsetY:2>nb?v-b.ieOffsetX:w-b.ieOffsetY,j[A]=(b[A]=Math.round(m-B*(0===nb||2===nb?1:y)))+"px";s+=", sizingMethod='auto expand')"}j.filter=-1!==l.indexOf("DXImageTransform.Microsoft.Matrix(")?l.replace(x,s):s+" "+l,(0===a||1===a)&&1===f&&0===g&&0===h&&1===i&&(r&&-1===s.indexOf("Dx=0, Dy=0")||o.test(l)&&100!==parseFloat(RegExp.$1)||-1===l.indexOf("gradient(")&&j.removeAttribute("filter"))}},yb=function(){var x,y,z,A,B,C,D,E,F,b=this.data,c=this.t.style,d=b.perspective,e=b.scaleX,f=0,g=0,h=0,i=0,j=b.scaleY,k=0,l=0,m=0,n=0,o=b.scaleZ,p=0,q=0,r=0,s=d?-1/d:0,t=b.rotation,u=b.zOrigin,v=",",w=1e5;J&&(D=T(this.t,"top",null,!1,"0"),E=parseFloat(D)||0,F=D.substr((E+"").length),b._ffFix=!b._ffFix,c.top=(b._ffFix?E+.05:E-.05)+(""===F?"px":F)),t&&(x=Math.cos(t),y=Math.sin(t),z=e*x,A=j*y,f=e*-y,j*=x,e=z,i=A),t=b.rotationY,t&&(x=Math.cos(t),y=Math.sin(t),z=e*x,A=i*x,B=o*-y,C=s*-y,g=e*y,k=i*y,o*=x,s*=x,e=z,i=A,m=B,q=C),t=b.rotationX,t&&(x=Math.cos(t),y=Math.sin(t),z=f*x+g*y,A=j*x+k*y,B=n*x+o*y,C=r*x+s*y,g=f*-y+g*x,k=j*-y+k*x,o=n*-y+o*x,s=r*-y+s*x,f=z,j=A,n=B,r=C),u&&(p-=u,h=g*p,l=k*p,p=o*p+u),h+=b.x,l+=b.y,p=((p+b.z)*w>>0)/w,c[sb]="matrix3d("+(e*w>>0)/w+v+(i*w>>0)/w+v+(m*w>>0)/w+v+(q*w>>0)/w+v+(f*w>>0)/w+v+(j*w>>0)/w+v+(n*w>>0)/w+v+(r*w>>0)/w+v+(g*w>>0)/w+v+(k*w>>0)/w+v+(o*w>>0)/w+v+(s*w>>0)/w+v+(h*w>>0)/w+v+(l*w>>0)/w+v+p+v+(d?1+-p/d:1)+")"},zb=function(){var d,e,f,g,h,i,j,k,b=this.data,c=this.t;J&&(d=T(c,"top",null,!1,"0"),e=parseFloat(d)||0,f=d.substr((e+"").length),b._ffFix=!b._ffFix,c.style.top=(b._ffFix?e+.05:e-.05)+(""===f?"px":f)),b.rotation||b.skewX?(g=b.rotation,h=g-b.skewX,i=1e5,j=b.scaleX*i,k=b.scaleY*i,c.style[sb]="matrix("+(Math.cos(g)*j>>0)/i+","+(Math.sin(g)*j>>0)/i+","+(Math.sin(h)*-k>>0)/i+","+(Math.cos(h)*k>>0)/i+","+b.x+","+b.y+")"):c.style[sb]="matrix("+b.scaleX+",0,0,"+b.scaleY+","+b.x+","+b.y+")"};pb("transform,scale,scaleX,scaleY,scaleZ,x,y,z,rotation,rotationX,rotationY,rotationZ,skewX,skewY,shortRotation,shortRotationX,shortRotationY,shortRotationZ,transformOrigin,transformPerspective",null,function(a,b,c,d,e,g,h){if(d._transform)return e;var n,o,p,q,r,s,t,i=d._transform=wb(a,f,!0),j=a.style,k=1e-6,l=rb.length,m=h;for("string"==typeof m.transform&&sb?(q=j[sb],j[sb]=m.transform,n=wb(a,null,!1),j[sb]=q):"object"==typeof m&&(o=null!=m.rotation?m.rotation:null!=m.rotationZ?m.rotationZ:i.rotation*z,n={scaleX:ab(null!=m.scaleX?m.scaleX:m.scale,i.scaleX),scaleY:ab(null!=m.scaleY?m.scaleY:m.scale,i.scaleY),scaleZ:ab(null!=m.scaleZ?m.scaleZ:m.scale,i.scaleZ),x:ab(m.x,i.x),y:ab(m.y,i.y),z:ab(m.z,i.z),perspective:ab(m.transformPerspective,i.perspective)},n.rotation=null!=m.shortRotation||null!=m.shortRotationZ?cb(m.shortRotation||m.shortRotationZ||0,i.rotation):"number"==typeof o?o*y:bb(o,i.rotation),vb&&(n.rotationX=null!=m.shortRotationX?cb(m.shortRotationX,i.rotationX):"number"==typeof m.rotationX?m.rotationX*y:bb(m.rotationX,i.rotationX),n.rotationY=null!=m.shortRotationY?cb(m.shortRotationY,i.rotationY):"number"==typeof m.rotationY?m.rotationY*y:bb(m.rotationY,i.rotationY),k>n.rotationX&&n.rotationX>-k&&(n.rotationX=0),k>n.rotationY&&n.rotationY>-k&&(n.rotationY=0)),n.skewX=null==m.skewX?i.skewX:"number"==typeof m.skewX?m.skewX*y:bb(m.skewX,i.skewX),n.skewY=null==m.skewY?i.skewY:"number"==typeof m.skewY?m.skewY*y:bb(m.skewY,i.skewY),(p=n.skewY-i.skewY)&&(n.skewX+=p,n.rotation+=p),k>n.skewY&&n.skewY>-k&&(n.skewY=0),k>n.skewX&&n.skewX>-k&&(n.skewX=0),k>n.rotation&&n.rotation>-k&&(n.rotation=0)),s=i.z||i.rotationX||i.rotationY||n.z||n.rotationX||n.rotationY||n.perspective,s||null==n.scale||(n.scaleZ=1);--l>-1;)c=rb[l],r=n[c]-i[c],(r>k||-k>r||null!=A[c])&&(t=!0,e=new lb(i,c,i[c],r,e),e.xs0=0,e.plugin=g,d._overwriteProps.push(e.n));return r=m.transformOrigin,(r||vb&&s&&i.zOrigin)&&(sb?(t=!0,r=(r||T(a,c,f,!1,"50% 50%"))+"",c=ub,e=new lb(j,c,0,0,e,-1,"css_transformOrigin"),e.b=j[c],e.plugin=g,vb?(q=i.zOrigin,r=r.split(" "),i.zOrigin=(r.length>2?parseFloat(r[2]):q)||0,e.xs0=e.e=j[c]=r[0]+" "+(r[1]||"50%")+" 0px",e=new lb(i,"zOrigin",0,0,e,-1,e.n),e.b=q,e.xs0=e.e=i.zOrigin):e.xs0=e.e=j[c]=r):$(r+"",i)),t&&(d._transformType=s||3===this._transformType?3:2),e},!0),pb("boxShadow","0px 0px 0px 0px #999",function(a,b,c,d,e,g){var h=-1!==(b+"").indexOf("inset")?" inset":"";return this.parseComplex(a.style,this.format(T(a,this.p,f,!1,this.dflt))+h,this.format(b)+h,e,g)},!0,!0),pb("borderRadius","0px",function(a,b,c,d,g){b=this.format(b);var k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z,i=["borderTopLeftRadius","borderTopRightRadius","borderBottomRightRadius","borderBottomLeftRadius"],j=a.style;for(s=parseFloat(a.offsetWidth),t=parseFloat(a.offsetHeight),k=b.split(" "),l=0;i.length>l;l++)this.p.indexOf("border")&&(i[l]=R(i[l])),o=n=T(a,i[l],f,!1,"0px"),-1!==o.indexOf(" ")&&(n=o.split(" "),o=n[0],n=n[1]),p=m=k[l],q=parseFloat(o),v=o.substr((q+"").length),w="="===p.charAt(1),w?(r=parseInt(p.charAt(0)+"1",10),p=p.substr(2),r*=parseFloat(p),u=p.substr((r+"").length-(0>r?1:0))||""):(r=parseFloat(p),u=p.substr((r+"").length)),""===u&&(u=e[c]||v),u!==v&&(x=Z(a,"borderLeft",q,v),y=Z(a,"borderTop",q,v),"%"===u?(o=100*(x/s)+"%",n=100*(y/t)+"%"):"em"===u?(z=Z(a,"borderLeft",1,"em"),o=x/z+"em",n=y/z+"em"):(o=x+"px",n=y+"px"),w&&(p=parseFloat(o)+r+u,m=parseFloat(n)+r+u)),g=mb(j,i[l],o+" "+n,p+" "+m,!1,"0px",g);return g},!0,!1,gb("0px 0px 0px 0px",!1,!0)),pb("backgroundPosition","0 0",function(a,b,c,d,e,g){var l,m,n,o,p,h="background-position",i=f||S(a,null),j=this.format((i?L?i.getPropertyValue(h+"-x")+" "+i.getPropertyValue(h+"-y"):i.getPropertyValue(h):a.currentStyle.backgroundPositionX+" "+a.currentStyle.backgroundPositionY)||"0 0"),k=this.format(b);if(-1!==j.indexOf("%")!=(-1!==k.indexOf("%"))){for(l=j.split(" "),m=k.split(" "),D.setAttribute("src",T(a,"backgroundImage").replace(t,"")),n=2;--n>-1;)j=l[n],o=-1!==j.indexOf("%"),o!==(-1!==m[n].indexOf("%"))&&(p=0===n?a.offsetWidth-D.width:a.offsetHeight-D.height,l[n]=o?parseFloat(j)/100*p+"px":100*(parseFloat(j)/p)+"%");j=l.join(" ")}return this.parseComplex(a.style,j,k,e,g)},!1,!1,$),pb("backgroundSize","0 0",null,!1,!1,$),pb("perspective","0px",null,!0),pb("perspectiveOrigin","50% 50%",null,!0),pb("transformStyle","preserve-3d",null,!0),pb("backfaceVisibility","visible",null,!0),pb("margin",null,hb("marginTop,marginRight,marginBottom,marginLeft")),pb("padding",null,hb("paddingTop,paddingRight,paddingBottom,paddingLeft")),pb("clip","rect(0px,0px,0px,0px)"),pb("textShadow","0px 0px 0px #999",null,!1,!0),pb("autoRound",null,function(a,b,c,d,e){return e}),pb("border","0px solid #000",function(a,b,c,d,e,g){return this.parseComplex(a.style,this.format(T(a,"borderTopWidth",f,!1,"0px")+" "+T(a,"borderTopStyle",f,!1,"solid")+" "+T(a,"borderTopColor",f,!1,"#000")),this.format(b),e,g)},!1,!0,function(a){var b=a.split(" ");return b[0]+" "+(b[1]||"solid")+" "+(a.match(fb)||["#000"])[0]});var Ab=function(a){var e,b=this.t,c=b.filter,d=this.s+this.c*a>>0;100===d&&(-1===c.indexOf("atrix(")&&-1===c.indexOf("radient(")?(b.removeAttribute("filter"),e=!T(this.data,"filter")):(b.filter=c.replace(q,""),e=!0)),e||(this.xn1&&(b.filter=c=c||"alpha(opacity=100)"),-1===c.indexOf("opacity")?b.filter+=" alpha(opacity="+d+")":b.filter=c.replace(o,"opacity="+d))};pb("opacity,alpha,autoAlpha","1",function(a,b,c,d,e,g){var j,h=parseFloat(T(a,"opacity",f,!1,"1")),i=a.style;return b=parseFloat(b),"autoAlpha"===c&&(j=T(a,"visibility",f),1===h&&"hidden"===j&&0!==b&&(h=0),e=new lb(i,"visibility",0,0,e,-1,null,!1,0,0!==h?"visible":"hidden",0===b?"hidden":"visible"),e.xs0="visible",d._overwriteProps.push(e.n)),M?e=new lb(i,"opacity",h,b-h,e):(e=new lb(i,"opacity",100*h,100*(b-h),e),e.xn1="autoAlpha"===c?1:0,i.zoom=1,e.type=2,e.b="alpha(opacity="+e.s+")",e.e="alpha(opacity="+(e.s+e.c)+")",e.data=a,e.plugin=g,e.setRatio=Ab),e});var Bb=function(a){if(1===a||0===a){this.t.className=1===a?this.e:this.b;for(var b=this.data,c=this.t.style,d=c.removeProperty?"removeProperty":"removeAttribute";b;)b.v?c[b.p]=b.v:c[d](b.p.replace(r,"-$1").toLowerCase()),b=b._next}else this.t.className!==this.b&&(this.t.className=this.b)};for(pb("className",null,function(a,b,c,d,e,g,h){var k,l,i=a.className,j=a.style.cssText;return e=d._classNamePT=new lb(a,c,0,0,e,2),e.setRatio=Bb,e.b=i,e.e="="!==b.charAt(1)?b:"+"===b.charAt(0)?i+" "+b.substr(2):i.split(b.substr(2)).join(""),d._tween._duration&&(l=U(a,f,!0),a.className=e.e,k=V(a,l,U(a),h),a.className=i,e.data=k.firstMPT,a.style.cssText=j,e=e.xfirst=d.parse(a,k.difs,e,g)),e}),i="bezier,throwProps,physicsProps,physics2D".split(","),nb=i.length;nb--;)qb(i[nb]);return i=c.prototype,i._firstPT=null,i._onInitTween=function(a,b,h){if(!a.nodeType)return!1;this._target=a,this._tween=h,this._vars=b,G=b.autoRound,d=!1,e=b.suffixMap||c.suffixMap,f=S(a,""),g=this._overwriteProps;var j,k,l,m,n,o,q,r,s,i=a.style;if(H&&""===i.zIndex&&(j=T(a,"zIndex",f),("auto"===j||""===j)&&(i.zIndex=0)),"string"==typeof b&&(m=i.cssText,j=U(a,f),i.cssText=m+";"+b,j=V(a,j,U(a)).difs,!M&&p.test(b)&&(j.opacity=parseFloat(RegExp.$1)),b=j,i.cssText=m),this._firstPT=k=this.parse(a,b,null),this._transformType){for(s=3===this._transformType,sb?I&&(H=!0,""===i.zIndex&&(q=T(a,"zIndex",f),("auto"===q||""===q)&&(i.zIndex=0)),K&&(i.WebkitBackfaceVisibility=this._vars.WebkitBackfaceVisibility||(s?"visible":"hidden"))):i.zoom=1,l=k;l&&l._next;)l=l._next;r=new lb(a,"transform",0,0,null,2),this._linkCSSP(r,null,l),r.setRatio=s&&vb?yb:sb?zb:xb,r.data=this._transform||wb(a,f,!0),g.pop()}if(d){for(;k;){for(o=k._next,l=m;l&&l.pr>k.pr;)l=l._next;(k._prev=l?l._prev:n)?k._prev._next=k:m=k,(k._next=l)?l._prev=k:n=k,k=o}this._firstPT=m}return!0},i.parse=function(a,b,c,d){var i,j,k,l,m,n,o,p,q,r,g=a.style;for(i in b)n=b[i],j=h[i],j?c=j.parse(a,n,i,this,c,d,b):(m=T(a,i,f)+"",q="string"==typeof n,"color"===i||"fill"===i||"stroke"===i||-1!==i.indexOf("Color")||q&&!n.indexOf("rgb")?(q||(n=eb(n),n=(n.length>3?"rgba(":"rgb(")+n.join(",")+")"),c=mb(g,i,m,n,!0,"transparent",c,0,d)):!q||-1===n.indexOf(" ")&&-1===n.indexOf(",")?(k=parseFloat(m),o=k||0===k?m.substr((k+"").length):"",(""===m||"auto"===m)&&("width"===i||"height"===i?(k=Y(a,i,f),o="px"):(k="opacity"!==i?0:1,o="")),r=q&&"="===n.charAt(1),r?(l=parseInt(n.charAt(0)+"1",10),n=n.substr(2),l*=parseFloat(n),p=n.substr((l+"").length-(0>l?1:0))||""):(l=parseFloat(n),p=q?n.substr((l+"").length)||"":""),""===p&&(p=e[i]||o),n=l||0===l?(r?l+k:l)+p:b[i],o!==p&&""!==p&&(l||0===l)&&(k||0===k)&&(k=Z(a,i,k,o),"%"===p?(k/=Z(a,i,100,"%")/100,k>100&&(k=100)):"em"===p?k/=Z(a,i,1,"em"):(l=Z(a,i,l,p),p="px"),r&&(l||0===l)&&(n=l+k+p)),r&&(l+=k),!k&&0!==k||!l&&0!==l?n||"NaN"!=n+""&&null!=n?(c=new lb(g,i,l||k||0,0,c,-1,"css_"+i,!1,0,m,n),c.xs0="display"===i&&"none"===n?m:n):O("invalid "+i+" tween value. "):(c=new lb(g,i,k,l-k,c,0,"css_"+i,G!==!1&&("px"===p||"zIndex"===i),0,m,n),c.xs0=p)):c=mb(g,i,m,n,!0,null,c,0,d)),d&&c&&!c.plugin&&(c.plugin=d);return c},i.setRatio=function(a){var d,e,f,b=this._firstPT,c=1e-6;if(1!==a||this._tween._time!==this._tween._duration&&0!==this._tween._time)if(a||this._tween._time!==this._tween._duration&&0!==this._tween._time||this._tween._rawPrevTime===-1e-6)for(;b;){if(d=b.c*a+b.s,b.r?d=d>0?d+.5>>0:d-.5>>0:c>d&&d>-c&&(d=0),b.type)if(1===b.type)if(f=b.l,2===f)b.t[b.p]=b.xs0+d+b.xs1+b.xn1+b.xs2;else if(3===f)b.t[b.p]=b.xs0+d+b.xs1+b.xn1+b.xs2+b.xn2+b.xs3;else if(4===f)b.t[b.p]=b.xs0+d+b.xs1+b.xn1+b.xs2+b.xn2+b.xs3+b.xn3+b.xs4;else if(5===f)b.t[b.p]=b.xs0+d+b.xs1+b.xn1+b.xs2+b.xn2+b.xs3+b.xn3+b.xs4+b.xn4+b.xs5;else{for(e=b.xs0+d+b.xs1,f=1;b.l>f;f++)e+=b["xn"+f]+b["xs"+(f+1)];b.t[b.p]=e}else-1===b.type?b.t[b.p]=b.xs0:b.setRatio&&b.setRatio(a);else b.t[b.p]=d+b.xs0;b=b._next}else for(;b;)2!==b.type?b.t[b.p]=b.b:b.setRatio(a),b=b._next;else for(;b;)2!==b.type?b.t[b.p]=b.e:b.setRatio(a),b=b._next},i._enableTransforms=function(a){this._transformType=a||3===this._transformType?3:2},i._linkCSSP=function(a,b,c,d){return a&&(b&&(b._prev=a),a._next&&(a._next._prev=a._prev),c?c._next=a:d||null!==this._firstPT||(this._firstPT=a),a._prev?a._prev._next=a._next:this._firstPT===a&&(this._firstPT=a._next),a._next=b,a._prev=c),a},i._kill=function(b){var e,f,g,c=b,d=!1;if(b.css_autoAlpha||b.css_alpha){c={};for(f in b)c[f]=b[f];c.css_opacity=1,c.css_autoAlpha&&(c.css_visibility=1)}return b.css_className&&(e=this._classNamePT)&&(g=e.xfirst,g&&g._prev?this._linkCSSP(g._prev,e._next,g._prev._prev):g===this._firstPT&&(this._firstPT=null),e._next&&this._linkCSSP(e._next,e._next._next,g._prev),this._target._gsOverwrittenClassNamePT=this._linkCSSP(e,this._target._gsOverwrittenClassNamePT),this._classNamePT=null,d=!0),a.prototype._kill.call(this,c)||d},a.activate([c]),c},!0)}),window._gsDefine&&_gsQueue.pop()();
  (function(t,e){"use strict";var i=t.GreenSockGlobals=t.GreenSockGlobals||t;if(!i.TweenLite){var s,n,r,a,o,l=function(t){var e,s=t.split("."),n=i;for(e=0;s.length>e;e++)n[s[e]]=n=n[s[e]]||{};return n},h=l("com.greensock"),_=1e-10,u=function(t){var e,i=[],s=t.length;for(e=0;e!==s;i.push(t[e++]));return i},f=function(){},m=function(){var t=Object.prototype.toString,e=t.call([]);return function(i){return null!=i&&(i instanceof Array||"object"==typeof i&&!!i.push&&t.call(i)===e)}}(),p={},c=function(s,n,r,a){this.sc=p[s]?p[s].sc:[],p[s]=this,this.gsClass=null,this.func=r;var o=[];this.check=function(h){for(var _,u,f,m,d=n.length,v=d;--d>-1;)(_=p[n[d]]||new c(n[d],[])).gsClass?(o[d]=_.gsClass,v--):h&&_.sc.push(this);if(0===v&&r)for(u=("com.greensock."+s).split("."),f=u.pop(),m=l(u.join("."))[f]=this.gsClass=r.apply(r,o),a&&(i[f]=m,"function"==typeof define&&define.amd?define((t.GreenSockAMDPath?t.GreenSockAMDPath+"/":"")+s.split(".").pop(),[],function(){return m}):s===e&&"undefined"!=typeof module&&module.exports&&(module.exports=m)),d=0;this.sc.length>d;d++)this.sc[d].check()},this.check(!0)},d=t._gsDefine=function(t,e,i,s){return new c(t,e,i,s)},v=h._class=function(t,e,i){return e=e||function(){},d(t,[],function(){return e},i),e};d.globals=i;var g=[0,0,1,1],T=[],y=v("easing.Ease",function(t,e,i,s){this._func=t,this._type=i||0,this._power=s||0,this._params=e?g.concat(e):g},!0),w=y.map={},P=y.register=function(t,e,i,s){for(var n,r,a,o,l=e.split(","),_=l.length,u=(i||"easeIn,easeOut,easeInOut").split(",");--_>-1;)for(r=l[_],n=s?v("easing."+r,null,!0):h.easing[r]||{},a=u.length;--a>-1;)o=u[a],w[r+"."+o]=w[o+r]=n[o]=t.getRatio?t:t[o]||new t};for(r=y.prototype,r._calcEnd=!1,r.getRatio=function(t){if(this._func)return this._params[0]=t,this._func.apply(null,this._params);var e=this._type,i=this._power,s=1===e?1-t:2===e?t:.5>t?2*t:2*(1-t);return 1===i?s*=s:2===i?s*=s*s:3===i?s*=s*s*s:4===i&&(s*=s*s*s*s),1===e?1-s:2===e?s:.5>t?s/2:1-s/2},s=["Linear","Quad","Cubic","Quart","Quint,Strong"],n=s.length;--n>-1;)r=s[n]+",Power"+n,P(new y(null,null,1,n),r,"easeOut",!0),P(new y(null,null,2,n),r,"easeIn"+(0===n?",easeNone":"")),P(new y(null,null,3,n),r,"easeInOut");w.linear=h.easing.Linear.easeIn,w.swing=h.easing.Quad.easeInOut;var b=v("events.EventDispatcher",function(t){this._listeners={},this._eventTarget=t||this});r=b.prototype,r.addEventListener=function(t,e,i,s,n){n=n||0;var r,l,h=this._listeners[t],_=0;for(null==h&&(this._listeners[t]=h=[]),l=h.length;--l>-1;)r=h[l],r.c===e&&r.s===i?h.splice(l,1):0===_&&n>r.pr&&(_=l+1);h.splice(_,0,{c:e,s:i,up:s,pr:n}),this!==a||o||a.wake()},r.removeEventListener=function(t,e){var i,s=this._listeners[t];if(s)for(i=s.length;--i>-1;)if(s[i].c===e)return s.splice(i,1),void 0},r.dispatchEvent=function(t){var e,i,s,n=this._listeners[t];if(n)for(e=n.length,i=this._eventTarget;--e>-1;)s=n[e],s.up?s.c.call(s.s||i,{type:t,target:i}):s.c.call(s.s||i)};var k=t.requestAnimationFrame,A=t.cancelAnimationFrame,S=Date.now||function(){return(new Date).getTime()},x=S();for(s=["ms","moz","webkit","o"],n=s.length;--n>-1&&!k;)k=t[s[n]+"RequestAnimationFrame"],A=t[s[n]+"CancelAnimationFrame"]||t[s[n]+"CancelRequestAnimationFrame"];v("Ticker",function(t,e){var i,s,n,r,l,h=this,u=S(),m=e!==!1&&k,p=500,c=33,d=function(t){var e,a,o=S()-x;o>p&&(u+=o-c),x+=o,h.time=(x-u)/1e3,e=h.time-l,(!i||e>0||t===!0)&&(h.frame++,l+=e+(e>=r?.004:r-e),a=!0),t!==!0&&(n=s(d)),a&&h.dispatchEvent("tick")};b.call(h),h.time=h.frame=0,h.tick=function(){d(!0)},h.lagSmoothing=function(t,e){p=t||1/_,c=Math.min(e,p,0)},h.sleep=function(){null!=n&&(m&&A?A(n):clearTimeout(n),s=f,n=null,h===a&&(o=!1))},h.wake=function(){null!==n?h.sleep():h.frame>10&&(x=S()-p+5),s=0===i?f:m&&k?k:function(t){return setTimeout(t,0|1e3*(l-h.time)+1)},h===a&&(o=!0),d(2)},h.fps=function(t){return arguments.length?(i=t,r=1/(i||60),l=this.time+r,h.wake(),void 0):i},h.useRAF=function(t){return arguments.length?(h.sleep(),m=t,h.fps(i),void 0):m},h.fps(t),setTimeout(function(){m&&(!n||5>h.frame)&&h.useRAF(!1)},1500)}),r=h.Ticker.prototype=new h.events.EventDispatcher,r.constructor=h.Ticker;var C=v("core.Animation",function(t,e){if(this.vars=e=e||{},this._duration=this._totalDuration=t||0,this._delay=Number(e.delay)||0,this._timeScale=1,this._active=e.immediateRender===!0,this.data=e.data,this._reversed=e.reversed===!0,B){o||a.wake();var i=this.vars.useFrames?q:B;i.add(this,i._time),this.vars.paused&&this.paused(!0)}});a=C.ticker=new h.Ticker,r=C.prototype,r._dirty=r._gc=r._initted=r._paused=!1,r._totalTime=r._time=0,r._rawPrevTime=-1,r._next=r._last=r._onUpdate=r._timeline=r.timeline=null,r._paused=!1;var R=function(){o&&S()-x>2e3&&a.wake(),setTimeout(R,2e3)};R(),r.play=function(t,e){return null!=t&&this.seek(t,e),this.reversed(!1).paused(!1)},r.pause=function(t,e){return null!=t&&this.seek(t,e),this.paused(!0)},r.resume=function(t,e){return null!=t&&this.seek(t,e),this.paused(!1)},r.seek=function(t,e){return this.totalTime(Number(t),e!==!1)},r.restart=function(t,e){return this.reversed(!1).paused(!1).totalTime(t?-this._delay:0,e!==!1,!0)},r.reverse=function(t,e){return null!=t&&this.seek(t||this.totalDuration(),e),this.reversed(!0).paused(!1)},r.render=function(){},r.invalidate=function(){return this},r.isActive=function(){var t,e=this._timeline,i=this._startTime;return!e||!this._gc&&!this._paused&&e.isActive()&&(t=e.rawTime())>=i&&i+this.totalDuration()/this._timeScale>t},r._enabled=function(t,e){return o||a.wake(),this._gc=!t,this._active=this.isActive(),e!==!0&&(t&&!this.timeline?this._timeline.add(this,this._startTime-this._delay):!t&&this.timeline&&this._timeline._remove(this,!0)),!1},r._kill=function(){return this._enabled(!1,!1)},r.kill=function(t,e){return this._kill(t,e),this},r._uncache=function(t){for(var e=t?this:this.timeline;e;)e._dirty=!0,e=e.timeline;return this},r._swapSelfInParams=function(t){for(var e=t.length,i=t.concat();--e>-1;)"{self}"===t[e]&&(i[e]=this);return i},r.eventCallback=function(t,e,i,s){if("on"===(t||"").substr(0,2)){var n=this.vars;if(1===arguments.length)return n[t];null==e?delete n[t]:(n[t]=e,n[t+"Params"]=m(i)&&-1!==i.join("").indexOf("{self}")?this._swapSelfInParams(i):i,n[t+"Scope"]=s),"onUpdate"===t&&(this._onUpdate=e)}return this},r.delay=function(t){return arguments.length?(this._timeline.smoothChildTiming&&this.startTime(this._startTime+t-this._delay),this._delay=t,this):this._delay},r.duration=function(t){return arguments.length?(this._duration=this._totalDuration=t,this._uncache(!0),this._timeline.smoothChildTiming&&this._time>0&&this._time<this._duration&&0!==t&&this.totalTime(this._totalTime*(t/this._duration),!0),this):(this._dirty=!1,this._duration)},r.totalDuration=function(t){return this._dirty=!1,arguments.length?this.duration(t):this._totalDuration},r.time=function(t,e){return arguments.length?(this._dirty&&this.totalDuration(),this.totalTime(t>this._duration?this._duration:t,e)):this._time},r.totalTime=function(t,e,i){if(o||a.wake(),!arguments.length)return this._totalTime;if(this._timeline){if(0>t&&!i&&(t+=this.totalDuration()),this._timeline.smoothChildTiming){this._dirty&&this.totalDuration();var s=this._totalDuration,n=this._timeline;if(t>s&&!i&&(t=s),this._startTime=(this._paused?this._pauseTime:n._time)-(this._reversed?s-t:t)/this._timeScale,n._dirty||this._uncache(!1),n._timeline)for(;n._timeline;)n._timeline._time!==(n._startTime+n._totalTime)/n._timeScale&&n.totalTime(n._totalTime,!0),n=n._timeline}this._gc&&this._enabled(!0,!1),(this._totalTime!==t||0===this._duration)&&(this.render(t,e,!1),O.length&&M())}return this},r.progress=r.totalProgress=function(t,e){return arguments.length?this.totalTime(this.duration()*t,e):this._time/this.duration()},r.startTime=function(t){return arguments.length?(t!==this._startTime&&(this._startTime=t,this.timeline&&this.timeline._sortChildren&&this.timeline.add(this,t-this._delay)),this):this._startTime},r.timeScale=function(t){if(!arguments.length)return this._timeScale;if(t=t||_,this._timeline&&this._timeline.smoothChildTiming){var e=this._pauseTime,i=e||0===e?e:this._timeline.totalTime();this._startTime=i-(i-this._startTime)*this._timeScale/t}return this._timeScale=t,this._uncache(!1)},r.reversed=function(t){return arguments.length?(t!=this._reversed&&(this._reversed=t,this.totalTime(this._timeline&&!this._timeline.smoothChildTiming?this.totalDuration()-this._totalTime:this._totalTime,!0)),this):this._reversed},r.paused=function(t){if(!arguments.length)return this._paused;if(t!=this._paused&&this._timeline){o||t||a.wake();var e=this._timeline,i=e.rawTime(),s=i-this._pauseTime;!t&&e.smoothChildTiming&&(this._startTime+=s,this._uncache(!1)),this._pauseTime=t?i:null,this._paused=t,this._active=this.isActive(),!t&&0!==s&&this._initted&&this.duration()&&this.render(e.smoothChildTiming?this._totalTime:(i-this._startTime)/this._timeScale,!0,!0)}return this._gc&&!t&&this._enabled(!0,!1),this};var D=v("core.SimpleTimeline",function(t){C.call(this,0,t),this.autoRemoveChildren=this.smoothChildTiming=!0});r=D.prototype=new C,r.constructor=D,r.kill()._gc=!1,r._first=r._last=null,r._sortChildren=!1,r.add=r.insert=function(t,e){var i,s;if(t._startTime=Number(e||0)+t._delay,t._paused&&this!==t._timeline&&(t._pauseTime=t._startTime+(this.rawTime()-t._startTime)/t._timeScale),t.timeline&&t.timeline._remove(t,!0),t.timeline=t._timeline=this,t._gc&&t._enabled(!0,!0),i=this._last,this._sortChildren)for(s=t._startTime;i&&i._startTime>s;)i=i._prev;return i?(t._next=i._next,i._next=t):(t._next=this._first,this._first=t),t._next?t._next._prev=t:this._last=t,t._prev=i,this._timeline&&this._uncache(!0),this},r._remove=function(t,e){return t.timeline===this&&(e||t._enabled(!1,!0),t._prev?t._prev._next=t._next:this._first===t&&(this._first=t._next),t._next?t._next._prev=t._prev:this._last===t&&(this._last=t._prev),t._next=t._prev=t.timeline=null,this._timeline&&this._uncache(!0)),this},r.render=function(t,e,i){var s,n=this._first;for(this._totalTime=this._time=this._rawPrevTime=t;n;)s=n._next,(n._active||t>=n._startTime&&!n._paused)&&(n._reversed?n.render((n._dirty?n.totalDuration():n._totalDuration)-(t-n._startTime)*n._timeScale,e,i):n.render((t-n._startTime)*n._timeScale,e,i)),n=s},r.rawTime=function(){return o||a.wake(),this._totalTime};var I=v("TweenLite",function(e,i,s){if(C.call(this,i,s),this.render=I.prototype.render,null==e)throw"Cannot tween a null target.";this.target=e="string"!=typeof e?e:I.selector(e)||e;var n,r,a,o=e.jquery||e.length&&e!==t&&e[0]&&(e[0]===t||e[0].nodeType&&e[0].style&&!e.nodeType),l=this.vars.overwrite;if(this._overwrite=l=null==l?Q[I.defaultOverwrite]:"number"==typeof l?l>>0:Q[l],(o||e instanceof Array||e.push&&m(e))&&"number"!=typeof e[0])for(this._targets=a=u(e),this._propLookup=[],this._siblings=[],n=0;a.length>n;n++)r=a[n],r?"string"!=typeof r?r.length&&r!==t&&r[0]&&(r[0]===t||r[0].nodeType&&r[0].style&&!r.nodeType)?(a.splice(n--,1),this._targets=a=a.concat(u(r))):(this._siblings[n]=$(r,this,!1),1===l&&this._siblings[n].length>1&&K(r,this,null,1,this._siblings[n])):(r=a[n--]=I.selector(r),"string"==typeof r&&a.splice(n+1,1)):a.splice(n--,1);else this._propLookup={},this._siblings=$(e,this,!1),1===l&&this._siblings.length>1&&K(e,this,null,1,this._siblings);(this.vars.immediateRender||0===i&&0===this._delay&&this.vars.immediateRender!==!1)&&(this._time=-_,this.render(-this._delay))},!0),E=function(e){return e.length&&e!==t&&e[0]&&(e[0]===t||e[0].nodeType&&e[0].style&&!e.nodeType)},z=function(t,e){var i,s={};for(i in t)G[i]||i in e&&"transform"!==i&&"x"!==i&&"y"!==i&&"width"!==i&&"height"!==i&&"className"!==i&&"border"!==i||!(!U[i]||U[i]&&U[i]._autoCSS)||(s[i]=t[i],delete t[i]);t.css=s};r=I.prototype=new C,r.constructor=I,r.kill()._gc=!1,r.ratio=0,r._firstPT=r._targets=r._overwrittenProps=r._startAt=null,r._notifyPluginsOfEnabled=r._lazy=!1,I.version="1.13.1",I.defaultEase=r._ease=new y(null,null,1,1),I.defaultOverwrite="auto",I.ticker=a,I.autoSleep=!0,I.lagSmoothing=function(t,e){a.lagSmoothing(t,e)},I.selector=t.$||t.jQuery||function(e){var i=t.$||t.jQuery;return i?(I.selector=i,i(e)):"undefined"==typeof document?e:document.querySelectorAll?document.querySelectorAll(e):document.getElementById("#"===e.charAt(0)?e.substr(1):e)};var O=[],L={},N=I._internals={isArray:m,isSelector:E,lazyTweens:O},U=I._plugins={},F=N.tweenLookup={},j=0,G=N.reservedProps={ease:1,delay:1,overwrite:1,onComplete:1,onCompleteParams:1,onCompleteScope:1,useFrames:1,runBackwards:1,startAt:1,onUpdate:1,onUpdateParams:1,onUpdateScope:1,onStart:1,onStartParams:1,onStartScope:1,onReverseComplete:1,onReverseCompleteParams:1,onReverseCompleteScope:1,onRepeat:1,onRepeatParams:1,onRepeatScope:1,easeParams:1,yoyo:1,immediateRender:1,repeat:1,repeatDelay:1,data:1,paused:1,reversed:1,autoCSS:1,lazy:1},Q={none:0,all:1,auto:2,concurrent:3,allOnStart:4,preexisting:5,"true":1,"false":0},q=C._rootFramesTimeline=new D,B=C._rootTimeline=new D,M=N.lazyRender=function(){var t=O.length;for(L={};--t>-1;)s=O[t],s&&s._lazy!==!1&&(s.render(s._lazy,!1,!0),s._lazy=!1);O.length=0};B._startTime=a.time,q._startTime=a.frame,B._active=q._active=!0,setTimeout(M,1),C._updateRoot=I.render=function(){var t,e,i;if(O.length&&M(),B.render((a.time-B._startTime)*B._timeScale,!1,!1),q.render((a.frame-q._startTime)*q._timeScale,!1,!1),O.length&&M(),!(a.frame%120)){for(i in F){for(e=F[i].tweens,t=e.length;--t>-1;)e[t]._gc&&e.splice(t,1);0===e.length&&delete F[i]}if(i=B._first,(!i||i._paused)&&I.autoSleep&&!q._first&&1===a._listeners.tick.length){for(;i&&i._paused;)i=i._next;i||a.sleep()}}},a.addEventListener("tick",C._updateRoot);var $=function(t,e,i){var s,n,r=t._gsTweenID;if(F[r||(t._gsTweenID=r="t"+j++)]||(F[r]={target:t,tweens:[]}),e&&(s=F[r].tweens,s[n=s.length]=e,i))for(;--n>-1;)s[n]===e&&s.splice(n,1);return F[r].tweens},K=function(t,e,i,s,n){var r,a,o,l;if(1===s||s>=4){for(l=n.length,r=0;l>r;r++)if((o=n[r])!==e)o._gc||o._enabled(!1,!1)&&(a=!0);else if(5===s)break;return a}var h,u=e._startTime+_,f=[],m=0,p=0===e._duration;for(r=n.length;--r>-1;)(o=n[r])===e||o._gc||o._paused||(o._timeline!==e._timeline?(h=h||H(e,0,p),0===H(o,h,p)&&(f[m++]=o)):u>=o._startTime&&o._startTime+o.totalDuration()/o._timeScale>u&&((p||!o._initted)&&2e-10>=u-o._startTime||(f[m++]=o)));for(r=m;--r>-1;)o=f[r],2===s&&o._kill(i,t)&&(a=!0),(2!==s||!o._firstPT&&o._initted)&&o._enabled(!1,!1)&&(a=!0);return a},H=function(t,e,i){for(var s=t._timeline,n=s._timeScale,r=t._startTime;s._timeline;){if(r+=s._startTime,n*=s._timeScale,s._paused)return-100;s=s._timeline}return r/=n,r>e?r-e:i&&r===e||!t._initted&&2*_>r-e?_:(r+=t.totalDuration()/t._timeScale/n)>e+_?0:r-e-_};r._init=function(){var t,e,i,s,n,r=this.vars,a=this._overwrittenProps,o=this._duration,l=!!r.immediateRender,h=r.ease;if(r.startAt){this._startAt&&(this._startAt.render(-1,!0),this._startAt.kill()),n={};for(s in r.startAt)n[s]=r.startAt[s];if(n.overwrite=!1,n.immediateRender=!0,n.lazy=l&&r.lazy!==!1,n.startAt=n.delay=null,this._startAt=I.to(this.target,0,n),l)if(this._time>0)this._startAt=null;else if(0!==o)return}else if(r.runBackwards&&0!==o)if(this._startAt)this._startAt.render(-1,!0),this._startAt.kill(),this._startAt=null;else{i={};for(s in r)G[s]&&"autoCSS"!==s||(i[s]=r[s]);if(i.overwrite=0,i.data="isFromStart",i.lazy=l&&r.lazy!==!1,i.immediateRender=l,this._startAt=I.to(this.target,0,i),l){if(0===this._time)return}else this._startAt._init(),this._startAt._enabled(!1)}if(this._ease=h=h?h instanceof y?h:"function"==typeof h?new y(h,r.easeParams):w[h]||I.defaultEase:I.defaultEase,r.easeParams instanceof Array&&h.config&&(this._ease=h.config.apply(h,r.easeParams)),this._easeType=this._ease._type,this._easePower=this._ease._power,this._firstPT=null,this._targets)for(t=this._targets.length;--t>-1;)this._initProps(this._targets[t],this._propLookup[t]={},this._siblings[t],a?a[t]:null)&&(e=!0);else e=this._initProps(this.target,this._propLookup,this._siblings,a);if(e&&I._onPluginEvent("_onInitAllProps",this),a&&(this._firstPT||"function"!=typeof this.target&&this._enabled(!1,!1)),r.runBackwards)for(i=this._firstPT;i;)i.s+=i.c,i.c=-i.c,i=i._next;this._onUpdate=r.onUpdate,this._initted=!0},r._initProps=function(e,i,s,n){var r,a,o,l,h,_;if(null==e)return!1;L[e._gsTweenID]&&M(),this.vars.css||e.style&&e!==t&&e.nodeType&&U.css&&this.vars.autoCSS!==!1&&z(this.vars,e);for(r in this.vars){if(_=this.vars[r],G[r])_&&(_ instanceof Array||_.push&&m(_))&&-1!==_.join("").indexOf("{self}")&&(this.vars[r]=_=this._swapSelfInParams(_,this));else if(U[r]&&(l=new U[r])._onInitTween(e,this.vars[r],this)){for(this._firstPT=h={_next:this._firstPT,t:l,p:"setRatio",s:0,c:1,f:!0,n:r,pg:!0,pr:l._priority},a=l._overwriteProps.length;--a>-1;)i[l._overwriteProps[a]]=this._firstPT;(l._priority||l._onInitAllProps)&&(o=!0),(l._onDisable||l._onEnable)&&(this._notifyPluginsOfEnabled=!0)}else this._firstPT=i[r]=h={_next:this._firstPT,t:e,p:r,f:"function"==typeof e[r],n:r,pg:!1,pr:0},h.s=h.f?e[r.indexOf("set")||"function"!=typeof e["get"+r.substr(3)]?r:"get"+r.substr(3)]():parseFloat(e[r]),h.c="string"==typeof _&&"="===_.charAt(1)?parseInt(_.charAt(0)+"1",10)*Number(_.substr(2)):Number(_)-h.s||0;h&&h._next&&(h._next._prev=h)}return n&&this._kill(n,e)?this._initProps(e,i,s,n):this._overwrite>1&&this._firstPT&&s.length>1&&K(e,this,i,this._overwrite,s)?(this._kill(i,e),this._initProps(e,i,s,n)):(this._firstPT&&(this.vars.lazy!==!1&&this._duration||this.vars.lazy&&!this._duration)&&(L[e._gsTweenID]=!0),o)},r.render=function(t,e,i){var s,n,r,a,o=this._time,l=this._duration,h=this._rawPrevTime;if(t>=l)this._totalTime=this._time=l,this.ratio=this._ease._calcEnd?this._ease.getRatio(1):1,this._reversed||(s=!0,n="onComplete"),0===l&&(this._initted||!this.vars.lazy||i)&&(this._startTime===this._timeline._duration&&(t=0),(0===t||0>h||h===_)&&h!==t&&(i=!0,h>_&&(n="onReverseComplete")),this._rawPrevTime=a=!e||t||h===t?t:_);else if(1e-7>t)this._totalTime=this._time=0,this.ratio=this._ease._calcEnd?this._ease.getRatio(0):0,(0!==o||0===l&&h>0&&h!==_)&&(n="onReverseComplete",s=this._reversed),0>t?(this._active=!1,0===l&&(this._initted||!this.vars.lazy||i)&&(h>=0&&(i=!0),this._rawPrevTime=a=!e||t||h===t?t:_)):this._initted||(i=!0);else if(this._totalTime=this._time=t,this._easeType){var u=t/l,f=this._easeType,m=this._easePower;(1===f||3===f&&u>=.5)&&(u=1-u),3===f&&(u*=2),1===m?u*=u:2===m?u*=u*u:3===m?u*=u*u*u:4===m&&(u*=u*u*u*u),this.ratio=1===f?1-u:2===f?u:.5>t/l?u/2:1-u/2}else this.ratio=this._ease.getRatio(t/l);if(this._time!==o||i){if(!this._initted){if(this._init(),!this._initted||this._gc)return;if(!i&&this._firstPT&&(this.vars.lazy!==!1&&this._duration||this.vars.lazy&&!this._duration))return this._time=this._totalTime=o,this._rawPrevTime=h,O.push(this),this._lazy=t,void 0;this._time&&!s?this.ratio=this._ease.getRatio(this._time/l):s&&this._ease._calcEnd&&(this.ratio=this._ease.getRatio(0===this._time?0:1))}for(this._lazy!==!1&&(this._lazy=!1),this._active||!this._paused&&this._time!==o&&t>=0&&(this._active=!0),0===o&&(this._startAt&&(t>=0?this._startAt.render(t,e,i):n||(n="_dummyGS")),this.vars.onStart&&(0!==this._time||0===l)&&(e||this.vars.onStart.apply(this.vars.onStartScope||this,this.vars.onStartParams||T))),r=this._firstPT;r;)r.f?r.t[r.p](r.c*this.ratio+r.s):r.t[r.p]=r.c*this.ratio+r.s,r=r._next;this._onUpdate&&(0>t&&this._startAt&&this._startTime&&this._startAt.render(t,e,i),e||(this._time!==o||s)&&this._onUpdate.apply(this.vars.onUpdateScope||this,this.vars.onUpdateParams||T)),n&&(!this._gc||i)&&(0>t&&this._startAt&&!this._onUpdate&&this._startTime&&this._startAt.render(t,e,i),s&&(this._timeline.autoRemoveChildren&&this._enabled(!1,!1),this._active=!1),!e&&this.vars[n]&&this.vars[n].apply(this.vars[n+"Scope"]||this,this.vars[n+"Params"]||T),0===l&&this._rawPrevTime===_&&a!==_&&(this._rawPrevTime=0))}},r._kill=function(t,e){if("all"===t&&(t=null),null==t&&(null==e||e===this.target))return this._lazy=!1,this._enabled(!1,!1);e="string"!=typeof e?e||this._targets||this.target:I.selector(e)||e;var i,s,n,r,a,o,l,h;if((m(e)||E(e))&&"number"!=typeof e[0])for(i=e.length;--i>-1;)this._kill(t,e[i])&&(o=!0);else{if(this._targets){for(i=this._targets.length;--i>-1;)if(e===this._targets[i]){a=this._propLookup[i]||{},this._overwrittenProps=this._overwrittenProps||[],s=this._overwrittenProps[i]=t?this._overwrittenProps[i]||{}:"all";break}}else{if(e!==this.target)return!1;a=this._propLookup,s=this._overwrittenProps=t?this._overwrittenProps||{}:"all"}if(a){l=t||a,h=t!==s&&"all"!==s&&t!==a&&("object"!=typeof t||!t._tempKill);for(n in l)(r=a[n])&&(r.pg&&r.t._kill(l)&&(o=!0),r.pg&&0!==r.t._overwriteProps.length||(r._prev?r._prev._next=r._next:r===this._firstPT&&(this._firstPT=r._next),r._next&&(r._next._prev=r._prev),r._next=r._prev=null),delete a[n]),h&&(s[n]=1);!this._firstPT&&this._initted&&this._enabled(!1,!1)}}return o},r.invalidate=function(){return this._notifyPluginsOfEnabled&&I._onPluginEvent("_onDisable",this),this._firstPT=null,this._overwrittenProps=null,this._onUpdate=null,this._startAt=null,this._initted=this._active=this._notifyPluginsOfEnabled=this._lazy=!1,this._propLookup=this._targets?{}:[],this},r._enabled=function(t,e){if(o||a.wake(),t&&this._gc){var i,s=this._targets;if(s)for(i=s.length;--i>-1;)this._siblings[i]=$(s[i],this,!0);else this._siblings=$(this.target,this,!0)}return C.prototype._enabled.call(this,t,e),this._notifyPluginsOfEnabled&&this._firstPT?I._onPluginEvent(t?"_onEnable":"_onDisable",this):!1},I.to=function(t,e,i){return new I(t,e,i)},I.from=function(t,e,i){return i.runBackwards=!0,i.immediateRender=0!=i.immediateRender,new I(t,e,i)},I.fromTo=function(t,e,i,s){return s.startAt=i,s.immediateRender=0!=s.immediateRender&&0!=i.immediateRender,new I(t,e,s)},I.delayedCall=function(t,e,i,s,n){return new I(e,0,{delay:t,onComplete:e,onCompleteParams:i,onCompleteScope:s,onReverseComplete:e,onReverseCompleteParams:i,onReverseCompleteScope:s,immediateRender:!1,useFrames:n,overwrite:0})},I.set=function(t,e){return new I(t,0,e)},I.getTweensOf=function(t,e){if(null==t)return[];t="string"!=typeof t?t:I.selector(t)||t;var i,s,n,r;if((m(t)||E(t))&&"number"!=typeof t[0]){for(i=t.length,s=[];--i>-1;)s=s.concat(I.getTweensOf(t[i],e));for(i=s.length;--i>-1;)for(r=s[i],n=i;--n>-1;)r===s[n]&&s.splice(i,1)}else for(s=$(t).concat(),i=s.length;--i>-1;)(s[i]._gc||e&&!s[i].isActive())&&s.splice(i,1);return s},I.killTweensOf=I.killDelayedCallsTo=function(t,e,i){"object"==typeof e&&(i=e,e=!1);for(var s=I.getTweensOf(t,e),n=s.length;--n>-1;)s[n]._kill(i,t)};var J=v("plugins.TweenPlugin",function(t,e){this._overwriteProps=(t||"").split(","),this._propName=this._overwriteProps[0],this._priority=e||0,this._super=J.prototype},!0);if(r=J.prototype,J.version="1.10.1",J.API=2,r._firstPT=null,r._addTween=function(t,e,i,s,n,r){var a,o;return null!=s&&(a="number"==typeof s||"="!==s.charAt(1)?Number(s)-i:parseInt(s.charAt(0)+"1",10)*Number(s.substr(2)))?(this._firstPT=o={_next:this._firstPT,t:t,p:e,s:i,c:a,f:"function"==typeof t[e],n:n||e,r:r},o._next&&(o._next._prev=o),o):void 0},r.setRatio=function(t){for(var e,i=this._firstPT,s=1e-6;i;)e=i.c*t+i.s,i.r?e=Math.round(e):s>e&&e>-s&&(e=0),i.f?i.t[i.p](e):i.t[i.p]=e,i=i._next},r._kill=function(t){var e,i=this._overwriteProps,s=this._firstPT;if(null!=t[this._propName])this._overwriteProps=[];else for(e=i.length;--e>-1;)null!=t[i[e]]&&i.splice(e,1);for(;s;)null!=t[s.n]&&(s._next&&(s._next._prev=s._prev),s._prev?(s._prev._next=s._next,s._prev=null):this._firstPT===s&&(this._firstPT=s._next)),s=s._next;return!1},r._roundProps=function(t,e){for(var i=this._firstPT;i;)(t[this._propName]||null!=i.n&&t[i.n.split(this._propName+"_").join("")])&&(i.r=e),i=i._next},I._onPluginEvent=function(t,e){var i,s,n,r,a,o=e._firstPT;if("_onInitAllProps"===t){for(;o;){for(a=o._next,s=n;s&&s.pr>o.pr;)s=s._next;(o._prev=s?s._prev:r)?o._prev._next=o:n=o,(o._next=s)?s._prev=o:r=o,o=a}o=e._firstPT=n}for(;o;)o.pg&&"function"==typeof o.t[t]&&o.t[t]()&&(i=!0),o=o._next;return i},J.activate=function(t){for(var e=t.length;--e>-1;)t[e].API===J.API&&(U[(new t[e])._propName]=t[e]);return!0},d.plugin=function(t){if(!(t&&t.propName&&t.init&&t.API))throw"illegal plugin definition.";var e,i=t.propName,s=t.priority||0,n=t.overwriteProps,r={init:"_onInitTween",set:"setRatio",kill:"_kill",round:"_roundProps",initAll:"_onInitAllProps"},a=v("plugins."+i.charAt(0).toUpperCase()+i.substr(1)+"Plugin",function(){J.call(this,i,s),this._overwriteProps=n||[]},t.global===!0),o=a.prototype=new J(i);o.constructor=a,a.API=t.API;for(e in r)"function"==typeof t[e]&&(o[r[e]]=t[e]);return a.version=t.version,J.activate([a]),a},s=t._gsQueue){for(n=0;s.length>n;n++)s[n]();for(r in p)p[r].func||t.console.log("GSAP encountered missing dependency: com.greensock."+r)}o=!1}})("undefined"!=typeof module&&module.exports&&"undefined"!=typeof global?global:this||window,"TweenLite");


  // Color change
  (function(a,b){function m(a,b,c){var d=h[b.type]||{};return a==null?c||!b.def?null:b.def:(a=d.floor?~~a:parseFloat(a),isNaN(a)?b.def:d.mod?(a+d.mod)%d.mod:0>a?0:d.max<a?d.max:a)}function n(b){var c=f(),d=c._rgba=[];return b=b.toLowerCase(),l(e,function(a,e){var f,h=e.re.exec(b),i=h&&e.parse(h),j=e.space||"rgba";if(i)return f=c[j](i),c[g[j].cache]=f[g[j].cache],d=c._rgba=f._rgba,!1}),d.length?(d.join()==="0,0,0,0"&&a.extend(d,k.transparent),c):k[b]}function o(a,b,c){return c=(c+1)%1,c*6<1?a+(b-a)*c*6:c*2<1?b:c*3<2?a+(b-a)*(2/3-c)*6:a}var c="backgroundColor borderBottomColor borderLeftColor borderRightColor borderTopColor color columnRuleColor outlineColor textDecorationColor textEmphasisColor",d=/^([\-+])=\s*(\d+\.?\d*)/,e=[{re:/rgba?\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*(?:,\s*(\d+(?:\.\d+)?)\s*)?\)/,parse:function(a){return[a[1],a[2],a[3],a[4]]}},{re:/rgba?\(\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d+(?:\.\d+)?)\s*)?\)/,parse:function(a){return[a[1]*2.55,a[2]*2.55,a[3]*2.55,a[4]]}},{re:/#([a-f0-9]{2})([a-f0-9]{2})([a-f0-9]{2})/,parse:function(a){return[parseInt(a[1],16),parseInt(a[2],16),parseInt(a[3],16)]}},{re:/#([a-f0-9])([a-f0-9])([a-f0-9])/,parse:function(a){return[parseInt(a[1]+a[1],16),parseInt(a[2]+a[2],16),parseInt(a[3]+a[3],16)]}},{re:/hsla?\(\s*(\d+(?:\.\d+)?)\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d+(?:\.\d+)?)\s*)?\)/,space:"hsla",parse:function(a){return[a[1],a[2]/100,a[3]/100,a[4]]}}],f=a.Color=function(b,c,d,e){return new a.Color.fn.parse(b,c,d,e)},g={rgba:{props:{red:{idx:0,type:"byte"},green:{idx:1,type:"byte"},blue:{idx:2,type:"byte"}}},hsla:{props:{hue:{idx:0,type:"degrees"},saturation:{idx:1,type:"percent"},lightness:{idx:2,type:"percent"}}}},h={"byte":{floor:!0,max:255},percent:{max:1},degrees:{mod:360,floor:!0}},i=f.support={},j=a("<p>")[0],k,l=a.each;j.style.cssText="background-color:rgba(1,1,1,.5)",i.rgba=j.style.backgroundColor.indexOf("rgba")>-1,l(g,function(a,b){b.cache="_"+a,b.props.alpha={idx:3,type:"percent",def:1}}),f.fn=a.extend(f.prototype,{parse:function(c,d,e,h){if(c===b)return this._rgba=[null,null,null,null],this;if(c.jquery||c.nodeType)c=a(c).css(d),d=b;var i=this,j=a.type(c),o=this._rgba=[],p;d!==b&&(c=[c,d,e,h],j="array");if(j==="string")return this.parse(n(c)||k._default);if(j==="array")return l(g.rgba.props,function(a,b){o[b.idx]=m(c[b.idx],b)}),this;if(j==="object")return c instanceof f?l(g,function(a,b){c[b.cache]&&(i[b.cache]=c[b.cache].slice())}):l(g,function(b,d){var e=d.cache;l(d.props,function(a,b){if(!i[e]&&d.to){if(a==="alpha"||c[a]==null)return;i[e]=d.to(i._rgba)}i[e][b.idx]=m(c[a],b,!0)}),i[e]&&a.inArray(null,i[e].slice(0,3))<0&&(i[e][3]=1,d.from&&(i._rgba=d.from(i[e])))}),this},is:function(a){var b=f(a),c=!0,d=this;return l(g,function(a,e){var f,g=b[e.cache];return g&&(f=d[e.cache]||e.to&&e.to(d._rgba)||[],l(e.props,function(a,b){if(g[b.idx]!=null)return c=g[b.idx]===f[b.idx],c})),c}),c},_space:function(){var a=[],b=this;return l(g,function(c,d){b[d.cache]&&a.push(c)}),a.pop()},transition:function(a,b){var c=f(a),d=c._space(),e=g[d],i=this.alpha()===0?f("transparent"):this,j=i[e.cache]||e.to(i._rgba),k=j.slice();return c=c[e.cache],l(e.props,function(a,d){var e=d.idx,f=j[e],g=c[e],i=h[d.type]||{};if(g===null)return;f===null?k[e]=g:(i.mod&&(g-f>i.mod/2?f+=i.mod:f-g>i.mod/2&&(f-=i.mod)),k[e]=m((g-f)*b+f,d))}),this[d](k)},blend:function(b){if(this._rgba[3]===1)return this;var c=this._rgba.slice(),d=c.pop(),e=f(b)._rgba;return f(a.map(c,function(a,b){return(1-d)*e[b]+d*a}))},toRgbaString:function(){var b="rgba(",c=a.map(this._rgba,function(a,b){return a==null?b>2?1:0:a});return c[3]===1&&(c.pop(),b="rgb("),b+c.join()+")"},toHslaString:function(){var b="hsla(",c=a.map(this.hsla(),function(a,b){return a==null&&(a=b>2?1:0),b&&b<3&&(a=Math.round(a*100)+"%"),a});return c[3]===1&&(c.pop(),b="hsl("),b+c.join()+")"},toHexString:function(b){var c=this._rgba.slice(),d=c.pop();return b&&c.push(~~(d*255)),"#"+a.map(c,function(a,b){return a=(a||0).toString(16),a.length===1?"0"+a:a}).join("")},toString:function(){return this._rgba[3]===0?"transparent":this.toRgbaString()}}),f.fn.parse.prototype=f.fn,g.hsla.to=function(a){if(a[0]==null||a[1]==null||a[2]==null)return[null,null,null,a[3]];var b=a[0]/255,c=a[1]/255,d=a[2]/255,e=a[3],f=Math.max(b,c,d),g=Math.min(b,c,d),h=f-g,i=f+g,j=i*.5,k,l;return g===f?k=0:b===f?k=60*(c-d)/h+360:c===f?k=60*(d-b)/h+120:k=60*(b-c)/h+240,j===0||j===1?l=j:j<=.5?l=h/i:l=h/(2-i),[Math.round(k)%360,l,j,e==null?1:e]},g.hsla.from=function(a){if(a[0]==null||a[1]==null||a[2]==null)return[null,null,null,a[3]];var b=a[0]/360,c=a[1],d=a[2],e=a[3],f=d<=.5?d*(1+c):d+c-d*c,g=2*d-f,h,i,j;return[Math.round(o(g,f,b+1/3)*255),Math.round(o(g,f,b)*255),Math.round(o(g,f,b-1/3)*255),e]},l(g,function(c,e){var g=e.props,h=e.cache,i=e.to,j=e.from;f.fn[c]=function(c){i&&!this[h]&&(this[h]=i(this._rgba));if(c===b)return this[h].slice();var d,e=a.type(c),k=e==="array"||e==="object"?c:arguments,n=this[h].slice();return l(g,function(a,b){var c=k[e==="object"?a:b.idx];c==null&&(c=n[b.idx]),n[b.idx]=m(c,b)}),j?(d=f(j(n)),d[h]=n,d):f(n)},l(g,function(b,e){if(f.fn[b])return;f.fn[b]=function(f){var g=a.type(f),h=b==="alpha"?this._hsla?"hsla":"rgba":c,i=this[h](),j=i[e.idx],k;return g==="undefined"?j:(g==="function"&&(f=f.call(this,j),g=a.type(f)),f==null&&e.empty?this:(g==="string"&&(k=d.exec(f),k&&(f=j+parseFloat(k[2])*(k[1]==="+"?1:-1))),i[e.idx]=f,this[h](i)))}})}),f.hook=function(b){var c=b.split(" ");l(c,function(b,c){a.cssHooks[c]={set:function(b,d){var e,g,h="";if(a.type(d)!=="string"||(e=n(d))){d=f(e||d);if(!i.rgba&&d._rgba[3]!==1){g=c==="backgroundColor"?b.parentNode:b;while((h===""||h==="transparent")&&g&&g.style)try{h=a.css(g,"backgroundColor"),g=g.parentNode}catch(j){}d=d.blend(h&&h!=="transparent"?h:"_default")}d=d.toRgbaString()}try{b.style[c]=d}catch(d){}}},a.fx.step[c]=function(b){b.colorInit||(b.start=f(b.elem,c),b.end=f(b.end),b.colorInit=!0),a.cssHooks[c].set(b.elem,b.start.transition(b.end,b.pos))}})},f.hook(c),a.cssHooks.borderColor={expand:function(a){var b={};return l(["Top","Right","Bottom","Left"],function(c,d){b["border"+d+"Color"]=a}),b}},k=a.Color.names={aqua:"#00ffff",black:"#000000",blue:"#0000ff",fuchsia:"#ff00ff",gray:"#808080",green:"#008000",lime:"#00ff00",maroon:"#800000",navy:"#000080",olive:"#808000",purple:"#800080",red:"#ff0000",silver:"#c0c0c0",teal:"#008080",white:"#ffffff",yellow:"#ffff00",transparent:[null,null,null,0],_default:"#ffffff"}})(jQuery);


  $.MetroBannerCloseAll = function(){
      $(".MetroBannerBox").each(function()
      {   
          CloseMetroBanner($(this));
      });
  }

  
  $.MetroBanner = function (settings,callback){

        settings = $.extend({
            type: undefined,
            title: undefined,
            content: undefined,
            contentarray: undefined,
            contenttimer: 3,
            img: undefined,
            closeimg: "static/img/back.png",
            timeout: undefined,
            position: "top",
            color: "#572080",
            buthovercolor: "#431764",
            colorarray: undefined,
            colortimer: 3,
            closeicon: true,
            pushbody: true,
        }, settings);


        // Some Basic Initialization
        buthovercolor = settings.buthovercolor;
        butleavecolor = settings.color;

        if(settings.content == undefined && settings.contentarray == undefined){

          if( settings.type != "login" ){
              alert("Metro Banner: Content is needed or type:'login' is required");
              return false;  
          }

        }else if( settings.contentarray != undefined ){
            settings.content = settings.contentarray[0];
        }

        if( settings.colorarray != undefined ){
           settings.color = settings.colorarray[0];
        }

        $(".mbtxtUsername").remove();
        $(".mbtxtPassword").remove();

        if( isAnimating ){
          return false;
        }

        isAnimating = true;
        setTimeout(function() {isAnimating = false;}, 320);

        if( mbIsOpen ){

            $.MetroBannerCloseAll();
            setTimeout(function() {
              mbIsOpen = true;
              CreateMetroBanner(settings,callback);
            }, 320);

        }else{
            mbIsOpen = true;
            CreateMetroBanner(settings,callback);
        }
        
        

    }

    function CreateMetroBanner(settings,callback){

        mbCounter += 1;
      
       // Check if the user wants a login UI
        if( settings.type == "login"){
           var LoginContent  = '<form class="mbLoginForm"><input type="text" class="mbtxtUsername" name="mbtxtUsername" placeholder="Username">';
               LoginContent += '<input type="password" class="mbtxtPassword" name="mbtxtPassword" placeholder="Password">';
               LoginContent += '<button class="mbbutLogIng" style="background-color: '+ settings.color +';">Login</button>';
               LoginContent += '</form>';

            settings.content = LoginContent;
        }

        var mbID    = "MetroBanner" + mbCounter;
        var content = "";

        // If Top or Buttom... else right or left
        if( settings.position == "top" || settings.position == "bottom"){

          content +=  '<div id="'+ mbID +'" class="MetroBannerBox mb'+ settings.position + '" align="center" data-pushbody="'+ settings.pushbody +'" data-position="'+ settings.position +'" style="background-color:'+ settings.color +';">';
          content +=    '<table class="mbTableContainer">';
          content +=      '<tr>';
          content +=        '<td class="mbW35l">';

          if( settings.img != undefined){
            content +=          '<img src="'+ settings.img +'" class="mbIcon">';
          }

          content +=         '</td>';
          content +=        '<td align="center">';

          if( settings.title != undefined ){
            content +=          '<span class="mbTitle">';
            content +=              settings.title; 
            content +=          '</span>';
          }

          content +=          '<span class="mbContent">';
          content +=            settings.content;
          content +=          '</span>';
          content +=        '</td>';
          content +=        '<td class="mbW35r"><i class="iCloseButton"></i>';

          if( settings.closeicon ){
              content +=          '<img src="'+ settings.closeimg +'" class="mbClose" data-closeid="'+ mbID +'">';
          }

          content +=         '</td>';
          content +=       '</tr> ';
          content +=     '</table>';
          content +=   '</div>';


        }else{ 
          // Right or Left Position
          content +=  '<div id="'+ mbID +'" class="MetroBannerBox mb'+ settings.position + '" align="center" data-pushbody="'+ settings.pushbody +'" data-position="'+ settings.position +'" style="background-color:'+ settings.color +';">';
          
          if( settings.closeicon ){
              content +=  '<img src="'+ settings.closeimg +'" class="mbClose" data-closeid="'+ mbID +'"><i class="iCloseButton"></i>';
          }
          
          content +=    '<table class="mbTableHeightContainer">';
          content +=      '<tr>';
          content +=        '<td align="center">';
          
          if( settings.title != undefined ){
            content +=          '<span class="mbTitle">';
            content +=              settings.title; 
            content +=          '</span>';
          }

          content +=          '<span class="mbContent">';
          content +=            settings.content;
          content +=           '</span>';

          if( settings.img != undefined){
            content +=          '<img src="'+ settings.img +'" class="mbIconLeftRight">';
          }

          content +=         '</td>';
          content +=       '</tr>';
          content +=     '</table>';
          content +=   '</div>';


        }

        if( settings.pushbody === false || settings.position != "top" ){
          $("body").removeAttr("style");
        }

        $("body").append(content);
        var MetroBanner = $("#"+mbID);


        // Timeout function
        if( settings.timeout !=undefined){
            
            clearInterval(TiemOutInterval);
            TiemOutInterval = setTimeout(function() {
                  
              console.log( MetroBanner.attr("data-mouseover") );

                if( MetroBanner.attr("data-mouseover") == "yes"){
                    MetroBanner.attr("data-closeafter","yes");
                }else{
                    $.MetroBannerCloseAll();
                }

            }, settings.timeout * 1000);
        }



        clearInterval(TextInterval);
        clearInterval(ColorInterval);


        var mbContent = $(".mbContent");

        if( settings.contentarray != undefined){
            //contenttimer
            var Current = 1;
            TextInterval = setInterval(function(){
              
            // Prevent change text on mouse over
            if(mbContent.attr("data-mouseover") == undefined ){
                if( Current > settings.contentarray.length-1){
                    Current = 0;
                  }

                var NewText = settings.contentarray[Current]; 

                mbContent.animate({
                    "opacity":0
                },200,function(){

                    mbContent.html( NewText ); 
                    mbContent.animate({"opacity":1},200);

                });
                Current += 1;
            }// End is Mouse Over


            }, (settings.contenttimer*1000) );
        } // End Content Array

        // Color Array
        if( settings.colorarray != undefined){
            var CurrentColor = 1;
            ColorInterval = setInterval(function(){
              
            // Prevent change text on mouse over
            if( CurrentColor > settings.colorarray.length-1){
                CurrentColor = 0;
              }

            var NewColor = settings.colorarray[CurrentColor]; 

            $(".MetroBannerBox").animate({
                backgroundColor:NewColor
            },1000);
            CurrentColor += 1;


            }, (settings.colortimer*1000) );
        } // End Content Array



        MetroBanner.find(".iCloseButton").bind("click",function(){

          // Launch Callback
          if (typeof callback == "function"){   
              if(callback) callback("close");
          }

          CloseMetroBanner(MetroBanner);

        });

        if( settings.type == "login" ){


          MetroBanner.find(".mbLoginForm").bind("submit", function(e){

              var User = $(".mbtxtUsername").val();
              var Pass = $(".mbtxtPassword").val();

              if(User.length == 0){
                  $(".mbtxtUsername").focus();
                  return false;
              }

              if(Pass.length == 0){
                  $(".mbtxtPassword").focus();
                  return false;
              }

              // Launch Callback
              if (typeof callback == "function"){   
                  if(callback) callback("login",User, Pass);
              }

              e.preventDefault();
          });

        }


        var MetroBannerHeight = MetroBanner.outerHeight(true);
        var MetroBannerWidth  = MetroBanner.outerWidth(true);


        // In Animations
        if( settings.pushbody ){

            switch(settings.position){
                case "top":
                    MetroBanner.css("top","-"+ (MetroBannerHeight) +"px");
                    TweenLite.to("body", 0.270, {top: MetroBannerHeight+"px", ease:Power1.easeInOut});
                    TweenLite.to(MetroBanner, 0.320, {top: "0px", autoAlpha:1, ease:Power4.easeInOut});
                break;

                case "bottom":
                    MetroBanner.css("bottom", "-"+MetroBannerHeight +"px");
                    TweenLite.to("body", 0.270, {top: "-"+MetroBannerHeight+"px", ease:Power1.easeInOut});
                    TweenLite.to(MetroBanner, 0.320, { y:"-"+MetroBannerHeight, autoAlpha:1, ease:Power2.easeOut});
                break;

                case "right":
                    MetroBanner.css("right", "-"+ MetroBannerWidth +"px");
                    TweenLite.to("body", 0.270, {left: "-"+MetroBannerWidth+"px", ease:Power1.easeInOut});
                    TweenLite.to(MetroBanner, 0.320, { x: "-="+MetroBannerWidth, autoAlpha:1, ease:Power2.easeOut});
                break;

                case "left":
                    MetroBanner.css("left", "-"+ MetroBannerWidth +"px");
                    TweenLite.to("body", 0.270, {right: "-"+MetroBannerWidth+"px", ease:Power1.easeInOut});
                    TweenLite.to(MetroBanner, 0.320, { x: "+="+MetroBannerWidth, autoAlpha:1, ease:Power2.easeOut});
                break;
            }

        }else{
            // Do not push body
            switch(settings.position){
                case "top":
                    MetroBanner.css("top","-"+ (MetroBannerHeight) +"px");
                    TweenLite.to(MetroBanner, 0.320, {top: "0px", autoAlpha:1, ease:Power2.easeOut});
                break;

                case "bottom":
                    MetroBanner.css("bottom", "-"+MetroBannerHeight +"px");
                    TweenLite.to(MetroBanner, 0.320, { y:"-"+MetroBannerHeight, autoAlpha:1, ease:Power2.easeOut});
                break;

                case "right":
                    MetroBanner.css("right", "-"+ MetroBannerWidth +"px");
                    TweenLite.to(MetroBanner, 0.320, { x: "-="+MetroBannerWidth, autoAlpha:1, ease:Power2.easeOut});
                break;

                case "left":
                    MetroBanner.css("left", "-"+ MetroBannerWidth +"px");
                    TweenLite.to(MetroBanner, 0.320, { x: "+="+MetroBannerWidth, autoAlpha:1, ease:Power2.easeOut});
                break;
            }
        }


    }





    $(document).ready(function(){
        $("body").on("click",".mbClose",function(){
            
            var MetroBannerID = $(this).attr("data-closeid");
            var MetroBanner   = $("#" + MetroBannerID);

            MetroBanner.find(".iCloseButton").click();
        });

        $("body").on("mouseover",".mbContent",function(){
            $(this).attr("data-mouseover","yes");
        });

        $("body").on("mouseout",".mbContent",function(){
            $(this).removeAttr("data-mouseover");
        });

        $("body").on("mouseover",".MetroBannerBox",function(){
            $(this).attr("data-mouseover","yes");
        });

        $("body").on("mouseleave",".MetroBannerBox",function(){
            $(this).removeAttr("data-mouseover");

            if( $(this).attr("data-closeafter")== "yes"){
                CloseMetroBanner( $(this) );
            }
        });

        $("body").on("mouseover",".mbbutLogIng",function(){
            $(this).css("background-color", buthovercolor);
        });

        $("body").on("mouseout",".mbbutLogIng",function(){
            $(this).css("background-color", butleavecolor);
        });

    });
    
    // Closing rutine
    function CloseMetroBanner(MetroBanner){


      var PushBody = MetroBanner.attr("data-pushbody");
      var Position = MetroBanner.attr("data-position");

      var MetroBannerHeight = MetroBanner.outerHeight(true);
      var MetroBannerWidth  = MetroBanner.outerWidth(true);

      clearInterval(TextInterval);
      clearInterval(ColorInterval);


      if( PushBody == "true"){

        switch(Position){
                case "top":
                    TweenLite.to("body", 0.270, {top: "-="+MetroBannerHeight, ease:Power1.easeInOut, onComplete:DestroyMetroBaner });
                    TweenLite.to(MetroBanner, 0.320, {top: "0px", autoAlpha:0, ease:Power2.easeOut});
                break;

                case "bottom":

                    TweenLite.to("body", 0.270, {top: "0px", ease:Power1.easeInOut});
                    TweenLite.to(MetroBanner, 0.320, { bottom:"-="+ MetroBannerHeight +"px", autoAlpha:0, ease:Power2.easeOut});
                break;

                case "right":

                    TweenLite.to("body", 0.270, {left: "0px", ease:Power1.easeInOut});
                    TweenLite.to(MetroBanner, 0.320, { right: "-="+MetroBannerWidth, autoAlpha:0, ease:Power2.easeOut});
                break;

                case "left":

                    TweenLite.to("body", 0.270, {right: "0px", ease:Power1.easeInOut});
                    TweenLite.to(MetroBanner, 0.320, { left: "-="+MetroBannerWidth, autoAlpha:0, ease:Power2.easeOut});
                break;
            }

      }else{

        switch(Position){
                case "top":
                    TweenLite.to(MetroBanner, 0.320, {top: "-="+ MetroBannerHeight +"px", autoAlpha:0, ease:Power2.easeOut});
                break;
                case "bottom":
                    TweenLite.to(MetroBanner, 0.320, { bottom:"-="+ MetroBannerHeight +"px", autoAlpha:0, ease:Power2.easeOut});
                break;
                case "right":
                    TweenLite.to(MetroBanner, 0.320, { right: "-="+MetroBannerWidth, autoAlpha:0, ease:Power2.easeOut});
                break;
                case "left":
                    TweenLite.to(MetroBanner, 0.320, { left: "-="+MetroBannerWidth, autoAlpha:0, ease:Power2.easeOut});
                break;
            }

      }



            
      };

      function DestroyMetroBaner(){
          $(".MetroBannerBox").remove();
          isAnimating = false;
          mbIsOpen    = false;
      }


})(jQuery);