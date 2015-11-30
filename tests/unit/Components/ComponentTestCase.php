<?hh

use DomNode;
use UnitTestCase;
use Symfony\Component\DomCrawler\Crawler;

class ComponentTestCase extends UnitTestCase {

  public function toCrawler($component) {
    return new Crawler($component->toString());
  }

}

