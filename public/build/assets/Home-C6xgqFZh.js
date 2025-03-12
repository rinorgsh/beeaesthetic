import{T as z,F as w}from"./Footer-B4d0YFaU.js";import{_ as f}from"./_plugin-vue_export-helper-DlAUqK2U.js";import{r as o,o as A,a as y,c as s,b as a,d as i,F as g,e as b,s as h,n as _,q as B,f as c}from"./app-BVFfF1Vv.js";import{R as E,S as q}from"./SocialSection-CIK7T-xQ.js";/* empty css            */const F={class:"hero-banner"},$={class:"background-slideshow desktop-slideshow"},N={class:"background-slideshow mobile-slideshow"},I=5e3,T={__name:"HeroBanner",setup(v){const t=o(["Images/banner.jpeg","Images/banner6.jpeg","Images/banner7.jpeg","Images/banner9.jpeg"]),e=o(["Images/banner.jpeg","Images/banner4.jpeg","Images/banner5.jpeg","Images/banner3.jpeg"]),d=o(0),u=o(0),p=o(null),m=o(null),S=()=>{d.value=(d.value+1)%t.value.length},x=()=>{u.value=(u.value+1)%e.value.length};function k(){[t.value[0],t.value[1],e.value[0],e.value[1]].forEach(n=>{const l=new Image;l.src=n})}return A(()=>{k(),p.value=setInterval(S,I),m.value=setInterval(x,I)}),y(()=>{p.value&&clearInterval(p.value),m.value&&clearInterval(m.value)}),(j,n)=>(a(),s("section",F,[n[0]||(n[0]=i("div",{class:"overlay"},null,-1)),i("div",$,[(a(!0),s(g,null,b(t.value,(l,r)=>(a(),s("div",{key:"desktop-"+r,class:_(["slide-bg",{active:d.value===r}]),style:h({backgroundImage:`url(${l})`})},null,6))),128))]),i("div",N,[(a(!0),s(g,null,b(e.value,(l,r)=>(a(),s("div",{key:"mobile-"+r,class:_(["slide-bg",{active:u.value===r}]),style:h({backgroundImage:`url(${l})`})},null,6))),128))]),n[1]||(n[1]=i("div",{class:"hero-content"},[i("h1",{class:"hero-title"},"BEE AESTHETIC"),i("p",{class:"hero-subtitle"},"Your Nails, Your Signature")],-1))]))}},M=f(T,[["__scopeId","data-v-f3250036"]]),H={class:"welcome-section"},P={__name:"WelcomeSection",setup(v){return(t,e)=>(a(),s("section",H,e[0]||(e[0]=[B('<div class="container" data-v-f8214cb7><div class="welcome-content" data-v-f8214cb7><p class="welcome-text" data-v-f8214cb7> Bienvenue chez <span class="highlight" data-v-f8214cb7>Bee Aesthetic</span>, votre destination pour des ongles élégants et soignés. Forte de mes <span class="highlight" data-v-f8214cb7>4 années d&#39;expérience</span> dans le domaine de la beauté des ongles, je mets mon expertise à votre service pour sublimer vos mains tout en préservant la santé de vos ongles. </p><p class="welcome-text" data-v-f8214cb7> Que ce soit pour des finitions impeccables, des options durables comme le <span class="highlight" data-v-f8214cb7>BIAB</span>, ou encore des formations professionnelles destinées aux futurs experts de l&#39;onglerie, chaque rendez-vous est une expérience unique, où chaque détail compte. </p><p class="welcome-text" data-v-f8214cb7> Avec <span class="highlight" data-v-f8214cb7>Bee Aesthetic</span>, vous bénéficiez de 4 ans de savoir-faire et d&#39;un soin attentif et personnalisé. Prenez rendez-vous dès aujourd&#39;hui et laissez vos ongles refléter votre style et votre élégance. </p></div></div>',1)])))}},C=f(P,[["__scopeId","data-v-f8214cb7"]]),V={class:"services-section"},D={__name:"ServiceSection",setup(v){return(t,e)=>(a(),s("section",V,e[0]||(e[0]=[B('<div class="section-title-container" data-v-ca09f71c><h2 class="section-title" data-v-ca09f71c>Nos services</h2></div><div class="services-container" data-v-ca09f71c><div class="row" data-v-ca09f71c><div class="col-lg-6 service-col" data-v-ca09f71c><div class="service-content" data-v-ca09f71c><div class="service-image" data-v-ca09f71c><img src="Images/service2.jpeg" alt="Manucure &amp; BIAB" class="img-fluid" data-v-ca09f71c></div><h3 class="service-title" data-v-ca09f71c>Manucure &amp; BIAB</h3><p class="service-description" data-v-ca09f71c> Sublimez vos mains avec nos soins professionnels alliant élégance et durabilité. Chez Bee Aesthetic, nous utilisons des techniques modernes telles que le BIAB (Builder in a Bottle) pour renforcer vos ongles tout en préservant leur santé naturelle. </p><div class="service-btn-container" data-v-ca09f71c><a href="/services/manicure" class="service-btn" data-v-ca09f71c>En savoir plus</a></div></div></div><div class="col-lg-6 service-col" data-v-ca09f71c><div class="service-content" data-v-ca09f71c><div class="service-image" data-v-ca09f71c><img src="Images/service.jpeg" alt="Formation" class="img-fluid" data-v-ca09f71c></div><h3 class="service-title" data-v-ca09f71c>Formation</h3><p class="service-description" data-v-ca09f71c> Perfectionnez votre maîtrise du BIAB et des techniques d&#39;onglerie avec nos formations professionnelles complètes. Que vous soyez débutant ou déjà expérimenté, nos cours sont conçus pour développer vos compétences et vous guider vers l&#39;excellence. </p><div class="service-btn-container" data-v-ca09f71c><a href="/services/formation" class="service-btn" data-v-ca09f71c>En savoir plus</a></div></div></div></div></div>',2)])))}},Q=f(D,[["__scopeId","data-v-ca09f71c"]]),G={__name:"Home",props:{title:String},setup(v){return(t,e)=>(a(),s(g,null,[c(z),c(M),c(C),c(Q),c(E),c(q),c(w)],64))}};export{G as default};
