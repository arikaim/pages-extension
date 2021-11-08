'use strict';

arikaim.component.onLoaded(function() {
    arikaim.ui.form.onSubmit("#page_form",function() {  
        return pagesControlPanel.add('#page_form');
    },function(result) {          
        arikaim.ui.form.showMessage(result.message);     
        pagesView.showPagesList();   
    });
});