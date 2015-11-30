<?hh

use DomNode;
use UnitTestCase;
use Symfony\Component\DomCrawler\Crawler;

class ComponentTestCase extends UnitTestCase {

  public function toCrawler($component) {
    return new Crawler($component->toString());
  }

  public function toDomNode($component) {
    return $this->toCrawler($component)
                ->getNode(0)
                ->firstChild
                ->firstChild;
  }

  public function assertHasElement($selector, $node) {
    $node = $this->toCrawler($node);
    $elements = $node->filter($selector);
    $this->assertGreaterThanOrEqual(1, count($elements));
  }

  public function assertDoesntHaveElement($selector, $node) {
    $node = $this->toCrawler($node);
    $elements = $node->filter($selector);
    $this->assertEquals(0, count($elements));
  }

  public function assertHasClass($className, $node) {
    $node = $this->coerceToDomNode($node);
    $this->assertContains($className, $node->getAttribute('class'));
  }

  public function assertDoesntHaveClass($className, $node) {
    $node = $this->coerceToDomNode($node);
    $this->assertNotContains($className, $node->getAttribute('class'));
  }

  private function coerceToDomNode($node) {
    if(!($node instanceof DomNode)) {
      $node = $this->toDomNode($node);
    }

    return $node;
  }

}

