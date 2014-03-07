<?php
/**
 * 
 * User: Windows
 * Date: 2/26/14
 * Time: 12:38 AM
 * 
 */

namespace Application\Strategy;



use Application\Strategy\StrategyModel\ImageModel;
use Application\Strategy\StrategyRenderer\ImageRenderer;
use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface;
use Zend\View\Renderer\RendererInterface;
use Zend\View\ViewEvent;

class ImageStrategy extends AbstractListenerAggregate {


    protected $listeners = array();


    protected $renderer;

    protected $imageType;

    public function __construct(ImageRenderer $renderer){


        $this->renderer = $renderer;
    }

    /**
     * Attach one or more listeners
     *
     * Implementors may add an optional $priority argument; the EventManager
     * implementation will pass this to the aggregate.
     *
     * @param EventManagerInterface $events
     *
     * @return void
     */
    public function attach(EventManagerInterface $events,$priority =1)
    {
        $this->listeners[] = $events->attach(ViewEvent::EVENT_RENDERER, array($this, 'selectRenderer'), $priority);
        $this->listeners[] = $events->attach(ViewEvent::EVENT_RESPONSE, array($this, 'injectResponse'), $priority);

    }
    public function selectRenderer(ViewEvent $e){

       $model = $e->getModel();



        if(!$model instanceof StrategyModel\ImageModel){


            return;
        }
        return $this->renderer;
    }

    public function injectResponse(ViewEvent $e){

        $renderer = $e->getRenderer();

        if ($renderer !== $this->renderer) {

            // Discovered renderer is not ours; do nothing
            return;
        }

        $result = $e->getResult();

        if(!is_file($result)){

            return;
        }

        $response = $e->getResponse();

        $headers = $response->getHeaders();
       // $headers->addHeaderLine('content-type', $renderer->getType());
        header('content-type: '.$renderer->getType(),true);
        $headers->addHeaderLine('content-transfer-encoding', 'BINARY');
        readfile($result);


    }

    /*
    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }
    */
    /**
     * @param mixed $imageType
     */
    public function setImageType($imageType)
    {
        $this->imageType = $imageType;
    }
    /**
     * @return mixed
     */
    public function getImageType()
    {
        return $this->imageType;
    }






} 