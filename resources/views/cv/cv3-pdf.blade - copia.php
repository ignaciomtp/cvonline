<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

      <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    @include('cv.style-options.'.$color)

    @include('cv.styles.'.'common-styles')

    @include('cv.styles.'.'template3')

    <title>Hello, world!</title>

  </head>

  <body style="font-size: 21.5px;">

      <div id="sidebar" class="block-25 ib height100 backprimary m-0 verticaltop">
        <div class="nametitle pt-3 px-2 pb-1" >
          {{ $user->name }} {{ $user->surname }}
        </div>
        <div class="jobtitle px-2 secondary-color py-1">
          {{ $user->job }}
        </div>

        <div class="p-2">
          <img src="{{ public_path('storage/images/' . $user->photo) }}" class="mb-1" >
        </div>

        <div class="section-sidebar-title p-2">
          Datos de contacto
        </div>

        <div class="address2 px-2 py-2 mb-2">
            <span class="negrita">Dirección</span><br>
            {{ $user->address }}, <br>
            {{ $user->zip }} {{ $user->city }} <br>
            <span class="negrita">Email</span><br>
            {{ $user->email }} <br>
            <span class="negrita">Teléfono</span><br>
            {{ $user->phone }}
        </div>

        <div class="section-sidebar-title p-2 ">
          Habilidades
        </div>

        <div class=" p-2 mb-2">
          @foreach($skills as $skill)
          <div class="p-1 skills ">   
            <div class="fonside ib block-50 ">
              <strong>{{ $skill->name }}</strong>     
            </div>   


              <div class="ib block-45 text-right ">
                @for($i = 0; $i < $skill->level; $i++)
                  <div class="starblock">
                    @include('cv.icons.star-fill-pdf', ['color' => config("colors.".$colorIcons)])
                  </div>
                 
                @endfor

                @if($skill->level < 5)
                  @for($j = 0; $j < 5 - $skill->level; $j++)
                    <div class="starblock">
                      @include('cv.icons.star-pdf', ['color' => config("colors.".$colorIcons)])
                    </div>
                    
                  @endfor
                @endif
              </div>              

          </div>
          @endforeach
        </div>

      </div> <!-- end sidebar -->

      <div class="block-72 verticaltop pt-4 px-1 m-0 ib">
        <div id="profile" @class(['d-inline' => in_array('profile', $visibleSections), 'd-none' => ! in_array('profile', $visibleSections),])>
         <p class="profile mb-4">{{ $profile }}
         </p>
        </div>

        <div id="experiencia" @class(['d-inline' => in_array('experience', $visibleSections), 'd-none' => ! in_array('experience', $visibleSections),])>
          <div class=" bbottomcolor2 m-0 p-0">
            <span class="section-main-title textcolor mb-2">Experiencia</span>
          </div>

          @foreach($experiences as $exp)
          <div class="my-2 font80 p-0">
            
              <div class="block-15 ib smfont negrita m-0 borde" >
                {{ $exp->date_start }}<br>
                {{ $exp->date_finish }}
              </div>
              <div class="block-80 ib pl-1 verticaltop borde" >
                <span class=""><strong>{{ $exp->title }}</strong> - </span>
                <span class="m-0 mayus">{{ $exp->company_name }},</span> <span>{{ $exp->company_city }}</span>
                <div >{!! $exp->job_description !!}</div>
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
          <div class="my-2 font80">

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
          <div class="my-2 font80">

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
            <div class="my-2 font80">

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


  </body>
</html>