"use strict";(self.webpackChunkadmin_dashboard_template_dashwind=self.webpackChunkadmin_dashboard_template_dashwind||[]).push([[979],{7735:(e,t,a)=>{a.d(t,{Z:()=>h});var s=a(2791),n=a(2782);const r=a.p+"static/media/html-5.6e930594286d8afe4c79.png",i=a.p+"static/media/css-3.d1a3c1e59ca82dbdf815.png",l=a.p+"static/media/js.3dfb665e058d08c99f28.png",o=a.p+"static/media/mysql.7d8d571e5629923eaf74.png";var c=a(184);const d=e=>{let{languages:t}=e;const[a,n]=(0,s.useState)(!1),d=e=>{switch(e.toLowerCase()){case"html":return r;case"css":return i;case"javascript":return l;case"mysql":return o;default:return"https://reqres.in/img/faces/1-image.jpg"}};return(0,c.jsx)("div",{className:"flex",onClick:()=>{n(!a)},children:t.map(((e,t)=>(0,c.jsx)("img",{className:"w-16 h-16 p-1 ".concat(a?"mr-6":"mr-0"," rounded-lg shadow-sm ").concat(0!==t?"-ml-6":"ml-0"," object-cover"),src:d(e),alt:"Avatar ".concat(e),style:{minWidth:"64px",minHeight:"64px"}},t)))})},m=[{language:["Html","Css","JavaScript"],category:"\u65b0\u5352\u7814\u4fee",problem_description:"\u30d5\u30ed\u30f3\u30c8\u30a8\u30f3\u30c9\u521d\u7d1a\u8b1b\u5ea7",problem_count:10,status:"\u53d7\u8b1b\u6e08",like_count:3,name:"Salto\u304f\u3093",avatar:"/test.png",parameter:"3rC70BJiCJsX"},{language:["MySql"],category:"\u65b0\u5352\u7814\u4fee",problem_description:"MySql\u521d\u7d1a\u8b1b\u5ea7",problem_count:10,status:"\u672a\u53d7\u8b1b",like_count:3,name:"Salto\u304f\u3093",avatar:"/test.png",parameter:"NDn4EaQP57el"}];const h=function(){const e={NODE_ENV:"production",PUBLIC_URL:"",WDS_SOCKET_HOST:void 0,WDS_SOCKET_PATH:void 0,WDS_SOCKET_PORT:void 0,FAST_REFRESH:!0,REACT_APP_API_URL:"https://frivo-online.net",REACT_APP_API_HOST:"https://api.frivo-online.net"}.REACT_APP_CODE_API_URL,[t]=(0,s.useState)(m),a=function(e){let t=arguments.length>2&&void 0!==arguments[2]&&arguments[2],a=arguments.length>3&&void 0!==arguments[3]&&arguments[3];return arguments.length>1&&void 0!==arguments[1]&&arguments[1]?(0,c.jsx)("div",{className:"badge badge-ghost badge-lg",children:e}):t?(0,c.jsx)("button",{className:"btn btn-success text-lg font-bold  shadow-lg text-white btn-md transition duration-150 ease-in-out transform hover:scale-110 focus:outline-none focus:ring focus:ring-green-300 w-full",children:e}):a?(0,c.jsx)("div",{className:"badge badge-ghost badge-lg font-bold text-2xl",children:e}):"\u672a\u53d7\u8b1b"===e?(0,c.jsx)("div",{className:"badge badge-ghost badge-lg",children:e}):"\u53d7\u8b1b\u4e2d"===e?(0,c.jsx)("div",{className:"badge badge-secondary badge-lg text-white",children:e}):"\u53d7\u8b1b\u6e08"===e?(0,c.jsx)("div",{className:"badge badge-primary badge-lg text-white",children:e}):"\u65b0\u5352\u7814\u4fee"===e?(0,c.jsx)("div",{className:"badge badge-ghost badge-lg",children:e}):(0,c.jsx)("div",{className:"badge badge-ghost",children:e})};return(0,c.jsx)(c.Fragment,{children:(0,c.jsx)(n.Z,{title:"Problems",topMargin:"mt-2",children:(0,c.jsx)("div",{className:"overflow-x-auto w-full",children:(0,c.jsxs)("table",{className:"table w-full",children:[(0,c.jsx)("thead",{children:(0,c.jsxs)("tr",{className:"text-center",children:[(0,c.jsx)("th",{children:"\u8a00\u8a9e"}),(0,c.jsx)("th",{children:"\u30ab\u30c6\u30b4\u30ea"}),(0,c.jsx)("th",{children:"\u30bf\u30a4\u30c8\u30eb"}),(0,c.jsx)("th",{children:"\u554f\u984c\u6570"}),(0,c.jsx)("th",{children:"\u30b9\u30c6\u30fc\u30bf\u30b9"}),(0,c.jsx)("th",{children:"\u3044\u3044\u306d\u6570"}),(0,c.jsx)("th",{children:"\u4f5c\u6210\u8005"})]})}),(0,c.jsx)("tbody",{className:"text-center",children:t.map(((t,s)=>(0,c.jsxs)("tr",{children:[(0,c.jsx)("td",{children:(0,c.jsx)(d,{languages:t.language})}),(0,c.jsx)("td",{children:a(t.category,!0)}),(0,c.jsx)("td",{children:(0,c.jsx)("a",{href:"".concat(e,"/").concat(t.parameter),className:"btn btn-success text-lg font-bold shadow-lg text-white btn-md transition duration-150 ease-in-out transform hover:scale-110 focus:outline-none focus:ring focus:ring-green-300 w-full",children:t.problem_description})}),(0,c.jsxs)("td",{className:"text-xs",children:[a(t.problem_count,!1,!1,!0),"\u554f"]}),(0,c.jsx)("td",{children:a(t.status)}),(0,c.jsxs)("td",{className:"text-xs",children:[a(t.like_count,!1,!1,!0),"\u3044\u3044\u306d"]}),(0,c.jsx)("td",{children:(0,c.jsxs)("div",{className:"flex items-center space-x-3",children:[(0,c.jsx)("div",{className:"avatar",children:(0,c.jsx)("div",{className:"mask mask-circle w-12 h-12",children:(0,c.jsx)("img",{src:t.avatar,alt:"Avatar"})})}),(0,c.jsx)("div",{children:(0,c.jsx)("div",{className:"font-bold",children:t.name})})]})})]},s)))})]})})})})}},3552:(e,t,a)=>{a.d(t,{Z:()=>u});var s=a(2791),n=a(6030),r=a(5316),i=a(9434),l=a(2782),o=a(5054),c=a(184);const d=()=>(0,c.jsxs)("div",{className:"avatar-group -space-x-6 rtl:space-x-reverse",children:[(0,c.jsx)("div",{className:"avatar",children:(0,c.jsx)("div",{className:"w-12",children:(0,c.jsx)("img",{src:"https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg"})})}),(0,c.jsx)("div",{className:"avatar",children:(0,c.jsx)("div",{className:"w-12",children:(0,c.jsx)("img",{src:"https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg"})})}),(0,c.jsx)("div",{className:"avatar",children:(0,c.jsx)("div",{className:"w-12",children:(0,c.jsx)("img",{src:"https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg"})})}),(0,c.jsx)("div",{className:"avatar",children:(0,c.jsx)("div",{className:"w-12",children:(0,c.jsx)("img",{src:"https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg"})})}),(0,c.jsx)("div",{className:"avatar placeholder",children:(0,c.jsx)("div",{className:"w-12 bg-neutral text-neutral-content",children:(0,c.jsx)("span",{children:"+3"})})})]});var m=a(7064),h=a(4800),g=a(3306);const u=function(){const e=(0,i.I0)(),[t,a]=(0,n.FV)(r.Ns),[u,j]=(0,s.useState)(x),[p,v]=(0,s.useState)(!1);(0,s.useEffect)((()=>{t&&["myProjects","allProjects"].includes(t)||a("myProjects");const e=("myProjects"===t?x:b).map((e=>({...e,isActive:!1})));j(e)}),[t]);const f=u.find((e=>e.isActive));return(0,c.jsxs)(c.Fragment,{children:[(0,c.jsx)(g.Z,{onTabChange:e=>{a(e)},tabs:["myProjects","allProjects"]}),(0,c.jsx)("div",{className:"grid grid-cols-1 md:grid-cols-3 gap-6 mt-2",children:u.map(((a,s)=>a.isActive||!u.some((e=>e.isActive))?(0,c.jsxs)(l.Z,{title:a.name,topMargin:"mt-2",children:[(0,c.jsx)("span",{className:"badge badge-outline",children:a.badge}),(0,c.jsx)("p",{className:"flex mt-2",children:a.description}),(0,c.jsxs)("div",{className:"flex mt-12 justify-between",children:[(0,c.jsx)(d,{}),(0,c.jsx)("div",{className:"mt-6 text-right",children:(0,c.jsx)("input",{type:"checkbox",className:"toggle toggle-success toggle-lg",checked:a.isActive,onChange:()=>(a=>{const s=u.map(((e,t)=>t===a?{...e,isActive:!e.isActive}:e));e((0,o.c0)({message:"Switched to ".concat("myProjects"===t?"My Projects":"All Projects"),status:1})),j(s)})(s)})})]})]},s):null))}),f&&(0,c.jsx)("div",{className:"mt-4",children:(0,c.jsx)(m.Z,{project:f})}),"myProjects"===t&&(0,c.jsx)("button",{className:"btn btn-error text-white fixed right-5 bottom-5 rounded-full",onClick:()=>{v(!0)},children:"Create Project"}),p&&(0,c.jsx)(h.Z,{isOpen:p,onClose:()=>{v(!1)}})]})},x=[{name:"\u793e\u5185\u7814\u4fee\u30a2\u30d7\u30ea\u306e\u4f5c\u6210",badge:"\u500b\u4eba\u958b\u767a",isActive:!1,description:"Slack is an instant messaging program designed by Slack Technologies and owned by Salesforce."},{name:"\u793e\u5185\u7ba1\u7406\u30a2\u30d7\u30ea\u306e\u4f5c\u6210",badge:"\u793e\u5185\u958b\u767a",isActive:!1,description:"Meta Platforms, Inc., doing business as Meta and formerly named Facebook, Inc., and TheFacebook."},{name:"SALTO\u76db\u308a\u4e0a\u3052\u3088\u3046\u4f1a",badge:"\u793e\u5185\u958b\u767a",isActive:!1,description:"Meta Platforms, Inc., doing business as Meta and formerly named Facebook, Inc., and TheFacebook."}],b=[{name:"\u793e\u5185\u7814\u4fee\u30a2\u30d7\u30ea\u306e\u4f5c\u6210",badge:"\u500b\u4eba\u958b\u767a",isActive:!1,description:"Slack is an instant messaging program designed by Slack Technologies and owned by Salesforce."},{name:"\u793e\u5185\u7ba1\u7406\u30a2\u30d7\u30ea\u306e\u4f5c\u6210",badge:"\u793e\u5185\u958b\u767a",isActive:!1,description:"Meta Platforms, Inc., doing business as Meta and formerly named Facebook, Inc., and TheFacebook."},{name:"SALTO\u76db\u308a\u4e0a\u3052\u3088\u3046\u4f1a",badge:"\u793e\u5185\u958b\u767a",isActive:!1,description:"Meta Platforms, Inc., doing business as Meta and formerly named Facebook, Inc., and TheFacebook."},{name:"\u30b3\u30fc\u30dd\u30ec\u30fc\u30c8\u30b5\u30a4\u30c8\u306e\u4f5c\u6210",badge:"\u500b\u4eba\u958b\u767a",isActive:!1,description:"Meta Platforms, Inc., doing business as Meta and formerly named Facebook, Inc., and TheFacebook."},{name:"\u3010\u65b0\u5352\u7814\u4fee\u3011SQL\u554f\u984c\u96c6",badge:"\u793e\u5185\u7814\u4fee",isActive:!1,description:"Meta Platforms, Inc., doing business as Meta and formerly named Facebook, Inc., and TheFacebook."}]},5618:(e,t,a)=>{a.r(t),a.d(t,{default:()=>S});var s=a(2791),n=a(9434),r=a(5054),i=a(184);const l=function(e){let{title:t,icon:a,value:s,description:n,colorIndex:r}=e;const l=["primary","primary"];return(0,i.jsx)("div",{className:"stats shadow",children:(0,i.jsxs)("div",{className:"stat",children:[(0,i.jsx)("div",{className:"stat-figure dark:text-slate-300 text-".concat(l[r%2]),children:a}),(0,i.jsx)("div",{className:"stat-title dark:text-slate-300",children:t}),(0,i.jsx)("div",{className:"stat-value dark:text-slate-300 text-".concat(l[r%2]),children:s}),(0,i.jsx)("div",{className:"stat-desc  "+(n.includes("\u2197\ufe0e")?"font-bold text-green-700 dark:text-green-300":n.includes("\u2199")?"font-bold text-rose-500 dark:text-red-400":""),children:n})]})})};var o=a(5136),c=a(3596),d=a(8863),m=a(2999),h=a(2782);var g=a(5967),u=a(3623);g.kL.register(g.uw,g.f$,g.od,g.jn,g.Dx,g.u,g.Gu,g.De);const x=function(){const e=["January","February","March","April","May","June","July"],t={labels:e,datasets:[{fill:!0,label:"MAU",data:e.map((()=>100*Math.random()+500)),borderColor:"rgb(53, 162, 235)",backgroundColor:"rgba(53, 162, 235, 0.5)"}]};return(0,i.jsx)(h.Z,{title:"\u6708\u6b21\u96c6\u8a08",children:(0,i.jsx)(u.x1,{data:t,options:{responsive:!0,plugins:{legend:{position:"top"}}}})})};g.kL.register(g.uw,g.f$,g.ZL,g.Dx,g.u,g.De);const b=function(){const e=["January","February","March","April","May","June","July"],t={labels:e,datasets:[{label:"Store 1",data:e.map((()=>1e3*Math.random()+500)),backgroundColor:"rgba(255, 99, 132, 1)"},{label:"Store 2",data:e.map((()=>1e3*Math.random()+500)),backgroundColor:"rgba(53, 162, 235, 1)"}]};return(0,i.jsx)(h.Z,{title:"\u534a\u671f\u96c6\u8a08",children:(0,i.jsx)(u.$Q,{options:{responsive:!0,plugins:{legend:{position:"top"}}},data:t})})};const j=s.forwardRef((function(e,t){let{title:a,titleId:n,...r}=e;return s.createElement("svg",Object.assign({xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24",strokeWidth:1.5,stroke:"currentColor","aria-hidden":"true","data-slot":"icon",ref:t,"aria-labelledby":n},r),a?s.createElement("title",{id:n},a):null,s.createElement("path",{strokeLinecap:"round",strokeLinejoin:"round",d:"M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"}))}));const p=s.forwardRef((function(e,t){let{title:a,titleId:n,...r}=e;return s.createElement("svg",Object.assign({xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24",strokeWidth:1.5,stroke:"currentColor","aria-hidden":"true","data-slot":"icon",ref:t,"aria-labelledby":n},r),a?s.createElement("title",{id:n},a):null,s.createElement("path",{strokeLinecap:"round",strokeLinejoin:"round",d:"M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z"}))}));const v=s.forwardRef((function(e,t){let{title:a,titleId:n,...r}=e;return s.createElement("svg",Object.assign({xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24",strokeWidth:1.5,stroke:"currentColor","aria-hidden":"true","data-slot":"icon",ref:t,"aria-labelledby":n},r),a?s.createElement("title",{id:n},a):null,s.createElement("path",{strokeLinecap:"round",strokeLinejoin:"round",d:"M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"}))}));const f=s.forwardRef((function(e,t){let{title:a,titleId:n,...r}=e;return s.createElement("svg",Object.assign({xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24",strokeWidth:1.5,stroke:"currentColor","aria-hidden":"true","data-slot":"icon",ref:t,"aria-labelledby":n},r),a?s.createElement("title",{id:n},a):null,s.createElement("path",{strokeLinecap:"round",strokeLinejoin:"round",d:"M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z"}))}));const w=s.forwardRef((function(e,t){let{title:a,titleId:n,...r}=e;return s.createElement("svg",Object.assign({xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24",strokeWidth:1.5,stroke:"currentColor","aria-hidden":"true","data-slot":"icon",ref:t,"aria-labelledby":n},r),a?s.createElement("title",{id:n},a):null,s.createElement("path",{strokeLinecap:"round",strokeLinejoin:"round",d:"M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99"}))}));var N=a(4734);const k=function(e){let{updateDashboardPeriod:t}=e;const[a,n]=(0,s.useState)({startDate:new Date,endDate:new Date});return(0,i.jsxs)("div",{className:"grid grid-cols-1 sm:grid-cols-2 gap-4",children:[(0,i.jsx)("div",{className:"",children:(0,i.jsx)(N.Z,{containerClassName:"w-72 ",value:a,theme:"light",inputClassName:"input input-bordered w-72",popoverDirection:"down",toggleClassName:"invisible",onChange:e=>{console.log("newValue:",e),n(e),t(e)},showShortcuts:!0,primaryColor:"white"})}),(0,i.jsxs)("div",{className:"text-right ",children:[(0,i.jsxs)("button",{className:"btn btn-ghost btn-sm normal-case",children:[(0,i.jsx)(w,{className:"w-4 mr-2"}),"Refresh Data"]}),(0,i.jsxs)("button",{className:"btn btn-ghost btn-sm normal-case  ml-2",children:[(0,i.jsx)(p,{className:"w-4 mr-2"}),"Share"]}),(0,i.jsxs)("div",{className:"dropdown dropdown-bottom dropdown-end  ml-2",children:[(0,i.jsx)("label",{tabIndex:0,className:"btn btn-ghost btn-sm normal-case btn-square ",children:(0,i.jsx)(f,{className:"w-5"})}),(0,i.jsxs)("ul",{tabIndex:0,className:"dropdown-content menu menu-compact  p-2 shadow bg-base-100 rounded-box w-52",children:[(0,i.jsx)("li",{children:(0,i.jsxs)("a",{children:[(0,i.jsx)(v,{className:"w-4"}),"Email Digests"]})}),(0,i.jsx)("li",{children:(0,i.jsxs)("a",{children:[(0,i.jsx)(j,{className:"w-4"}),"Download"]})})]})]})]})]})};a(3547);g.kL.register(g.qi,g.u,g.De,g.u,g.Gu,g.De);var y=a(3552),C=a(7735);const M=[{title:"My Project",value:"2",icon:(0,i.jsx)(o.Z,{className:"w-8 h-8"}),description:"\u2197\ufe0e 2"},{title:"Participating Project",value:"4",icon:(0,i.jsx)(m.Z,{className:"w-8 h-8"}),description:"\u2197\ufe0e 4"},{title:"Total Task",value:"1008",icon:(0,i.jsx)(d.Z,{className:"w-8 h-8"}),description:"\u2197\ufe0e 1008"},{title:"Digestion Task",value:"1000",icon:(0,i.jsx)(c.Z,{className:"w-8 h-8"}),description:"\u2197\ufe0e 1000"}],A=[{title:"Course Completed",value:"20",icon:(0,i.jsx)(o.Z,{className:"w-8 h-8"}),description:"\u2197\ufe0e 2"},{title:"Create Course",value:"4",icon:(0,i.jsx)(m.Z,{className:"w-8 h-8"}),description:"\u2197\ufe0e 4"},{title:"Total good",value:"100",icon:(0,i.jsx)(d.Z,{className:"w-8 h-8"}),description:"\u2197\ufe0e 100"},{title:"Total comment",value:"20",icon:(0,i.jsx)(c.Z,{className:"w-8 h-8"}),description:"\u2197\ufe0e 20"}];const E=function(){const e=(0,n.I0)();return(0,i.jsxs)(i.Fragment,{children:[(0,i.jsx)(k,{updateDashboardPeriod:t=>{e((0,r.c0)({message:"Period updated to ".concat(t.startDate," to ").concat(t.endDate),status:1}))}}),(0,i.jsxs)("div",{className:"grid lg:grid-cols-2  grid-cols-1 gap-6",children:[(0,i.jsx)(x,{}),(0,i.jsx)(b,{})]}),(0,i.jsx)("p",{className:"text-2xl font-bold text-yellow-400 my-4",children:"Project Stats (\u7acb\u3061\u4e0a\u3052\u30d7\u30ed\u30b8\u30a7\u30af\u30c8\u3068\u53c2\u753b\u30d7\u30ed\u30b8\u30a7\u30af\u30c8\u306e\u96c6\u8a08\u3068\u8a73\u7d30)"}),(0,i.jsx)("div",{className:"grid lg:grid-cols-4 my-4 md:grid-cols-2 grid-cols-1 gap-6",children:M.map(((e,t)=>(0,i.jsx)(l,{...e,colorIndex:t},t)))}),(0,i.jsx)(y.Z,{}),(0,i.jsx)("p",{className:"text-2xl font-bold text-yellow-400 my-4",children:"Salto Code Stats(\u53d7\u8b1b\u4e2d\u3068\u53d7\u8b1b\u6e08\u307f\u306e\u30b3\u30fc\u30b9\u306e\u96c6\u8a08\u3068\u8868\u793a)"}),(0,i.jsx)("div",{className:"grid lg:grid-cols-4 my-4 md:grid-cols-2 grid-cols-1 gap-6",children:A.map(((e,t)=>(0,i.jsx)(l,{...e,colorIndex:t},t)))}),(0,i.jsx)(C.Z,{})]})};const S=function(){const e=(0,n.I0)();return(0,s.useEffect)((()=>{e((0,r.Iw)({title:"Dashboard"}))}),[]),(0,i.jsx)(E,{})}},8863:(e,t,a)=>{a.d(t,{Z:()=>n});var s=a(2791);const n=s.forwardRef((function(e,t){let{title:a,titleId:n,...r}=e;return s.createElement("svg",Object.assign({xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24",strokeWidth:1.5,stroke:"currentColor","aria-hidden":"true","data-slot":"icon",ref:t,"aria-labelledby":n},r),a?s.createElement("title",{id:n},a):null,s.createElement("path",{strokeLinecap:"round",strokeLinejoin:"round",d:"M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125"}))}))},2999:(e,t,a)=>{a.d(t,{Z:()=>n});var s=a(2791);const n=s.forwardRef((function(e,t){let{title:a,titleId:n,...r}=e;return s.createElement("svg",Object.assign({xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24",strokeWidth:1.5,stroke:"currentColor","aria-hidden":"true","data-slot":"icon",ref:t,"aria-labelledby":n},r),a?s.createElement("title",{id:n},a):null,s.createElement("path",{strokeLinecap:"round",strokeLinejoin:"round",d:"M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z"}))}))},3596:(e,t,a)=>{a.d(t,{Z:()=>n});var s=a(2791);const n=s.forwardRef((function(e,t){let{title:a,titleId:n,...r}=e;return s.createElement("svg",Object.assign({xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24",strokeWidth:1.5,stroke:"currentColor","aria-hidden":"true","data-slot":"icon",ref:t,"aria-labelledby":n},r),a?s.createElement("title",{id:n},a):null,s.createElement("path",{strokeLinecap:"round",strokeLinejoin:"round",d:"M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"}))}))}}]);
//# sourceMappingURL=979.5a278bdf.chunk.js.map