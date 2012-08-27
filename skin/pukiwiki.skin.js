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

  $('li.open a,li.closed a').bind('click', function(e) {
    e.preventDefault();
    location.href = $(this).attr('href');
    return false;
  });

  function pkwk_removeIndex(text) {
    var content = new Array;
    var lines = text.split("\n");

    for (var i in lines) {
      var line = lines[i];

      if (line.match(/^\*\*\*/)) {
        line = line.replace(/^\*\*\*\s*\d+[\.\d]*\s+/, "*** ");
      }
      else if (line.match(/^\*\*/)) {
        line = line.replace(/^\*\*\s*\d+[\.\d]*\s+/, "** ");
      }
      else if (line.match(/^\*/)) {
        line = line.replace(/^\*\s*\d+[\.\d]*\s+/, "* ");
      }
      content.push(line);
    }
    return content.join("\n");
  }

  function pkwk_removeIndexTextArea(elem) {
    elem.value = pkwk_removeIndex(elem.value);
  }

  function pkwk_autoIndexTextArea(elem) {
    var content = new Array;
    var lines = pkwk_removeIndex(elem.value).split("\n");
    var curr_sec = 0;
    var curr_sub_sec = 0;
    var curr_sub_sub_sec = 0;
    for (var i in lines) {
      var line = lines[i];
      if (line.match(/^\*\*\*/)) {
        ++curr_sub_sub_sec;
        line = line.replace(/^\*+\s*/, "");
        line = "*** " + curr_sec + "." + curr_sub_sec + "." + curr_sub_sub_sec + ". " + line;
      }
      else if (line.match(/^\*\*/)) {
        ++curr_sub_sec;
        line = line.replace(/^\*+\s*/, "");
        line = "** " + curr_sec + "." + curr_sub_sec + ". " + line;
        curr_sub_sub_sec = 0;
      }
      else if (line.match(/^\*/)) {
        ++curr_sec;
        line = line.replace(/^\*+\s*/, "");
        line = "* " + curr_sec + ". " + line;
        curr_sub_sec = 0;
        curr_sub_sub_sec = 0;
      }
      content.push(line);
    }
    elem.value = content.join("\n");
  }

  $('#auto-idx').on('click', function(e) {
    e.preventDefault();
    pkwk_autoIndexTextArea($('#msg').get(0));
  });

  $('#rem-idx').on('click', function(e) {
    e.preventDefault();
    pkwk_removeIndexTextArea($('#msg').get(0));
  });

});
