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

    @include('cv.styles.'.'template2')
    
    <title>Hello, world!</title>

  </head>

  <body>
    <div class="p-0 mb-2">
      <div class="nametitle secondary-color p-0" >
        {{ $user->name }} {{ $user->surname }}
      </div>
      <div class="jobtitle p-0">
        {{ $user->job }}
      </div>
    </div>

    <div id="profile" @class(['d-inline' => in_array('profile', $visibleSections), 'd-none' => ! in_array('profile', $visibleSections),])>
     <p class="fontbase mb-4">{{ $profile }}
     </p>
    </div>

    <div class=" p-0 ">
      <div class="block-70 ib ">

        <div id="experiencia" @class(['d-inline' => in_array('experience', $visibleSections), 'd-none' => ! in_array('experience', $visibleSections),])>
          <div class=" bbottomcolor2 m-0 p-0">
            <div class="ib section-icon mb-neg10 mr-1 ">@include('cv.icons.briefcase-fill', ['color' => '#fff', 'size' => 10])</div>
            <span class="section-main-title textcolor mb-2">Experiencia</span>
          </div>

          @foreach($experiences as $exp)
          <div class="my-2">
            <div class="sectioncontent">
              <div class="block-12 ib clboth smfont negrita">
                {{ $exp->date_start }}<br>
                {{ $exp->date_finish }}
              </div>
              <div class="block-83 ib floatright clboth fontbase ">
                <span class="mayus">{{ $exp->title }}</span> - 
                <span class="m-0"><strong>{{ $exp->company_name }}</strong>, {{ $exp->company_city }}</span>
                <p class="m-0">{!! $exp->job_description !!}</p>
              </div>
            </div>
          </div>
          @endforeach   
        </div>

        <div class="clboth mb-2"></div>

        <div id="formation" @class(['d-inline' => in_array('formation', $visibleSections), 'd-none' => ! in_array('formation', $visibleSections),])>

          <div class=" bbottomcolor2 m-0 p-0">
            <div class="ib section-icon mb-neg10 mr-1 ">@include('cv.icons.mortarboard-fill', ['color' => '#fff', 'size' => 10])</div>
            <span class="section-main-title textcolor mb-2">Formación</span>
          </div>

          @foreach($formations as $for)
          <div class="my-2">
            <div class="sectioncontent">
              <div class="block-12 ib clboth negrita font90">{{ $for->date_finish }}</div>
              <div class="block-83 ib floatright clboth ">
                <span class="font-weight-bold">{{ $for->title }} {{ $for->name }}</span><br>
                <p>{{ $for->institution }}, {{ $for->institution_city }}</p> 
              </div>            
              
            </div>
          </div>
          @endforeach      
        </div>

        <div class="clboth mb-2"></div>

        <div id="complementary_formation" @class(['d-inline' => in_array('complementary_formation', $visibleSections), 'd-none' => ! in_array('complementary_formation', $visibleSections),])>
          <div class=" bbottomcolor2 m-0 p-0">
            <div class="ib section-icon mb-neg10 mr-1 ">@include('cv.icons.mortarboard-fill', ['color' => '#fff', 'size' => 10])</div>
            <span class="section-main-title textcolor mb-2">Formación Complementaria</span>
          </div>


          @foreach($complementary_formations as $cfor)
          <div class="my-2">
            <div class="sectioncontent">
              <div class="block-12 ib clboth negrita font90">{{ $cfor->year }}</div>
              <div class="block-83 ib floatright clboth ">
                {{ $cfor->title }} <span class="font-weight-bold">{{ $cfor->name }}</span> ({{ $cfor->hours }} horas), {{ $cfor->institution }}, {{ $cfor->institution_city }} 
              </div>
              
              
            </div>
          </div>
          @endforeach
        </div>

        <div class="clboth mb-2"></div>

        <div id="languages" @class(['d-inline' => in_array('languages', $visibleSections), 'd-none' => ! in_array('languages', $visibleSections),])>
          <div class=" bbottomcolor2 m-0 p-0">
            <div class="ib section-icon mb-neg10 mr-1 ">@include('cv.icons.flag-fill', ['color' => '#fff', 'size' => 10])</div>
            <span class="section-main-title textcolor mb-2">Idiomas</span>
          </div>

          @foreach($languages as $lang)
            <div class="my-2">
              <div class="sectioncontent">
                <div class="block-12 ib clboth negrita">{{ $lang->name }}</div>
                <div class="block-83 ib floatright clboth ">
                  Nivel {{ $lang->level }} @if($lang->certification)<span>(Certificado <span class="font-weight-bold">{{ $lang->certification }}</span>)</span>@endif
                </div>              
                
              </div>
            </div>
          @endforeach
        </div>

       

        <div class="offerbox ">
          {{ $offer }}
        </div>

        
        
      </div> <!-- end main -->


      <div id="sidebar" class="block-25 ib floatright ">
        <img src="{{ public_path('storage/images/' . $user->photo) }}" class="mb-3" height="100">

        <div class="bbottomcolor2 p-0">
          <div class="ib sidebar-icon mb-neg10 mr-1 ">@include('cv.icons.person-fill', ['color' => '#fff', 'size' => 10])</div>
          <div class="section-sidebar-title textcolor  ib mb-neg10">Contacto</div>
        </div>
        
        <div class="my-1 mb-4">
          <div class="address ">
            <span class="font-weight-bold">Dirección</span><br>
            {{ $user->address }}, <br>
            {{ $user->zip }} {{ $user->city }} <br>
            <span class="font-weight-bold">Email</span><br>
            {{ $user->email }} <br>
            <span class="font-weight-bold">Teléfono</span><br>
            {{ $user->phone }}
          </div>
        </div>

        <div class="bbottomcolor2 p-0">
          <div class="ib sidebar-icon mb-neg10 mr-1 ">@include('cv.icons.puzzle-fill', ['color' => '#fff', 'size' => 10])</div>
          <div class="section-sidebar-title textcolor ib mb-neg10">Habilidades</div>
        </div>

        <div class="my-1 mb-4">
          @foreach($skills as $skill)
          <div class="py-1 skills">            
              <strong>{{ $skill->name }}</strong>             
            
              <span class="floatright ">
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
              </span>
          </div>
          @endforeach
        </div>

      </div> <!-- end sidebar -->
    </div>

  </body>
</html>