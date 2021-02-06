
var beforeSendExample = function(xhr) {
    xhr.setRequestHeader('X-CSRF-Token', csrf_token);
};

// Create appender that uses beforeSendExample
var appender = JL.createAjaxAppender("CakePHP Appender");
appender.setOptions({
    "beforeSend": beforeSendExample
});

// Get all loggers to use this appender
JL().setOptions({
    "appenders": [appender]
});

