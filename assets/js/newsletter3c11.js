class Newsletter
{
    static init(opts)
    {
        $.post('/newsletter/modal.html', opts, response => {
            if(response.success)
            {
                const modal = $(response.data);
                const form = modal.find('form');

                form.on('submit', e => {
                    e.preventDefault();

                    $.post(form.attr('action'), form.serializeArray(), result => {
                        if(result.success)
                        {
                            modal.find('.success-message').removeClass('hidden').slideDown();
                        }
                        else
                        {
                            alert(result.details);
                        }
                    });

                    _dataLayer('form_register_newsletter');
                });

                $('body').append(modal);

                $('#modal-newsletter').pty_modal();

                $('a[href="#open-newsletter-modal"]').on('click', e => {
                    e.preventDefault();
                    $('#modal-newsletter').pty_modal('show');
                });
            }
        });
    }
}

$(document).ready(e => {
    Newsletter.init({
        token: _APP.frontend.token,
        lang: _APP.frontend.language,
    });
});