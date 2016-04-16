<?php
function renderPage($weekends_consumed){
$weekends_lived = intval($weekends_consumed);
$weekends_left = 4680 - $weekends_lived;
?>
      <div class="row">
        <div class="col s12 m6">
          <div class="card cyan lighten-5">
            <div class="card-content black-text">
              <span class="card-title"><?php echo($weekends_left); ?> weekends left!</span>
              <p>You have consumed <?php echo($weekends_lived); ?> weekends, and have appoximately <?php echo($weekends_left); ?> weekends left to enjoy if you were to live upto the age of 90.</p>
              <br/><p>Feel free to bookmark this page and comeback later anytime. We will remember you as long as you don't change your browser or device.</p>
            </div>
            <div class="card-action">
              <a href="#" id="clearcookie">Stop Remembering me</a>
              <a href="#">Visit the Project</a>
            </div>
          </div>
        </div>
        
        <div class="col s12 m6">
          <div class="card amber darken-4">
            <div class="card-content white-text no-mobile">
              <span class="card-title">What do the boxes mean?</span>
              <br/>
              <br/>
              <div class="weekend-box past">&nbsp;</div> These are your weekends from past.<br/>
              <div class="weekend-box">&nbsp;</div> These are your weekends that are remaining.<br/>
              <div class="weekend-box retired">&nbsp;</div> These are your weekends after retirement (Age: 65).
            </div>
            
            <div class="card-content white-text only-mobile" style="display: none;">
              <span class="card-title">Random note</span>
              <p>
                Normally you would see a visual of the amount of approximate weekends you have left in your lifespan. But since you are on a mobile device or device with a small screen,
                it's not being displayed. You are encouraged to visit this page on you desktop/laptop.
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="center-align no-mobile">
<?php
  
for($i = 0; $i < 4680; $i++){
?>
        <div class="weekend-box <?php if($weekends_lived > $i){echo('past');} ?> <?php if($i > 65*52){echo('retired');}?>">&nbsp;</div>
<?php
}
?>
        </div>
        <ul class="collapsible" data-collapsible="accordion" style="margin-top: 30px;">
        <li>
          <div class="collapsible-header">Disclaimer</div>
          <div class="collapsible-body"><p>You want to read a disclaimer inspite of knowing how few weekends one really has, but now that you are here you might as well read it entirely. 
            This website or its developers (We) cannot be held liable for any crazy vacation ideas that come up as a result of using this tool. We are not wizards who can predict your exact lifespan. 
            We hope you live over 90 years but we consider 90 to be a realistic lifespan in todays times. Feel free to do whatever you want. Share. Peace.</p></div>
        </li>
      </ul>
<?php
} // End of renderPage()

function renderForm(){
?>
      <form method="post">
        <input type="date" class="datepicker white center-align" placeholder="Select your Date of Birth" name="dateofbirth"/>
        <input type="submit" value="Submit" class="waves-effect waves-light btn"/>
      </form>
<?php
} // End of renderForm()
?>
<!doctype html>
<html>
  <head>
    <title>How many weekends do I have left?</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Have you ever wondered, How many weekends do you have left? Click here to use this interactive tool to find out!">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8">
    <link rel="icon" href="favicon.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css">
    <style>
      body{
        background-image: url('media/background.jpg');
        background-attachment: fixed;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
      }
      #page{
        width: 90%;
        margin: 5% auto;
        box-shadow: 0 0 10px #444;
        padding: 3%;
        background: rgba(255,255,255,0.6);
      }
      .weekend-box{
        display: inline-block;
        width: 8px;
        height: 10px;
        background: #8AFF83;
        border: 1px solid #444;
        line-height: 9px;
      }
      .past{
        background: #F72929;
      }
      .retired{
        background: #555;
      }
      .marginten{
        margin-left: 10px;
      }
      @media only screen and (max-width: 780px) {
          .no-mobile{
              display: none;
          }
        .only-mobile{
          display: block!important;
        }
      }
    </style>
  </head>
  <body>
    <div id="page" class="container">    
      <h1 class="center-align">How many weekends do I have?</h1>
<?php
       if(isset($_POST["cookie"])){
        if (isset($_COOKIE['lived_weeks'])) {
          unset($_COOKIE['lived_weeks']);
          setcookie('lived_weeks', '', time() - 3600); // empty value and old timestamp
        }
       }
      
      if(!isset($_COOKIE["lived_weeks"])){
        if(isset($_POST["dateofbirth"])){
          $date_elements = $_POST["dateofbirth"];
          $date_elements = explode('-', $date_elements);
          $years_lived = intval(date('Y')) - intval($date_elements[0]);
          $months_lived = intval(date('m')) - intval($date_elements[1]);
          $days_lived = intval(date('d')) - intval($date_elements[2]);
          $weekends_consumed = (($years_lived*52) + (($months_lived * 30) + $days_lived)/7);
          setcookie(
            "lived_weeks",
            $weekends_consumed,
            time() + (10 * 365 * 24 * 60 * 60)
          );
          renderPage($weekends_consumed);
        }
        // End of Set age cookie
        else{
          
          renderForm();
        }
      }
      
      else{



// How many weekends do I have left
if(isset($_COOKIE["lived_weeks"])){
  renderPage(intval($_COOKIE["lived_weeks"]));
}

              // End of main Else
}
?>
      
    </div><!-- #page -->
    <footer class="page-footer teal lighten-2">
      <div class="container">
            <div class="row">
              <div class="col l12 center-align">
                <p>This Project is a part of a case study done by <a href="https://vic.fdes.pro" title="Victor Fernandes" class="white-text">Victor Fernandes</a></p>
              </div>
        </div>
      </div>
          <div class="footer-copyright">
            <div class="container center-align">
               
            <a class="grey-text text-lighten-4  marginten" href="#!">Source Code</a>&nbsp;&nbsp;
            <a class="grey-text text-lighten-4  marginten" href="#!">Read the study</a>
            </div>
          </div>
      </footer>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
    <script type="text/JavaScript">
    $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    max: Date(),
    selectYears: 80, // Creates a dropdown of 15 years to control year
    format: 'You selecte!d: dddd, dd mmm, yyyy',
    formatSubmit: 'yyyy-mm-dd',
    hiddenName: true,
    close: 'Ok',
    today: null,
    clear: 'Cancel'
    });
      $( "#clearcookie" ).click(function() {
          //Your values here..
        $.post(window.location.href, { cookie: 0 } );
        $(location).attr('href', 'https://vic.fdes.pro/projects/how-many-weekends-do-i-have/'); // Enter your URL here so that the browser redirects here after successful cookie deletion. 
      });
    </script>
  </body>
</html>