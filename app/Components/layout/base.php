<?hh

class :layout:base extends :x:element {

  attribute string title @required;

  public function render() {
    return
      <x:doctype>
        <html>
          <head>
            <title>{$this->getAttribute('title')}</title>
          </head>
          <body>
            {$this->getChildren()}
          </body>
        </html>
      </x:doctype>;
  }

}

