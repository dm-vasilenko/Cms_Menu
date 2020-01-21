define(['jquery','Magento_Ui/js/form/provider'],function ($,Provider) {
    return Provider.extend({

        save: function (options) {
            var a = [];
            var gr = document.getElementsByName('selected_pages');
            for(var i = 0; i < gr.length; i++) {
                if (gr[i].checked) {
                    if(gr[i].value !== 'on'){
                        a.push(gr[i].value);
                    }
                }
            }
            document.getElementsByName('cms_page')[0].value = a.join('&');

            var data = this.get('data');
            data.selected_pages = $('.grid_container input[name=cms_page]').val();
            this.client.save(data, options);

            return this;
        },

    });
});