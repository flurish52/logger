import{k as b,o as l,f as p,b as t,i as y,l as _,a,w as u,d as x,u as r,j as g,m as w,p as N,q as k,c as f,s as $,g as D,x as v}from"./app-Bbvtw5yN.js";import{A as z}from"./ApplicationLogo-Cau6-YP4.js";import{_ as m}from"./_plugin-vue_export-helper-DlAUqK2U.js";import{_ as V}from"./AuthenticatedLayout-ClC5ZK_v.js";const A={class:"fixed top-2 right-2 inline-block text-left"},B={class:"absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg ring-1 ring-black ring-opacity-5"},j={class:"py-1 text-gray-700"},C={__name:"AddNewDropDown",setup(i){const e=b(!1),n=()=>{e.value=!e.value};return(h,s)=>(l(),p("div",A,[t("button",{onClick:n,class:"flex items-center justify-center w-10 h-10 text-white border border-2 hover: border-teal-700 rounded-full text-6xl"},s[0]||(s[0]=[t("svg",{xmlns:"http://www.w3.org/2000/svg",class:"w-5 h-5 mr-2",fill:"none",viewBox:"0 0 20 20",stroke:"teal","stroke-width":"2"},[t("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M12 4v16m8-8H4"})],-1)])),y(t("div",B,[t("ul",j,[t("li",null,[a(r(g),{href:"/dashboard/new-note",class:"block w-full px-4 py-2 text-left hover:bg-teal-50"},{default:u(()=>s[1]||(s[1]=[x(" New Note ")])),_:1})]),t("li",null,[a(r(g),{href:"/dashboard/",class:"block w-full px-4 py-2 text-left hover:bg-teal-50"},{default:u(()=>s[2]||(s[2]=[x(" New Task ")])),_:1})]),t("li",null,[a(r(g),{href:"/dashboard/",class:"block w-full px-4 py-2 text-left hover:bg-teal-50"},{default:u(()=>s[3]||(s[3]=[x(" New Schedules ")])),_:1})])])],512),[[_,e.value]])]))}},L={components:{ApplicationLogo:z,AddNewDropDown:C}},M={class:"md:ml-96 m-4 py-auto px-auto flex flex-col items-center justify-center text-center text-gray-800"},H={class:"mx-auto flex flex-col items-center justify-center w-full"};function S(i,e,n,h,s,d){const o=w("ApplicationLogo"),c=w("AddNewDropDown");return l(),p("div",M,[t("div",H,[e[0]||(e[0]=N('<div class="flex items-center justify-center gap-6 mb-6 mx-auto"><svg class="w-12 h-12 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M4 2h10c1.1 0 2 .9 2 2v16c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2zm0 2v16h10V4H4zm14 0h2v2h-2V4zm0 4h2v2h-2V8zm0 4h2v2h-2v-2zm0 4h2v2h-2v-2zm-8 2h2v2h-2v-2z"></path></svg><svg class="w-12 h-12 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M20 18H4c-1.1 0-2-.9-2-2V5c0-1.1.9-2 2-2h16c1.1 0 2 .9 2 2v11c0 1.1-.9 2-2 2zM4 5v11h16V5H4zm-1 15h18v2H3v-2z"></path></svg></div>',1)),a(o),e[1]||(e[1]=t("p",{class:"text-lg w-1/2 mb-4"}," Access and manage your notes seamlessly across devices. Use Logger on all your devices and keep all your notes synced in real-time. ",-1)),e[2]||(e[2]=t("p",{class:"text-2xl max-w-md mb-4 font-bold my-6"}," Click on any note to view ",-1))]),a(c,{class:"md:hidden"})])}const T=m(L,[["render",S]]),E={name:"ShareButton"},U={class:"fixed top-24 right-0 md:right-8 px-2 flex items-center justify-center flex-col bg-teal-600 border border-teal-800 rounded-lg text-white shadow-lg z-0 w-fit"};function q(i,e,n,h,s,d){return l(),p("button",U," Share ")}const F=m(E,[["render",q]]),I={key:0,class:"m-4 max-w-screen py-auto px-auto flex flex-col items-center justify-center text-center text-gray-800 lg:ml-96 lg:m-4"},K={__name:"Dashboard",props:{existingNote:Object,notes:Array,trashedNotes:Array},setup(i){let e=i,n=b("");k(()=>{n.value=e.existingNote});const h=d=>{v.post("/dashboard/restor/"+d).then(()=>{e.existingNote&&(window.location.href="/dashboard/trashed_notes")}).catch(o=>{console.error("Error restoring note:",o),alert("Failed to restore the note. Please try again.")})};let s=d=>{v.post("/dashboard/note/"+d,{content:n.value})};return(d,o)=>(l(),f(V,{notesToList:i.notes,trashedNotes:i.trashedNotes},{default:u(()=>[r(e).existingNote?(l(),p("div",I,[y(t("textarea",{"onUpdate:modelValue":o[0]||(o[0]=c=>r(n).content=c),onKeyup:o[1]||(o[1]=c=>r(s)(r(e).existingNote.id)),placeholder:"Write your notes here...",class:"max-w-full md:mr-12 ml-16 min-h-screen m-4 py-12 p-4 text-teal-900 bg-teal-100 border border-teal-300 rounded-lg shadow-sm resize-y focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent"},null,544),[[$,r(n).content]]),a(r(g),{href:"/dashboard",class:"absolute top-6 right-0 md:right-8 px-2 bg-red-500 border border-red-800 rounded-lg text-white shadow-lg z-0"},{default:u(()=>o[3]||(o[3]=[t("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24",fill:"currentColor",class:"w-6 h-6"},[t("path",{"fill-rule":"evenodd",d:"M6.225 5.175a.75.75 0 0 1 1.06 0L12 9.89l4.715-4.715a.75.75 0 1 1 1.06 1.06L13.06 12l4.715 4.715a.75.75 0 0 1-1.06 1.06L12 14.06l-4.715 4.715a.75.75 0 0 1-1.06-1.06L10.94 12 6.225 7.285a.75.75 0 0 1 0-1.06z","clip-rule":"evenodd"})],-1)])),_:1}),r(e).existingNote.trashed?(l(),p("button",{key:0,title:"Restor Note",onClick:o[2]||(o[2]=c=>h(r(e).existingNote.id)),class:"absolute top-16 right-0 md:right-8 px-2 bg-green-500 border border-green-800 rounded-lg text-white shadow-lg z-0"},o[4]||(o[4]=[t("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 32 32",width:"22",height:"22",fill:"none",stroke:"currentColor","stroke-width":"2.5","stroke-linecap":"round","stroke-linejoin":"round"},[t("path",{d:"M21 12a9 9 0 1 1-9-9"}),t("polyline",{points:"12 1 12 5 16 5"})],-1)]))):D("",!0),a(F)])):(l(),f(T,{key:1}))]),_:1},8,["notesToList","trashedNotes"]))}},G=m(K,[["__scopeId","data-v-b01d32cb"]]);export{G as default};