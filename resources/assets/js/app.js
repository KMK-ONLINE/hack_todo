$(document).ready(function() {
  var listItems = $('ul.todo-list > li');

  listItems.dblclick(function() {
    $(this).addClass('editing');
  });

  $('input.toggle-all').click(function() {
    alert('Not-Yet-Supported... this needs to submit on its own, not toggle the select boxes below.');

    var listItemCheckboxes = $('input[type=checkbox]', listItems);
    listItemCheckboxes.prop('checked', $(this).is(':checked'));
  });

  $('input[type=checkbox]', listItems).click(function() {
    $(this).parents('form').submit(); 
  });

});

