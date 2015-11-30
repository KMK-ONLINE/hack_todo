<?hh

namespace App\Lib;

class StrongParameter {

  private array $initialParams;
  private array $whiteList;
  private boolean $fillMissingWithNull;

  public function __construct($initialParams, $whiteList, $fillMissingWithNull = false) {
    $this->initialParams = $initialParams;
    $this->whiteList = $whiteList;
    $this->fillMissingWithNull = $fillMissingWithNull;
  }

  public function run() {
    $filtered = [];

    foreach($this->whiteList as $key) {
      if(array_key_exists($key, $this->initialParams)) {
        $filtered[$key] = $this->initialParams[$key];
      } else if ($this->fillMissingWithNull) {
        $filtered[$key] = null;
      }
    }

    return $filtered;
  }

}



