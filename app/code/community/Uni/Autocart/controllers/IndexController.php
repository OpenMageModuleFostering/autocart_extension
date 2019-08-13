<?php
/**
 * Unicode Systems
 * @category   Uni
 * @package    Uni_Autocart
 * @copyright  Copyright (c) 2010-2011 Unicode Systems. (http://www.unicodesystems.in)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL)
 */

class Uni_Autocart_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {                
      $this->loadLayout();
      $this->renderLayout();         
    }

    
 }
