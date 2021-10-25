/**
 *  Arikaim
 *  @copyright  Copyright (c) Konstantin Atanasov <info@arikaim.com>
 *  @license    http://www.arikaim.com/license
 *  http://www.arikaim.com
 */
'use strict';

function PagesControlPanel() {
  
    this.add = function(data, onSuccess, onError) {
        return arikaim.post('/api/admin/pages/add',data,onSuccess,onError);          
    };

    this.delete = function(uuid, onSuccess, onError) {
        return arikaim.delete('/api/admin/pages/delete/' + uuid,onSuccess,onError);          
    };

    this.update = function(data, onSuccess, onError) {
        return arikaim.put('/api/admin/pages/update',data, onSuccess, onError);          
    };

    this.setStatus = function(uuid, status, onSuccess, onError) {
        var data = {
            uuid: uuid,
            status: status
        };
        
        return arikaim.put('/api/admin/pages/status',data,onSuccess,onError);          
    };
}

var pagesControlPanel = new PagesControlPanel();

arikaim.component.onLoaded(function() {
    arikaim.ui.tab();      
});