<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    @include('cv.style-options.'.$color)

    @include('cv.styles.'.'common-styles')

    @include('cv.styles.'.'template2')
    
    <title>Hello, world!</title>

  </head>

  <body class="p-3">
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
          <div class=" bbottomcolor2 m-0 p-0 mb-1">
            <div class="ib section-icon mr-1 px-1">@include('cv.icons.briefcase-fill', ['color' => '#fff', 'size' => 15])</div>
            <span class="section-main-title textcolor ">Experiencia</span>
          </div>

          <table>
          @foreach($experiences as $exp)
            <tr >
              <td class="block-15 smfont negrita verticaltop">
                {{ $exp->date_start }}<br>
                {{ $exp->date_finish }}
              </td>
              <td class="fontbase verticaltop ">
                  <span >{{ $exp->title }}</span> - 
                  <span class="m-0"><strong>{{ $exp->company_name }}</strong>, {{ $exp->company_city }}</span>
                  <p class="m-0">{!! $exp->job_description !!}</p>
              </td>
            </tr>
          @endforeach   
          </table> 
        </div>

        <div class="clboth mb-2"></div>

        <div id="formation" @class(['d-inline' => in_array('formation', $visibleSections), 'd-none' => ! in_array('formation', $visibleSections),])>

          <div class=" bbottomcolor2 m-0 p-0 mb-1">
            <div class="ib section-icon mr-1 px-1">@include('cv.icons.mortarboard-fill', ['color' => '#fff', 'size' => 15])</div>
            <span class="section-main-title textcolor">Formación</span>
          </div>

          <table>
          @foreach($formations as $for)
            <tr >
              <td class="block-15 smfont negrita verticaltop">
               {{ $for->date_finish }}
              </td>
              <td class="fontbase verticaltop ">
                <span class="font-weight-bold">{{ $for->title }} {{ $for->name }}</span><br>
                <p>{{ $for->institution }}, {{ $for->institution_city }}</p> 
              </td>
            </tr>
          @endforeach   
          </table>   
        </div>

        <div class="clboth mb-2"></div>

        <div id="complementary_formation" @class(['d-inline' => in_array('complementary_formation', $visibleSections), 'd-none' => ! in_array('complementary_formation', $visibleSections),])>
          <div class=" bbottomcolor2 m-0 p-0 mb-1">
            <div class="ib section-icon mr-1 px-1">@include('cv.icons.mortarboard-fill', ['color' => '#fff', 'size' => 15])</div>
            <span class="section-main-title textcolor ">Formación Complementaria</span>
          </div>

          <table>
          @foreach($complementary_formations as $cfor)
            <tr >
              <td class="block-15 smfont negrita verticaltop">
               {{ $cfor->year }}
              </td>
              <td class="fontbase verticaltop ">
                 {{ $cfor->title }} <span class="font-weight-bold">{{ $cfor->name }}</span> ({{ $cfor->hours }} horas), {{ $cfor->institution }}, {{ $cfor->institution_city }} 
              </td>
            </tr>
          @endforeach
          </table>
        </div>

        <div class="clboth mb-2"></div>

        <div id="languages" @class(['d-inline' => in_array('languages', $visibleSections), 'd-none' => ! in_array('languages', $visibleSections),])>
          <div class=" bbottomcolor2 m-0 p-0 mb-1">
            <div class="ib section-icon mr-1 px-1">@include('cv.icons.flag-fill', ['color' => '#fff', 'size' => 15])</div>
            <span class="section-main-title textcolor ">Idiomas</span>
          </div>

          <table>
          @foreach($languages as $lang)
            <tr >
              <td class="block-15 smfont negrita verticaltop">
               {{ $lang->name }}
              </td>
              <td class="fontbase verticaltop ">
                Nivel {{ $lang->level }} @if($lang->certification)<span>(Certificado <span class="font-weight-bold">{{ $lang->certification }}</span>)</span>@endif
              </td>
            </tr>
          @endforeach
          </table>
        </div>

       

        <div class="offerbox ">
          {{ $offer }}
        </div>

        
        
      </div> <!-- end main -->


      <div id="sidebar" class="block-25 ib floatright ">
        <img src="{{ asset('storage/images/' . $user->photo) }}" alt="Foto" class="mb-3 foto">
        <div class="bbottomcolor2 p-0">
          <div class="ib sidebar-icon mr-1 ">@include('cv.icons.person-fill', ['color' => '#fff', 'size' => 15])</div>
          <div class="section-sidebar-title textcolor  ib mb-neg10">Contacto</div>
        </div>
        
        <div class="my-1 mb-4">
          <div class="address ">
            <div class="mb-1">
              <span class="font-weight-bold">Dirección</span><br>
              {{ $user->address }}, <br>
              {{ $user->zip }} {{ $user->city }}
            </div>
            <div class="mb-1">
              <span class="font-weight-bold">Email</span><br>
              {{ $user->email }}
            </div>
            <div class="mb-1">
              <span class="font-weight-bold">Teléfono</span><br>
              {{ $user->phone }}
            </div>
            
          </div>
        </div>

        <div class="bbottomcolor2 p-0">
          <div class="ib sidebar-icon mb-neg10 mr-1 ">@include('cv.icons.puzzle-fill', ['color' => '#fff', 'size' => 15])</div>
          <div class="section-sidebar-title textcolor ib mb-neg10">Habilidades</div>
        </div>

        <div class="my-1 mb-4">
          @foreach($skills as $skill)
          <div class="py-1 skills">            
              <div class="ib block-45 skilltag"><strong>{{ $skill->name }}</strong>  </div>             
            
              <div class="ib block-50 ">
                @for($i = 0; $i < $skill->level; $i++)
                  <div class="starblock">
                    @include('cv.icons.star-fill-pdf', ['color' => config("colors.".$colorIcons),'size' => 16])
                  </div>
                 
                @endfor

                @if($skill->level < 5)
                  @for($j = 0; $j < 5 - $skill->level; $j++)
                    <div class="starblock">
                      @include('cv.icons.star-pdf', ['color' => config("colors.".$colorIcons),'size' => 16])
                    </div>
                    
                  @endfor
                @endif
              </div>
          </div>
          @endforeach
        </div>

      </div> <!-- end sidebar -->
    </div>

  </body>
</html>