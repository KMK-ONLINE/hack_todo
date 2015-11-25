<?hh

class :home extends :x:element {

  attribute string name @required;

  protected function render() {
    return
      <layout:base title="Hello Title">
        Hello {$this->getAttribute('name')}!
        <strong>This is a test</strong>
      </layout:base>;
  }

}
