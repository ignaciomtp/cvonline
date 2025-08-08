<style type="text/css">


.col-container {
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap ;
}

.jobtitle {
  font-size: {{ $settings['job_size'] }}em;
}

.jobtitle2 {
  font-size: 1.3em;
}

.nametitle {
  font-size: {{ $settings['name_size'] }}em;
  line-height: 2em;
}

.nametitle2 {
  font-size: 1.5em;
  line-height: 1.7em;
}

.address {
  font-size: {{ $settings['address_size'] }}em;
  line-height: {{ $settings['address_line_height'] }}em;
}

.address2 {
  font-size: 0.8em;
  line-height: 1.2em;
}

.section {
  font-size: {{ $settings['section_size'] }}em;
  
}

.section2 {
  font-size: 1.3em;
  
}

.address span {
  width: 20px;
  display: inline-block;
  
  height: 0.8rem;
}

.address2 span {
  width: 15px;
  display: inline-block;
  
  height: 0.8rem;
}

.bottomalign {
  display: flex;
  flex-direction: column;
  justify-content: flex-end;  
}



.text90 {
  font-size: 0.em;
}

.text85 {
  font-size: 0.85em;
}

.text83 {
  font-size: 0.83em;
}

.text80 {
  font-size: 0.8em;
}

.borde-a {
  border: 1px solid blue;
}

.black {
  color: black;
}


</style>