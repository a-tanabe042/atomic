"use strict";(self.webpackChunkadmin_dashboard_template_dashwind=self.webpackChunkadmin_dashboard_template_dashwind||[]).push([[671],{8671:(o,e,t)=>{t.r(e),t.d(e,{default:()=>r});var a=t(2791),i=t(184);const r=function(){const o="https://api.frivo-online.net",[e,t]=(0,a.useState)(!0),[r,n]=(0,a.useState)("");(0,a.useEffect)((()=>{(async()=>{t(!0);const o=new URLSearchParams(window.location.search).get("id_token"),e=new URLSearchParams(window.location.search).get("access_token");if(console.log("idToken:",o),console.log("accessToken:",e),o&&e){localStorage.setItem("id_token",o),localStorage.setItem("access_token",e);try{await s(e),window.location.href="/app/welcome"}catch(a){n("\u30d7\u30ed\u30d5\u30a3\u30fc\u30eb\u306e\u53d6\u5f97\u306b\u5931\u6557\u3057\u307e\u3057\u305f\u3002"),window.location.href="/login"}}else n("\u8a8d\u8a3c\u60c5\u5831\u304c\u4e0d\u8db3\u3057\u3066\u3044\u307e\u3059\u3002"),window.location.href="/login";t(!1)})()}),[]);const s=async o=>{try{const e=await fetch("https://www.googleapis.com/oauth2/v2/userinfo",{headers:{Authorization:"Bearer ".concat(o)}});if(!e.ok)throw new Error("Failed to fetch Google profile");{const o=await e.json();console.log("Google Profile:",o),await c(o)}}catch(r){console.error("Error fetching Google profile:",r)}},c=async e=>{try{const t=await fetch("".concat(o,"/api/user-saltos?google_id=").concat(e.id));if(!t.ok)throw new Error("Failed to check if user exists");const a=await t.json();if(a&&a.length>0){const t=a[0].id,i=await fetch("".concat(o,"/api/user-saltos/").concat(t),{method:"PUT",headers:{"Content-Type":"application/json"},body:JSON.stringify({data:{email:e.email,verified_email:e.verified_email.toString(),picture:e.picture,hd:e.hd}})});if(!i.ok){const o=await i.json();throw console.error("Error updating profile in Strapi:",o),new Error("Failed to update profile in Strapi")}}else try{const t=await fetch("".concat(o,"/api/user-saltos"),{method:"POST",headers:{"Content-Type":"application/json"},body:JSON.stringify({data:{google_id:e.id,email:e.email,verified_email:e.verified_email.toString(),picture:e.picture,hd:e.hd}})});if(!t.ok){const o=await t.json();throw console.error("Error saving profile to Strapi:",o),new Error("Failed to save profile to Strapi")}const a=await t.json();console.log("Profile saved to Strapi:",a)}catch(r){console.error("Error saving profile to Strapi:",r)}}catch(r){console.error("Error handling profile in Strapi:",r)}};return e?(0,i.jsx)("div",{children:"Loading..."}):r?(0,i.jsxs)("div",{children:["Error: ",r]}):(0,i.jsx)("div",{children:"Loading..."})}}}]);
//# sourceMappingURL=671.c3d85946.chunk.js.map