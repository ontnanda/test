<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\Adapter\Adapter;
use Zend\Json\Json;
use Zend\View\Model\JsonModel;

use Zend\Cache\StorageFactory;
use Zend\Cache\Storage\Adapter\Memcached;
use Application\Models\Test;

class TestController extends AbstractActionController
{
    public function __construct()
    {
        $this->cacheTime = 36000;
        $this->now = date("Y-m-d H:i:s");
        $this->config = include __DIR__ . '../../../../config/module.config.php';
       
        $MemcachedResourceManager = new \Zend\Cache\Storage\Adapter\MemcachedResourceManager();
        $MemcachedResourceManager->addServer('1', $this->config['memcached']['server']);

        $this->cache = \Zend\Cache\StorageFactory::adapterFactory('memcached', array(
            'resource_manager' => $MemcachedResourceManager,
            'resource_id'      => '1',
            'namespace'        => 'test_',
            'ttl'              => 60,
        ));
    }

    public function apiAction(){
        try
        {
            $id = $this->params()->fromRoute('id', '');
            $n = $this->params()->fromRoute('n', '');
            $Test = new Test();
            $memcached_key = 'test_'.$id.$n;
            $result = $this->cache->getItem($memcached_key);
            if(!$result)  {
                switch($id){
                    case 1:
                    $result = $Test->test1($n);
                    break;
                    
                    case 2:
                    $result = $Test->test2($n);
                    break;
                    
                    case 3:
                    $Test->test3($n, $result);
                    break;
                }
            }else{
                $result->cached = true;
                return $result;
            }
            $view = new ViewModel();
            $view->status = true;
            $view->result = $result;
            $view->cached = 0;
            $this->cache->setItem($memcached_key, $view);
            return $view;
        }
        catch( Exception $e )
        {
            $view = new ViewModel();
            $view->status = false;
            $view->result = '';
            return $view;
        }
    }
}