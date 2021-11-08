<?php
/**
 * Arikaim
 *
 * @link        http://www.arikaim.com
 * @copyright   Copyright (c)  Konstantin Atanasov <info@arikaim.com>
 * @license     http://www.arikaim.com/license
 * 
*/
namespace Arikaim\Extensions\Pages\Controllers;

use Arikaim\Core\Db\Model;
use Arikaim\Core\Controllers\ControlPanelApiController;
use Arikaim\Core\Controllers\Traits\Status;

/**
 * Site pages control panel controler
*/
class PageControlPanel extends ControlPanelApiController
{
    use Status;

    /**
     * Init controller
     *
     * @return void
     */
    public function init()
    {
        $this->loadMessages('pages::admin.messages');
    }

    /**
     * Constructor
     * 
     * @param Container|null $container
     */
    public function __construct($container = null) 
    {
        parent::__construct($container);
        $this->setModelClass('Pages');
        $this->setExtensionName('Blog');
    }

    /**
     * Add page
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param Validator $data
     * @return Psr\Http\Message\ResponseInterface
    */
    public function addController($request, $response, $data) 
    {         
        $this->onDataValid(function($data) {
            $title = $data->get('title');
            $page = Model::SitePages('pages');

            if ($page->hasPage($title) == true) {
                $this->error('errors.page.exist');
                return false;
            }
            $result = $page->create([
                'name' => $title
            ]);
            $this->setResponse(\is_object($result),function() use($result) {                                                       
                $this
                    ->message('page.add')
                    ->field('uuid',$result->page)
                    ->field('slug',$result->slug);           
            },'errors.page.add');
        });
        $data
            ->addRule('text:min=2','name')
            ->validate();   
    }

    /**
     * Update page
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param Validator $data
     * @return Psr\Http\Message\ResponseInterface
    */
    public function updateController($request, $response, $data) 
    {    
        $this->onDataValid(function($data) {
            $pageName = $data->get('title');
            $uuid = $data->get('uuid');
            $model = Model::SitePages('pages')->findById($uuid);

            if ($model->hasPage($pageName,$uuid) == true) {
                $this->error('errors.page.exist');
                return false;
            }

            $page = $model->findById($uuid);
            if (\is_object($page) == false) {
                $this->error('errors.page.id');
                return false;
            }

            $result = $page->update([
                'name' => $pageName
            ]);
         
            $this->setResponse(($result !== false),function() use($page) {                                                       
                $this
                    ->message('page.update')
                    ->field('uuid',$page->uuid)
                    ->field('slug',$page->slug);           
            },'errors.page.update');
        });
        $data
            ->addRule('text:min=2','name')
            ->validate();   
    }

    /**
     * Delete page
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param Validator $data
     * @return Psr\Http\Message\ResponseInterface
    */
    public function delete($request, $response, $data)
    { 
        $this->onDataValid(function($data) {                  
            $uuid = $data->get('uuid');
            $page = Model::SitePages('pages')->findById($uuid);
                       
            if (\is_object($page) == false) {
                $this->error('errors.page.id');
                return false;              
            } 
            $result = $page->delete();

            $this->setResponse(($result !== false),function() use($uuid) {              
                $this
                    ->message('page.delete')
                    ->field('uuid',$uuid);                  
            },'errors.page.delete');
        });
        $data
            ->addRule('text:min=2|required','uuid')           
            ->validate(); 

        return $this->getResponse();            
    }
}
