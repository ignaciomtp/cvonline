<style type="text/css">
body {
  

  display: flex; 
  flex-wrap: nowrap;
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


.dancing-script-maincontent {
  font-family: "Dancing Script", cursive;
  font-optical-sizing: auto;
  font-weight: 500>;
  font-style: normal;
}

.starblock {
  display: inline-block;
  width: 0.6rem;
  height: 0.6rem;
  margin: 0;
}



.jobtitle {
  font-size: 1.1em;
  line-height: 1.15em;
}

.nametitle {
  font-size: 1.3em; 
  line-height: 1.45em;
  font-weight: bold;
}

.section-main-title {
  font-size: 1.2em;  
  line-height: 1.3em; 

}

.section-sidebar-title {
  font-size: 0.7em;  
  font-weight: bold;
  background-color: #000;
  line-height: 0.9em;
  vertical-align: middle;
}




.profile {
  font-size: 0.8em;
  line-height: 1em;  
}

.address {
  font-size: 0.6em;
  line-height: 1.3em;
}

.fonside {
  font-size: 0.6em;
}

.smfont {
  font-size: 0.7em;
  
}

.section {
  font-size: 18px;
  
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

.address span {
  width: 20px;
  display: inline-block;
  
  height: 0.8em;
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