<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

      <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    @include('cv.style-options.'.$color)

    <style type="text/css">
body {
  font-size: 1rem;
  margin: 0;
  padding: 0;

}

p {
  text-align: justify;
}



img {
  display: block;
  width: 100%;
  height: auto;
}


.dancing-script-maincontent {
  font-family: "Dancing Script", cursive;
  font-optical-sizing: auto;
  font-weight: 500>;
  font-style: normal;
}

.starblock {
  display: inline-block;
  width: 10px;
  height: 10px;
  margin: 0 2px;
}

.floatright {
  float: right;
}

.floatleft {
  float: left;
}

.clright {
  clear: right;
}

.clboth {
  clear: both;
}

.jobtitle {
  font-size: 20px;
  
}

.nametitle {
  font-size: 30px;  
  line-height: 35px;
  font-weight: bold;
}

.section-main-title {
  font-size: 25px;  
  line-height: 30px;

}

.section-sidebar-title {
  font-size: 1rem;  
  font-weight: bold;
  background-color: #000;
  line-height: 2rem;
  vertical-align: middle;
}

.fs-2 {
    font-size: 2rem !important;
}

.profile {

  line-height: 1.2rem;  
}

.address {
  font-size: 0.8rem;
  line-height: 1.2rem;
}

.fonside {
  font-size: 0.8rem;
}

.smfont {
  font-size: 0.8rem;
  line-height: 1rem;  
}

.section {
  font-size: 18px;
  
}

.sidebar-icon {
  width: 12px;
  height: 12px;
  padding: 8px;
  background-color: {{ config("colors.".$colorIcons) }};
  text-align: center;
  line-height: 12px;
}


.sidebar-icon img {
    position: relative;
    top: -30%;
    left: -30%;

}

.section-icon {
  width: 16px;
  height: 16px;
  padding: 10px;
  background-color: {{ config("colors.".$colorIcons) }};
  text-align: center;
  line-height: 16px;
  outline: 2px solid {{ config("colors.".$colorIcons) }};
}

.section-icon img {
    position: relative;
    top: -30%;
    left: -30%;

}

.secondary-color {
  color: {{ config("colors.".$colorIcons) }};
}

.address span {
  width: 20px;
  display: inline-block;
  
  height: 0.8rem;
}

.mayus {
  text-transform: uppercase;
}

.block-85 {
  width: 85%;
}

.block-80 {
  width: 80%;
}

.block-75 {
  width: 72%;
}

.block-70 {
  width: 70%;
}

.block-65 {
  width: 68%;
}

.block-60 {
  width: 60%;
}

.block-50 {
  width: 50%;
}

.block-40 {
  width: 40%;
}

.block-30 {
  width: 30%;
}

.block-25 {
  width: 25%;
}

.block-20 {
  width: 20%;
}

.block-15 {
  width: 15%;
}

.block-12 {
  width: 12%;
}

.block-10 {
  width: 10%;
}

.ib {
  display: inline-block;
}

.borde {
  border: 1px solid black;
}

.mb-neg10 {
  margin-bottom: -5px !important;
}

.bbottomcolor2 {
  border-bottom: 1px solid {{ config("colors.".$colorIcons) }};
}

.offerbox {
  font-size: 0.1rem;
  line-height: 0.2rem;  
  color: #FFF; 
}

.negrita {
  font-weight: bold;
}

.backprimary {
  background-color: {{ config("colors.".$color) }};
}

.backsecondary {
  background-color: {{ config("colors.".$colorIcons) }};
}

.sep20 {
  height: 20px !important;
}

.sep40 {
  height: 40px !important;
}

#sidebar {
  overflow: hidden;
  color: #FFF;
  height: 100%;
}

