import{C as u,g as d,b as r,w as m,f as a,d as o,c,j as p,u as t,m as f,t as w,h as _,n as g,i as y}from"./app-BVFfF1Vv.js";import{_ as b}from"./GuestLayout-B6eFchM8.js";import{_ as x,a as k,b as V}from"./TextInput-CaEOgzg2.js";import{P as v}from"./PrimaryButton-oUEnaGG8.js";/* empty css            */import"./ApplicationLogo-BLVjz-_g.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const B={key:0,class:"mb-4 text-sm font-medium text-green-600"},N={class:"mt-4 flex items-center justify-end"},q={__name:"ForgotPassword",props:{status:{type:String}},setup(l){const e=u({email:""}),i=()=>{e.post(route("password.email"))};return(P,s)=>(r(),d(b,null,{default:m(()=>[a(t(f),{title:"Forgot Password"}),s[2]||(s[2]=o("div",{class:"mb-4 text-sm text-gray-600"}," Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one. ",-1)),l.status?(r(),c("div",B,w(l.status),1)):p("",!0),o("form",{onSubmit:_(i,["prevent"])},[o("div",null,[a(x,{for:"email",value:"Email"}),a(k,{id:"email",type:"email",class:"mt-1 block w-full",modelValue:t(e).email,"onUpdate:modelValue":s[0]||(s[0]=n=>t(e).email=n),required:"",autofocus:"",autocomplete:"username"},null,8,["modelValue"]),a(V,{class:"mt-2",message:t(e).errors.email},null,8,["message"])]),o("div",N,[a(v,{class:g({"opacity-25":t(e).processing}),disabled:t(e).processing},{default:m(()=>s[1]||(s[1]=[y(" Email Password Reset Link ")])),_:1},8,["class","disabled"])])],32)]),_:1}))}};export{q as default};
