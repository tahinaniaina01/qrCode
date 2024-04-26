(function(){const r=document.createElement("link").relList;if(r&&r.supports&&r.supports("modulepreload"))return;for(const e of document.querySelectorAll('link[rel="modulepreload"]'))t(e);new MutationObserver(e=>{for(const s of e)if(s.type==="childList")for(const i of s.addedNodes)i.tagName==="LINK"&&i.rel==="modulepreload"&&t(i)}).observe(document,{childList:!0,subtree:!0});function o(e){const s={};return e.integrity&&(s.integrity=e.integrity),e.referrerPolicy&&(s.referrerPolicy=e.referrerPolicy),e.crossOrigin==="use-credentials"?s.credentials="include":e.crossOrigin==="anonymous"?s.credentials="omit":s.credentials="same-origin",s}function t(e){if(e.ep)return;e.ep=!0;const s=o(e);fetch(e.href,s)}})();const a="http://localhost:8888";let l="respo",p=new Html5QrcodeScanner("reader",{fps:10,qrbox:250});p.render(m);document.querySelector("#reader").style.border="none";async function m(n){let r=n.split(""),o="";r.map(e=>{o+=/[a-zA-Z0-9:]/.test(e)?e:""}),r=o,console.log(o),p.clear(),d(!0);let t;y();try{if(h(r)){const e={mac:r};t=await c(`${a}/recupe_qrcode.php`,e),console.log(t),l==="respo"&&u(t)}else if(v(r)){const e={id:r};t=await c(`${a}/recupe_qrcode.php`,e),console.log(t),l==="respo"&&u(t)}else g()}catch{t={error:{message:"il y a un erreur lors de l'envoi ou récupération du données"}},alert(t.error.message),f()}document.querySelector(".presence")&&document.querySelector(".presence").addEventListener("click",s=>{t=b(s,r),s.currentTarget.innerHTML=t?"OK":"ERROR"}),d(!1)}async function c(n="",r={}){return(await fetch(n,{method:"POST",headers:{"Content-Type":"application/json"},body:JSON.stringify(r)})).json()}function d(n){const r=document.querySelector(".container-loading");n?r.style.display="flex":r.style.display="none"}function h(n){return!!/^([0-9a-f]{2}:){5}[0-9a-f]{2}$/.test(n)}function v(n){return!!/^[A-Z]+\d+20\d{2}20\d{2}$/.test(n)}function y(){reader=document.querySelector("#reader"),reader.remove()}function u(n){const r=document.querySelector(".container"),o=n.nom,t=n.prenom,e=n.grade,s=n.statut;s==="impossible"?r.innerHTML=`
            <div class="presence-box">
                <div class="container-square">
                    <span class="square1"></span>
                    <span class="square2"></span>
                </div>
                <h1 class="invalide" style="background-color: #fff; text-align: center;">Vous ne pouvez plus faire de retrait aujourd'hui</h1>
                <button class="presence" style="margin-top: 50px;text-align: center" onclick="">OK</button>
            </div>
        `:r.innerHTML=`
        <div class="presence-box">
            <div class="container-square">
                <span class="square1"></span>
                <span class="square2"></span>
            </div>
            <div class="container-image"></div>
            <div class="container-information">
                <div class="container-info">
                    <h3>Nom : ${o}</h3>
                    <h3>Prénom : ${t}</h3>
                    <h3>Grade : ${e}</h3>
                </div>
                <button class="presence">${s||"Impossible"}</button>
            </div>
        </div>
    `}function g(){const n=document.querySelector(".container");n.innerHTML=`
        <div class="presence-box">
            <div class="container-square">
                <span class="square1"></span>
                <span class="square2"></span>
            </div>
            <h1>QRCODE INVALIDE</h1>
            <button class="presence">OK</button>
        </div>
    `}async function b(n,r){let o,t;const e=n.currentTarget.innerText;return e==="Presence"?(o={state:n.currentTarget.innerText,id:r},n.currentTarget.innerHTML=`
      <div class="loader-button"></div>
    `,t=await c(`${a}/Presence_etudiant.php`,o)):e==="Retrait"||e==="Remise"?(o={state:e,mac:r},n.currentTarget.innerHTML=`
      <div class="loader-button"></div>
    `,t=await c(`${a}/PresensePC.php`,o)):f(),t}function f(){window.location.reload(!0)}
