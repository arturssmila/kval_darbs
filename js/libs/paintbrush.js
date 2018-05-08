function processFilters(){var e=document.createElement("canvas"),t=e.getContext("2d");supports_canvas()&&(addFilter("filter-blur",e,t),addFilter("filter-edges",e,t),addFilter("filter-emboss",e,t),addFilter("filter-greyscale",e,t),addFilter("filter-matrix",e,t),addFilter("filter-mosaic",e,t),addFilter("filter-noise",e,t),addFilter("filter-posterize",e,t),addFilter("filter-sepia",e,t),addFilter("filter-sharpen",e,t),addFilter("filter-tint",e,t))}function addFilter(e,t,r){function i(e,t,r,i,o,s,f){var l=i[o],c=e+"-"+o;if(f.width=s.width=t.width,f.height=s.height=t.height,t&&f){var u=initializeBuffer(f,t);if(u){if("filter-blur"==e&&(u=gaussianBlur(t,u,r.blurAmount)),"filter-edges"==e){var d=[0,1,0,1,-4,1,0,1,0];u=n(t,u,d,r.edgesAmount)}if("filter-emboss"==e){var d=[-2,-1,0,-1,1,1,0,1,2];u=n(t,u,d,r.embossAmount)}if("filter-matrix"==e){var d=[.111,.111,.111,.111,.111,.111,.111,.111,.111];u=n(t,u,d,r.matrixAmount)}if("filter-sharpen"==e){var d=[-1,-1,-1,-1,9,-1,-1,-1,-1];u=n(t,u,d,r.sharpenAmount)}if("filter-tint"==e)var m=parseInt(createColor(r.tintColor),16),g={r:(16711680&m)>>16,g:(65280&m)>>8,b:255&m};if("filter-blur"!=e&&"filter-emboss"!=e&&"filter-matrix"!=e&&"filter-sharpen"!=e)for(var p=0,h=u.data,b=h.length;b>>2>p;p++){var v=p<<2,y={r:h[v],g:h[v+1],b:h[v+2]};u=a(e,r,t,u,v,y,g)}f.putImageData(u,0,0),stashOriginal(t,c,l,s)}}}function a(e,t,r,i,a,n,o){var l,c=i.data,u=r.width;switch(e){case"filter-greyscale":l=.21*n.r+.71*n.g+.07*n.b,c=setRGB(c,a,findColorDifference(t.greyscaleOpacity,l,n.r),findColorDifference(t.greyscaleOpacity,l,n.g),findColorDifference(t.greyscaleOpacity,l,n.b));break;case"filter-mosaic":var d=a>>2,m=Math.floor(d/u),g=m%t.mosaicSize,p=d-m*u,h=p%t.mosaicSize;g&&(d-=g*u),h&&(d-=h),d<<=2,c=setRGB(c,a,findColorDifference(t.mosaicOpacity,c[d],n.r),findColorDifference(t.mosaicOpacity,c[d+1],n.g),findColorDifference(t.mosaicOpacity,c[d+2],n.b));break;case"filter-noise":l=s(t.noiseAmount),c="mono"==t.noiseType||"monochrome"==t.noiseType?setRGB(c,a,f(n.r+l),f(n.g+l),f(n.b+l)):setRGB(c,a,f(n.r+s(t.noiseAmount)),f(n.g+s(t.noiseAmount)),f(n.b+s(t.noiseAmount)));break;case"filter-posterize":c=setRGB(c,a,findColorDifference(t.posterizeOpacity,parseInt(t.posterizeValues*parseInt(n.r/t.posterizeAreas)),n.r),findColorDifference(t.posterizeOpacity,parseInt(t.posterizeValues*parseInt(n.g/t.posterizeAreas)),n.g),findColorDifference(t.posterizeOpacity,parseInt(t.posterizeValues*parseInt(n.b/t.posterizeAreas)),n.b));break;case"filter-sepia":c=setRGB(c,a,findColorDifference(t.sepiaOpacity,.393*n.r+.769*n.g+.189*n.b,n.r),findColorDifference(t.sepiaOpacity,.349*n.r+.686*n.g+.168*n.b,n.g),findColorDifference(t.sepiaOpacity,.272*n.r+.534*n.g+.131*n.b,n.b));break;case"filter-tint":c=setRGB(c,a,findColorDifference(t.tintOpacity,o.r,n.r),findColorDifference(t.tintOpacity,o.g,n.g),findColorDifference(t.tintOpacity,o.b,n.b))}return i}function n(e,t,i,a){var n=document.createElement("canvas"),s=n.getContext("2d");s.width=n.width=e.width,s.height=n.height=e.height,s.drawImage(e,0,0,e.width,e.height);for(var f=s.getImageData(0,0,r.width,r.height),l=t.data,c=f.data,u=e.width,d=Math.sqrt(i.length),m=Math.floor(d/2),g=1;u-1>g;g++)for(var p=1;p<e.height-1;p++){for(var h=sumG=sumB=0,b=0;d>b;b++)for(var v=0;d>v;v++){var y=o(g+v-m,p+b-m,u)<<2,C={r:c[y],g:c[y+1],b:c[y+2]};h+=C.r*i[v+b*d],sumG+=C.g*i[v+b*d],sumB+=C.b*i[v+b*d]}var A=o(g,p,u)<<2,w={r:l[A],g:l[A+1],b:l[A+2]};l=setRGB(l,A,findColorDifference(a,h,w.r),findColorDifference(a,sumG,w.g),findColorDifference(a,sumB,w.b))}return t}function o(e,t,r){return e+t*r}function s(e){return Math.floor((e>>1)-Math.random()*e)}function f(e){return 0>e?0:e>255?255:e}var l=getElementsByClassName(e.toLowerCase());for(var c in l){var u=getFilterParameters(l[c]),d=getReferenceImage(l[c]);d.onLoad=i(e,d,u,l,c,t,r)}}function getFilterParameters(e){var t={blurAmount:1,edgesAmount:1,embossAmount:.25,greyscaleOpacity:1,matrixAmount:1,mosaicOpacity:1,mosaicSize:5,noiseAmount:30,noiseType:"mono",posterizeAmount:5,posterizeOpacity:1,sepiaOpacity:1,sharpenAmount:.25,tintColor:"#FFF",tintOpacity:.3};for(var r in t){var i=r.replace(/([A-Z])/g,function(e,t){return"-"+t.toLowerCase()}),a=e.getAttribute("data-pb-"+i);a&&(t[r]=a)}return t.tintColor=e.getAttribute("data-pb-tint-colour")||t.tintColor,t.posterizeAreas=256/t.posterizeAmount,t.posterizeValues=255/(t.posterizeAmount-1),t}function initializeBuffer(e,t){if(e.clearRect(0,0,e.width,e.height),t.width>0&&t.height>0)try{return e.drawImage(t,0,0,t.width,t.height),e.getImageData(0,0,e.width,e.height)}catch(r){}}function createColor(e){return e=e.replace(/^#/,""),3==e.length&&(e=e.replace(/(.)/g,"$1$1")),e}function findColorDifference(e,t,r){return e*t+(1-e)*r}function setRGB(e,t,r,i,a){return e[t]=r,e[t+1]=i,e[t+2]=a,e}function getReferenceImage(e){if("IMG"==e.nodeName)return e;var t=window.getComputedStyle(e,null).backgroundImage;if(t){var r=new Image;return r.src=t.replace(/['"]/g,"").slice(4,-1),r}return!1}function placeReferenceImage(e,t,r){"IMG"==e.nodeName?r.src=t:e.style.backgroundImage="url("+t+")"}function addAttribute(e,t,r){var i=document.createAttribute(t);return i.nodeValue=r,e.setAttributeNode(i)}function flushDataAttributes(e){for(var t=0;t<e.attributes.length;t++){var r=e.attributes[t].name;"data-pb-"==r.substr(0,8)&&e.removeAttribute(r)}}function removeClasses(e){for(var t=e.className.toLowerCase().split(" "),r=0;r<t.length;r++)"filter-"==t[r].substr(0,7)&&removeClass(e,t[r])}function destroyStash(e,t){for(var r=e.className.toLowerCase().split(" "),i=0;i<r.length;i++){var a=r[i];if("pb-ref-"==a.substr(0,7)){var n=document.getElementById("pb-original-"+a.substr(7,a.length-7));t&&(e.src=n.src),removeClass(e,a),d=document.body,throwaway=d.removeChild(n)}}}function stashOriginal(e,t,r,i){var a=stashInDom(e,t);placeReferenceImage(r,i.toDataURL("image/png"),e),a&&(r.className+=" pb-ref-"+t)}function stashInDom(e,t){var r="pb-original-"+t;if(document.getElementById(r))return!1;var i=document.createElement("img");return i.src=e.src,i.id=r,i.style.display="none",document.body.appendChild(i),!0}addLoadEvent(function(){processFilters()});