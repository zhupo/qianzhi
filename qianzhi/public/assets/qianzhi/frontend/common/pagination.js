define([], function() {
  
  $.fn.pagination = function (opt) {
    let {
      size = 10,
      num = 0,
      total = 0,
      onChange
    } = opt
    let pages = Math.floor(total / size)
    if (!total || !pages || !size) { return }
    const $this = $(this)
    $this.addClass('.pagination')
    const maxVisibleSize = 6
    let children = []
    const $prev = $(`<li class="prev disabled"><a href="javascript: void(0)" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>`)
    const $next = $(`<li class="next"><a href="javascript: void(0)" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>`)
    if (maxVisibleSize >= num) {
      children = Array(num).fill('').map((item, index) => 
        `<li class="${num === index ? 'active' : ''}"><a href="javascript: void(0)">${index + 1}</a></li>`
      )
    } else {
      
    }
  }


  return $
});