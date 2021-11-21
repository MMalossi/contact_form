<!DOCTYPE html>
<html lang="it">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form contatto</title>
  <link rel="stylesheet" href="./css/main.css">
</head>

<body>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
  <main>
    <section class="contact-form-section">
      <div class="container">
        <h1>Resta in contatto con noi</h1>
        <p>Inserisci i tuoi dati per essere richiamato in seguito!</p>
        <form role="form" method="post" action="contact-form.php">
          <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" 
              class="form-element" 
              id="nome" 
              name="nome" 
              placeholder="Inserisci il tuo nome" 
              value="<?php if(isset($_GET['nome'])){echo $_GET['nome'];}?>" 
              required>
          </div>
          <div class="form-group">
            <label for="cognome">Cognome</label>
            <input type="text" 
              class="form-element" 
              id="cognome" 
              name="cognome" 
              placeholder="Inserisci il tuo cognome"
              value="<?php if(isset($_GET['cognome'])){echo $_GET['cognome'];}?>" 
              required>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" 
              class="form-element" 
              id="email" 
              name="email"
              placeholder="Inserisci la mail a cui vuoi essere contattato" 
              value="<?php if(isset($_GET['email'])){echo $_GET['email'];}?>" 
              required>
          </div>
          <div class="form-group full">
            <label for='indirizzo'>Indirizzo</label>
            <input type="text" 
              class="form-element" 
              id="indirizzo"
              name="indirizzo"
              placeholder='Inserisci il tuo indirizzo'
              value="<?php if(isset($_GET['via'])){echo $_GET['via'];}?>"  
              required 
              autocomplete="off" />
          </div>
          <div class="form-group">
            <label for='citta'>Città</label>
            <input type="text" 
              class="form-element" 
              id="citta" 
              name="citta" 
              placeholder="Città" 
              value="<?php if(isset($_GET['citta'])){echo $_GET['citta'];}?>" 
              required />
          </div>
          <div class="form-group">
            <label for='provincia'>Provincia</label>
            <input type="text" 
              class="form-element" 
              id="provincia" 
              name="provincia" 
              placeholder='Provincia' 
              value="<?php if(isset($_GET['provincia'])){echo $_GET['provincia'];}?>" 
              required />
          </div>
          <div class="form-group">
            <label for='CAP'>CAP</label>
            <input type="tel" 
              class="form-element" 
              id="CAP" 
              name="CAP" 
              placeholder='CAP' 
              value="<?php if(isset($_GET['CAP'])){echo $_GET['CAP'];}?>" 
              required />
          </div>
          <div class="form-group">
            <label for='nazione'>Nazione</label>
            <input type="text" 
              class="form-element" 
              id="nazione" 
              name="nazione" 
              placeholder='Nazione' 
              value="<?php if(isset($_GET['nazione'])){echo $_GET['nazione'];}?>" 
              required />
          </div>
          <div class="submit-group">
            <input type="submit" value="Contattaci" name="submit" />
          </div>
          <?php
          $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        
          if(strpos($url, "error=emptyField") == true){
            echo "<div class='form-group full error'>Verifica di aver compilato tutti i campi</div>";
          } else if (strpos($url, "error=invalidCharacter") == true){
            echo "<div class='form-group full error'>Verifica di non aver inserito caratteri speciali nei campi nome, cognome oppure città</div>";
          } else if (strpos($url, "error=notNumericCap") == true){
            echo "<div class='form-group full error'>Il CAP dev'essere un valore numerico</div>";
          } else if (strpos($url, "error=invalidEmail") == true){
            echo "<div class='form-group full error'>Verifica di aver inserito una mail corretta</div>";
          } else if (strpos($url, "error=db") == true){
            echo "<div class='form-group full error'>Si è verificato un errore tecnico, riprova più tardi</div>";
          } else if (strpos($url, "result=submitted") == true){
            echo "<div class='form-group full success'>Dati salvati correttamente, ti ringraziamo per averci contattato!</div>";
          }
        ?> 
        </form>
      </div>
    </section>
  </main>
  <script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyClDkCP7HIXSPU9OjUNL87SEYvJmQQi0Io&callback=initAutocomplete&libraries=places&v=weekly"></script>
  <script src="/contact_form/google.js"></script>

</body>

</html>
