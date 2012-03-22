jQuery(document).ready(function($){
  //
  // Menu Bar
  //
  $('#toggle-menubar').on('click', function(e){
    e.preventDefault();
    if ($('#menubar').css('display') == 'none') {
      $('#contents').removeClass('col_12').addClass('col_8');
      $('#menubar').css('display', 'inherit');
    }
    else {
      $('#menubar').css('display', 'none');
      $('#contents').removeClass('col_8').addClass('col_12');
    }
  });

  //
  // Toggle Tree
  //
  /*
  function imbueToggleTree() {
    return function (elem, is_open) {
      elem.removeClass('toggle-tree-closed').addClass('toggle-tree');
      elem.children('li').addClass('bullet');
      var parents = elem.children('li:has(ul)');
      if (parents.length > 0) {
        parents.removeClass('bullet').addClass(is_open ? 'open' : 'closed');
        arguments.callee(parents.children('ul'), is_open);
      }
    };
  }

  imbueToggleTree()($('.toggle-tree'), true);
  imbueToggleTree()($('.toggle-tree-closed'), false);

  $('li.open,li.closed').bind('click', function(e) {
    e.preventDefault();
    if ($(this).hasClass('open')) {
      $(this).removeClass('open').addClass('closed');
      return false;
    } else {
      $(this).removeClass('closed').addClass('open');
      return false;
    }
  });
  */
});
