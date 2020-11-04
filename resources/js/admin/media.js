var el = document.getElementById('image-cropper');
var w = el.closest('.card-body').innerWidth;
var h = window.innerHeight;

var resize = new Croppie(el, {
    viewport: { width: 800, height: 600 },
    boundary: { width: w, height: h },
    showZoomer: true,
    enableResize: true,
    enableOrientation: false,
    mouseWheelZoom: 'ctrl',
});


async function getResult(callback = null) {
    resize.result('blob').then(function(blob) {
        document.getElementById('image-preview').setAttribute('src', URL.createObjectURL(blob));
        if (callback) callback();

        return blob;
    });
}

function sendResult(blob, override) {

    resize.result('blob').then(function(blob) {

        // Create artificial form
        var fd = new FormData();

        fd.append('data', blob);
        fd.append('type', 'blob');

        // Override existing file
        if (override === true) {
            fd.append('fname', fname);
        }

        // Make ajax request
        $.ajax({
            type: 'POST',
            url: endpoint,
            data: fd,
            processData: false,
            contentType: false
        }).done(function(data) {
            if (typeof data.id !== 'undefined') {
                var url = newFileUrl.replace("X", data.id);
                window.open(url, '_self');
            } else {
                location.reload();
            }
        });

    });
}


document.getElementById('save-image').onclick = async function(e) {
    e.preventDefault();
    sendResult(true);
};

document.getElementById('save-as').onclick = async function(e) {
    e.preventDefault();
    sendResult(false);
};


$(document).ready(function() {
    $('#preview-image').click(function(e) {
        e.preventDefault();
        getResult(function() {
            $('#fade').fadeIn(1000);
        });
    });

    $('#image-preview-close').click(function(e) {
        e.preventDefault();
        $('#fade').fadeOut(1000);
    });
});


