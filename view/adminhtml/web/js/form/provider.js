define(['jquery','Magento_Ui/js/form/provider'],function ($,Provider) {
    return Provider.extend({

        save: function (options) {
            var data = this.get('data');
            data.selected_pages = $('input[name=cms_page]').val();
            this.client.save(data, options);

            return this;
        }
    });
});