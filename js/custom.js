(function() {

  $(document).ready(function() {
    $('#submit').click(function() {
      var email, name, mobile,title,pass,valuelist1,isChecked , name_regex ,email_regex, mobile_regex ,pass_regex;
      name = $('#name').val();
      email = $('#email').val();
      mobile = $('#mobile').val();
      title = $('#title').val();
      valuelist1 = $('#valuelist').val();
      pass = $('#address').val();
      isChecked = $('input[id="checkbox"]:checked').val();
      name_regex = /^[a-zA-Z]{2,25}$/;
      title_regex = /^[a-zA-Z]{2,25}$/;
      email_regex = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-Z0-9]{2,4}$/;
      mobile_regex = /^\(?([0-9]{3})\)?([0-9]{3})?([0-9]{4})$/;
      pass_regex = /^([a-zA-Z0-9_\.\-\/\:\;])+$/;
      if (!name.match(name_regex) || name.length === 0) {
        $('#errormessage1').text('* Please enter your Name *');
        $('#name').css('box-shadow', '0px 0px 6px 1px #ff3333');
        $('#name').focus();
        return false;
      }else if (!email.match(email_regex) || email.length === 0) {
        $('#errormessage2').text('* Please enter a email address *');
        $('#email').css('box-shadow', '0px 0px 6px 1px #ff3333');
        $('#email').focus();
        return false;
      }else if (!mobile.match(mobile_regex) || mobile.length === 0) {
        $('#errormessage3').text('* Please enter your mobile Number *');
        $('#mobile').css('box-shadow', '0px 0px 6px 1px #ff3333');
        $('#mobile').focus();
        return false;
      }else if (!title.match(title_regex) || title.length === 0) {
        $('#errormessage11').text('* Please enter your Team Name *');
        $('#title').css('box-shadow', '0px 0px 6px 1px #ff3333');
        $('#title').focus();
        return false;
      }else if (valuelist1 === 'select your skill') {
        $('#errormessage6').text('* Please Choose your state');
        $('#valuelist').css('box-shadow', '0px 0px 6px 1px #ff3333');
        $('#valuelist').focus();
        return false;
      }else if (!pass.match(pass_regex) || pass.length === 0) {
        $('#errormessage9').text('* Please enter your Password *');
        $('#pass').css('box-shadow', '0px 0px 6px 1px #ff3333');
        $('#pass').focus();
        return false;
      }else if (!isChecked) {
        $('#errormessage10').text('Please select atleast one user ');
        return false;
      }else {
        return true;
      }
    });
  });

  $(document).ready(function() {
    $('#name').click(function() {
      var name, name_regex;
      name = $('#name').val();
      name_regex = /^[a-zA-Z]{2,25}$/;
      if (!name.match(name_regex) || name === '' || name.length === 0) {
        $('#errormessage1').hide();
        $('#name').css({
          'background-color': '#ffffff',
          'box-shadow': 'none',
          'border': '1px solid #00a2de'
        });
      } else {
        return false;
      }
    });
  });

  $(document).ready(function() {
    $('#name').blur(function() {
      var name, name_regex;
      name = $('#name').val();
      name_regex = /^[a-zA-Z]{2,25}$/;
      if (!name.match(name_regex) || name === '' || name.length === 0) {
        $('#errormessage1').show();
        $('#errormessage1').text('* Please enter a valid Name *');
        $('#name').focus();
        $('#name').css('box-shadow', '0px 0px 6px 1px #ff3333');
      } else {
        $('#errormessage1').hide();
        $('#name').addClass('success');
        return false;
      }
    });
  });

  $(document).ready(function() {
    $('#email').click(function() {
      var email, email_regex;
      email = $('#email').val();
      email_regex = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-Z0-9]{2,4}$/;
      if (!email.match(email_regex) || email.length === 0) {
        $('#errormessage2').hide();
        $('#email').css({
          'background-color': '#ffffff',
          'box-shadow': 'none',
          'border': '1px solid #00a2de'
        });
      } else {
        return false;
      }
    });
  });

  $(document).ready(function() {
    $('#email').blur(function() {
      var email, email_regex;
      email = $('#email').val();
      email_regex = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-Z0-9]{2,4}$/;
      if (!email.match(email_regex) || email.length === 0) {
        $('#errormessage2').show();
        $('#errormessage2').text('* Please enter a valid email *');
        $('#email').focus();
        $('#email').css('box-shadow', '0px 0px 6px 1px #ff3333');
      } else {
        $('#errormessage2').hide();
        $('#email').addClass('success');
        return false;
      }
    });
  });

  $(document).ready(function() {
    $('#mobile').click(function() {
      var mobile, mobile_regex;
      mobile = $('#mobile').val();
      mobile_regex = /^\(?([0-9]{3})\)?([0-9]{3})?([0-9]{4})$/;
      if (!mobile.match(mobile_regex) || mobile.length === 0) {
        $('#errormessage3').hide();
        $('#mobile').css({
          'background-color': '#ffffff',
          'box-shadow': 'none',
          'border': '1px solid #00a2de'
        });
      } else {
        return false;
      }
    });
  });

  $(document).ready(function() {
    $('#mobile').blur(function() {
      var mobile, mobile_regex;
      mobile = $('#mobile').val();
      mobile_regex = /^\(?([0-9]{3})\)?([0-9]{3})?([0-9]{4})$/;
      if (!mobile.match(mobile_regex) || mobile.length === 0) {
        $('#errormessage3').show();
        $('#errormessage3').text('* Please enter your 10 digits Mobile Number *');
        $('#mobile').focus();
        $('#mobile').css('box-shadow', '0px 0px 6px 1px #ff3333');
      } else {
        $('#errormessage3').hide();
        $('#mobile').addClass('success');
        return false;
      }
    });
  });

  $(document).ready(function() {
    $('#title').click(function() {
      var title, title_regex;
      title = $('#title').val();
      title_regex = /^[a-zA-Z]{2,25}$/;
      if (!title.match(title_regex) || title === '' || title.length === 0) {
        $('#errormessage11').hide();
        $('#title').css({
          'background-color': '#ffffff',
          'box-shadow': 'none',
          'border': '1px solid #00a2de'
        });
      } else {
        return false;
      }
    });
  });

  $(document).ready(function() {
    $('#title').blur(function() {
      var title, title_regex;
      title = $('#title').val();
      title_regex = /^[a-zA-Z]{2,25}$/;
      if (!title.match(title_regex) || title === '' || title.length === 0) {
        $('#errormessage11').show();
        $('#errormessage11').text('* Please enter a valid Team Name *');
        $('#title').focus();
        $('#title').css('box-shadow', '0px 0px 6px 1px #ff3333');
      } else {
        $('#errormessage11').hide();
        $('#title').addClass('success');
        return false;
      }
    });
  });

