var theme;
const chk = document.getElementById('chk');
$(function(){
  var test = localStorage.input === 'true'? true: false;
  $('input').prop('checked', test || false);
});

$('input').on('change', function() {
  localStorage.input = $(this).is(':checked');
  console.log("is checked?:");
  console.log($(this).is(':checked'));
});

chk.addEventListener('change', () => {
  document.cookie = 'theme=' +''+ ';expires=Thu, 01 Jan 1970 00:00:00 UTC;';
  var endDate = new Date();
  endDate.setFullYear(endDate.getFullYear() + 10);

  if ($('body').hasClass('lighto')) {
    document.body.classList.remove('lighto');
    document.body.classList.toggle('dark');
    document.cookie = 'theme=' + 'dark' +
                                '; Expires=' + endDate + ';'
  } 
  else 
  {
    document.body.classList.remove('dark');
    document.body.classList.toggle('lighto');
    document.cookie = 'theme=' + 'lighto' +
                                '; Expires=' + endDate + ';'
  }
  console.log("body tag has dark class?:");
  console.log($('body').hasClass('dark') );
  console.log("body tag has lighto class?:");
  console.log($('body').hasClass('lighto') );
  console.log("is dark selected ?:");
  console.log( document.cookie.match(/theme=dark/i) ? 'dark' : "lighto");
});

function isDarkThemeSelected() {
  return document.cookie.match(/theme=dark/i) != null;
}

function setThemeFromCookie() {
  document.body.classList.toggle(isDarkThemeSelected() ? 'dark':'lighto')
}

(function() {
    setThemeFromCookie()

})();