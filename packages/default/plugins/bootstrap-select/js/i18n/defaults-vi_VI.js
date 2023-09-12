/*!
 * Bootstrap-select v1.11.2 (http://silviomoreto.github.io/bootstrap-select)
 *
 * Copyright 2013-2016 bootstrap-select
 * Licensed under MIT (https://github.com/silviomoreto/bootstrap-select/blob/master/LICENSE)
 */

(function (root, factory) {
  if (typeof define === 'function' && define.amd) {
    // AMD. Register as an anonymous module unless amdModuleId is set
    define(["jquery"], function (a0) {
      return (factory(a0));
    });
  } else if (typeof exports === 'object') {
    // Node. Does not work with strict CommonJS, but
    // only CommonJS-like environments that support module.exports,
    // like Node.
    module.exports = factory(require("jquery"));
  } else {
    factory(jQuery);
  }
}(this, function (jQuery) {

(function ($) {
  $.fn.selectpicker.defaults = {
    noneSelectedText: '',
    noneResultsText: 'Không có kết quả phù hợp {0}',
    countSelectedText: function (numSelected, numTotal) {
      return "{0} dòng được chọn";
    },
    maxOptionsText: function (numAll, numGroup) {
      return [
        'Vượt giới hạn (tối đa {n} dòng)',
        'Nhóm đã vượt giới hạn (tối đa {n} dòng)'
      ];
    },
    selectAllText: 'Chọn tất cả',
    deselectAllText: 'Bỏ chọn tất cả',
    multipleSeparator: '; '
  };
})(jQuery);


}));
