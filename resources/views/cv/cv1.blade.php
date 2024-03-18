<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

@include('cv.style-options.gold')


<style type="text/css">

body {
  font-size: 0.9rem;
}


.jobtitle {
  font-size: 20px;
  
}


.address span {
  width: 20px;
  display: inline-block;
  
  height: 0.8rem;
}


.col-container {
  display: flex;
  justify-content: space-between;
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

.block-20 {
  width: 20%;
}

.block-10 {
  width: 10%;
}

.ib {
  display: inline-block;
}

.clrl {
  clear: left;
}

.clrr {
  clear: right;
}

.clr {
  clear: both;
}

.f-right {
  float: right;
}

.borde-r {
  border: 1px solid red;
}

.borde-v {
  border: 1px solid green;
}

.borde-a {
  border: 1px solid blue;
}

.black {
  color: black;
}



</style>


    <title>Hello, world!</title>
  </head>
  <body>
    <div class="col-container">

      <div class="block-30 f-right ">
        <div class="address ">
          <span>@include('cv.icons.geo-alt-fill', ['color' => '#AA9739', 'size' => 10])</span> {{ $user->address }}, <br>
          <span></span> {{ $user->zip }} {{ $user->city }} <br>
          <span>@include('cv.icons.envelope-fill', ['color' => '#AA9739', 'size' => 10])</span> {{ $user->email }} <br>
          <span>@include('cv.icons.telephone-fill', ['color' => '#AA9739', 'size' => 10])</span> {{ $user->phone }}
        </div>
      </div>

      <div class="block-10 ib mr-4">
        <img src="{{ public_path('storage/images/' . $user->photo) }}" height="100">
      </div>

      <div class="block-50 ib ml-2 ">
        <div class="nametitle " >
          {{ $user->name }} {{ $user->surname }}
        </div>
        <div class="jobtitle">
          {{ $user->job }}
        </div>
      </div>

    </div>

    <div class="clr"></div>

    <div class="">
     Lorem fistrum apetecan a gramenawer te va a hasé pupitaa llevame al sircoo jarl hasta luego Lucas ese hombree. Mamaar por la gloria de mi madre condemor te voy a borrar el cerito a wan está la cosa muy malar amatomaa ese pedazo de.
    </div>

    <div class="section mt-3 mb-2">
       Experiencia Profesional
    </div>

    <ul>
      @foreach($experiences as $exp)
      <li>
        <div class="sectioncontent">
          <span class="font-weight-bold">{{ $exp->title }}</span> en {{ $exp->company_name }}, {{ $exp->company_city }} ({{ $exp->date_start }} - {{ $exp->date_finish }})
          <p>
            {{ $exp->job_description }}
          </p>
        </div>
      </li>
      @endforeach
    </ul>
    

    <div class="section mt-3 mb-2">
      Formación Académica
    </div>

    <ul>
      @foreach($formations as $for)
      <li>
        <div class="sectioncontent">
          <span class="font-weight-bold">{{ $for->title }}</span>, {{ $for->institution }}, {{ $for->institution_city }} ({{ $for->date_finish }})
          
        </div>
      </li>
      @endforeach
    </ul>


    <div class="section mt-3 mb-2">
      Formación Complementaria
    </div>

    <ul>
      @foreach($complementary_formations as $cfor)
      <li>
        <div class="sectioncontent">
          <span class="font-weight-bold">{{ $cfor->title }}</span>, {{ $cfor->institution }}, {{ $cfor->institution_city }} ({{ $cfor->year }})
          
        </div>
      </li>
      @endforeach
    </ul>


    <div class="section mt-3 mb-3">
      Habilidades
    </div>

    <div class="col-container ">
      @foreach($skills as $skill)
      <div class="block-30 ib pt-2 pb-2">
        <div class="block-50 ib">
          <strong>{{ $skill->name }}</strong> 
        </div>
        
        <div class="block-40 ib black-green">
          @for($i = 0; $i < $skill->level; $i++)
           @include('cv.icons.star-fill', ['color' => '#AA9739'])
          @endfor

          @if($skill->level < 5)
            @for($j = 0; $j < 5 - $skill->level; $j++)
              @include('cv.icons.star', ['color' => '#AA9739'])
            @endfor
          @endif
        </div>
      </div>
      @endforeach
    </div>


  </body>
</html>