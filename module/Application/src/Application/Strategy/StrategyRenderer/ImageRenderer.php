<?php
/**
 * 
 * User: Windows
 * Date: 2/26/14
 * Time: 11:16 AM
 * 
 */

namespace Application\Strategy\StrategyRenderer;


use Application\Strategy\StrategyModel\ImageModel;
use Zend\View\Model\ModelInterface;
use Zend\View\Renderer\RendererInterface;
use Zend\View\Resolver\ResolverInterface;

class ImageRenderer implements RendererInterface {


    protected $resolver;

    protected $imageTypes = array(
        'image/jpeg',
        'image/png',
        'image/x-png',
        'image/gif',
    );

    protected $type;

    protected $img;
    /**
     * Return the template engine object, if any
     *
     * If using a third-party template engine, such as Smarty, patTemplate,
     * phplib, etc, return the template engine object. Useful for calling
     * methods on these objects, such as for setting filters, modifiers, etc.
     *
     * @return mixed
     */
    public function getEngine()
    {
        return $this;
    }

    /**
     * Set the resolver used to map a template name to a resource the renderer may consume.
     *
     * @param  ResolverInterface $resolver
     * @return RendererInterface
     */
    public function setResolver(ResolverInterface $resolver)
    {
        $this->resolver = $resolver;

    }



    /**
     * Processes a view script and returns the output.
     *
     * @param  string|ModelInterface $nameOrModel The script/resource process, or a view model
     * @param  null|array|\ArrayAccess $values Values to use during rendering
     * @return string The script output.
     */
    public function render($nameOrModel, $values = null)
    {
        $result = null;
        $img = null;
        if($nameOrModel instanceof ModelInterface){
            if($nameOrModel instanceof ImageModel){

             $img  = $nameOrModel->getVariable('image');
              if(!$img){
                  throw new \Exception("The file variable should be passed with 'image' key");
              }
              $tmp = explode(';', finfo_file(finfo_open(FILEINFO_MIME), $img));
              if(!in_array($tmp[0],$this->imageTypes)){
                  throw new \Exception("The image of type  is not allowed.");
              }

            }
        }
        return $img;
    }


    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $img
     */
    public function setImg($img)
    {
        $this->img = $img;
    }

    /**
     * @return mixed
     */
    public function getImg()
    {
        return $this->img;
    }


} 