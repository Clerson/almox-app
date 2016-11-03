$( document ).ready(function() {
                    var $server;
                    $server = 'http://localhost/almox-app/www/';
                     
                        

    
                        $('#envia').on('click', function(){
                        $un = $('#un').val();
                        $pw = $('#pw').val();
                        
                          $.ajax({
                            type: "get",
                            url: $server+"/login_envia.php",
                            data: "usuario="+$un+"&senha="+$pw,
                            success: function(data) {
                                alert('Seja Bem Vindo!');
                                $.mobile.navigate('index.php');

                                // window.open("index.php",'_self');
                                // window.location.replace('index.php');

                                /*     
                                  url = "index.php";       
                                  $( location ).attr("href", url);*/    
                                
                              

                            }
                          });
                        });
                    
});