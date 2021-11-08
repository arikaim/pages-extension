<?php
/**
 * Arikaim
 *
 * @link        http://www.arikaim.com
 * @copyright   Copyright (c)  Konstantin Atanasov <info@arikaim.com>
 * @license     http://www.arikaim.com/license
 * 
*/
namespace Arikaim\Extensions\Pages\Models\Schema;

use Arikaim\Core\Db\Schema;

/**
 * Site pages db table
 */
class SitePagesSchema extends Schema  
{    
    /**
     * Table name
     *
     * @var string
     */
    protected $tableName = 'site_pages';

    /**
     * Create table
     *
     * @param \Arikaim\Core\Db\TableBlueprint $table
     * @return void
     */
    public function create($table) 
    {            
        // columns    
        $table->id();     
        $table->prototype('uuid');
        $table->string('title')->nullable(false);       
        $table->status();
        $table->slug();
        $table->metaTags();
        $table->dateCreated();
        $table->dateUpdated();
        // index
        $table->unique('title');
    }

    /**
     * Update table
     *
     * @param \Arikaim\Core\Db\TableBlueprint $table
     * @return void
     */
    public function update($table) 
    {              
    }
}
