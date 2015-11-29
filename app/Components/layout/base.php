<?hh

class :layout:base extends :x:element {

  attribute string title @required;

  public function render() {
    return
      <x:doctype>
        <html lang="en" data-framework="react">
          <head>
            <meta charset="utf-8" />
            <title>{$this->getAttribute('title')}</title>
            <link href={elixir('css/app.css')} rel="stylesheet" type="text" />
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.min.js"></script>
            <script>{$this->script()}</script>
          </head>

          <body class="learn-bar">

            <aside class="learn">
              <header>
                <h3>Laravel + XHP</h3>
                <h5>
                  <span class="source-links">Example</span>
                </h5>
                <span class="source-links">
                  <a href="https://github.com/KMK-ONLINE/hack_todo">Source</a>
                </span>
              </header>

              <hr />

              <blockquote class="quote speech-bubble">
                <p>XHP is a PHP5 extension and HHVM feature that augments the syntax of the language such that XML document fragments become valid PHP expressions.</p>
                <footer>
                    <a href="https://github.com/facebook/xhp-lib">xhp-lib</a>
                </footer>
              </blockquote>

              <hr />

              <h4>Official Resources</h4>

              <ul>
                <li><a href="http://laravel.com/docs/5.1/quickstart">Laravel's original quickstart guide</a></li>
                <li><a href="https://github.com/facebook/xhp-lib">Facebook's explaination of XHP</a></li>
              </ul>

              <footer>

                <hr />

                <em>
                  If you have suggestions as to how we can improve this codebase, please <a href="https://github.com/KMK-ONLINE/hack_todo/issues">let us know</a>.
                </em>
              </footer>
            </aside>

            <section class="todoapp">
              {$this->getChildren()}
            </section>

            <footer class="info">
              <p>Double-click to edit a todo</p>
              <p>Created by <a href="http://github.com/kmk-online/">kmk-online</a></p>
              <p>Part of <a href="http://todomvc.com">TodoMVC</a></p>
            </footer>

          </body>
        </html>
      </x:doctype>;
  }

  public function script() {
    return <<<SCRIPT
$(document).ready(function() {
  var listItems = $('ul.todo-list > li');

  listItems.dblclick(function() {
    $(this).addClass('editing');
  });

  $('input.toggle-all').click(function() {
    var listItemCheckboxes = $('input[type=checkbox]', listItems);
    listItemCheckboxes.prop('checked', $(this).is(':checked'));
  });

});
SCRIPT;
  }

}

