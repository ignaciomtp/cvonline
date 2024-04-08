<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { onMounted } from "vue";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

function getDistanceToTop(elementId) {
    var element = document.getElementById(elementId);

    if (element) {
        var rect = element.getBoundingClientRect();
        return rect.top + window.scrollY;
    }

    // Return a default value or handle the case when the element is not found
    return null;
}



onMounted(() => {

    var navbar = document.querySelector(".navbar");
    var fixedTop = document.querySelector(".fixed-top");

    window.addEventListener('scroll', function() {

        if (window.scrollY > 170) {
            fixedTop.classList.add("top-nav-collapse");
        } else {
            fixedTop.classList.remove("top-nav-collapse");
        }
    });

    window.addEventListener('load', function() {
        var conte = document.querySelector("#header");
        console.log(conte.offsetTop);

        if (conte.offsetTop < 160) {
            fixedTop.classList.add("top-nav-collapse");
        } else {
            fixedTop.classList.remove("top-nav-collapse");
        }
    });


    var offcanvasToggle = document.querySelectorAll('[data-toggle="offcanvas"], .nav-link:not(.dropdown-toggle)');

    offcanvasToggle.forEach(function(element) {
        element.addEventListener('click', function() {
            var offcanvasCollapse = document.querySelector('.offcanvas-collapse');
            if (offcanvasCollapse) {
                offcanvasCollapse.classList.toggle('open');
            }
        });
    });


})

</script>

