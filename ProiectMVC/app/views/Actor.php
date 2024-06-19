<!DOCTYPE html>
<html lang="en">
    <head>

        <link rel="stylesheet" href="http://localhost/ProiectMVC/public/css/styles.css">

        <meta charset="UTF-8">
        <title>
            Actor's Page
        </title>
        <link rel="icon" type="image/x-icon" href="http://localhost/ProiectMVC/public/pictures/icon.jpg">
    </head>
<body>
<header>
    <div class="search-bar" id="searchBar">
        <button class="dissmis" onclick="toggleSearchBar()"><img src="http://localhost/ProiectMVC/public/pictures/arrow.png" alt=""></button>
        <button onclick="window.location.href='http://localhost/ProiectMVC/app/views/home/HomePage.php'" class="search-barr">Home Page</button>
        <button onclick="window.location.href='http://localhost/ProiectMVC/app/views/Actori.php'" class="search-barr">Actors</button>
        <button onclick="window.location.href='http://localhost/ProiectMVC/app/views/Years.php'" class="search-barr">Years</button>
      </div>
    <div class="section-1">
        <div class="title">Actors Awards</div>
        <div class="button-group">
            <div class="search-container">
                <form action="#" method="get">
                    <input type="text" name="search" placeholder="Search...">
                    <button type="submit" class="search-container">
                        <img src="http://localhost/ProiectMVC/public/pictures/search.png" alt="Search" style="width: 30px; height: 30px;">
                    </button>
                  </form>
              </div>            
              <button class="button" onclick="window.location.href='http://localhost/ProiectMVC/app/views/home/HomePage.php'">Home Page</button>
              <button class="button" onclick="window.location.href='http://localhost/ProiectMVC/app/views/Actori.php'">Actors</button>
              <button class="button" onclick="window.location.href='http://localhost/ProiectMVC/app/views/Years.php'">Years</button>
            <button class="button border" onclick="toggleSearchBar()"><img src="http://localhost/ProiectMVC/public/pictures/3arrows.jpg" alt=""></button>
          </div>
    </div>
    <div class="actor">
        <img src="http://localhost/ProiectMVC/public/pictures/aw2023.png" alt="aw2023">
        <div>
            <p style="font-size: 25px;"><strong>Speach from the actor</strong></p>
            <p> Thank you. It's my honor to say a few words briefly on behalf of this incredible cast on this stage
             and to the extended family of “Oppenheimer” who can't be here. Thank you so much Chris Nolan and Emma Thomas.
             Thank you for the opportunity, thank you for the respect. Thank you for the invitation to play a genuine part
             in making this scarily, important film. Thank you to Donna Langley and Universal Pictures for believing in
             us and in the film. Thank you Chuck Roven, Andy Thompson, and John Papsidera. Thank you very much. And of 
             course, thank you SAG-AFTRA, thank you for this. Thank you for fighting for us. Thank you for every SAG-AFTRA 
             member whose support and whose sacrifice allows us to be standing here better than we were before. When we were 
             all last together, it was at the premiere of this film on July 14th last year when the strike was just about to 
             begin and led by our fearless leader the great Cillian Murphy. We went from the red carpet and we didn't see the 
             film that night. We happily went in the direction of solidarity with your good selves so this is a full circle 
             moment for us and to receive this recognition in a year of specular achievement from all of the people in this 
             room, our acting friends, our acting heroes, it means the world to us. We know how lucky we are and we are grateful 
             and we are humbled and we are proud not just to be in Mr. Nolan's masterpiece, but proud to be in your company. 
             Thank you so much.
            </p>
        </div> 
    </div>
</header>
<script>
    function toggleSearchBar() {
      var searchBar = document.getElementById("searchBar");
      searchBar.classList.toggle("show");
    }
    </script>
</body>
</html>