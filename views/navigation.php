<nav class="navbar navbar-expand-lg fixed-top navbar-dark">
  <a class="navbar-brand" href="index"><img class="logotyp-img" alt="soldagar - logotyp" title="Soldagar.se" src="public/img/soldagar-logo-small.png"><div class="logotyp-text" title="Soldagar.se" alt="text SVG Vektorgrafik"></div></a>
  <h1 class="sandheader">Hemsidor, Media, Grafisk Hjälp & Reklamproduktion</h1>
  <p class="inline-text">MediaLappen får solen lysa mer på ert företag</p>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
    <ul class="navbar-nav">
      
      <li class="nav-item  <?php 
            if ($this->title == "Soldagar"){echo "active";}
          ?>">
        <a class="nav-link" href="index">Hem</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="https://medialappen.se">MediaLappen</a>
      </li>
      
      
      <li class="nav-item <?php 
            if ($this->title == "Kontakta Oss"){echo "active";}
          ?>">
        <a class="nav-link" href="kontakt">Kontakta Oss</a>
      </li>

      <!--li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li-->
      
      <!--li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li-->
    </ul>
    
  </div>
</nav>