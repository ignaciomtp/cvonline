<style type="text/css">
body {
  
  font-size: {{ $settings['base_font_size']  }}px;
  margin: 0; /* Elimina márgenes por defecto */
  height: 100%; /* Altura completa del contenedor */
}

html, body {
  width: 100%; /* Asegura ancho completo */
  height: 100%; /* Asegura altura completa */
}

#sidebar {
  position: absolute; /* Posicionamiento absoluto */
  top: 0;
  left: 0;
}

#maincontent {
  /*width: 75%;  75% del ancho */
  height: 100%; /* 100% de la altura del contenedor padre */
  position: absolute; /* Posicionamiento absoluto */
  top: 0;
  left: 25%; /* Desplazado para empezar después del sidebar */  
}

table {
  width: 100%;
}

img {
  display: block;
  width: 100%;
  height: auto;
}

ul {
    margin: 0;
    padding: 0;
    margin-left: 20px;
    padding-left: 20px; /* Ajusta el margen izquierdo de la lista */
    list-style-position: outside;
}
li {
    margin: 0;
    padding: 0;
    text-indent: 0;
}

.height100vh {
  height: 842px; /* 100% del alto del viewport */
}

.dancing-script-maincontent {
  font-family: "Dancing Script", cursive;
  font-optical-sizing: auto;
  font-weight: 500>;
  font-style: normal;
}

.starblock, .starblock2 {
  display: inline-block;
  text-align: center; /* Centra horizontalmente elementos en línea */
  line-height: 9px; /* Centra verticalmente ajustando al alto del contenedor */
  width: 8px;
  height: 9px;
  margin: 0 1px;
}

.starblock2, .verticaltop {
  vertical-align: top;
}


.starblock svg {
    vertical-align: middle; /* Asegura alineación vertical */
    display: inline-block; /* Trata el SVG como un elemento en línea */
    margin-bottom: 4px;
}

.starblock2 svg {
    vertical-align: middle; /* Asegura alineación vertical */
    display: inline-block; /* Trata el SVG como un elemento en línea */
    margin-top: 11px;

}

.jobtitle {
  font-size: {{ $settings['job_size']  }}px;
  line-height: {{ $settings['job_line_height']  }}px;
}

.nametitle {
  font-size: {{ $settings['name_size']  }}px;
  line-height: {{ $settings['name_line_height']  }}px;
  font-weight: bold;
}

.section-main-title {
  font-size: {{ $settings['section_size']  }}px; 
  

}

.section-sidebar-title {
  font-size: 0.8em;  
  font-weight: bold;
  background-color: #000;
  vertical-align: middle;
}

.font90 {
  font-size: 0.9em;
  
}

.font80 {
  font-size: 0.8em;
  
}

.profile {
  font-size: 0.8em;
  line-height: 1em;  
}

.address {
  font-size: {{ $settings['address_size']  }}px;
  
}

.address2 {
  font-size: {{ $settings['address_size']  }}px;
}

.fonside {
  font-size: 0.6em;

}

.smfont {
  font-size: 0.7em;
  
}

.section {
  {{ $settings['section_size']  }}px;
  
}

.skills {
  padding-top: 0 !important;
  padding-bottom: 0 !important;

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



.mb-neg10 {
  margin-bottom: -5px !important;
}

.bbottomcolor2 {
  border-bottom: 1px solid {{ config("colors.".$colorIcons) }};
}

.offerbox {
  font-size: 0.1em;
  line-height: 0.2em;  
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