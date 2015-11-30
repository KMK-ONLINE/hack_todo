<?hh

namespace Components\Task;

use ComponentTestCase;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Collection;

class FooterTest extends ComponentTestCase {

  public function test_has_filters() {
    $collection = new Collection();

    $component = <task:footer />;
    $dom = $this->toCrawler($component);

    $this->assertEquals(1, count($dom->filter('a[href*="?filter=active"]')));
    $this->assertEquals(1, count($dom->filter('a[href*="?filter=completed"]')));
  }

  public function test_selected_class_on_active_filter() {
    Input::replace(['filter' => 'completed']);

    $collection = new Collection();
    $component = <task:footer />;

    $dom = $this->toCrawler($component);
    $this->assertEquals(1, count($dom->filter('a.selected')));

    $activeFilter = $dom->filter('a.selected')->first();
    $this->assertContains('completed', $activeFilter->attr('href'));
  }

}
