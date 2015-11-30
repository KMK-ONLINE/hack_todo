# KMK • TodoMVC

Feature Complete:
  - clear completed

  - pretty errors
  - complete all todos

TODO:
  - service pattern
  - request test -> acceptance test w/selenium / headless
  - update larator

Nice To Have:
  - $this->assertResponseStatus(302); shows the error message if it does not match the status
  get this shit out:
    <div class="block">
                            <ol class="traces list_exception">
       <li> in <a title="/vagrant/hack_todo/vendor/laravel/framework/src/Illuminate/Database/Eloquent/Model.php line 424" ondblclick="var f=this.innerHTML;this.innerHTML=this.title;this.title=f;">Model.php line 424</a></li>
       <li>at <abbr title="Illuminate\Database\Eloquent\Model">Model</abbr>->fill(<em>array</em>('name' => 'Feed Cat', 'completed' => <em>true</em>)) in <a title="/vagrant/hack_todo/app/Http/Controllers/TaskController.php line 51" ondblclick="var f=this.innerHTML;this.innerHTML=this.title;this.title=f;">TaskController.php line 51</a></li>

