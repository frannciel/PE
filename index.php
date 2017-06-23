<!DOCTYPE html>
<html lang="pt-BR">
   <head>
      <meta charset="UTF-8">
      <meta name="google-signin-scope" content="profile email">
      <meta name="google-signin-client_id" content="131804782068-7tjdq664uf5p2hllor3p6g7ebr9ki7q2.apps.googleusercontent.com">
      <script src="https://apis.google.com/js/platform.js" async defer></script>

      <link rel="stylesheet" type="text/css" href="css/styles.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
       integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
   </head>   
   <body>
      <div class="container">
         <div class="content col-lg-8 col-md-offset-2">
            <div class="panel panel-success">
                
               <div class="panel-heading">
                  <div class="row titulo">
                     <h2>Protocolo Eletrônico</h2>
                  </div>
               </div>
               
               <div class="panel-body" style="text-align: center">
                  
                   <form name="form_login" method="POST" action="php/autenticador.php">
                     <div class="row">
                        <div class="col-lg-2 col-md-offset-2">
                           <label>Email</label>
                        </div>
                        <div class="col-lg-6 titulo">
                           <input type="text" name="email" class="form-control">
                        </div>
                        <div class="col-lg-2 col-md-offset-2">
                          <label>Senha</label>
                          </div>
                        <div class="col-lg-6 titulo">
                           <input type="password" name="senha" class="form-control">
                        </div>
                        <div class="col-lg-4 col-md-offset-4">
                           <button type="submit" class="btn btn-primary btn-block"> Entrar</button>
                        </div>
                     </div> 
                  </form>     
                  <div class="user row">
                     <p id="user-email"></p>
                     <div class="g-signin2" align="center" data-onsuccess="onSignIn" data-theme="dark" data-width="200" data-height="30" data-longtitle="true" data-lang="pt-BR">testandoS</div>
                  </div>
               </div>
            </div>
         </div>
      </div>   
   </body>
   <script>
      function onSignIn(response) {
         // Conseguindo as informações do seu usuário:
         var perfil = response.getBasicProfile();

         // Recebendo o TOKEN que você usará nas demais requisições à API:
         var id_token = response.getAuthResponse().id_token;
         //console.log("~ le Tolkien: " + id_token);

         // Conseguindo o ID do Usuário
         var userID = perfil.getId();
         // Conseguindo o Nome do Usuário
         var userName = perfil.getName();
         // Conseguindo o E-mail do Usuário
         var userEmail = perfil.getEmail();


         //document.getElementById('user-photo').src = userPicture;
         //document.getElementById('user-name').innerText = userName;
         document.getElementById('user-email').innerText = userEmail;
        

         //Enviando o token para backend via post
         var xhr = new XMLHttpRequest();
         //xhr.open('POST', 'https://yourbackend.example.com/tokensignin');
         xhr.open('POST', 'php/autenticador.php');
         xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
         xhr.onload = function() {
           console.log('Signed in as: ' + xhr.responseText);
         };
         xhr.send('idtoken=' + id_token);
      };
      function signOut() {
         var auth2 = gapi.auth2.getAuthInstance();
         auth2.signOut().then(function () {
            console.log('User signed out.');
         });
      }
   </script>
   <!-- Latest compiled and minified JavaScript -->
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
      integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
   </script>
</html>