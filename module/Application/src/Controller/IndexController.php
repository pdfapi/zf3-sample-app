<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use PdfApi\Parameter\Enum\Orientation;
use PdfApi\Parameter\Enum\Size;
use PdfApi\PdfApi;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{

    private $pdfApi;

    public function __construct(PdfApi $pdfApi) {
        $this->pdfApi = $pdfApi;
    }
    
    public function indexAction()
    {

        $template = <<<HTML
        <html>
            <body>
                <h1>pdfapi.io makes PDF generation so easy.</h1>
                <p>And it can do complicated stuff.</p>
            </body>
        </html>
HTML;
        $header = <<<HTML
        <!DOCTYPE html>
        <html>
            <body>
                <p>pdfapi.io</p>
            </body>
        </html>
HTML;

        $footer = <<<HTML
        <!DOCTYPE html>
        <html>
            <body>
                <p>pdfapi.io</p>
            </body>
        </html>
HTML;

        $this->pdfApi->setHtml($template);
        $this->pdfApi->setHeader($header);
        //$this->pdfApi->setFooter($footer);
        $this->pdfApi->setSize(Size::A4);
        $this->pdfApi->setOrientation(Orientation::Landscape);

        $rawPdf = $this->pdfApi->generate();

        echo $rawPdf;

        return new ViewModel();
    }
}
