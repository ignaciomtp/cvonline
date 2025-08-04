
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

@include('cv.style-options.'.$color)

@include('cv.styles.'.'common-styles')

@include('cv.styles.'.'template1')

  <title>Hello, world!</title>

  </head>
  <body class="p-2" style="width: 595px; height: 842px;">
    <div class="col-container ">

      <div class="block-10  mr-4">
        <img src="{{ URL::asset('storage/images/' . $user->photo) }}" height="100">
      </div>

      <div class="block-50  pl-2 bottomalign" style="height: 100px;">
        <span class="nametitle2 textcolor " >
          {{ $user->name }} {{ $user->surname }}
        </span>
        
        <span class="jobtitle2 ">
          {{ $user->job }}
        </span>
      </div>

      <div class="block-30  ">
        <div class="address2 textcolor bottomalign  pb-2" style="height: 100px;">
          <div>
            <span class="textcolor">@include('cv.icons.geo-alt-fill', ['color' => config("colors.".$colorIcons), 'size' => 16])</span> {{ $user->address }}, <br>
            <span></span> {{ $user->zip }} {{ $user->city }} <br>
          </div>

          <div>
            <span>@include('cv.icons.envelope-fill', ['color' => config("colors.".$colorIcons), 'size' => 16])</span> {{ $user->email }}
          </div>

          <div>
            <span>@include('cv.icons.telephone-fill', ['color' => config("colors.".$colorIcons), 'size' => 16])</span> {{ $user->phone }}
          </div>
                    
        </div>
      </div>

    </div>

    <div id="profile"  @class(['d-block' => in_array('profile', $visibleSections), 'd-none' => ! in_array('profile', $visibleSections), 'my-3'])>
     <p class=" text83">{{ $profile }}
     </p>
    </div>

    <div id="experiencia" @class(['d-block' => in_array('experience', $visibleSections), 'd-none' => ! in_array('experience', $visibleSections), 'my-3'])>

      <div class="section2 textcolor bbottomcolor mb-2">
         Experiencia Profesional
      </div>

        @foreach($experiences as $exp)
        <div class="m-2">
          <div class="sectioncontent text83">
            <span class="font-weight-bold">{{ $exp->title }}</span> en {{ $exp->company_name }}, {{ $exp->company_city }} ({{ $exp->date_start }} - {{ $exp->date_finish }})
            <p class="m-0">
              {!! $exp->job_description !!}
            </p>
          </div>
        </div>
        @endforeach   
    </div>


    <div id="formation" @class(['d-block' => in_array('formation', $visibleSections), 'd-none' => ! in_array('formation', $visibleSections), 'my-3'])>

      <div class="section2 textcolor bbottomcolor mb-2">
        Formación Académica
      </div>

      @foreach($formations as $for)
      <div class="m-2">
        <div class="sectioncontent text83">
          <span class="font-weight-bold">{{ $for->title }} {{ $for->name }}</span>, {{ $for->institution }}, {{ $for->institution_city }} ({{ $for->date_finish }})
          
        </div>
      </div>
      @endforeach      
    </div>


    <div id="complementary_formation" @class(['d-block' => in_array('complementary_formation', $visibleSections), 'd-none' => ! in_array('complementary_formation', $visibleSections), 'my-3'])>
      <div class="section2 textcolor bbottomcolor  mb-2">
        Formación Complementaria
      </div>


      @foreach($complementary_formations as $cfor)
      <div class="m-2">
        <div class="sectioncontent text83">
          {{ $cfor->title }} <span class="font-weight-bold">{{ $cfor->name }}</span>, {{ $cfor->institution }}, {{ $cfor->institution_city }} ({{ $cfor->year }})
          
        </div>
      </div>
      @endforeach
    </div>


    <div id="skills" @class(['d-block' => in_array('skills', $visibleSections), 'd-none' => ! in_array('skills', $visibleSections), 'my-3'])>

      <div class="section2 textcolor bbottomcolor  mb-3">
        Habilidades
      </div>

      <div class="col-container ">
        @foreach($skills as $skill)
        <div class="block-33 py-1 text83 ">
          <div class="block-40 ib ">
            <strong>{{ $skill->name }}</strong> 
          </div>
          
          <div class="block-50 ib ">
            @for($i = 0; $i < $skill->level; $i++)
             @include('cv.icons.star-fill', ['color' => config("colors.".$colorIcons), 'size' => 15])
            @endfor

            @if($skill->level < 5)
              @for($j = 0; $j < 5 - $skill->level; $j++)
                @include('cv.icons.star', ['color' => config("colors.".$colorIcons), 'size' => 15])
              @endfor
            @endif
          </div>
        </div>
        @endforeach
      </div>
    </div>


    <div id="languages" @class(['d-block' => in_array('languages', $visibleSections), 'd-none' => ! in_array('languages', $visibleSections), 'my-3'])>
      <div class="section2 textcolor bbottomcolor  mb-3">
        Idiomas
      </div>

      @foreach($languages as $lang)
        <div class="m-2">
          <div class="sectioncontent text83">
            <span class="font-weight-bold">{{ $lang->name }}</span>, nivel {{ $lang->level }} ({{ $lang->certification }})
            
          </div>
        </div>
      @endforeach
    </div>



  </body>
</html>