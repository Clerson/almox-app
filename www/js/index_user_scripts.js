/*jshint browser:true */
/*global $ */(function()
{
 "use strict";
 /*
   hook up event handlers 
 */
 function register_event_handlers()
 {
    
    
       
        

    $(document).on("click", "#envia", function(evt)
    {
                return false;
    });


    
    
    }
 document.addEventListener("app.Ready", register_event_handlers, false);
})();