@page {
    margin: 0 !important;
    padding: 0 !important;
}

    </style>

    <title>Hello, world!</title>

  </head>

  <body>

    <div>

      <div id="sidebar" class="block-25 ib backprimary ">
        <div class="nametitle pt-5 px-3 pb-0" >
          {{ $user->name }} {{ $user->surname }}
        </div>
        <div class="jobtitle px-3 secondary-color">
          {{ $user->job }}
        </div>

        <div class="p-3">
          <img src="{{ public_path('storage/images/' . $user->photo) }}" class="mb-1" height="100">
        </div>

        <div class="section-sidebar-title px-3 pt-1">
          Datos de contacto
        </div>

        <div class="address px-3 py-2 mb-2">
            <span class="font-weight-bold">Dirección</span><br>
            {{ $user->address }}, <br>
            {{ $user->zip }} {{ $user->city }} <br>
            <span class="font-weight-bold">Email</span><br>
            {{ $user->email }} <br>
            <span class="font-weight-bold">Teléfono</span><br>
            {{ $user->phone }}
        </div>

        <div class="section-sidebar-title px-3 pt-1">
          Habilidades
        </div>

        <div class=" px-3 py-2 mb-2">
          @foreach($skills as $skill)
          <div class="py-1 fonside skills">            
              <strong>{{ $skill->name }}</strong>             
            
              <span class="floatright ">
                @for($i = 0; $i < $skill->level; $i++)
                  <div class="starblock">
                    @include('cv.icons.star-fill', ['color' => config("colors.".$colorIcons)])
                  </div>
                 
                @endfor

                @if($skill->level < 5)
                  @for($j = 0; $j < 5 - $skill->level; $j++)
                    <div class="starblock">
                      @include('cv.icons.star', ['color' => config("colors.".$colorIcons)])
                    </div>
                    
                  @endfor
                @endif
              </span>
          </div>
          @endforeach
        </div>

      </div> <!-- end sidebar -->

      <div class="block-70 ib pt-5 pr-4 ml-0 floatright">
        <div id="profile" @class(['d-inline' => in_array('profile', $visibleSections), 'd-none' => ! in_array('profile', $visibleSections),])>
         <p class="profile mb-4">{{ $profile }}
         </p>
        </div>

        <div id="experiencia" @class(['d-inline' => in_array('experience', $visibleSections), 'd-none' => ! in_array('experience', $visibleSections),])>
          <div class=" bbottomcolor2 m-0 p-0">
            <span class="section-main-title textcolor mb-2">Experiencia</span>
          </div>

          @foreach($experiences as $exp)
          <div class="my-2 profile">
            
              <div class="block-12 floatleft smfont negrita " >
                {{ $exp->date_start }}<br>
                {{ $exp->date_finish }}
              </div>
              <div class="block-80 " style="margin-left: 100px;">
                <span class=""><strong>{{ $exp->title }}</strong></span> - 
                <span class="m-0 mayus">{{ $exp->company_name }}</span>, {{ $exp->company_city }}
                <p class="m-0">{!! $exp->job_description !!}</p>
              </div>
              <div class="clboth"></div>

          </div>
          @endforeach   
        </div>

        <div class="sep20"></div>

        <div id="formation" @class(['d-inline' => in_array('formation', $visibleSections), 'd-none' => ! in_array('formation', $visibleSections),])>

          <div class=" bbottomcolor2 m-0 p-0">
            <span class="section-main-title textcolor mb-2">Formación</span>
          </div>

          @foreach($formations as $for)
          <div class="my-2 profile">

              <div class="block-12 floatleft smfont negrita">{{ $for->date_finish }}</div>
              <div class="block-80 " style="margin-left: 100px;">
                <span class="font-weight-bold">{{ $for->title }} {{ $for->name }}</span><br>
                <p>{{ $for->institution }}, {{ $for->institution_city }}</p> 
              </div>            
              
          
          </div>
          @endforeach      
        </div>

        <div class="sep20"></div>

        <div id="complementary_formation" @class(['d-inline' => in_array('complementary_formation', $visibleSections), 'd-none' => ! in_array('complementary_formation', $visibleSections),])>
          <div class=" bbottomcolor2 m-0 p-0">
            <span class="section-main-title textcolor mb-2">Formación Complementaria</span>
          </div>


          @foreach($complementary_formations as $cfor)
          <div class="my-2 profile">

              <div class="block-12 floatleft smfont negrita">{{ $cfor->year }}</div>
              <div class="block-80 " style="margin-left: 100px;">
                {{ $cfor->title }} <span class="font-weight-bold">{{ $cfor->name }}</span> ({{ $cfor->hours }} horas), {{ $cfor->institution }}, {{ $cfor->institution_city }} 
              </div>
              
          </div>
          @endforeach
        </div>

        <div class="sep20"></div>

        <div id="languages" @class(['d-inline' => in_array('languages', $visibleSections), 'd-none' => ! in_array('languages', $visibleSections),])>
          <div class=" bbottomcolor2 m-0 p-0">
            <span class="section-main-title textcolor mb-2">Idiomas</span>
          </div>

          @foreach($languages as $lang)
            <div class="my-2 profile">

                <div class="block-12 floatleft smfont negrita">{{ $lang->name }}</div>
                <div class="block-80 " style="margin-left: 100px;">
                  Nivel {{ $lang->level }} @if($lang->certification)<span>(Certificado <span class="font-weight-bold">{{ $lang->certification }}</span>)</span>@endif
                </div>              
                
             
            </div>
          @endforeach
        </div>

        <div class="sep20"></div>

         <div class="offerbox ">
          {{ $offer }}
        </div>


      </div> <!-- end main block -->   




 


    </div> <!-- end container div -->




  </body>
</html>