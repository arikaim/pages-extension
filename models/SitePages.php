<?php
/**
 * Arikaim
 *
 * @link        http://www.arikaim.com
 * @copyright   Copyright (c)  Konstantin Atanasov <info@arikaim.com>
 * @license     http://www.arikaim.com/license
 * 
*/
namespace Arikaim\Extensions\Pages\Models;

use Illuminate\Database\Eloquent\Model;

use Arikaim\Core\Db\Traits\Uuid;
use Arikaim\Core\Db\Traits\Slug;
use Arikaim\Core\Db\Traits\Find;
use Arikaim\Core\Db\Traits\Status;
use Arikaim\Core\Db\Traits\DateCreated;
use Arikaim\Core\Db\Traits\DateUpdated;

/**
 * SitePages model class
 */
class SitePages extends Model  
{
    use Uuid,
        Find,
        Slug,
        Status,
        DateCreated,
        DateUpdated;
       
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'site_pages';

    /**
     * Fillable columns
     *
     * @var array
     */
    protected $fillable = [
        'title',       
        'status',
        'slug',
        'date_created',
        'date_updated'
    ];
   
    public $timestamps = false;
    
    /**
     * Slug source column
     *
     * @var string
     */
    protected $slugSourceColumn = 'title';
    
    /**
     * Return true if page exist
     *
     * @param string $id Model Id, uuid or title
     * @return boolean
     */
    public function hasPage($id, ?string $exclude = null): bool
    {
        $model = $this->findPage($id,$exclude);

        return \is_object($model);
    }

    /**
     * Find page
     *
     * @param string|integer $title Model Id, Uuid, Slug or Ttitle
     * @param string|null $exclude
     * @return Model|false
     */
    public function findPage($title, ?string $exclude = null)
    {
        $model = $this->findById($title);
        if (\is_object($model) == false) {
            $model = $this->findByColumn($title,'title');
        }
        if (\is_object($model) == false) {
            $model = $this->findBySlug($title);
        }
        if (\is_object($model) == false) {
            return false;
        }

        return (empty($exclude) == false && $model->uuid == $exclude) ? false : $model;       
    } 
}
