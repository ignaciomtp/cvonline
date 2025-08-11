
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="file:///{{ public_path('css/bootstrap.min.css') }}">
@include('cv.style-options.'.$color)

@include('cv.styles.'.'common-styles')

@include('cv.styles.'.'template1')

  <title>Hello, world!</title>

  </head>
  <body class="p-3">

      <table>
        <tr>
          <td class="block-10 ">
            <img src="file:///{{ public_path('storage/images/' . $user->photo) }}" alt="Foto" height="120">
          </td>
          <td class="block-50 ">
            <div class="nametitle textcolor" >
              {{ $user->name }} {{ $user->surname }}
            </div>
            <div class="jobtitle">
              {{ $user->job }}
            </div>           
          </td>
          <td class="block-30">
            <div class="address textcolor">
              <table>
                <tr>
                  <td class="block-10">
                    @include('cv.icons.geo-alt-fill', ['color' => config("colors.".$colorIcons), 'size' => 18])
                  </td>
                  <td>
                    {{ $user->address }},
                  </td>
                </tr>

                <tr>
                  <td class="block10"></td>
                  <td>{{ $user->zip }} {{ $user->city }}</td>
                </tr>
                
                <tr>
                  <td class="block-10">
                    @include('cv.icons.envelope-fill', ['color' => config("colors.".$colorIcons), 'size' => 18])
                  </td>
                  <td>
                    {{ $user->email }}
                  </td>                  
                </tr>

                <tr>
                  <td class="block-10">
                    @include('cv.icons.telephone-fill', ['color' => config("colors.".$colorIcons), 'size' => 18])
                  </td>
                  <td>
                    {{ $user->phone }}
                  </td>
                </tr>
              </table>

            </div>
          </td>
        </tr>
      </table>

    <div id="profile" @class(['d-block' => in_array('profile', $visibleSections), 'd-none' => ! in_array('profile', $visibleSections), 'my-3'])>
     <p>{{ $profile }}
     </p>
    </div>

    <div id="experiencia" @class(['d-block' => in_array('experience', $visibleSections), 'd-none' => ! in_array('experience', $visibleSections), 'my-3'])>

      <div class="section textcolor bbottomcolor mb-2">
         Experiencia Profesional
      </div>

        @foreach($experiences as $exp)
        <div class="m-2">
          <div class="sectioncontent">
            <span class="font-weight-bold">{{ $exp->title }}</span> en {{ $exp->company_name }}, {{ $exp->company_city }} ({{ $exp->date_start }} - {{ $exp->date_finish }})
            <p class="m-0">
              {!! $exp->job_description !!}
            </p>
          </div>
        </div>
        @endforeach   
    </div>


    <div id="formation" @class(['d-block' => in_array('formation', $visibleSections), 'd-none' => ! in_array('formation', $visibleSections), 'my-3'])>

      <div class="section textcolor bbottomcolor mb-2">
        Formación Académica
      </div>

      @foreach($formations as $for)
      <div class="m-2">
        <div class="sectioncontent">
          <span class="font-weight-bold">{{ $for->title }} {{ $for->name }}</span>, {{ $for->institution }}, {{ $for->institution_city }} ({{ $for->date_finish }})
          
        </div>
      </div>
      @endforeach      
    </div>


    <div id="complementary_formation" @class(['d-block' => in_array('complementary_formation', $visibleSections), 'd-none' => ! in_array('complementary_formation', $visibleSections), 'my-3'])>
      <div class="section textcolor bbottomcolor  mb-2">
        Formación Complementaria
      </div>


      @foreach($complementary_formations as $cfor)
      <div class="m-2">
        <div class="sectioncontent">
          {{ $cfor->title }} <span class="font-weight-bold">{{ $cfor->name }}</span>, {{ $cfor->institution }}, {{ $cfor->institution_city }} ({{ $cfor->year }})
          
        </div>
      </div>
      @endforeach
    </div>


    <div id="skills" @class(['d-block' => in_array('skills', $visibleSections), 'd-none' => ! in_array('skills', $visibleSections), 'my-3'])>

      <div class="section textcolor bbottomcolor  mb-3">
        Habilidades
      </div>

      <div class="m-0 ">
        @foreach($skills as $skill)
        <div class="block-32 ib py-1 skill m-0 ">
          <div class="block-45 ib ">
            <strong>{{ $skill->name }}</strong> 
          </div>
          
          <div class="block-50 ib ">
            @for($i = 0; $i < $skill->level; $i++)
             @include('cv.icons.star-fill-pdf', ['color' => config("colors.".$colorIcons), 'size' => 14])
            @endfor

            @if($skill->level < 5)
              @for($j = 0; $j < 5 - $skill->level; $j++)
                @include('cv.icons.star-pdf', ['color' => config("colors.".$colorIcons), 'size' => 14])
              @endfor
            @endif
          </div>
        </div>
        @endforeach
      </div>
    </div>


    <div id="languages" @class(['d-block' => in_array('languages', $visibleSections), 'd-none' => ! in_array('languages', $visibleSections), 'my-3'])>
      <div class="section textcolor bbottomcolor  mb-3">
        Idiomas
      </div>

      @foreach($languages as $lang)
        <div class="m-2">
          <div class="sectioncontent">
            <span class="font-weight-bold">{{ $lang->name }}</span>, nivel {{ $lang->level }} ({{ $lang->certification }})
            
          </div>
        </div>
      @endforeach
    </div>



  </body>
</html>