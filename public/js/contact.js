// preload img
$.preload( '/img/loading.gif' );

$( function(){

  var en = {
    name : 'We need to know who you are.',
    email : 'We need to know how to reply you.',
    email_format : 'The email format is incorrect.',
    comments : 'Are you sure you want to leave your comments empty?',
    sent : 'Your comments have been sent, thank you!',
    error : 'We are having problems sending your comments, please try again later :3'
  },

  tw = {
    name : '請填寫您的名字.',
    email : '請填寫您的電子郵件.',
    email_format : '您輸入的電子郵件格式錯誤.',
    comments : '請填寫您的意見.',
    sent : '您的意已經送出，謝謝!',
    error : '寄送郵件發生錯誤，請稍後在試 :3'
  },

  // get current lang and set what lang to use in the validatiaon
  lang = $.secret( 'out' ,'lang' ) == 'en' ? en : tw,

  validate_rules = {
    name : {
      required : true
    },
    email : {
      required : true,
      email : true
    },
    comments : {
      required : true
    }
  },

  validate_msg = {
    name : {
      required : lang.name
    },
    email : {
      required : lang.email,
      email : lang.email_format
    },
    comments : {
      required : lang.comments
    }
  },

  send = function(){
    $form.ajaxSubmit({
      target : '#jquery-msg-content',
      url : '/contact/send',
      dataType : 'json',
      success : function( rsp ){
        // set msg to success or error by the ajax reponse
        var msg = rsp[ 'success' ] == true ?
          lang.sent :
          lang.error;

        // display msg and unblock the screen after 3 second
        $.msg( 'replace', msg ).
          msg( 'unblock', 3000, 1 );
      }
    });

  },

  // cache DOM el
  $form = $( '#email-form' );

// --- execute -----------------------------------------------------------------

  // form validation
  $form.validate({
    rules : validate_rules,
    messages : validate_msg,
    submitHandler : function(){
      $.msg({
        autoUnblock : false,
        afterBlock : send,
        // clear input values before unblock screen
        beforeUnblock : function(){
          $form.clearForm();
        },
        bgPath: '/img/',
        // set default content to a loading img
        content : '<img src="/img/loading.gif"/>',
        msgID : 1
      });
    }
  });

  // btn mousedown effect
  $( '.btn' ).bind( 'mousedown', function(){
    $( this ).addClass( 'btn_down' );
  }).bind( 'mouseup', function(){
    $( this ).removeClass( 'btn_down' );
  }).bind( 'mouseout', function(){
    $( this ).removeClass( 'btn_down' );
  });

});