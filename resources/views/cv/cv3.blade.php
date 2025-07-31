<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

      <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    @include('cv.style-options.'.$color)

    @include('cv.styles.'.'template3')

    <title>Hello, world!</title>

  </head>

  <body style="width: 595px; height: 842px;">

      <div id="sidebar" class="block-25 height100 backprimary m-0">
        <div class="nametitle pt-3 px-2 pb-1" >
          {{ $user->name }} {{ $user->surname }}
        </div>
        <div class="jobtitle px-2 secondary-color py-1">
          {{ $user->job }}
        </div>

        <div class="p-2">
          <img src="{{ URL::asset('storage/images/' . $user->photo) }}" class="mb-1" >
        </div>

        <div class="section-sidebar-title px-2 pt-1 pb-1">
          Datos de contacto
        </div>

        <div class="address px-2 py-2 mb-2">
            <span class="font-weight-bold">Dirección</span><br>
            {{ $user->address }}, <br>
            {{ $user->zip }} {{ $user->city }} <br>
            <span class="font-weight-bold">Email</span><br>
            {{ $user->email }} <br>
            <span class="font-weight-bold">Teléfono</span><br>
            {{ $user->phone }}
        </div>

        <div class="section-sidebar-title px-2 pt-1 pb-1">
          Habilidades
        </div>

        <div class=" p-2 mb-2">
          @foreach($skills as $skill)
          <div class="py-1 skills">   
            <span class="fonside">
              <strong>{{ $skill->name }}</strong>     
            </span>         
                        
            <span class="floatright  ">
              @for($i = 0; $i < $skill->level; $i++)
                <div class="starblock">
                  @include('cv.icons.star-fill', ['color' => config("colors.".$colorIcons), 'size' => 12])
                </div>
               
              @endfor

              @if($skill->level < 5)
                @for($j = 0; $j < 5 - $skill->level; $j++)
                  <div class="starblock">
                    @include('cv.icons.star', ['color' => config("colors.".$colorIcons), 'size' => 12])
                  </div>
                  
                @endfor
              @endif
            </span>
          </div>
          @endforeach
        </div>

      </div> <!-- end sidebar -->

      <div class="block-72 pt-4 px-1 m-0">
        <div id="profile" @class(['d-inline' => in_array('profile', $visibleSections), 'd-none' => ! in_array('profile', $visibleSections),])>
         <p class="profile mb-4">{{ $profile }}
         </p>
        </div>

        <div id="experiencia" @class(['d-inline' => in_array('experience', $visibleSections), 'd-none' => ! in_array('experience', $visibleSections),])>
          <div class=" bbottomcolor2 m-0 p-0">
            <span class="section-main-title textcolor mb-2">Experiencia</span>
          </div>

          @foreach($experiences as $exp)
          <div class="my-2 profile dispflex p-0">
            
              <div class="block-15 smfont negrita m-0 " >
                {{ $exp->date_start }}<br>
                {{ $exp->date_finish }}
              </div>
              <div class="block-85  m-0 pl-1" >
                <span class=""><strong>{{ $exp->title }}</strong></span> - 
                <span class="m-0 mayus">{{ $exp->company_name }}</span>, {{ $exp->company_city }}
                <div class="m-0 ">{!! $exp->job_description !!}</div>
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
          <div class="my-2 profile dispflex p-0">

              <div class="block-20 smfont negrita">{{ $for->date_finish }}</div>
              <div class="block-80 ">
                <span class="font-weight-bold">{{ $for->title }} {{ $for->name }}</span><br>
                <p class="m-0">{{ $for->institution }}, {{ $for->institution_city }}</p> 
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
          <div class="my-2 profile dispflex p-0">

              <div class="block-20 smfont negrita">{{ $cfor->year }}</div>
              <div class="block-80 " >
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
            <div class="my-2 profile dispflex p-0">

                <div class="block-20 smfont negrita">{{ $lang->name }}</div>
                <div class="block-80 ">
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