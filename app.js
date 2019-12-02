$('document').ready(function(){
    $('.home-page').click(function(event){
        event.preventDefault();
        
        $.ajax("", {
            type: 'POST',
            data: {
                
            }
        }).done(function(response){
            
        }).fail(function(){
            alert('Something went wrong with contacting the server');
        });
    });
    
    $('.add-u-page').click(function(event){
        event.preventDefault();
        
        $.ajax("", {
            type: 'POST',
            data: {
                
            }
        }).done(function(response){
            
        }).fail(function(){
            alert('Something went wrong with contacting the server');
        });
    });
    
    $('.new-issue-page').click(function(event){
        event.preventDefault();
        
        $.ajax("", {
            type: 'POST',
            data: {
                
            }
        }).done(function(response){
            
        }).fail(function(){
            alert('Something went wrong with contacting the server');
        });
    });
    
    $('.logout-page').click(function(event){
        event.preventDefault();
        
        $.ajax("", {
            type: 'POST',
            data: {
                
            }
        }).done(function(response){
            
        }).fail(function(){
            alert('Something went wrong with contacting the server');
        });
    });
});