var N=Object.defineProperty;var f=Object.getOwnPropertySymbols;var _=Object.prototype.hasOwnProperty,B=Object.prototype.propertyIsEnumerable;var E=(a,u,t)=>u in a?N(a,u,{enumerable:!0,configurable:!0,writable:!0,value:t}):a[u]=t,p=(a,u)=>{for(var t in u||(u={}))_.call(u,t)&&E(a,t,u[t]);if(f)for(var t of f(u))B.call(u,t)&&E(a,t,u[t]);return a};import{r as m,R as e,a as D}from"./vendor.ea656ce4.js";const b=function(){const u=document.createElement("link").relList;if(u&&u.supports&&u.supports("modulepreload"))return;for(const n of document.querySelectorAll('link[rel="modulepreload"]'))s(n);new MutationObserver(n=>{for(const o of n)if(o.type==="childList")for(const c of o.addedNodes)c.tagName==="LINK"&&c.rel==="modulepreload"&&s(c)}).observe(document,{childList:!0,subtree:!0});function t(n){const o={};return n.integrity&&(o.integrity=n.integrity),n.referrerpolicy&&(o.referrerPolicy=n.referrerpolicy),n.crossorigin==="use-credentials"?o.credentials="include":n.crossorigin==="anonymous"?o.credentials="omit":o.credentials="same-origin",o}function s(n){if(n.ep)return;n.ep=!0;const o=t(n);fetch(n.href,o)}};b();const v="/api";async function C(a,u,t="47_19"){const[s,n]=t.split("_");a.length>250&&(alert("\u0414\u043B\u0438\u043D\u0430 \u0442\u0435\u043A\u0441\u0442 \u043D\u0435 \u0434\u043E\u043B\u0436\u043D\u0430 \u043F\u0440\u0435\u0432\u044B\u0448\u0430\u0442\u044C 250 \u0441\u0438\u043C\u0432\u043E\u043B\u043E\u0432. \u0423 \u0412\u0430\u0441 "+a.length),a=a.substring(0,250));const o=new FormData;o.set("text",a),o.set("voice",s),o.set("model",n);const l=await(await fetch(u+"/getaudio",{method:"POST",body:o})).blob(),r=new FileReader;r.readAsDataURL(l),r.onload=()=>{const i=new Audio;i.src=r.result,i.autoplay=!0}}async function w(a){return await(await fetch(a+"/answers/random")).json()}const x=({id:a,atext:u,complexity:t})=>{const[s,n]=m.exports.useState(!1),o=t<1?"\u0431\u0430\u043B\u043B\u0430":"\u0431\u0430\u043B\u043B",c=l=>{const r=l.target,i=l.target.dataset.action,y=document.getElementById("voice_type").value;if(i==="speak"){const d=r.dataset.text,g=r.dataset.complexity;console.log(d),n(!0);const h=`\u0421\u043B\u043E\u0436\u043D\u043E\u0441\u0442\u044C: ${g} ${o}. ${d}`;C(h,v,y).then(()=>{n(!1)})}};return e.createElement("div",{className:"card QuestionCard",id:"card_"+a,onClick:c},e.createElement("div",{className:"card-content"},e.createElement("div",{className:"content"},u)),e.createElement("footer",{className:"card-footer"},e.createElement("a",{href:"#none",className:"card-footer-item"},"\u0421\u043B\u043E\u0436\u043D\u043E\u0441\u0442\u044C: ",t," ",o," "),e.createElement("a",{href:"#none",className:"card-footer-item","data-action":"speak","data-text":u,"data-complexity":t},s?"\u0417\u0430\u0433\u0440\u0443\u0436\u0430\u0435\u0442\u0441\u044F":"\u041E\u0437\u0432\u0443\u0447\u0438\u0442\u044C")))},k={background:"black",color:"white",position:"sticky",top:0,zIndex:100};function A(){const[a,u]=m.exports.useState([]);return m.exports.useEffect(()=>{w(v).then(t=>u(t))},[]),e.createElement(e.Fragment,null,e.createElement("section",{className:"section py-4",style:k},e.createElement("div",{className:"container is-fullhd"},e.createElement("div",{className:"columns"},e.createElement("div",{className:"column"},e.createElement("h1",{className:"title has-text-light is-size-4"},"\u0413\u0435\u043D\u0435\u0440\u0430\u0442\u043E\u0440 \u0432\u043E\u043F\u0440\u043E\u0441\u043E\u0432")),e.createElement("div",{className:"column is-flex is-justify-content-end"},e.createElement("div",{className:"select"},e.createElement("select",{id:"voice_type"},e.createElement("option",{value:"51_14"},"\u0415\u043B\u0435\u043D\u0430"),e.createElement("option",{value:"132_55"},"\u0414\u0435\u0434 \u041C\u043E\u0440\u043E\u0437"),e.createElement("option",{value:"8_12"},"\u0422\u0430\u0442\u044C\u044F\u043D\u0430"),e.createElement("option",{defaultValue:!0,value:"47_19"},"\u0412\u0430\u043B\u0435\u0440\u0438\u0439"),e.createElement("option",{value:"48_13"},"\u0410\u043D\u0434\u0440\u0435\u0439"),e.createElement("option",{value:"70_54"},"\u0414\u0435\u0432\u043E\u0447\u043A\u0430"),e.createElement("option",{value:"49_18"},"\u0421\u0430\u0432\u0435\u043B\u0438\u0439"),e.createElement("option",{value:"126_59"},"\u041B\u0435\u043D\u0438\u043D"),e.createElement("option",{value:"15_17"},"\u0420\u043E\u043C\u0430\u043D"))))))),e.createElement("section",{className:"section"},e.createElement("div",{className:"container is-fullhd"},e.createElement("div",{className:"columns is-multiline"},a.map(t=>e.createElement("div",{className:"column is-4",key:t.id},e.createElement(x,p({},t))))))))}D.render(e.createElement(e.StrictMode,null,e.createElement(A,null)),document.getElementById("root"));
