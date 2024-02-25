"use strict";(self.webpackChunkadmin_dashboard_template_dashwind=self.webpackChunkadmin_dashboard_template_dashwind||[]).push([[755],{2782:(e,s,i)=>{i.d(s,{Z:()=>t});var a=i(3547),n=i(184);const t=function(e){let{title:s,children:i,topMargin:t,TopSideButtons:l}=e;return(0,n.jsxs)("div",{className:"card w-full p-6 bg-base-100 shadow-xl "+(t||"mt-6"),children:[(0,n.jsxs)(a.Z,{styleClass:l?"inline-block":"",children:[s,l&&(0,n.jsx)("div",{className:"inline-block float-right",children:l})]}),(0,n.jsx)("div",{className:"divider mt-2"}),(0,n.jsx)("div",{className:"h-full w-full pb-6 bg-base-100",children:i})]})}},3547:(e,s,i)=>{i.d(s,{Z:()=>n});var a=i(184);const n=function(e){let{styleClass:s,children:i}=e;return(0,a.jsx)("div",{className:"text-xl font-semibold ".concat(s),children:i})}},230:(e,s,i)=>{i(184)},2986:(e,s,i)=>{i.d(s,{Z:()=>t});i(2791);var a=i(9434),n=i(184);i(230),i(3547);i(5054),i(2782);const t=function(){return(0,a.I0)(),(0,n.jsx)(n.Fragment,{children:(0,n.jsxs)("article",{className:"prose",children:[(0,n.jsx)("h1",{className:"",children:"Project Architecture"}),(0,n.jsx)("h2",{id:"component1",children:"Frontend"}),(0,n.jsxs)("ul",{children:[(0,n.jsx)("li",{children:"React"}),(0,n.jsx)("li",{children:"Tailwind CSS"}),(0,n.jsx)("li",{children:"DaisyUI"})]}),(0,n.jsx)("h2",{children:"Backend"}),(0,n.jsx)("ul",{children:(0,n.jsx)("li",{children:"Strapi"})}),(0,n.jsx)("h2",{children:"\u30a4\u30f3\u30d5\u30e9\u30b9\u30c8\u30e9\u30af\u30c1\u30e3"}),(0,n.jsxs)("ul",{children:[(0,n.jsx)("li",{children:"AWS EC2"}),(0,n.jsx)("li",{children:"Docker"}),(0,n.jsx)("li",{children:"Nginx"})]}),(0,n.jsx)("h2",{children:"CI/CD"}),(0,n.jsx)("ul",{children:(0,n.jsx)("li",{children:"Jenkins"})}),(0,n.jsx)("h2",{children:"\u30d0\u30fc\u30b8\u30e7\u30f3\u7ba1\u7406"}),(0,n.jsx)("ul",{children:(0,n.jsx)("li",{children:"GitHub"})}),(0,n.jsx)("div",{className:"h-24"})]})})}},3379:(e,s,i)=>{i.d(s,{Z:()=>t});var a=i(2791),n=i(184);const t=function(e){let{activeIndex:s}=e;const i=[{name:"Typography",isActive:1===s},{name:"Form Input",isActive:!1},{name:"Cards",isActive:!1}],[t,l]=(0,a.useState)(i);return(0,n.jsxs)("ul",{className:"menu w-56 mt-10 text-sm",children:[(0,n.jsx)("li",{className:"menu-title",children:(0,n.jsx)("span",{className:"",children:"Components"})}),t.map(((e,s)=>(0,n.jsx)("li",{onClick:()=>{return e=s,l(t.map(((s,i)=>i===e?{...s,isActive:!0}:{...s,isActive:!1}))),void document.getElementById("component"+(e+1)).scrollIntoView({behavior:"smooth"});var e},className:e.isActive?"bordered":"",children:(0,n.jsx)("a",{children:e.name})},s)))]})}},7249:(e,s,i)=>{i.d(s,{Z:()=>l});i(2791);var a=i(9434),n=(i(3547),i(5054)),t=i(184);const l=function(){const e=(0,a.I0)();return(0,t.jsx)(t.Fragment,{children:(0,t.jsxs)("article",{className:"prose",children:[(0,t.jsx)("h1",{className:"",children:"Features"}),(0,t.jsx)("h2",{id:"feature1",children:"Authentication"}),(0,t.jsxs)("p",{children:["JWT based Authentication logic is present in ",(0,t.jsx)("span",{className:"badge mt-0 mb-0 badge-ghost",children:"/app/auth.js"}),". In the file you can see we are adding bearer token in header for every request. Every routes under ",(0,t.jsx)("span",{className:"badge mt-0 mb-0 badge-ghost",children:"/routes/"})," folder will need authentication. For public routes like login, register you will have to add routes in ",(0,t.jsx)("span",{className:"badge mt-0 mb-0 badge-ghost",children:"App.js"})," file and also include the path in PUBLIC_ROUTES variable under ",(0,t.jsx)("span",{className:"badge mt-0 mb-0 badge-ghost",children:"/app/auth.js"})," file so that auto redirect to login page is not triggered."]}),(0,t.jsx)("h2",{id:"feature2",children:"Left Sidebar"}),(0,t.jsxs)("p",{children:["This is main internal navigation (for pages that will come after login only), all sidebar menu items with their icons are present in ",(0,t.jsx)("span",{className:"badge mt-0 mb-0 badge-ghost",children:"/routes/sidebar.js"}),"  file, while  path and page components mapping are respectively present in ",(0,t.jsx)("span",{className:"badge mt-0 mb-0 badge-ghost",children:"/routes/index.js"})," file."]}),(0,t.jsx)("h2",{id:"feature3",children:"Add New Page"}),(0,t.jsxs)("p",{children:["All ",(0,t.jsx)("span",{className:"font-semibold",children:"public routes"})," are present in ",(0,t.jsx)("span",{className:"badge mt-0 mb-0 badge-ghost",children:"App.js"})," file. Steps to add new public page -"]}),(0,t.jsxs)("ul",{className:"mt-0",children:[(0,t.jsxs)("li",{children:["Create Page inside ",(0,t.jsx)("span",{className:"badge mt-0 mb-0 badge-ghost",children:"/pages"})," folder"]}),(0,t.jsxs)("li",{children:["Go to ",(0,t.jsx)("span",{className:"badge mt-0 mb-0 badge-ghost",children:"App.js"})," and import the component and add its path"]}),(0,t.jsxs)("li",{children:["Add your new route path in ",(0,t.jsx)("span",{className:"badge mt-0 mb-0 badge-ghost",children:"/app/auth.js"})," file under PUBLIC_ROUTES variable, this will allow the page to open without login."]})]}),(0,t.jsxs)("p",{className:"mt-4",children:["All ",(0,t.jsx)("span",{className:"font-semibold",children:"protected routes"})," are present in ",(0,t.jsx)("span",{className:"badge mt-0 mb-0 badge-ghost",children:"/routes/sidebar.js"})," file"]}),(0,t.jsxs)("ul",{className:"mt-0",children:[(0,t.jsxs)("li",{children:["Create your page inside ",(0,t.jsx)("span",{className:"badge mt-0 mb-0 badge-ghost",children:"/pages/protected"})," folder"]}),(0,t.jsxs)("li",{children:["Add your new routes in ",(0,t.jsx)("span",{className:"badge mt-0 mb-0 badge-ghost",children:"/routes/sidebar.js"}),", this will show your new page in sidebar"]}),(0,t.jsxs)("li",{children:["Import your new routes component and map its path in ",(0,t.jsx)("span",{className:"badge mt-0 mb-0 badge-ghost",children:"/routes/index.js"})]})]}),(0,t.jsx)("h2",{id:"feature4",children:"Right Sidebar"}),(0,t.jsxs)("div",{children:["This is used for showing long list contents like notifications, settings etc.. We are using redux to show and hide and it is single component and can be called from any file with dispatch method. To add new content follow following steps:",(0,t.jsxs)("ul",{children:[(0,t.jsx)("li",{children:"Create new component file containing main body of your content"}),(0,t.jsxs)("li",{children:["Create new variable in ",(0,t.jsx)("span",{className:"badge mt-0 mb-0 badge-ghost",children:"/utils/globalConstantUtils.js"})," file under RIGHT_DRAWER_TYPES variable"]}),(0,t.jsxs)("li",{children:["Now include the file mapped with the new variable in ",(0,t.jsx)("span",{className:"badge mt-0 mb-0 badge-ghost",children:"/containers/RightSidebar.js"})," file using switch. ",(0,t.jsx)("br",{}),"For ex- If you new component name is ",(0,t.jsx)("span",{className:"badge mt-0 mb-0 badge-ghost",children:"TestRightSideBar.js"})," and  variable name is TEST_RIGHT_SIDEBAR, then add following code inside switch code block",(0,t.jsx)("br",{}),(0,t.jsx)("div",{className:"mockup-code mt-4",children:(0,t.jsx)("pre",{className:"my-0 py-0",children:(0,t.jsx)("code",{children:"[RIGHT_DRAWER_TYPES.TEST_RIGHT_SIDEBAR] : \n<TestRightSideBar {...extraObject} closeRightDrawer={close}/>"})})}),(0,t.jsx)("span",{className:"text-sm mt-1 italic",children:"Here extraObject have variables that is passed from parent component while calling openRightDrawer method"})]}),(0,t.jsxs)("li",{children:["Now the last step, call dispatch method as follows",(0,t.jsx)("div",{className:"mockup-code mt-1",children:(0,t.jsx)("pre",{className:"my-0 py-0",children:(0,t.jsx)("code",{children:'import { useDispatch } from "react-redux"\n  const dispatch = useDispatch()\n  dispatch(openRightDrawer({header : "Test Right Drawer", \n  bodyType : RIGHT_DRAWER_TYPES.TEST_RIGHT_SIDEBAR}))'})})})]})]})]}),(0,t.jsx)("h2",{id:"feature5",children:"Themes"}),(0,t.jsxs)("p",{children:["By default we have added light and dark theme and Daisy UI comes with a number of themes, which you can use with no extra effort, you just have to include it in ",(0,t.jsx)("span",{className:"badge mt-0 mb-0 badge-ghost",children:"tailwind.config.js"})," file,  you can add themes like cupcake, corporate, reto etc... Also we can configure themes colors in config file, for more documentation on themes checkout ",(0,t.jsx)("a",{href:"https://daisyui.com/docs/themes/",target:"_blank",children:"Daisy UI documentation."})]}),(0,t.jsx)("h2",{id:"feature6",children:"Modal"}),(0,t.jsxs)("div",{children:["With global modal functionality you dont have to create seperate modal for each page. We are using redux to show and hide and it is a single component and can be called from any file with dispatch method. Code for showing modal is present in modalSlice and layout container component. To show modal just call openModal() function of modalSlice using dispatch.",(0,t.jsx)("br",{}),"To add new modal in any page follow following steps:",(0,t.jsxs)("ul",{children:[(0,t.jsx)("li",{children:"Create new component file containing main body of your modal content"}),(0,t.jsxs)("li",{children:["Create new variable in ",(0,t.jsx)("span",{className:"badge mt-0 mb-0 badge-ghost",children:"/utils/globalConstantUtils.js"})," file under MODAL_BODY_TYPES variable"]}),(0,t.jsxs)("li",{children:["Now include the file mapped with the new variable in ",(0,t.jsx)("span",{className:"badge mt-0 mb-0 badge-ghost",children:"/containers/ModalLayout.js"})," file using switch. ",(0,t.jsx)("br",{}),"For ex- If you new component name is ",(0,t.jsx)("span",{className:"badge mt-0 mb-0 badge-ghost",children:"TestModal.js"})," and  variable name is TEST_MODAL, then add following code inside switch code block",(0,t.jsx)("br",{}),(0,t.jsx)("div",{className:"mockup-code mt-4",children:(0,t.jsx)("pre",{className:"my-0 py-0",children:(0,t.jsx)("code",{children:"[RIGHT_DRAWER_TYPES.TEST_MODAL] : \n<TestModal closeModal={close} extraObject={extraObject}/>"})})}),(0,t.jsx)("span",{className:"text-sm mt-1 italic",children:"Here extraObject have variables that is passed from parent component while calling openModal method"})]}),(0,t.jsxs)("li",{children:["Now the last step, call dispatch method as follows",(0,t.jsx)("div",{className:"mockup-code mt-1",children:(0,t.jsx)("pre",{className:"my-0 py-0",children:(0,t.jsx)("code",{children:'import { useDispatch } from "react-redux"\n  const dispatch = useDispatch()\n   dispatch(openModal({title : "Test Modal Title", \n   bodyType : MODAL_BODY_TYPES.TEST_MODAL}))'})})})]})]})]}),(0,t.jsx)("h2",{id:"feature7",children:"Notification"}),(0,t.jsx)("p",{children:"Many times we have to show notification to user be it on successfull form submission or any api success. And requirement can come to show notification from any page, so global notification handling is needed."}),(0,t.jsxs)("p",{className:"mt-4",children:["Code for showing notification is present in headerSlice and layout container component. To show notification just call ",(0,t.jsx)("span",{className:"badge badge-ghost",children:"showNotification()"})," function of headerSlice using dispatch. To show success message notification pass status as 1 and for showing error message pass status as 0."]}),(0,t.jsx)("div",{className:"mockup-code mb-4",children:(0,t.jsx)("pre",{className:"my-0 py-0",children:(0,t.jsx)("code",{children:'import { useDispatch } from "react-redux"\n  const dispatch = useDispatch()\n  dispatch(showNotification({message : "Message here", status : 1}))'})})}),(0,t.jsx)("p",{children:"Click on this button to check"}),(0,t.jsx)("button",{className:"btn btn-success",onClick:()=>e((0,n.c0)({message:"Your message has been sent!",status:1})),children:"Success"}),(0,t.jsx)("button",{className:"btn btn-error ml-4",onClick:()=>e((0,n.c0)({message:"Something went wrong!",status:0})),children:"Error"}),(0,t.jsx)("div",{className:"h-24"})]})})}},5597:(e,s,i)=>{i.d(s,{Z:()=>t});var a=i(2791),n=i(184);const t=function(e){let{activeIndex:s}=e;const i=[{name:"Authentication",isActive:1===s},{name:"Sidebar",isActive:!1},{name:"Add New Page",isActive:!1},{name:"Right sidebar",isActive:!1},{name:"Themes",isActive:!1},{name:"Modal",isActive:!1},{name:"Notification",isActive:!1}],[t,l]=(0,a.useState)(i);return(0,n.jsxs)("ul",{className:"menu w-56 mt-10 text-sm",children:[(0,n.jsx)("li",{className:"menu-title",children:(0,n.jsx)("span",{className:"",children:"Features"})}),t.map(((e,s)=>(0,n.jsx)("li",{onClick:()=>{return e=s,l(t.map(((s,i)=>i===e?{...s,isActive:!0}:{...s,isActive:!1}))),void document.getElementById("feature"+(e+1)).scrollIntoView({behavior:"smooth"});var e},className:e.isActive?"bordered":"",children:(0,n.jsx)("a",{children:e.name})},s)))]})}},1536:(e,s,i)=>{i.d(s,{Z:()=>t});i(2791);var a=i(9434),n=(i(3547),i(5054),i(184));const t=function(){return(0,a.I0)(),(0,n.jsx)(n.Fragment,{children:(0,n.jsxs)("article",{className:"prose",children:[(0,n.jsx)("h1",{className:"",children:"Project Architecture"}),(0,n.jsx)("h2",{id:"getstarted1",children:"Frontend"}),(0,n.jsxs)("ul",{children:[(0,n.jsx)("li",{children:"React"}),(0,n.jsx)("li",{children:"Tailwind CSS"}),(0,n.jsx)("li",{children:"DaisyUI"})]}),(0,n.jsx)("h2",{children:"Backend"}),(0,n.jsx)("ul",{children:(0,n.jsx)("li",{children:"Strapi"})}),(0,n.jsx)("h2",{children:"\u30a4\u30f3\u30d5\u30e9\u30b9\u30c8\u30e9\u30af\u30c1\u30e3"}),(0,n.jsxs)("ul",{children:[(0,n.jsx)("li",{children:"AWS EC2"}),(0,n.jsx)("li",{children:"Docker"}),(0,n.jsx)("li",{children:"Nginx"})]}),(0,n.jsx)("h2",{children:"CI/CD"}),(0,n.jsx)("ul",{children:(0,n.jsx)("li",{children:"Jenkins"})}),(0,n.jsx)("h2",{children:"\u30d0\u30fc\u30b8\u30e7\u30f3\u7ba1\u7406"}),(0,n.jsx)("ul",{children:(0,n.jsx)("li",{children:"GitHub"})}),(0,n.jsx)("div",{className:"h-24"})]})})}},9293:(e,s,i)=>{i.d(s,{Z:()=>t});var a=i(2791),n=i(184);const t=function(e){let{activeIndex:s}=e;const i=[{name:"Architecture",isActive:1===s}],[t,l]=(0,a.useState)(i);return(0,n.jsxs)("ul",{className:"menu w-56 mt-10 text-sm",children:[(0,n.jsx)("li",{className:"menu-title",children:(0,n.jsx)("span",{className:"",children:"Getting Started"})}),t.map(((e,s)=>(0,n.jsx)("li",{onClick:()=>{return e=s,l(t.map(((s,i)=>i===e?{...s,isActive:!0}:{...s,isActive:!1}))),void document.getElementById("getstarted"+(e+1)).scrollIntoView({behavior:"smooth"});var e},className:e.isActive?"bordered":"",children:(0,n.jsx)("a",{children:e.name})},s)))]})}},3755:(e,s,i)=>{i.r(s),i.d(s,{default:()=>h});var a=i(1087),n=i(5597),t=i(1536),l=i(9293),c=(i(230),i(3379)),d=i(7249),r=i(2986),o=i(184);const h=function(){return(0,o.jsx)(o.Fragment,{children:(0,o.jsx)("div",{className:"min-h-screen bg-base-200 flex items-center",children:(0,o.jsx)("div",{className:"card mx-auto w-full max-w-4xl  shadow-xl",children:(0,o.jsxs)("div",{className:"py-12 p-10 h-screen flex overflow-hidden  bg-base-100 rounded-xl",children:[(0,o.jsxs)("div",{className:"flex-none p-4 overflow-y-scroll gap-6 ",children:[(0,o.jsx)("h1",{className:"text-3xl font-bold mb-2",children:"Salto Atoms"}),(0,o.jsx)(a.rU,{to:"/login",children:(0,o.jsx)("button",{type:"submit",className:"btn normal-case btn-xs btn-primary",children:"Live Preview"})}),(0,o.jsx)(l.Z,{}),(0,o.jsx)(n.Z,{}),(0,o.jsx)(c.Z,{})]}),(0,o.jsxs)("div",{className:"grow pt-16  overflow-y-scroll",children:[(0,o.jsx)(t.Z,{}),(0,o.jsx)(d.Z,{}),(0,o.jsx)(r.Z,{})]})]})})})})}}}]);
//# sourceMappingURL=755.889a1738.chunk.js.map