$(document).ready(function() {
    $('#valuelist').click(function() {
      var valuelist1;
      valuelist1 = $('#valuelist').val();
      if (valuelist1 === 'select your skill') {
        $('#errormessage6').hide();
        $('#valuelist').css({
          'background-color': '#ffffff',
          'box-shadow': 'none',
          'border': '1px solid #00a2de'
        });
      } else {
        return false;
      }
    });
  });

  $(document).ready(function() {
    $('#valuelist').blur(function() {
      var valuelist1;
      valuelist1 = $('#valuelist').val();
      if (valuelist1 === 'select your skill') {
        $('#errormessage6').show();
        $('#errormessage6').text('* Please select any skill *');
        $('#valuelist').focus();
        $('#valuelist').css('box-shadow', '0px 0px 6px 1px #ff3333');
      } else {
        $('#errormessage6').hide();
        $('#valuelist').addClass('success');
        return false;
      }
    });
  });

  $(document).ready(function() {
    $('#checkbox').click(function() {
      var isChecked;
      isChecked = $('input[id="checkbox"]:checked').val();
      if (isChecked) {
        $('#errormessage10').hide();
      } else {
        return false;
      }
    });
  });


  $(document).ready(function() {
    $('#pass').click(function() {
      var pass, pass_regex;
      pass = $('#pass').val();
      pass_regex = /^([a-zA-Z0-9_\.\-\/])+$/;
      if (!pass.match(pass_regex) || pass.length === 0) {
        $('#errormessage9').hide();
        $('#pass').css({
          'background-color': '#ffffff',
          'box-shadow': 'none',
          'border': '1px solid #00a2de'
        });
      } else {
        return false;
      }
    });
  });

  $(document).ready(function() {
    $('#pass').blur(function() {
      var pass, pass_regex;
      pass = $('#pass').val();
      pass_regex = /^([a-zA-Z0-9_\.\-\/\:\;])+$/;
      if (!pass.match(pass_regex) || pass.length === 0) {
        $('#errormessage9').show();
        $('#errormessage9').text('* Please enter your valid password *');
        $('#pass').focus();
        $('#pass').css('box-shadow', '0px 0px 6px 1px #ff3333');
      } else {
        $('#errormessage9').hide();
        $('#pass').addClass('success');
        return false;
      }
    });
  });
  
}).call(this);