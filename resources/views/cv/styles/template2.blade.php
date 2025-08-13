    <style type="text/css">

body {
  font-size: 12pt;
}

p {
  text-align: justify;
}

table {
  width: 100%;
}

.col-container {
  display: flex;
  justify-content: space-between;
  flex-wrap: nowrap ;
}

.starblock, .starblock2 {
  display: inline-block;
  text-align: center; /* Centra horizontalmente elementos en línea */
  line-height: 10px; /* Centra verticalmente ajustando al alto del contenedor */
  width: 10px;
  height: 10px;
  margin: 0 1px;
}

.starblock2, .verticaltop {
  vertical-align: top;
}


.starblock svg {
    vertical-align: middle; /* Asegura alineación vertical */
    display: inline-block; /* Trata el SVG como un elemento en línea */
    margin-bottom: 5px;
}

.starblock2 svg {
    vertical-align: middle; /* Asegura alineación vertical */
    display: inline-block; /* Trata el SVG como un elemento en línea */
    margin-top: 4px;

}

.floatright {
  float: right;
}

.floatleft {
  float: left;
}

.clright {
  clear: right;
}

.clboth {
  clear: both;
}


.nametitle {
  font-size: 20pt;  
  font-weight: bold;
}

.jobtitle {
  font-size: 16pt;
  
}

.section-main-title {
  font-size: 14pt;  

}


.section-sidebar-title {
  font-size: 12pt;  
  font-weight: bold;
}

.fontbase {
  font-size: 12pt;
  line-height: 15pt;
}


.font90 {
  font-size: 0.9em;
}

.font80 {
  font-size: 0.8em;
}

.address {
  font-size: 10pt;
  line-height: 12pt;
}


.skilltag {
  font-size: 10pt;
}

.smfont {
  font-size: 9.5pt;
  
}



.section {
  font-size: 18pt;
  
}

.sidebar-icon, .sidebar-icon2 {
  background-color: {{ config("colors.".$colorIcons) }};
  text-align: center; /* Centra horizontalmente elementos en línea */
  line-height: 23px; /* Centra verticalmente ajustando al alto del contenedor */
  height: 23px; /* Alto del contenedor */
  width: 23px; /* Ancho del contenedor */
}


.sidebar-icon svg {
    vertical-align: middle; /* Asegura alineación vertical */
    display: inline-block; /* Trata el SVG como un elemento en línea */
}

.sidebar-icon2 svg {
    vertical-align: middle; /* Asegura alineación vertical */
    display: inline-block; /* Trata el SVG como un elemento en línea */
    margin-right: 2px;
    margin-bottom: 4px;
}


.section-icon, .section-icon2 {
  /* width: 16pt; */
  background-color: {{ config("colors.".$colorIcons) }};
  text-align: center; /* Centra horizontalmente elementos en línea */
  line-height: 30px; /* Centra verticalmente ajustando al alto del contenedor */
  height: 30px; /* Alto del contenedor */
  width: 30px; /* Ancho del contenedor */
}

.section-icon svg {
    vertical-align: middle; /* Asegura alineación vertical */
    display: inline-block; /* Trata el SVG como un elemento en línea */
}


.section-icon2 svg {
    vertical-align: middle; /* Asegura alineación vertical */
    display: inline-block; /* Trata el SVG como un elemento en línea */
    margin-bottom: 7px;
}

.foto {
  width: 100%;
  object-fit: contain;
}


.section-icon2 img {
    position: relative;

}

.secondary-color {
  color: {{ config("colors.".$colorIcons) }};
}

.skills {
  margin: 0;
}

.borde {
  border: 1pt solid black;
}

.mb-neg10 {
  margin-bottom: -5pt !important;
}

.mb-neg17 {
  margin-bottom: -7pt !important;
}

.bbottomcolor2 {
  border-bottom: 1pt solid {{ config("colors.".$colorIcons) }};
}

.offerbox {
  font-size: 0.1rem;
  line-height: 0.2rem;  
  color: #FFF; 
}

.negrita {
  font-weight: bold;
}

    </style>
