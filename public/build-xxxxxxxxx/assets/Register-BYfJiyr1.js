import{T as f,o as c,c as w,w as n,a,u as s,Z as g,b as t,d,j as _,n as V,e as v}from"./app-D0H97h00.js";import{_ as y}from"./GuestLayout-YyKUk3p-.js";import{_ as l,T as m,a as i}from"./TextInput-Wr4cFTDo.js";import{P as x}from"./PrimaryButton-Bik2iBCe.js";/* empty css                                                    */import"./_plugin-vue_export-helper-DlAUqK2U.js";const b={class:"mt-4"},k={class:"mt-4"},C={class:"mt-4"},h={class:"flex items-center justify-end mt-4"},j={__name:"Register",setup(q){const e=f({name:"",email:"",password:"",password_confirmation:""}),u=()=>{e.post(route("register"),{onFinish:()=>e.reset("password","password_confirmation")})};return(p,o)=>(c(),w(y,null,{default:n(()=>[a(s(g),{title:"Register"}),t("form",{onSubmit:v(u,["prevent"])},[t("div",null,[a(l,{for:"name",value:"Nombre"}),a(m,{id:"name",type:"text",class:"mt-1 block w-full",modelValue:s(e).name,"onUpdate:modelValue":o[0]||(o[0]=r=>s(e).name=r),required:"",autofocus:"",autocomplete:"name"},null,8,["modelValue"]),a(i,{class:"mt-2",message:s(e).errors.name},null,8,["message"])]),t("div",b,[a(l,{for:"email",value:"Email"}),a(m,{id:"email",type:"email",class:"mt-1 block w-full",modelValue:s(e).email,"onUpdate:modelValue":o[1]||(o[1]=r=>s(e).email=r),required:"",autocomplete:"username"},null,8,["modelValue"]),a(i,{class:"mt-2",message:s(e).errors.email},null,8,["message"])]),t("div",k,[a(l,{for:"password",value:"Contraseña"}),a(m,{id:"password",type:"password",class:"mt-1 block w-full",modelValue:s(e).password,"onUpdate:modelValue":o[2]||(o[2]=r=>s(e).password=r),required:"",autocomplete:"new-password"},null,8,["modelValue"]),a(i,{class:"mt-2",message:s(e).errors.password},null,8,["message"])]),t("div",C,[a(l,{for:"password_confirmation",value:"Confirmar Contraseña"}),a(m,{id:"password_confirmation",type:"password",class:"mt-1 block w-full",modelValue:s(e).password_confirmation,"onUpdate:modelValue":o[3]||(o[3]=r=>s(e).password_confirmation=r),required:"",autocomplete:"new-password"},null,8,["modelValue"]),a(i,{class:"mt-2",message:s(e).errors.password_confirmation},null,8,["message"])]),t("div",h,[a(s(_),{href:p.route("login"),class:"underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"},{default:n(()=>[d(" ¿Ya registrado? ")]),_:1},8,["href"]),a(x,{class:V(["ms-4",{"opacity-25":s(e).processing}]),disabled:s(e).processing},{default:n(()=>[d(" Registrarse ")]),_:1},8,["class","disabled"])])],32)]),_:1}))}};export{j as default};
