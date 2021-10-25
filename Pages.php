<?php
/**
 * Arikaim
 *
 * @link        http://www.arikaim.com
 * @copyright   Copyright (c)  Konstantin Atanasov <info@arikaim.com>
 * @license     http://www.arikaim.com/license
 * 
*/
namespace Arikaim\Extensions\Pages;

use Arikaim\Core\Extension\Extension;

/**
 * Pages extension
*/
class Pages extends Extension
{
    /**
     * Install extension routes, events, jobs
     *
     * @return void
    */
    public function install()
    {
        // Control Panel        
        $this->addApiRoute('POST','/api/admin/pages/add','PageControlPanel','add','session');   
        $this->addApiRoute('PUT','/api/admin/pages/update','PageControlPanel','update','session');   
        $this->addApiRoute('PUT','/api/admin/pages/status','PageControlPanel','setStatus','session');   
        $this->addApiRoute('DELETE','/api/admin/pages/delete/{uuid}','PageControlPanel','delete','session');  
        // Relation map 
        $this->addRelationMap('page','SitePages');
        // Create db tables
        $this->createDbTable('SitePagesSchema');
    }   

    /**
     *  UnInstall extension
     *
     * @return void
     */
    public function unInstall()
    {
    }
}
