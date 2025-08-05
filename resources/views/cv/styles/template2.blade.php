    <style type="text/css">

body {
  font-size: 1rem;
}

p {
  text-align: justify;
}


img {
  display: block;
  width: 100%;
  height: auto;
}

.col-container {
  display: flex;
  justify-content: space-between;
  flex-wrap: nowrap ;
}

.starblock {
  display: inline-block;
  width: 8px;
  height: 9px;
  margin: 0 2px;
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

.jobtitle {
  font-size: 20px;
  
}

.jobtitle2 {
  font-size: 1.3em;
}

.nametitle {
  font-size: 30px;  
  line-height: 35px;
  font-weight: bold;
}

.nametitle2 {
  font-size: 1.7em; 
  font-weight: bold;
}

.section-main-title {
  font-size: 25px;  
  line-height: 30px;

}

.section-main-title2 {
  font-size: 1.35em;

}

.section-sidebar-title {
  font-size: 18px;  

  font-weight: bold;
}

.fs-2 {
    font-size: 2rem !important;
}

.profile {

  line-height: 1.2em;  
}

.fontbase {
  font-size: 0.85em;
  line-height: 1em;  
}

.fontbase2 {
  font-size: 0.9em;
  line-height: 1.15em;  
}

.address {
  font-size: 0.9rem;
  line-height: 1.4rem;
}

.smfont {
  font-size: 0.8rem;
  line-height: 1rem;  
}

.smfont2 {
  font-size: 0.7rem;
  line-height: 0.9rem; 
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

.sidebar-icon2 {
  width: 22px;
  height: 24px;
  padding: 2px;
  background-color: {{ config("colors.".$colorIcons) }};
  text-align: center;
  line-height: 24px;
}


.sidebar-icon2 img {
    position: relative;
    top: -10%;
    left: -10%;

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

.section-icon2 {
  width: 28px;
  height: 28px;
  padding: 5px;
  background-color: {{ config("colors.".$colorIcons) }};
  text-align: center;
  line-height: 26px;
  outline: 2px solid {{ config("colors.".$colorIcons) }};
}

.section-icon img {
    position: relative;
    top: -30%;
    left: -30%;

}

.section-icon2 img {
    position: relative;

}

.secondary-color {
  color: {{ config("colors.".$colorIcons) }};
}

.address span {
  width: 20px;
  display: inline-block;
  
  height: 0.8rem;
}

.borde {
  border: 1px solid black;
}

.mb-neg10 {
  margin-bottom: -5px !important;
}

.mb-neg17 {
  margin-bottom: -7px !important;
}

.bbottomcolor2 {
  border-bottom: 1px solid {{ config("colors.".$colorIcons) }};
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