<template>
    <Head title="Welcome" />

            <!-- Navigation -->
        <nav class="navbar fixed-top">
            <div class="container sm:px-4 lg:px-8 flex flex-wrap items-center justify-between lg:flex-nowrap">
                
                <!-- Text Logo - Use this if you don't have a graphic logo -->
                <!-- <a class="text-gray-800 font-semibold text-3xl leading-4 no-underline page-scroll" href="index.html">Pavo</a> -->

                <!-- Image Logo -->
                <a class="logo mr-4 py-0.5 hover:no-underline focus:no-underline" href="index.html">
                    <span class="inline-block mr-1 ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-file-text" viewBox="0 0 16 16">
                          <path d="M5 4a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5M5 8a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1z"/>
                          <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1"/>
                        </svg>

                        
                    </span>
                    <span class=" titlelogo" style="font-size: 0.9rem;">TUCURRICULUM.ONLINE</span>
                    
                </a>

                <button class="background-transparent rounded text-xl leading-none hover:no-underline focus:no-underline lg:hidden lg:text-gray-400" type="button" data-toggle="offcanvas">
                    <span class="navbar-toggler-icon inline-block w-8 h-8 align-middle"></span>
                </button>

                <div class="navbar-collapse offcanvas-collapse lg:flex lg:flex-grow lg:items-center" id="navbarsExampleDefault">
                    <ul class="pl-0 mt-3 mb-2 ml-auto flex flex-col list-none lg:mt-0 lg:mb-0 lg:flex-row">
                    <!--      <li>
                            <a class="nav-link page-scroll active" href="#header">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li>
                            <a class="nav-link page-scroll" href="#features">Features</a>
                        </li>
                        <li>
                            <a class="nav-link page-scroll" href="#details">Details</a>
                        </li>
                        <li>
                            <a class="nav-link page-scroll" href="#pricing">Pricing</a>
                        </li>
                    -->
                        <li v-if="$page.props.auth.user">
                            <a class="nav-link page-scroll"  :href="route('dashboard')">Panel de control</a>
                        </li>

                        <template v-else>

                            <li>
                                <a class="nav-link page-scroll" :href="route('login')">Login</a>
                            </li>

                            <li>
                                <a class="nav-link page-scroll" :href="route('register')">Registro</a>
                            </li>
                        </template>                           
                        

                    </ul>

                </div> <!-- end of navbar-collapse -->
            </div> <!-- end of container -->
        </nav> <!-- end of navbar -->
        <!-- end of navigation -->

        <!-- Header -->
        <header id="header" class="header py-18 text-center md:pt-36 lg:text-left xl:pt-44 xl:pb-32" >
            <div class="container px-4 sm:px-8 lg:grid lg:grid-cols-2 lg:gap-x-8" id="contenido">
                <div class="mb-16 lg:mt-20 xl:mt-30 xl:mr-12" >
                    <h1 class="h1-large mb-5">Crea tu CV en línea rápido y fácil</h1>
                    <p class="p-large mb-8">Empieza ahora con nuestro avanzado creador de CV para elaborar un CV profesional y moderno. ¡Impulsa tu carrera ahora!</p>
                    <div v-if="!$page.props.auth.user">
                        <a class="btn-solid-lg" :href="route('login')"><i class="fa fa-user mr-1"></i> Login</a>
                        <a class="btn-solid-lg secondary" :href="route('register')"><i class="fa fa-bookmark mr-1"></i> Registrarse</a>
                    </div>
                </div>
                <div class="xl:text-right">
                    <img class="inline" src="images/header-cvs.png" alt="alternative" />
                </div>
            </div> <!-- end of container -->
        </header> <!-- end of header -->
        <!-- end of header -->


        <!-- Introduction -->
        <div class="pt-4 pb-4 text-center">
            <div class="container px-4 sm:px-8 xl:px-4">
                <h2 class="mt-4">Crea y descarga tus currículums fácilmente</h2>
                <p class="mb-1 text-gray-800 text-2xl leading-10 lg:max-w-5xl lg:mx-auto">Dar un impulso a tu carrera es muy fácil con nuestro editor de currículums online. Estos tres sencillos pasos pueden abrirte las puertas de tu próximo trabajo:</p>
            </div> <!-- end of container -->
        </div>
        <!-- end of introduction -->


        <!-- Features -->
        <div id="features" class="cards-1">
            <div class="container px-4 sm:px-8 xl:px-4">

                <!-- Card -->
                <div class="card">
                    <div class="card-image">
                        <img src="images/1_elige.png" alt="alternative" />
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Elige una Plantilla</h5>
                        <p class="mb-4">Crea un nuevo currículum y elige una plantilla</p>
                    </div>
                </div>
                <!-- end of card -->

                <!-- Card -->
                <div class="card">
                    <div class="card-image">
                        <img src="images/2_cubre.png" alt="alternative" />
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Introduce tus Datos</h5>
                        <p class="mb-4">Introduce fácilmente tu formación, experiencia, cursos, habilidades, etc.</p>
                    </div>
                </div>
                <!-- end of card -->

                <!-- Card -->
                <div class="card">
                    <div class="card-image">
                        <img src="images/3_descarga.png" alt="alternative" />
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Descarga tu CV</h5>
                        <p class="mb-4">Descarga tu currículum en formato PDF o Word.</p>
                    </div>
                </div>
                <!-- end of card -->


            </div> <!-- end of container -->
        </div> <!-- end of cards-1 -->
        <!-- end of features -->





        <!-- Pricing -->
        <div id="pricing" class="cards-2">
            <div class="absolute bottom-0 h-40 w-full bg-white"></div>
            <div class="container px-4 pb-px sm:px-8">
                <h2 class="mb-2.5 text-white lg:max-w-xl lg:mx-auto">Pricing options for all budgets</h2>
                <p class="mb-16 text-white lg:max-w-3xl lg:mx-auto"> Our pricing plans are setup in such a way that any user can start enjoying Pavo without worrying so much about costs. They are flexible and work for any type of industry </p>

                <!-- Card-->
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">STANDARD</div>
                        <div class="price"><span class="currency">$</span><span class="value">29</span></div>
                        <div class="frequency">monthly</div>
                        <p>This basic package covers the marketing needs of small startups</p>
                        <ul class="list mb-7 space-y-2 text-left">
                            <li class="flex">
                                <i class="fas fa-chevron-right"></i>
                                <div>List building and relations</div>
                            </li>
                            <li class="flex">
                                <i class="fas fa-chevron-right"></i>
                                <div>Seamless platform integration</div>
                            </li>
                            <li class="flex">
                                <i class="fas fa-chevron-right"></i>
                                <div>Great performance on devices</div>
                            </li>
                            <li class="flex">
                                <i class="fas fa-chevron-right"></i>
                                <div>Community support and videos</div>
                            </li>
                        </ul>
                        <div class="button-wrapper">
                            <a class="btn-solid-reg page-scroll" href="#download">Download</a>
                        </div>
                    </div>
                </div> <!-- end of card -->
                <!-- end of card -->

                <!-- Card-->
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">ADVANCED</div>
                        <div class="price"><span class="currency">$</span><span class="value">39</span></div>
                        <div class="frequency">monthly</div>
                        <p>This is a more advanced package suited for medium companies</p>
                        <ul class="list mb-7 space-y-2 text-left">
                            <li class="flex">
                                <i class="fas fa-chevron-right"></i>
                                <div>List building and relations</div>
                            </li>
                            <li class="flex">
                                <i class="fas fa-chevron-right"></i>
                                <div>Seamless platform integration</div>
                            </li>
                            <li class="flex">
                                <i class="fas fa-chevron-right"></i>
                                <div>Great performance on devices</div>
                            </li>
                            <li class="flex">
                                <i class="fas fa-chevron-right"></i>
                                <div>Community support and videos</div>
                            </li>
                        </ul>
                        <div class="button-wrapper">
                            <a class="btn-solid-reg page-scroll" href="#download">Download</a>
                        </div>
                    </div>
                </div> <!-- end of card -->
                <!-- end of card -->

                <!-- Card-->
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">COMPLETE</div>
                        <div class="price"><span class="currency">$</span><span class="value">49</span></div>
                        <div class="frequency">monthly</div>
                        <p>This is a comprehensive package designed for big organizations</p>
                        <ul class="list mb-7 text-left space-y-2">
                            <li class="flex">
                                <i class="fas fa-chevron-right"></i>
                                <div>List building and relations</div>
                            </li>
                            <li class="flex">
                                <i class="fas fa-chevron-right"></i>
                                <div>Seamless platform integration</div>
                            </li>
                            <li class="flex">
                                <i class="fas fa-chevron-right"></i>
                                <div>Great performance on devices</div>
                            </li>
                            <li class="flex">
                                <i class="fas fa-chevron-right"></i>
                                <div>Community support and videos</div>
                            </li>
                        </ul>
                        <div class="button-wrapper">
                            <a class="btn-solid-reg page-scroll" href="#download">Download</a>
                        </div>
                    </div>
                </div> <!-- end of card -->
                <!-- end of card -->

            </div> <!-- end of container -->
        </div> <!-- end of cards-2 -->
        <!-- end of pricing -->




        <!-- Footer -->
        <div class="footer">
            <div class="container px-4 sm:px-8">
                <h4 class="mb-8 lg:max-w-3xl lg:mx-auto">Pavo is a mobile application for marketing automation and you can reach the team at <a class="text-indigo-600 hover:text-gray-500" href="mailto:email@domain.com">email@domain.com</a></h4>
                <div class="social-container">
                    <span class="fa-stack">
                        <a href="#your-link">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fab fa-facebook-f fa-stack-1x"></i>
                        </a>
                    </span>
                    <span class="fa-stack">
                        <a href="#your-link">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fab fa-twitter fa-stack-1x"></i>
                        </a>
                    </span>
                    <span class="fa-stack">
                        <a href="#your-link">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fab fa-pinterest-p fa-stack-1x"></i>
                        </a>
                    </span>
                    <span class="fa-stack">
                        <a href="#your-link">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fab fa-instagram fa-stack-1x"></i>
                        </a>
                    </span>
                    <span class="fa-stack">
                        <a href="#your-link">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fab fa-youtube fa-stack-1x"></i>
                        </a>
                    </span>
                </div> <!-- end of social-container -->
            </div> <!-- end of container -->
        </div> <!-- end of footer -->
        <!-- end of footer -->



        <!-- Copyright -->
        <div class="copyright">
            <div class="container px-4 sm:px-8 lg:grid lg:grid-cols-3">
                <ul class="mb-4 list-unstyled p-small">
                    <li class="mb-2"><a href="article.html">Article Details</a></li>
                    <li class="mb-2"><a href="terms.html">Terms & Conditions</a></li>
                    <li class="mb-2"><a href="privacy.html">Privacy Policy</a></li>
                </ul>
                <p class="pb-2 p-small statement">Copyright © <a href="#your-link" class="no-underline">Your name</a></p>

                <p class="pb-2 p-small statement">Distributed by :<a href="https://themewagon.com/" class="no-underline">Themewagon</a></p>
            </div> 

        <!-- end of container -->
        </div> <!-- end of copyright -->
        <!-- end of copyright -->


</template>



<style>
    @import "../../css/app.css";
    
    @import "../../css/fontawesome-all.css";
    @import "../../css/magnific-popup.css";
    @import "../../css/swiper.css";
    @import "../../css/styles.css";

    .logo {
        color: #000;
        display:table;
    }

    .logo:hover {
        color: #ff6e84;
    }

    .titlelogo {
        display:table-cell;
        vertical-align:middle;
    }

    .borde {
        border: 1px solid black;
    }



</style>