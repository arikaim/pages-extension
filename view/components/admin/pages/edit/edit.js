'use strict';

arikaim.component.onLoaded(function() {
    arikaim.ui.form.onSubmit("#page_form",function() {  
        return pagesControlPanel.update('#page_form');
    },function(result) {          
        arikaim.ui.form.showMessage(result.message);        
    });
});