<style type="text/css">
body {
  font-size: 1rem;
  margin: 0;
  padding: 0;
  width: 595px;
  height: 842px;  
}

p {
  text-align: justify;
}



img {
  display: block;
  width: 100%;
  height: auto;
}


.dancing-script-maincontent {
  font-family: "Dancing Script", cursive;
  font-optical-sizing: auto;
  font-weight: 500>;
  font-style: normal;
}

.starblock {
  display: inline-block;
  width: 10px;
  height: 10px;
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

.nametitle {
  font-size: 30px;  
  line-height: 35px;
  font-weight: bold;
}

.section-main-title {
  font-size: 25px;  
  line-height: 30px;

}

.section-sidebar-title {
  font-size: 1rem;  
  font-weight: bold;
  background-color: #000;
  line-height: 2rem;
  vertical-align: middle;
}

.fs-2 {
    font-size: 2rem !important;
}

.profile {

  line-height: 1.2rem;  
}

.address {
  font-size: 0.8rem;
  line-height: 1.2rem;
}

.fonside {
  font-size: 0.8rem;
}

.smfont {
  font-size: 0.8rem;
  line-height: 1rem;  
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
  
  height: 0.8rem;
}

.mayus {
  text-transform: uppercase;
}

.block-85 {
  width: 85%;
}

.block-80 {
  width: 80%;
}

.block-75 {
  width: 72%;
}

.block-70 {
  width: 70%;
}

.block-65 {
  width: 68%;
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

.block-25 {
  width: 25%;
}

.block-20 {
  width: 20%;
}

.block-15 {
  width: 15%;
}

.block-12 {
  width: 12%;
}

.block-10 {
  width: 10%;
}

.ib {
  display: inline-block;
}

.borde {
  border: 1px solid black;
}

.mb-neg10 {
  margin-bottom: -5px !important;
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

.backprimary {
  background-color: {{ config("colors.".$color) }};
}

.backsecondary {
  background-color: {{ config("colors.".$colorIcons) }};
}

.sep20 {
  height: 20px !important;
}

.sep40 {
  height: 40px !important;
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