<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="file:///{{ public_path('css/bootstrap.min.css') }}">

    @include('cv.style-options.'.$color)

    @include('cv.styles.'.'common-styles')

    @include('cv.styles.'.'template3')

    <title>Hello, world!</title>

  </head>

  <body >

      <div id="sidebar" class="block-25  backprimary m-0 verticaltop height100">
        <div class="nametitle pt-3 px-2 pb-1" >
          {{ $user->name }} {{ $user->surname }}
        </div>
        <div class="jobtitle px-2 secondary-color py-1">
          {{ $user->job }}
        </div>

        <div class="p-2">
          <img src="file:///{{ public_path('storage/images/' . $user->photo) }}" class="mb-1" alt="Foto" >
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
          <div class=" skills ">   
            <div class="fonside ib block-40 ">
              <strong>{{ $skill->name }}</strong>     
            </div>   

              <div class="ib block-50 text-right ">
                @for($i = 0; $i < $skill->level; $i++)
                  <div class="starblock2 ">
                    @include('cv.icons.star-fill-pdf', ['color' => config("colors.".$colorIcons),'size' => 15])
                  </div>
                 
                @endfor

                @if($skill->level < 5)
                  @for($j = 0; $j < 5 - $skill->level; $j++)
                    <div class="starblock2 ">
                      @include('cv.icons.star-pdf', ['color' => config("colors.".$colorIcons),'size' => 15])
                    </div>
                    
                  @endfor
                @endif
              </div>              

          </div>
          @endforeach
        </div>

      </div> <!-- end sidebar -->

      <div class="block-72 verticaltop pt-4 px-1 m-0 height100" id="maincontent">
        <div id="profile" @class(['d-inline' => in_array('profile', $visibleSections), 'd-none' => ! in_array('profile', $visibleSections),])>
         <p class="font80 mb-4">{{ $profile }}
         </p>
        </div>

        <div id="experiencia" @class(['d-inline' => in_array('experience', $visibleSections), 'd-none' => ! in_array('experience', $visibleSections),])>
          <div class=" bbottomcolor2 m-0 p-0">
            <span class="section-main-title textcolor mb-2">Experiencia</span>
          </div>

          <table >
          @foreach($experiences as $exp)
            <tr>
              <td class="block-15 smfont negrita pt-1 verticaltop ">
                {{ $exp->date_start }}<br>
                {{ $exp->date_finish }}
              </td>
              <td class="block-85 pl-1 font80 verticaltop ">
                <strong>{{ $exp->title }}</strong> - 
                <span class="m-0 mayus">{{ $exp->company_name }},</span> <span>{{ $exp->company_city }}</span>
                <div >{!! $exp->job_description !!}</div>
              </td>
            </tr>

          @endforeach   
          </table>
        </div>

        <div class="sep20"></div>

        <div id="formation" @class(['d-inline' => in_array('formation', $visibleSections), 'd-none' => ! in_array('formation', $visibleSections),])>

          <div class=" bbottomcolor2 m-0 p-0">
            <span class="section-main-title textcolor mb-2">Formación</span>
          </div>

          <table >
          @foreach($formations as $for)

            <tr class="my-2 font80">
              <td class="block-15 negrita verticaltop">
                {{ $for->date_finish }}
              </td>
              <td class="block-85 pl-1  verticaltop ">
                <span class="font-weight-bold">{{ $for->title }} {{ $for->name }}</span><br>
                <p>{{ $for->institution }}, {{ $for->institution_city }}</p> 
              </td>
            </tr>


          @endforeach   
          </table>   
        </div>

        <div class="sep20"></div>

        <div id="complementary_formation" @class(['d-inline' => in_array('complementary_formation', $visibleSections), 'd-none' => ! in_array('complementary_formation', $visibleSections),])>
          <div class=" bbottomcolor2 m-0 p-0">
            <span class="section-main-title textcolor mb-2">Formación Complementaria</span>
          </div>

          <table >
          @foreach($complementary_formations as $cfor)
            <tr class="my-2 font80">
              <td class="block-15 negrita verticaltop">
                {{ $cfor->year }}
              </td>
              <td class="block-85 pl-1  verticaltop ">
                {{ $cfor->title }} <span class="font-weight-bold">{{ $cfor->name }}</span> ({{ $cfor->hours }} horas), {{ $cfor->institution }}, {{ $cfor->institution_city }} 
              </td>

            </tr>

          @endforeach
          <table >
        </div>

        <div class="sep20"></div>

        <div id="languages" @class(['d-inline' => in_array('languages', $visibleSections), 'd-none' => ! in_array('languages', $visibleSections),])>
          <div class=" bbottomcolor2 m-0 p-0">
            <span class="section-main-title textcolor mb-2">Idiomas</span>
          </div>

          <table >
          @foreach($languages as $lang)
            <tr class="my-2 font80">
              <td class="block-15 negrita verticaltop">{{ $lang->name }}</td>
              <td class="block-85 pl-1  verticaltop ">
                Nivel {{ $lang->level }} @if($lang->certification)<span>(Certificado <span class="font-weight-bold">{{ $lang->certification }}</span>)</span>@endif
              </td>
            </tr>

          @endforeach
        </table>
        </div>

        <div class="sep20"></div>

         <div class="offerbox ">
          {{ $offer }}
        </div>


      </div> <!-- end main block -->   


  </body>
</html>