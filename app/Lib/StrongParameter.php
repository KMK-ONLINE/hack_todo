<?hh

namespace App\Lib;

class StrongParameter {

  public function __construct(private array $initialParams, private array $whiteList) {
    $this->initialParams = $initialParams;
    $this->whiteList = $whiteList;
  }

  public function run() {
    $filtered = [];

    foreach($this->whiteList as $key) {
      if(array_key_exists($key, $this->initialParams)) {
        $filtered[$key] = $this->initialParams[$key];
      } else {
        $filtered[$key] = null;
      }
    }

    return $filtered;
  }

}


