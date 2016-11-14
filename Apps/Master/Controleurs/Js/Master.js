
Master = function(){};
Master.prototype = {
    eventListeners: function () {
        var This = this;

        $('button').click( function () {
            var textToEncrypt, blockSize;
            textToEncrypt= $('.message').val();
            blockSize= $('.size').val();
            This.scriptsConnection(textToEncrypt, blockSize);
        })

    },

    scriptsConnection: function (textToEncrypt, blockSize) {
        $.ajax({
            type: "POST",
            url: '../S/Master/encryption',
            data: {'textToEncrypt' : textToEncrypt,
                    'blockSize' : blockSize
                    },
            crossDomain: true,
            success: function (data) {
                $('.encrypted-msg').html('Encryt: ' + data);
            }
        });
    },

    init: function () {
        this.eventListeners();
    }
};